<?php

namespace App\Services;

use App\Models\Event;

class ExpenseCalculator
{
  public static function getBalance(Event $event)
  {
    return collect($event->users)->map(
      function ($user) use ($event) {
        $positive = (int) collect($event->expenses)
          ->filter(fn ($expense) => $expense->user_id === $user->id)
          ->reduce(fn ($total, $curr) => $total + $curr->amount, 0);

        $negative = (int) collect($event->expenses)
          ->filter(fn ($expense) => $expense->users->pluck('id')->contains($user->id))
          ->reduce(
            fn ($total, $contributedExpense) =>
            $total + $contributedExpense->amount / $contributedExpense->users->count(),
            0
          );

        $user->balance = $positive - $negative;

        return $user;
      }
    );
  }

  public static function getResult($users)
  {
    return $users->map(function ($user) use ($users) {
      if ($user->balance <= 0) {
        return $user;
      }
      $debtors = $users->filter(fn ($user) => $user->balance < 0);

      $incoming = collect([]);

      $debtors->each(function ($debtor) use ($user, &$incoming) {
        if ($user->balance > 0 && $debtor->balance < 0) {
          $amount = min(abs($debtor->balance), $user->balance);
          $incoming = collect([...$incoming, ['id' => $debtor->id, 'amount' => $amount]]);
          $debtor->balance = $debtor->balance + $amount;
          $debtor->outgoing = collect([...($debtor->outgoing ?? []), ['id' => $user->id, 'amount' => $amount]]);
          $user->balance = $user->balance - $amount;
        }
      });

      $user->incoming = $incoming;
      return $user;
    });
  }

  public static function calculate(Event $event)
  {
    $balance = self::getBalance($event);

    return self::getResult($balance);
  }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if (request()->user()->cannot('view', $event)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $event->load('creator');

        return view('pages.events.show', ['event' => $event]);
    }

    public function getBalance(Event $event)
    {
        return collect($event->users)->map(
            function (User $user) use ($event) {
                $positive = (int) collect($event->expenses)
                    ->filter(fn (Expense $expense) => $expense->user_id === $user->id)
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

    public function getResult($users)
    {
        return $users->map(function ($user) use ($users) {
            if ($user->balance <= 0) {
                return $user;
            }
            $debtors = $users->filter(fn ($user) => $user->balance < 0);

            $incoming = [];

            $debtors->each(function ($debtor) use ($user, &$incoming) {
                if ($user->balance > 0 && $debtor->balance < 0) {
                    $amount = min(abs($debtor->balance), $user->balance);
                    $incoming = [...$incoming, ['id' => $debtor->id, 'amount' => $amount]];
                    $debtor->balance = $debtor->balance + $amount;
                    $debtor->outgoing = [...($debtor->outgoing ?? []), ['id' => $user->id, 'amount' => $amount]];
                    $user->balance = $user->balance - $amount;
                }
            });

            $user->incoming = $incoming;
            return $user;
        });
    }

    public function result(Event $event)
    {
        $balance = $this->getBalance($event);
        $users = $this->getResult($balance);

        return view('pages.events.result', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (request()->user()->cannot('view', $event)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEventRequest  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Mail\AddedToEvent;
use App\Models\Event;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEventRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->all());

        $event = Event::create([
            'title' => $request->input('title'),
            'user_id' => $request->user()->id
        ]);

        $event->users()->attach($request->user()->id);

        Mail::to($request->email)->send(new AddedToEvent(request()->user(), $event));

        return to_route('events.show', $event->id);
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

    public function result(Event $event)
    {
        $balance = $this->getBalance($event);
        $users = $this->getResult($balance);

        return view('pages.events.result', ['users' => $users, 'event' => $event]);
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

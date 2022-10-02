<?php

namespace App\Http\Controllers;

use App\Http\Requests\CloseEventRequest;
use App\Http\Requests\OpenEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Mail\AddedToEvent;
use App\Mail\EventClosed;
use App\Models\Event;
use App\Models\InvitedUser;
use App\Models\User;
use App\Services\ExpenseCalculator;
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
    public function store(StoreEventRequest $request)
    {
        $event = Event::create([
            'title' => $request->validated()['title'],
            'user_id' => $request->user()->id
        ]);

        $event->users()->attach($request->user()->id);

        collect($request->validated()['emails'])->each(
            function ($email) use ($event) {
                if ($user = User::whereEmail($email)->first()) {
                    $event->users()->attach($user->id);
                } else {
                    InvitedUser::create([
                        'email' => $email,
                        'event_id' => $event->id,
                    ]);
                }

                Mail::to($email)->send(new AddedToEvent(request()->user(), $event));
            }
        );

        return to_route('events.show', $event->id);
    }

    public function invite(Event $event, Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->input('email');

        InvitedUser::create([
            'email' => $email,
            'event_id' => $event->id,
        ]);

        Mail::to($email)->send(new AddedToEvent(request()->user(), $event));

        return to_route('events.show', ['event' => $event]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Request $request)
    {
        $invitedUserWithEmail = InvitedUser::where([
            'email' => $request->user()->email,
            'event_id' => $event->id
        ])->first();

        if ($invitedUserWithEmail) {
            $event->users()->attach($request->user()->id);
            $invitedUserWithEmail->delete();
        }

        if (request()->user()->cannot('view', $event)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }


        $event->load('creator', 'users', 'invitedUsers');

        return view('pages.events.show', ['event' => $event]);
    }

    public function result(Event $event)
    {
        $users = ExpenseCalculator::calculate($event);

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

    public function close(Event $event, CloseEventRequest $request)
    {
        $event->update(['closed_at' => now()]);

        $event->users->each(function ($user) use ($event) {
            Mail::to($user->email)->send(new EventClosed($event, $user->email));
        });

        return to_route('events.show', $event->id);
    }

    public function open(Event $event, OpenEventRequest $request)
    {
        $event->update(['closed_at' => null]);

        return to_route('events.show', $event->id);
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

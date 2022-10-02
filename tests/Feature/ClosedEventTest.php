<?php

use App\Models\Event;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('can close an event', function () {
    $user = actingAs();

    $event = Event::factory()
        ->create(['user_id' => $user->id]);

    $event->users()->attach($user->id);

    post(route('events.close', $event))->assertRedirect(route('events.show', $event));
});

it('displays a closed event in the interface', function () {
    $user = actingAs();

    $event = Event::factory()
        ->create(['user_id' => $user->id, 'closed_at' => now()]);

    $event->users()->attach($user->id);

    get(route('events.show', $event->id))->assertSee('Closed');
});

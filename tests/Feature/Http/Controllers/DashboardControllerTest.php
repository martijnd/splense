<?php

use App\Models\Event;
use App\Models\User;

it('should display a list of events', function () {
    $user = User::factory()
        ->has(Event::factory()->count(1))
        ->create();

    $response = actingAs($user)->get('/');

    $response->assertStatus(200)
        ->assertSee($user->events()->first()->title);
});

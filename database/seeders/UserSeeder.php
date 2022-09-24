<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventUser;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        $user = User::factory()->create([
            'email' => 'martijn.dorsman@gmail.com',
            'name' => 'Martijn Dorsman'
        ]);

        // Create 5 users
        $users = collect([$user, ...User::factory(4)->create()]);

        // Create an event and attach 5 users to it
        $event = Event::factory()
            ->create(['user_id' => $user->id]);
        $event->users()->attach($users->pluck('id'));
        $expenses = Expense::factory(5)
            ->sequence(fn ($sequence) => ['user_id' => $users[$sequence->index]->id])
            ->create(['event_id' => $event->id]);

        // Add all users as participants to the expenses
        $expenses->each(fn ($expense) => $expense->participants()->attach($users->pluck('id')));

        // $user = User::factory()
        //     ->has(
        //         Event::factory()
        //             ->count(3)
        //             ->has(
        //                 Expense::factory()
        //                     ->count(10)
        //                     ->has(
        //                         User::factory()->count(5),
        //                         'participants'
        //                     ),
        //             )
        //             ->state(function ($attributes, User $user) {
        //                 return ['user_id' => $user->id];
        //             })
        //     )
        //     ->create([
        //         'email' => 'martijn.dorsman@gmail.com',
        //         'name' => 'Martijn Dorsman'
        //     ]);
    }
}

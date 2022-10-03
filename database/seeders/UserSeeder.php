<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
        $event = Event::factory()
            ->create(['user_id' => $user->id]);

        if (App::environment('production')) {
            return;
        }

        // Create 5 users
        $users = collect([$user, ...User::factory(9)->create()]);

        // Create an event and attach 5 users to it
        $event->users()->attach($users->pluck('id'));
        $expenses = Expense::factory(5)
            ->sequence(fn ($sequence) => ['user_id' => $users[$sequence->index]->id])
            ->create(['event_id' => $event->id]);

        // Add all users as participants to the expenses
        $expenses->each(fn ($expense) => $expense->users()->attach($users->pluck('id')));
    }
}

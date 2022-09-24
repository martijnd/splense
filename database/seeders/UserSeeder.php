<?php

namespace Database\Seeders;

use App\Models\Event;
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
        $user = User::factory()
            ->has(
                Event::factory()
                    ->count(3)
                    ->has(
                        Expense::factory()
                            ->count(10)
                            ->has(
                                User::factory()->count(5),
                                'participants'
                            ),
                    )
                    ->state(function ($attributes, User $user) {
                        return ['user_id' => $user->id];
                    })
            )
            ->create([
                'email' => 'martijn.dorsman@gmail.com',
                'name' => 'Martijn Dorsman'
            ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Event as ModelsEvent;
use App\Models\User;
use Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()
            ->has(ModelsEvent::factory()->count(3))
            ->create([
                'email' => 'martijn.dorsman@gmail.com',
                'name' => 'Martijn Dorsman'
            ]);

        User::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory()->create([
             'name' => 'Test',
             'email' => 'test@example.com',
             'password' => bcrypt('1234password'),
         ]);

        Worker::factory(5)->create();
    }
}

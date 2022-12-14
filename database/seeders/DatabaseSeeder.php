<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create(['email' => 'admin@admin.com','user_type' => User::ROLE_ADMIN]);

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}

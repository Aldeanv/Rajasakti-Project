<?php

namespace Database\Seeders;

use App\Models\Participant;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Program;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Alvito Deannova',
            'email' => 'alvitodennova@gmail.com',
            'username' => 'Aldeanv',
            'password' => '12344444',
            'is_admin' => '1'
        ]);
    }
}

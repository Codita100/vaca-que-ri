<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Enache',
            'email' => 'corinae@createdirect.ro',
            'password' => bcrypt('Teamor123'),
            'token' => Str::random(16),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'alfaisal',
            'email' => 'alfaisal@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'phone' => fake()->phoneNumber(),
            'roles' => 'ADMIN',
            'remember_token' => Str::random(10),
        ]);
    }
}

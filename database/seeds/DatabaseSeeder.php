<?php

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
        \App\User::query()->create([
            'name' => 'admin',
            'image' => 'sad',
            'email' => 'admin@admin.com',
            'address' => 'sad',
            'contact' => 'sad',
            'role' => 'admin',
            'gender' => 'male', 'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);
    }
}

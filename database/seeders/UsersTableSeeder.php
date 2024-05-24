<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Maate Reagan',
            'email' => 'mugreagan@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Administrator'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jass Admin',
            'email' => 'jass@gmail.com',
            'password' => 'password',
        ]);
    }
}

<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'User',
            'phone' => '01710011223',
            'email' => 'user@gmail.com',
            'password' => bcrypt('user@gmail.com'),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'first_name' => 'Digital',
            'last_name' => 'Flos',
            'email' => 'test@test.com',
            'role_id' => 1,
            'password' => Hash::make('123456'),
        ]);

        
    }
}

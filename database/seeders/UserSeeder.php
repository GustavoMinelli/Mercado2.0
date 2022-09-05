<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' =>'Sysout',
            'email' => 'admin@sysout.com',
            'password' => Hash::make('sysout'),
            'role' => 1,
        ]);


    }
}

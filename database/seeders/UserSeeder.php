<?php

namespace Database\Seeders;

use App\Models\Manager;
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
    public function run() {
        // $manager = Manager::first();
        // User::insert([

        //     'manager' => $manager->id,
        //     'email' => 'admin@sysout.com',
        //     'password' => Hash::make('123456789'),
        // ]);

            User::insert([

                // 'name' =>'Sysout',
                'email' => 'admin@sysout.com',
                'password' => Hash::make('sysout'),

            ]);


    }
}

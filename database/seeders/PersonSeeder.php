<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = [
            'name' => 'Sysout',
            'updated_at' => now(),
            'created_at' => now(),
        ];

        Person::insert($person);
    }
}

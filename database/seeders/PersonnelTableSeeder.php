<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonnelTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('personnel')->insert([
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'johndoe@gmail.com',
                'phone_number' => '09123456789',
                'department' => 'Electrical',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'janesmith@gmail.com',
                'phone_number' => '09234567890',
                'department' => 'Plumbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michaeljohnson@gmail.com',
                'phone_number' => '09345678901',
                'department' => 'Air-conditioning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Emily',
                'last_name' => 'Brown',
                'email' => 'emilybrown@gmail.com',
                'phone_number' => '09456789012',
                'department' => 'Structural',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

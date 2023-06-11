<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'user_type' => 'tenant',
                'first_name' => 'David',
                'last_name' => 'Johnson',
                'email' => 'davidjohnson@gmail.com',
                'phone' => '09567890123',
                'profile_picture' => 'david.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/david.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'tenant',
                'first_name' => 'Sarah',
                'last_name' => 'Wilson',
                'email' => 'sarahwilson@gmail.com',
                'phone' => '09678901234',
                'profile_picture' => 'sarah.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/sarah.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'tenant',
                'first_name' => 'Daniel',
                'last_name' => 'Anderson',
                'email' => 'danielanderson@gmail.com',
                'phone' => '09789012345',
                'profile_picture' => 'daniel.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/daniel.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'tenant',
                'first_name' => 'Olivia',
                'last_name' => 'Miller',
                'email' => 'oliviamiller@gmail.com',
                'phone' => '09890123456',
                'profile_picture' => 'olivia.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/olivia.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'tenant',
                'first_name' => 'Matthew',
                'last_name' => 'Taylor',
                'email' => 'matthewtaylor@gmail.com',
                'phone' => '09901234567',
                'profile_picture' => 'matthew.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/matthew.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'tenant',
                'first_name' => 'Sophia',
                'last_name' => 'Clark',
                'email' => 'sophiaclark@gmail.com',
                'phone' => '09012345678',
                'profile_picture' => 'sophia.jpg',
                'profile_picture_path' => 'storage/profiles/personnel/sophia.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

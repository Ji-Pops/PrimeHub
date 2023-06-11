<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            [
                'unit_number' => '102-B',
                'unit_name' => 'Charming Blissful Retreat',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '103-B',
                'unit_name' => 'Elegant Serene Oasis',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '201-A',
                'unit_name' => 'Enchanting Tranquil Haven',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '201-B',
                'unit_name' => 'Idyllic Peaceful Retreat',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '202-B',
                'unit_name' => 'Quaint Serene Hideaway',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'unit_number' => '203-C',
                'unit_name' => 'Tranquil Blissful Escape',
                'contacts_tenant_id' => '14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

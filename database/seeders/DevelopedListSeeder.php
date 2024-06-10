<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopedListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('developed_lists')->insert([
            'item_name' => 'Megalos',
            'description' => 'Blablaal'
        ]);

        DB::table('developed_lists')->insert([
            'item_name' => 'External Login Page',
            'description' => 'Blablaal'
        ]);

        DB::table('developed_lists')->insert([
            'item_name' => 'Mikrotik Login Page',
            'description' => 'Blablaal'
        ]);

        DB::table('developed_lists')->insert([
            'item_name' => 'Server',
            'description' => 'Blablaal'
        ]);

        DB::table('developed_lists')->insert([
            'item_name' => 'Socmed',
            'description' => 'Blablaal'
        ]);

        DB::table('developed_lists')->insert([
            'item_name' => 'Mikrotik Routing',
            'description' => 'Blablaal'
        ]);
    }
}

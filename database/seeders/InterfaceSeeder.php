<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterfaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('interfacings')->insert([
            'interfacing_name' => 'No PMS',
            'description' => 'Not connect any PMS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'VHP',
            'description' => 'Http request method',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'Opera',
            'description' => 'Sharing csv',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'Realta',
            'description' => 'Http request method',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'Pyxis',
            'description' => 'Http request method',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'Rhapsody',
            'description' => 'Cloud on premise',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('interfacings')->insert([
            'interfacing_name' => 'Power Pro',
            'description' => 'Fias protocol',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

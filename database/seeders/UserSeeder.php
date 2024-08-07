<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Arjunstein',
            'email' => 'arjun@varnion.com',
            'password' => bcrypt('arjun'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

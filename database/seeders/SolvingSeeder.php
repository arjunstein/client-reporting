<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolvingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = DB::table('clients')->pluck('id')->toArray();
        $developedLists = DB::table('developed_lists')->pluck('id')->toArray();
        $requests = DB::table('requests')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('solvings')->insert([
                'client_id' => $clients[array_rand($clients)],
                'developed_id' => $developedLists[array_rand($developedLists)],
                'request_id' => $requests[array_rand($requests)],
                'resolving' => 'Resolving details for solving ' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

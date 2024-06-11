<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $statuses = ['In Queue', 'On Process', 'Waiting Client Confirm', 'Done'];
        $clients = DB::table('clients')->pluck('id')->toArray(); // Assuming you have clients in your database

        for ($i = 0; $i < 50; $i++) {
            $startDate = Carbon::now()->startOfYear()->addDays(rand(0, now()->startOfYear()->diffInDays(now())));
            $finishDate = $startDate->copy()->addDays(rand(1, now()->diffInDays($startDate)));


            DB::table('requests')->insert([
                'issue' => $faker->sentence(),
                'client_id' => $clients[array_rand($clients)],
                'status' => $statuses[array_rand($statuses)],
                'request_date' => $startDate,
                'finish_date' => $finishDate,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

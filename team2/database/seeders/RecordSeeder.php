<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('records')->insert([
            ['u_id' => 3, 'symptom_id' => '1', 'created_at' => '20231219000000']
            , ['u_id' => 3, 'symptom_id' => '2', 'created_at' => '20231219000000']
            , ['u_id' => 3, 'symptom_id' => '3', 'created_at' => '20231219000000']
            , ['u_id' => 3, 'symptom_id' => '4', 'created_at' => '20231219000000']
            , ['u_id' => 3, 'symptom_id' => '5', 'created_at' => '20231219000000']
            , ['u_id' => 3, 'symptom_id' => '6', 'created_at' => '20231218000000']
            , ['u_id' => 3, 'symptom_id' => '7', 'created_at' => '20231221000000']
            , ['u_id' => 3, 'symptom_id' => '8', 'created_at' => '20231221000000']
            , ['u_id' => 3, 'symptom_id' => '9', 'created_at' => '20231221000000']
            , ['u_id' => 3, 'symptom_id' => '10', 'created_at' => '20231221000000']
        ]);
    }
}

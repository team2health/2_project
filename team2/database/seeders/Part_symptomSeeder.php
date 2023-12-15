<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Part_symptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('part_symptoms')->insert([
            ['symptom_id' => '1', 'part_id' => '1']
            , ['symptom_id' => '1', 'part_id' => '2']
            , ['symptom_id' => '1', 'part_id' => '3']
            , ['symptom_id' => '1', 'part_id' => '30']
            , ['symptom_id' => '1', 'part_id' => '33']
            , ['symptom_id' => '2', 'part_id' => '4']
            , ['symptom_id' => '2', 'part_id' => '5']
            , ['symptom_id' => '2', 'part_id' => '6']
            , ['symptom_id' => '2', 'part_id' => '31']
            , ['symptom_id' => '2', 'part_id' => '32']
            , ['symptom_id' => '2', 'part_id' => '33']
            , ['symptom_id' => '2', 'part_id' => '34']
            , ['symptom_id' => '3', 'part_id' => '7']
            , ['symptom_id' => '3', 'part_id' => '8']
            , ['symptom_id' => '3', 'part_id' => '9']
            , ['symptom_id' => '4', 'part_id' => '10']
            , ['symptom_id' => '4', 'part_id' => '11']
            , ['symptom_id' => '4', 'part_id' => '12']
            , ['symptom_id' => '4', 'part_id' => '29']
            , ['symptom_id' => '4', 'part_id' => '31']
            , ['symptom_id' => '4', 'part_id' => '32']
            , ['symptom_id' => '4', 'part_id' => '34']
            , ['symptom_id' => '5', 'part_id' => '14']
            , ['symptom_id' => '5', 'part_id' => '15']
            , ['symptom_id' => '5', 'part_id' => '16']
            , ['symptom_id' => '6', 'part_id' => '13']
            , ['symptom_id' => '6', 'part_id' => '30']
            , ['symptom_id' => '8', 'part_id' => '22']
            , ['symptom_id' => '8', 'part_id' => '23']
            , ['symptom_id' => '8', 'part_id' => '24']
            , ['symptom_id' => '8', 'part_id' => '25']
            , ['symptom_id' => '8', 'part_id' => '26']
            , ['symptom_id' => '8', 'part_id' => '27']
            , ['symptom_id' => '8', 'part_id' => '28']
            , ['symptom_id' => '8', 'part_id' => '31']
            , ['symptom_id' => '8', 'part_id' => '35']
            , ['symptom_id' => '9', 'part_id' => '17']
            , ['symptom_id' => '9', 'part_id' => '18']
            , ['symptom_id' => '9', 'part_id' => '19']
            , ['symptom_id' => '9', 'part_id' => '29']
            , ['symptom_id' => '10', 'part_id' => '20']
            , ['symptom_id' => '10', 'part_id' => '21']
            , ['symptom_id' => '10', 'part_id' => '29']
            , ['symptom_id' => '10', 'part_id' => '31']
        ]);
    }
}

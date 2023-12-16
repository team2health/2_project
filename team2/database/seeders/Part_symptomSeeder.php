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
            ['part_symptom_id' => '1', 'symptom_id' => '1', 'part_id' => '1']
            , ['part_symptom_id' => '2', 'symptom_id' => '2', 'part_id' => '1']
            , ['part_symptom_id' => '3', 'symptom_id' => '3', 'part_id' => '1']
            , ['part_symptom_id' => '4', 'symptom_id' => '30', 'part_id' => '1']
            , ['part_symptom_id' => '5', 'symptom_id' => '33', 'part_id' => '1']
            , ['part_symptom_id' => '6', 'symptom_id' => '4', 'part_id' => '2']
            , ['part_symptom_id' => '7', 'symptom_id' => '5', 'part_id' => '2']
            , ['part_symptom_id' => '8', 'symptom_id' => '6', 'part_id' => '2']
            , ['part_symptom_id' => '9', 'symptom_id' => '31', 'part_id' => '2']
            , ['part_symptom_id' => '10', 'symptom_id' => '32', 'part_id' => '2']
            , ['part_symptom_id' => '11', 'symptom_id' => '33', 'part_id' => '2']
            , ['part_symptom_id' => '12', 'symptom_id' => '34', 'part_id' => '2']
            , ['part_symptom_id' => '13', 'symptom_id' => '7', 'part_id' => '3']
            , ['part_symptom_id' => '14', 'symptom_id' => '8', 'part_id' => '3']
            , ['part_symptom_id' => '15', 'symptom_id' => '9', 'part_id' => '3']
            , ['part_symptom_id' => '16', 'symptom_id' => '10', 'part_id' => '4']
            , ['part_symptom_id' => '17', 'symptom_id' => '11', 'part_id' => '4']
            , ['part_symptom_id' => '18', 'symptom_id' => '12', 'part_id' => '4']
            , ['part_symptom_id' => '19', 'symptom_id' => '29', 'part_id' => '4']
            , ['part_symptom_id' => '20', 'symptom_id' => '31', 'part_id' => '4']
            , ['part_symptom_id' => '21', 'symptom_id' => '32', 'part_id' => '4']
            , ['part_symptom_id' => '22', 'symptom_id' => '34', 'part_id' => '4']
            , ['part_symptom_id' => '23', 'symptom_id' => '14', 'part_id' => '5']
            , ['part_symptom_id' => '24', 'symptom_id' => '15', 'part_id' => '5']
            , ['part_symptom_id' => '25', 'symptom_id' => '16', 'part_id' => '5']
            , ['part_symptom_id' => '26', 'symptom_id' => '13', 'part_id' => '6']
            , ['part_symptom_id' => '27', 'symptom_id' => '30', 'part_id' => '6']
            , ['part_symptom_id' => '28', 'symptom_id' => '22', 'part_id' => '8']
            , ['part_symptom_id' => '29', 'symptom_id' => '23', 'part_id' => '8']
            , ['part_symptom_id' => '30', 'symptom_id' => '24', 'part_id' => '8']
            , ['part_symptom_id' => '31', 'symptom_id' => '25', 'part_id' => '8']
            , ['part_symptom_id' => '32', 'symptom_id' => '26', 'part_id' => '8']
            , ['part_symptom_id' => '33', 'symptom_id' => '27', 'part_id' => '8']
            , ['part_symptom_id' => '34', 'symptom_id' => '28', 'part_id' => '8']
            , ['part_symptom_id' => '35', 'symptom_id' => '31', 'part_id' => '8']
            , ['part_symptom_id' => '36', 'symptom_id' => '35', 'part_id' => '8']
            , ['part_symptom_id' => '37', 'symptom_id' => '17', 'part_id' => '9']
            , ['part_symptom_id' => '38', 'symptom_id' => '18', 'part_id' => '9']
            , ['part_symptom_id' => '39', 'symptom_id' => '19', 'part_id' => '9']
            , ['part_symptom_id' => '40', 'symptom_id' => '29', 'part_id' => '9']
            , ['part_symptom_id' => '41', 'symptom_id' => '20', 'part_id' => '10']
            , ['part_symptom_id' => '42', 'symptom_id' => '21', 'part_id' => '10']
            , ['part_symptom_id' => '43', 'symptom_id' => '29', 'part_id' => '10']
            , ['part_symptom_id' => '44', 'symptom_id' => '31', 'part_id' => '10']
        ]);
    }
}

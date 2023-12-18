<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Disease_diagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disease_diagnoses')->insert([
            ['disease_diagnosis_id' => '1', 'disease_id' => '1', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '2', 'disease_id' => '1', 'diagnosis_id' => '2']
            , ['disease_diagnosis_id' => '3', 'disease_id' => '1', 'diagnosis_id' => '3']
            , ['disease_diagnosis_id' => '4', 'disease_id' => '2', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '5', 'disease_id' => '2', 'diagnosis_id' => '3']
            , ['disease_diagnosis_id' => '6', 'disease_id' => '2', 'diagnosis_id' => '4']
            , ['disease_diagnosis_id' => '7', 'disease_id' => '3', 'diagnosis_id' => '5']
            , ['disease_diagnosis_id' => '8', 'disease_id' => '4', 'diagnosis_id' => '5']
            , ['disease_diagnosis_id' => '9', 'disease_id' => '5', 'diagnosis_id' => '5']
            , ['disease_diagnosis_id' => '10', 'disease_id' => '6', 'diagnosis_id' => '5']
            , ['disease_diagnosis_id' => '11', 'disease_id' => '7', 'diagnosis_id' => '5']
            , ['disease_diagnosis_id' => '12', 'disease_id' => '8', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '13', 'disease_id' => '8', 'diagnosis_id' => '3']
            , ['disease_diagnosis_id' => '14', 'disease_id' => '9', 'diagnosis_id' => '6']
            , ['disease_diagnosis_id' => '15', 'disease_id' => '10', 'diagnosis_id' => '6']
            , ['disease_diagnosis_id' => '16', 'disease_id' => '11', 'diagnosis_id' => '6']
            , ['disease_diagnosis_id' => '17', 'disease_id' => '12', 'diagnosis_id' => '2']
            , ['disease_diagnosis_id' => '18', 'disease_id' => '13', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '19', 'disease_id' => '13', 'diagnosis_id' => '3']
            , ['disease_diagnosis_id' => '20', 'disease_id' => '13', 'diagnosis_id' => '7']
            , ['disease_diagnosis_id' => '21', 'disease_id' => '14', 'diagnosis_id' => '7']
            , ['disease_diagnosis_id' => '22', 'disease_id' => '15', 'diagnosis_id' => '7']
            , ['disease_diagnosis_id' => '23', 'disease_id' => '16', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '24', 'disease_id' => '16', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '25', 'disease_id' => '17', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '26', 'disease_id' => '18', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '27', 'disease_id' => '19', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '28', 'disease_id' => '19', 'diagnosis_id' => '9']
            , ['disease_diagnosis_id' => '29', 'disease_id' => '20', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '30', 'disease_id' => '21', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '31', 'disease_id' => '22', 'diagnosis_id' => '1']
            , ['disease_diagnosis_id' => '32', 'disease_id' => '23', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '33', 'disease_id' => '23', 'diagnosis_id' => '10']
            , ['disease_diagnosis_id' => '34', 'disease_id' => '24', 'diagnosis_id' => '8']
            , ['disease_diagnosis_id' => '35', 'disease_id' => '25', 'diagnosis_id' => '1']
        ]);
    }
}

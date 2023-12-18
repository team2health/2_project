<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Dps_linkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dps_links')->insert([
            ['dps_id' => '1', 'disease_id' => '1', 'part_symptom_id' => '1']
            , ['dps_id' => '2', 'disease_id' => '1', 'part_symptom_id' => '2']
            , ['dps_id' => '3', 'disease_id' => '2', 'part_symptom_id' => '3']
            , ['dps_id' => '4', 'disease_id' => '8', 'part_symptom_id' => '4']
            , ['dps_id' => '5', 'disease_id' => '2', 'part_symptom_id' => '5']
            , ['dps_id' => '6', 'disease_id' => '3', 'part_symptom_id' => '6']
            , ['dps_id' => '7', 'disease_id' => '7', 'part_symptom_id' => '7']
            , ['dps_id' => '8', 'disease_id' => '6', 'part_symptom_id' => '8']
            , ['dps_id' => '9', 'disease_id' => '12', 'part_symptom_id' => '9']
            , ['dps_id' => '10', 'disease_id' => '4', 'part_symptom_id' => '10']
            , ['dps_id' => '11', 'disease_id' => '6', 'part_symptom_id' => '11']
            , ['dps_id' => '12', 'disease_id' => '5', 'part_symptom_id' => '12']
            , ['dps_id' => '13', 'disease_id' => '8', 'part_symptom_id' => '13']
            , ['dps_id' => '14', 'disease_id' => '8', 'part_symptom_id' => '14']
            , ['dps_id' => '15', 'disease_id' => '8', 'part_symptom_id' => '15']
            , ['dps_id' => '16', 'disease_id' => '9', 'part_symptom_id' => '16']
            , ['dps_id' => '17', 'disease_id' => '9', 'part_symptom_id' => '17']
            , ['dps_id' => '18', 'disease_id' => '10', 'part_symptom_id' => '18']
            , ['dps_id' => '19', 'disease_id' => '25', 'part_symptom_id' => '19']
            , ['dps_id' => '20', 'disease_id' => '12', 'part_symptom_id' => '20']
            , ['dps_id' => '21', 'disease_id' => '11', 'part_symptom_id' => '21']
            , ['dps_id' => '22', 'disease_id' => '25', 'part_symptom_id' => '22']
            , ['dps_id' => '23', 'disease_id' => '14', 'part_symptom_id' => '23']
            , ['dps_id' => '24', 'disease_id' => '15', 'part_symptom_id' => '24']
            , ['dps_id' => '25', 'disease_id' => '14', 'part_symptom_id' => '25']
            , ['dps_id' => '26', 'disease_id' => '13', 'part_symptom_id' => '26']
            , ['dps_id' => '27', 'disease_id' => '13', 'part_symptom_id' => '27']
            , ['dps_id' => '28', 'disease_id' => '20', 'part_symptom_id' => '28']
            , ['dps_id' => '29', 'disease_id' => '21', 'part_symptom_id' => '29']
            , ['dps_id' => '30', 'disease_id' => '21', 'part_symptom_id' => '30']
            , ['dps_id' => '31', 'disease_id' => '21', 'part_symptom_id' => '31']
            , ['dps_id' => '32', 'disease_id' => '21', 'part_symptom_id' => '32']
            , ['dps_id' => '33', 'disease_id' => '22', 'part_symptom_id' => '33']
            , ['dps_id' => '34', 'disease_id' => '22', 'part_symptom_id' => '34']
            , ['dps_id' => '35', 'disease_id' => '21', 'part_symptom_id' => '35']
            , ['dps_id' => '36', 'disease_id' => '16', 'part_symptom_id' => '36']
            , ['dps_id' => '37', 'disease_id' => '16', 'part_symptom_id' => '37']
            , ['dps_id' => '38', 'disease_id' => '17', 'part_symptom_id' => '38']
            , ['dps_id' => '39', 'disease_id' => '23', 'part_symptom_id' => '39']
            , ['dps_id' => '40', 'disease_id' => '18', 'part_symptom_id' => '40']
            , ['dps_id' => '41', 'disease_id' => '19', 'part_symptom_id' => '41']
            , ['dps_id' => '42', 'disease_id' => '23', 'part_symptom_id' => '42']
            , ['dps_id' => '43', 'disease_id' => '24', 'part_symptom_id' => '43']
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parts')->insert([
            ['part_id' => 1, 'part_name' => '머리']
            , ['part_id' => 2, 'part_name' => '눈']
            , ['part_id' => 3, 'part_name' => '코']
            , ['part_id' => 4, 'part_name' => '입']
            , ['part_id' => 5, 'part_name' => '귀']
            , ['part_id' => 6, 'part_name' => '목']
            , ['part_id' => 7, 'part_name' => '어깨']
            , ['part_id' => 8, 'part_name' => '배']
            , ['part_id' => 9, 'part_name' => '팔']
            , ['part_id' => 10, 'part_name' => '다리']
        ]);
    }
}

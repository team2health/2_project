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
            , ['part_id' => 5, 'part_name' => '목']
            , ['part_id' => 6, 'part_name' => '어깨']
            , ['part_id' => 7, 'part_name' => '팔']
            , ['part_id' => 8, 'part_name' => '손목']
            , ['part_id' => 9, 'part_name' => '손']
            , ['part_id' => 10, 'part_name' => '폐']
            , ['part_id' => 11, 'part_name' => '심장']
            , ['part_id' => 12, 'part_name' => '배']
            , ['part_id' => 13, 'part_name' => '골반']
            , ['part_id' => 14, 'part_name' => '생식기']
            , ['part_id' => 15, 'part_name' => '허벅지']
            , ['part_id' => 16, 'part_name' => '무릎']
            , ['part_id' => 17, 'part_name' => '종아리']
            , ['part_id' => 18, 'part_name' => '발목']
            , ['part_id' => 19, 'part_name' => '발']
            , ['part_id' => 20, 'part_name' => '등']
            , ['part_id' => 21, 'part_name' => '팔꿈치']
            , ['part_id' => 22, 'part_name' => '허리']
            , ['part_id' => 23, 'part_name' => '엉덩이']
        ]);
    }
}

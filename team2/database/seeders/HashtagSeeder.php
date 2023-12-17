<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HashtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hashtags')->insert([
            ['hashtag_id' => '1', 'hashtag_name' => '#발열']
			,['hashtag_id' => '2', 'hashtag_name' => '#편두통']
			,['hashtag_id' => '3', 'hashtag_name' => '#꾀병']
			,['hashtag_id' => '4', 'hashtag_name' => '#자유']
			,['hashtag_id' => '5', 'hashtag_name' => '#친목']
			,['hashtag_id' => '6', 'hashtag_name' => '#운동']
			,['hashtag_id' => '7', 'hashtag_name' => '#복통']
			,['hashtag_id' => '8', 'hashtag_name' => '#안구건조증']
			,['hashtag_id' => '9', 'hashtag_name' => '#체함']
			,['hashtag_id' => '10', 'hashtag_name' => '#해']
			,['hashtag_id' => '11', 'hashtag_name' => '#달']
			,['hashtag_id' => '12', 'hashtag_name' => '#별']
			,['hashtag_id' => '13', 'hashtag_name' => '#염좌']
			,['hashtag_id' => '14', 'hashtag_name' => '#손목터널증후군']
			,['hashtag_id' => '15', 'hashtag_name' => '#어깨결림']
        ]);
    }
}
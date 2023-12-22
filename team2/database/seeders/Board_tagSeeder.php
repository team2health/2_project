<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Board_tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('board_tags')->insert([
			['board_id' => '11', 'hashtag_id' => '5']
            , ['board_id' => '12', 'hashtag_id' => '5']
            , ['board_id' => '13', 'hashtag_id' => '5']
            , ['board_id' => '14', 'hashtag_id' => '7']
            , ['board_id' => '11', 'hashtag_id' => '4']
            , ['board_id' => '16', 'hashtag_id' => '9']
            , ['board_id' => '11', 'hashtag_id' => '8']
            , ['board_id' => '12', 'hashtag_id' => '8']
            , ['board_id' => '19', 'hashtag_id' => '8']
            , ['board_id' => '20', 'hashtag_id' => '6']
        ]);
    }
}

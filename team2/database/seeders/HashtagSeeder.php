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
			['hashtag_id' => '1', 'hashtag_name' => '#해']
			,['hashtag_id' => '2', 'hashtag_name' => '#달']
			,['hashtag_id' => '3', 'hashtag_name' => '#별']
			,['hashtag_id' => '4', 'hashtag_name' => '#나는']
			,['hashtag_id' => '5', 'hashtag_name' => '#딸기']
			,['hashtag_id' => '6', 'hashtag_name' => '#스무디']
			,['hashtag_id' => '7', 'hashtag_name' => '#라떼']
			,['hashtag_id' => '8', 'hashtag_name' => '#커피']
			,['hashtag_id' => '9', 'hashtag_name' => '#발열']
			,['hashtag_id' => '10', 'hashtag_name' => '#복통']
			,['hashtag_id' => '11', 'hashtag_name' => '#물리']
			,['hashtag_id' => '12', 'hashtag_name' => '#전공']
			,['hashtag_id' => '13', 'hashtag_name' => '#취미']
			,['hashtag_id' => '14', 'hashtag_name' => '#운동']
			,['hashtag_id' => '15', 'hashtag_name' => '#입원']
			,['hashtag_id' => '16', 'hashtag_name' => '#퇴원']
            ,['hashtag_id' => '17', 'hashtag_name' => '#영원']
			,['hashtag_id' => '18', 'hashtag_name' => '#별헤는밤']
			,['hashtag_id' => '19', 'hashtag_name' => '#윤동주']
			,['hashtag_id' => '20', 'hashtag_name' => '#별하나']
			,['hashtag_id' => '21', 'hashtag_name' => '#추억']
			,['hashtag_id' => '22', 'hashtag_name' => '#사랑']
			,['hashtag_id' => '23', 'hashtag_name' => '#동경']
			,['hashtag_id' => '24', 'hashtag_name' => '#냠냠']
			,['hashtag_id' => '25', 'hashtag_name' => '#시']
			,['hashtag_id' => '26', 'hashtag_name' => '#쓸쓸함']
			,['hashtag_id' => '27', 'hashtag_name' => '#우주']
			,['hashtag_id' => '28', 'hashtag_name' => '#북간도']
			,['hashtag_id' => '29', 'hashtag_name' => '#박민경']
			,['hashtag_id' => '30', 'hashtag_name' => '#강휘야']
			,['hashtag_id' => '31', 'hashtag_name' => '#유현호']
        ]);
    }
}
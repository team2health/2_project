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
			['hashtag_id' => '1', 'hashtag_name' => '#고열', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '2', 'hashtag_name' => '#두통', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '3', 'hashtag_name' => '#발열', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '4', 'hashtag_name' => '#복통', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '5', 'hashtag_name' => '#객혈', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '6', 'hashtag_name' => '#변비', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '7', 'hashtag_name' => '#설사', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '8', 'hashtag_name' => '#기침', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '9', 'hashtag_name' => '#딸꾹질', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '10', 'hashtag_name' => '#상처', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '11', 'hashtag_name' => '#소화불량', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '12', 'hashtag_name' => '#코피', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '13', 'hashtag_name' => '#경련', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '14', 'hashtag_name' => '#눈떨림', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '15', 'hashtag_name' => '#구토', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '16', 'hashtag_name' => '#비염', 'created_at' => NOW(), 'updated_at' => NOW()]
            ,['hashtag_id' => '17', 'hashtag_name' => '#감기', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '18', 'hashtag_name' => '#코로나', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '19', 'hashtag_name' => '#재채기', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '20', 'hashtag_name' => '#두드러기', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '21', 'hashtag_name' => '#눈물', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '22', 'hashtag_name' => '#충혈', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '23', 'hashtag_name' => '#호흡', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '24', 'hashtag_name' => '#어지러움', 'created_at' => NOW(), 'updated_at' => NOW()]
			,['hashtag_id' => '25', 'hashtag_name' => '#구내염', 'created_at' => NOW(), 'updated_at' => NOW()]
        ]);
    }
}
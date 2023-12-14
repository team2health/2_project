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
            ['hash_id' => '1', 'hash_name' => '#발열']
			,['hash_id' => '2', 'hash_name' => '#편두통']
			,['hash_id' => '3', 'hash_name' => '#꾀병']
			,['hash_id' => '4', 'hash_name' => '#자유']
			,['hash_id' => '5', 'hash_name' => '#친목']
			,['hash_id' => '6', 'hash_name' => '#운동']
			,['hash_id' => '7', 'hash_name' => '#복통']
			,['hash_id' => '8', 'hash_name' => '#안구건조증']
			,['hash_id' => '9', 'hash_name' => '#체함']
			,['hash_id' => '10', 'hash_name' => '#해']
			,['hash_id' => '11', 'hash_name' => '#달']
			,['hash_id' => '12', 'hash_name' => '#별']
			,['hash_id' => '13', 'hash_name' => '#염좌']
			,['hash_id' => '14', 'hash_name' => '#손목터널증후군']
			,['hash_id' => '15', 'hash_name' => '#어깨결림']
        ]);
    }
}
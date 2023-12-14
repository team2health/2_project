<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorite_tags')->insert([
            ['hash_id' => '1', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '2', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '3', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '4', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
            ,['hash_id' => '5', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '6', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '7', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '8', 'u_id' => '1', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
            ,['hash_id' => '1', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '2', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '3', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '4', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
            ,['hash_id' => '5', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '6', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '7', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
			,['hash_id' => '8', 'u_id' => '2', 'created_at' => 20231214174000, 'updated_at' => 20231214174000]
        ]);
    }
}

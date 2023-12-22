<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['u_id' => '3', 'board_id' => '1', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '2', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '3', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '15', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '22', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '21', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '27', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '28', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
            , ['u_id' => '3', 'board_id' => '30', 'comment_content'=> '병원에서 부활시켜줘', 'created_at' => now()]
        ]);
    }
}

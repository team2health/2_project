<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('boards')->insert(
            [['u_id' => '1', 'category_id' => '1', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '2', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '3', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '4', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '1', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '2', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '3', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '4', 'board_title' => '집에가고싶은데도 가지못하고',
                        'board_content' => '실비보험을 안들었다면 얼마나 될까요?????? 안들었으면 큰일인데...ㅠㅠ ㅠㅠㅠㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000, 'deleted_at' => 20231214174000]
                    ]);
                }
            }
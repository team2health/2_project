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
            [['u_id' => '1', 'category_id' => '1', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '2', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '3', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '1', 'category_id' => '4', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '1', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '2', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '3', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000],
                        ['u_id' => '2', 'category_id' => '4', 'board_title' => '맹장염인 것 같아요..',
                        'board_content' => '응급실을 가야할까요?? 집에 지금 아무도 없는데 걸을 수가 없어요ㅠㅠ', 'board_hits' => 0, 'created_at' => 20231214174000,
                        'updated_at' => 20231214174000]
                    ]);
                }
            }
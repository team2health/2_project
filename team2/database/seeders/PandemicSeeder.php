<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PandemicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   // 나중에 id autoin 뭐시기로 바꾸기
        DB::table('pandemics')->insert([
			['pandemic_name' => '독감', 'pandemic_symptoms' => '#고열 #기침 #인후통 #몸살', 'created_at' => NOW(), 'updated_at' => NOW()]
            , ['pandemic_name' => '수막구균성 수막염', 'pandemic_symptoms' => '#고열 #두통 #구토와 메스꺼움', 'created_at' => NOW(), 'updated_at' => NOW()]
            , ['pandemic_name' => 'A형간염', 'pandemic_symptoms' => '#피로감 #복통 #발열 #황달', 'created_at' => NOW(), 'updated_at' => NOW()]
        ]);
    }
}

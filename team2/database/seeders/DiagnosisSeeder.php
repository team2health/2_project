<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiagnosisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diagnoses')->insert([
            ['hospital_id' => 1, 'hospital_name' => '내과'] // 편두통 지루성 피부염 감기 인후염 또는 인두염 관절염 소화불량 과민성 대장 증후군 소화 장애
            , ['hospital_id' => 2, 'hospital_name' => '신경과'] // 편두통
            , ['hospital_id' => 3, 'hospital_name' => '가정의학과'] // 편두통 지루성 피부염 감기 인후염 또는 인두염
            , ['hospital_id' => 4, 'hospital_name' => '피부과 의원'] // 지루성 피부염
            , ['hospital_id' => 5, 'hospital_name' => '안과'] // 녹내장 안구 건조증 각막염 결막염 백내장
            , ['hospital_id' => 6, 'hospital_name' => '치과'] // 구내염 구강암 구강 건조증 안면연축
            , ['hospital_id' => 7, 'hospital_name' => '이비인후과'] // 인후염 또는 인두염 중이염 메니에르병
            , ['hospital_id' => 8, 'hospital_name' => '정형외과'] // 관절염 손목터널 증후군 퇴행성 관절염 발목염좌 림프부종 국소성 근육 경련
            , ['hospital_id' => 9, 'hospital_name' => '응급실'] // 발목염좌
            , ['hospital_id' => 10, 'hospital_name' => '외과'] // 림프부종
        ]);
    }
}

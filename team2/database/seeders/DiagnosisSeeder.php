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
            ['diagnosis_id' => 1, 'diagnosis_name' => '내과'] // 편두통 지루성 피부염 감기 인후염 또는 인두염 관절염 소화불량 과민성 대장 증후군 소화 장애
            , ['diagnosis_id' => 2, 'diagnosis_name' => '신경과'] // 편두통
            , ['diagnosis_id' => 3, 'diagnosis_name' => '가정의학과'] // 편두통 지루성 피부염 감기 인후염 또는 인두염
            , ['diagnosis_id' => 4, 'diagnosis_name' => '피부과 의원'] // 지루성 피부염
            , ['diagnosis_id' => 5, 'diagnosis_name' => '안과'] // 녹내장 안구 건조증 각막염 결막염 백내장
            , ['diagnosis_id' => 6, 'diagnosis_name' => '치과'] // 구내염 구강암 구강 건조증 안면연축
            , ['diagnosis_id' => 7, 'diagnosis_name' => '이비인후과'] // 인후염 또는 인두염 중이염 메니에르병
            , ['diagnosis_id' => 8, 'diagnosis_name' => '정형외과'] // 관절염 손목터널 증후군 퇴행성 관절염 발목염좌 림프부종 국소성 근육 경련
            , ['diagnosis_id' => 9, 'diagnosis_name' => '응급실'] // 발목염좌
            , ['diagnosis_id' => 10, 'diagnosis_name' => '외과'] // 림프부종
        ]);
    }
}

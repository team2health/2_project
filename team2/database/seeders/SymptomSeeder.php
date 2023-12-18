<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symptoms')->insert([
            ['symptom_id' => 1, 'symptom_name' => '두통'] // 머리 편두통
            , ['symptom_id' => 2, 'symptom_name' => '두근거림'] // 머리 편두통
            , ['symptom_id' => 3, 'symptom_name' => '두피 건조함'] // 머리 지루성 피부염
            , ['symptom_id' => 4, 'symptom_name' => '시야 변화'] // 눈 녹내장
            , ['symptom_id' => 5, 'symptom_name' => '시력 저하'] // 눈 백내장
            , ['symptom_id' => 6, 'symptom_name' => '충혈'] // 눈 결막염
            , ['symptom_id' => 7, 'symptom_name' => '콧물'] // 코 감기
            , ['symptom_id' => 8, 'symptom_name' => '재채기'] // 코 감기
            , ['symptom_id' => 9, 'symptom_name' => '코막힘'] // 코 감기
            , ['symptom_id' => 10, 'symptom_name' => '염증'] // 입 구내염
            , ['symptom_id' => 11, 'symptom_name' => '치아 통증'] // 입 구내염
            , ['symptom_id' => 12, 'symptom_name' => '혀 통증'] // 입 구강암
            , ['symptom_id' => 13, 'symptom_name' => '목소리 변화'] // 목 인후염 또는 인두염
            , ['symptom_id' => 14, 'symptom_name' => '이명(귀울림)'] // 귀 중이염
            , ['symptom_id' => 15, 'symptom_name' => '청력 저하'] // 귀 메니에르
            , ['symptom_id' => 16, 'symptom_name' => '귀 분비물'] // 귀 중이염
            , ['symptom_id' => 17, 'symptom_name' => '관절 통증'] // 팔 관절염
            , ['symptom_id' => 18, 'symptom_name' => '팔꿈치 통증'] // 팔 관절염
            , ['symptom_id' => 19, 'symptom_name' => '손목 통증'] // 팔 터널 증후군
            , ['symptom_id' => 20, 'symptom_name' => '무릎 통증'] // 다리 퇴행성 관절염
            , ['symptom_id' => 21, 'symptom_name' => '발목 통증'] // 다리 발목염좌
            , ['symptom_id' => 22, 'symptom_name' => '더부룩함'] // 배 소화불량
            , ['symptom_id' => 23, 'symptom_name' => '가스'] // 배 과민성 대장 증후군
            , ['symptom_id' => 24, 'symptom_name' => '변비'] // 배 과민성 대장 증후군
            , ['symptom_id' => 25, 'symptom_name' => '설사'] // 배 과민성 대장 증후군
            , ['symptom_id' => 26, 'symptom_name' => '복부 팽만'] // 배 과민성 대장 증후군
            , ['symptom_id' => 27, 'symptom_name' => '구토'] // 배 소화장애
            , ['symptom_id' => 28, 'symptom_name' => '불편감'] // 배 소화장애
            , ['symptom_id' => 29, 'symptom_name' => '붓기'] // 다리, 팔 림프부종 입 혈관부종
            , ['symptom_id' => 30, 'symptom_name' => '발열'] // 머리 감기, 목 인후염 또는 인두염
            , ['symptom_id' => 31, 'symptom_name' => '경련'] // 눈, 입 안면연축 다리 국소성 근육 경련
            , ['symptom_id' => 32, 'symptom_name' => '건조함'] // 눈 안구 건조증, 입 구강 건조증
            , ['symptom_id' => 33, 'symptom_name' => '가려움'] // 머리 지루성 피부염, 눈 결막염
            , ['symptom_id' => 34, 'symptom_name' => '통증'] // 눈 각막염 입 혈관부종
            , ['symptom_id' => 35, 'symptom_name' => '복통'] // 배 과민성 대장 증후군
        ]);
    }
}

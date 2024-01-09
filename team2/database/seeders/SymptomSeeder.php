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
            ['symptom_id' => 1, 'symptom_name' => '두통'] // 머리
            , ['symptom_id' => 2, 'symptom_name' => '어지러움'] // 머리
            , ['symptom_id' => 3, 'symptom_name' => '두피 통증'] // 머리
            , ['symptom_id' => 4, 'symptom_name' => '압력 또는 무게감'] // 머리, 폐, 배
            , ['symptom_id' => 5, 'symptom_name' => '흔들림'] // 머리
            , ['symptom_id' => 6, 'symptom_name' => '시력 변화'] // 눈
            , ['symptom_id' => 7, 'symptom_name' => '통증'] // 눈, 코, 입, 목, 어깨, 팔, 손목, 손, 폐, 심장, 배, 골반, 생식기, 허벅지, 무릎, 종아리, 발목, 발, 등, 팔꿈치, 허리, 엉덩이
            , ['symptom_id' => 8, 'symptom_name' => '건조함'] // 눈, 코, 입, 목
            , ['symptom_id' => 9, 'symptom_name' => '가려움'] // 머리, 눈, 코, 입, 생식기, 엉덩이
            , ['symptom_id' => 10, 'symptom_name' => '분비물'] // 눈, 생식기
            , ['symptom_id' => 11, 'symptom_name' => '붓기'] // 눈, 입, 목, 어깨, 팔, 손목, 손, 골반, 생식기, 허벅지, 무릎, 종아리, 발목, 발, 팔꿈치
            , ['symptom_id' => 12, 'symptom_name' => '충혈'] // 눈
            , ['symptom_id' => 13, 'symptom_name' => '감각 이상'] // 눈, 손, 골반, 허벅지, 발목, 발, 등, 팔꿈치, 엉덩이
            , ['symptom_id' => 14, 'symptom_name' => '시야 변화'] // 눈
            , ['symptom_id' => 15, 'symptom_name' => '흐릿함'] // 눈
            , ['symptom_id' => 16, 'symptom_name' => '시력 저하'] // 눈
            , ['symptom_id' => 17, 'symptom_name' => '경련'] // 눈, 팔, 손목, 허벅지, 종아리, 허리, 엉덩이
            , ['symptom_id' => 18, 'symptom_name' => '색상 변화'] // 눈
            , ['symptom_id' => 19, 'symptom_name' => '콧물'] // 코
            , ['symptom_id' => 20, 'symptom_name' => '재채기'] // 코
            , ['symptom_id' => 21, 'symptom_name' => '코 막힘'] // 코
            , ['symptom_id' => 22, 'symptom_name' => '출혈'] // 코
            , ['symptom_id' => 23, 'symptom_name' => '입술의 갈라짐'] // 입
            , ['symptom_id' => 24, 'symptom_name' => '불편감'] // 목, 손목, 어깨, 팔, 손, 골반, 생식기, 허벅지, 무릎, 발목, 발, 허리
            , ['symptom_id' => 25, 'symptom_name' => '쓰림'] // 목
            , ['symptom_id' => 26, 'symptom_name' => '열감'] // 목, 어깨, 손목, 골반
            , ['symptom_id' => 27, 'symptom_name' => '발열'] // 머리
            , ['symptom_id' => 28, 'symptom_name' => '뻐근함'] // 어깨, 골반, 허벅지, 무릎, 종아리, 발목, 발, 등, 팔꿈치, 허리
            , ['symptom_id' => 29, 'symptom_name' => '염증'] // 목, 입, 어깨, 팔, 손목, 골반, 생식기
            , ['symptom_id' => 30, 'symptom_name' => '근육 약화'] // 어깨, 팔, 손목, 허벅지, 종아리, 발목, 허리
            , ['symptom_id' => 31, 'symptom_name' => '메스꺼움'] // 목
            , ['symptom_id' => 32, 'symptom_name' => '피로'] // 눈, 어깨, 팔, 손목, 손, 발목, 발, 등
            , ['symptom_id' => 33, 'symptom_name' => '저림 또는 마비'] // 팔, 손목, 손, 종아리, 발
            , ['symptom_id' => 34, 'symptom_name' => '호흡곤란'] // 폐, 심장
            , ['symptom_id' => 35, 'symptom_name' => '기침'] // 목
            , ['symptom_id' => 36, 'symptom_name' => '심장 박동의 불규칙성'] // 심장
            , ['symptom_id' => 37, 'symptom_name' => '소화불량'] // 배
            , ['symptom_id' => 38, 'symptom_name' => '구토'] // 배
            , ['symptom_id' => 39, 'symptom_name' => '불쾌감'] // 배
            , ['symptom_id' => 40, 'symptom_name' => '가스'] // 배
            , ['symptom_id' => 41, 'symptom_name' => '피부 변화'] // 등
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diseases')->insert([
            ['disease_id' => 1, 'disease_name' => '편두통', 'disease_info' => '편두통은 심한 두통과 함께 빛, 소리, 냄새에 대한 과민증상과 함께 오는 만성적인 두통입니다.']
            , ['disease_id' => 2, 'disease_name' => '지루성 피부염', 'disease_info' => '머리 가죽의 피부염으로 흔하게 나타나며, 가려움증과 비듬이 발생할 수 있습니다.']
            , ['disease_id' => 3, 'disease_name' => '녹내장', 'disease_info' => '내장은 눈의 안압이 증가하여 시야에 변화를 일으킬 수 있습니다.']
            , ['disease_id' => 4, 'disease_name' => '안구 건조증', 'disease_info' => '눈의 표면이 충분한 눈물로 수분이 공급되지 못하여 건조해집니다.']
            , ['disease_id' => 5, 'disease_name' => '각막염', 'disease_info' => '각막의 염증으로 인해 발생할 수 있습니다. 이는 눈이 붉고 통증을 동반할 수 있습니다.']
            , ['disease_id' => 6, 'disease_name' => '결막염 ', 'disease_info' => '결막의 염증으로 눈이 붓고 붉으며, 가려움증과 통증을 유발할 수 있습니다.']
            , ['disease_id' => 7, 'disease_name' => '백내장 ', 'disease_info' => '수정체의 탁해짐으로 시야가 흐려지고, 빛이 제대로 들어오지 않아 시력이 저하될 수 있습니다.']
            , ['disease_id' => 8, 'disease_name' => '감기 ', 'disease_info' => '감기는 호흡기 바이러스에 의해 발생하는 감염성 질환으로,  콧물, 코막힘, 목이 아프거나 통증이 느껴지며, 기침, 인후통, 체중감소, 근육통 등이 동반될 수 있습니다.']
            , ['disease_id' => 9, 'disease_name' => '구내염', 'disease_info' => '구강내 점막세포나 잇몸, 혀, 입술 등 구강 조직에 손상이 생기거나 염증이 생기는 것입니다.']
            , ['disease_id' => 10, 'disease_name' => '구강암', 'disease_info' => '구강암은 입안에서 발생하는 암 종류 중 하나로, 입술, 혀, 치은, 입안 안쪽의 점막 등 구강 내 다양한 부위에서 발생할 수 있습니다. ']
            , ['disease_id' => 11, 'disease_name' => '구강 건조증', 'disease_info' => '구강 건조증은 구강 내부의 침샘에서 충분한 침염이 분비되지 않아 입안이 지속적으로 건조한 상태입니다.']
            , ['disease_id' => 12, 'disease_name' => '안면연축', 'disease_info' => '안면연축은 안면 신경의 자극 증상으로 눈과 입이 의도치 않게 미세하게 떨리는 경련성 증상을 말한다.']
            , ['disease_id' => 13, 'disease_name' => '인후염 또는 인두염', 'disease_info' => '목의 염증으로 인한 인두염이나 인후염은 목소리 변화를 유발할 수 있습니다. 이는 성대와 주변 부위의 염증으로 인해 발생할 수 있습니다.']
            , ['disease_id' => 14, 'disease_name' => '중이염', 'disease_info' => '중이염은 귀의 중이(이명관, 중이부, 고막) 부분에 발생하는 염증으로, 대개 세균 또는 바이러스 감염으로 인해 발생합니다.']
            , ['disease_id' => 15, 'disease_name' => '메니에르병', 'disease_info' => '메니에르병은 회전감 있는 현기증과 청력 저하, 이명(귀울림), 이 충만감(귀가 꽉 찬 느낌) 등의 증상이 동시에 발현되는 질병입니다.']
            , ['disease_id' => 16, 'disease_name' => '관절염', 'disease_info' => '관절염(arthritis)은 하나 이상의 관절에 염증이 발생하는 질환들의 모음으로, 다양한 종류가 있습니다. 가장 흔한 관절염 종류로는 류마티스 관절염과 골관절염이 있습니다.']
            , ['disease_id' => 17, 'disease_name' => '손목터널 증후군', 'disease_info' => '손목 터널 증후군은 손목 내의 중간 신경인 정중신경이 손목 내에서 압박을 받아 발생하는 상태입니다.']
            , ['disease_id' => 18, 'disease_name' => '퇴행성 관절염', 'disease_info' => '퇴행성 관절염, 일반적으로는 골관절염(Osteoarthritis, OA)이라고도 불리며, 관절의 연령과 관련된 변화로 인해 발생하는 질환입니다.']
            , ['disease_id' => 19, 'disease_name' => '발목염좌', 'disease_info' => '발목염좌는 발목 주변의 인대, 근육, 뼈 등에 부상이나 손상으로 인해 발생하는 상태입니다. 일반적으로 삐끗한 느낌, 통증, 붓기, 염증, 운동 제약 등의 증상을 동반합니다.']
            , ['disease_id' => 20, 'disease_name' => '소화불량', 'disease_info' => '소화불량은 음식물이 소화되지 못하고 소화관에서 불편함을 느끼는 상태를 가리킵니다. 다양한 이유로 발생할 수 있으며, 식사 후 불쾌한 증상을 유발할 수 있습니다.']
            , ['disease_id' => 21, 'disease_name' => '과민성 대장 증후군', 'disease_info' => '과민성 대장 증후군은 일반적인 소화 기계의 기능 장애로, 대장의 기능이 이상하게 작용할 때 발생하는 질환입니다. ']
            , ['disease_id' => 22, 'disease_name' => '소화 장애', 'disease_info' => '소화 장애는 음식물을 소화하는 과정에서 발생하는 문제로, 소화 시스템에서 발생하는 다양한 증상을 나타냅니다. ']
            , ['disease_id' => 23, 'disease_name' => '림프부종', 'disease_info' => '림프부종은 림프관에 림프액이 쌓여 발생하는 상태를 가리킵니다. 림프부종은 일반적으로 림프관의 손상이나 블록이 발생하여 림프액의 정상적인 흐름이 차단될 때 발생합니다. ']
            , ['disease_id' => 24, 'disease_name' => '국소성 근육 경련', 'disease_info' => '국소성 근육 경련은 특정 근육 또는 근육 그룹에서 발생하는 갑작스러운 근육 수축으로, 일반적으로 통증과 함께 발생합니다.']
            , ['disease_id' => 25, 'disease_name' => '혈관부종', 'disease_info' => '혈관 부종은 피하 조직 부위가 붓는 것을 말하며 때로는 얼굴과 목에 영향을 줍니다.']
        ]);
    }
}

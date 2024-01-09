<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\OpenAI;
use App\Models\User;
use App\Models\Part;
use App\Models\Record;
use App\Models\Part_symptom;

class MainController extends Controller
{
    public function mainget() {
        $result = Part::orderby('part_id', 'asc')->get();

        return view('main')->with('part', $result);
    }

    public function partselectpost(Request $request) {
        $part_id = $request->part_id;
        
        $result[0] = Part_symptom::join('symptoms', 'part_symptoms.symptom_id', '=', 'symptoms.symptom_id')
            ->select('symptoms.symptom_name', 'part_symptoms.part_symptom_id')
            ->where('part_symptoms.part_id', $part_id)
            ->orderby('symptoms.symptom_id', 'asc')
            ->get();
        $result[1] = $part_id;

        return response()->json($result);
    }

    public function symptomselectpost(Request $request) {
        // Log::debug($request);

        $id = session('id');
        $userinfo = User::select('birthday', 'user_gender')->where('id', $id)->get();

        // 유저 나이
        $birthday = $userinfo[0]['birthday'];

        $currentYear = date('Y');

        $birthYear = date('Y', strtotime($birthday));
    
        $age = $currentYear - $birthYear;

        // 유저 성별
        $gender = '';
        if($userinfo[0]['user_gender'] == 1) {
            $gender = '남성';
        } else if($userinfo[0]['user_gender'] == 2) {
            $gender = '여성';
        }



        // $result = OpenAI::chat()->create([
        //     'model' => 'gpt-3.5-turbo',
        //     'messages' => [
        //         ['role' => 'system', 'content' => '
        //         당신은 세계 최고의 의사입니다.
        //         나이와 성별, 부위, 증상을 알면 가능성이 가장 높은 예상 질병을 알 수 있습니다. 먼저 예상 질병을 알려주고 해당 예상 질병에 맞는 증상을 알려주세요. 마지막으로는 예상 질병에 맞는 병원을 추천해주는데 병원은 `을 씌워서 알려주세요.
        //         출력 문장은 예를 들어
        //         해당 부위와 증상으로 예상할 수 있는 질병은 "예상 질병"입니다.
        //         "예상 질병"은 "증상"입니다.
        //         진료 과목: `{병원}`
        //         이런 식으로 간략하게 알려주세요.'],
        //         ['role' => 'user', 'content' => $age.'세의 '.$gender.'의 '.'부위에서 증상, 증상, 증상 어쩌구저쩌꾸'],
        //     ],
        // ]);
    }
    
    // public function useraddresspost(Request $request) {

    //     $user_id = $request->user_id;
    //     $disease_id = $request->disease_id;

    //     $result[] = User::where('id', $user_id)->get();
    //     $result[] = Disease_diagnosis::join('diagnoses', 'disease_diagnoses.diagnosis_id', '=', 'diagnoses.diagnosis_id')
    //         ->select('diagnoses.diagnosis_name')
    //         ->where('disease_diagnoses.disease_id', $disease_id)
    //         ->get();

    //     return response()->json($result);
    // }
}

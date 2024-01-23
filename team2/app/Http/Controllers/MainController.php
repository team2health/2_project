<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
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
        $id = session('id');
        $userinfo = User::select('birthday', 'user_gender')->where('id', $id)->get();

        // 유저 나이
        $birthday = $userinfo[0]['birthday'];

        $currentYear = date('Y');

        $birthYear = date('Y', strtotime($birthday));
    
        $age = $currentYear+1 - $birthYear;

        // 유저 성별
        $gender = '';
        if($userinfo[0]['user_gender'] == 1) {
            $gender = '남성';
        } else if($userinfo[0]['user_gender'] == 2) {
            $gender = '여성';
        }

        $part_symptom_id = $request->input('part_symptom_id.0');

        $part = Part_symptom::join('parts', 'parts.part_id', '=', 'part_symptoms.part_id')
        ->select('parts.part_name')
        ->where('part_symptoms.part_symptom_id', $part_symptom_id)
        ->get();

        $symptom_id = [];

        foreach($request->part_symptom_id as $item) {
            $symptom_id[] = Part_symptom::join('symptoms', 'symptoms.symptom_id', '=', 'part_symptoms.symptom_id')
            ->select('symptoms.symptom_name')
            ->where('part_symptoms.part_symptom_id', $item)
            ->get();


            $result = Record::create([
                'u_id' => $id,
                'part_symptom_id' => $item
            ]);
        }

        foreach($symptom_id as $item) {
            $symptom_name[] = $item[0]->symptom_name;
        }

        $symptom = implode(',', $symptom_name);

        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => '
                당신은 세계 최고의 의사입니다.
                환자의 나이, 성별, 부위, 증상을 알면 질병을 알 수 있습니다.
                환자에게 질병을 알려주고 해당 질병에 대한 정보를 상세하게  알려주세요. 마지막엔 해당 질병일 때 어느 병원을 가야하는지 
                백틱(backtick)을 씌워서 하나 이상 알려주세요.'],
                ['role' => 'user', 'content' => '병원 추천할 때에는 `내과`, `이비인후과` 이렇게 
                백틱(backtick)을 씌워주세요.'],
                ['role' => 'user', 'content' => '예시) 질병은 "감기"입니다.
                감기는 바이러스에 의해 코와 목 부분을 포함한 상부 호흡기계의 감염 증상으로, 사람에게 나타나는 가장 흔한 급성 질환 중 하나입니다. 재채기, 코막힘, 콧물, 인후통, 기침, 미열, 두통 및 근육통과 같은 증상이 나타날 수 있습니다.
                병원으로는 `내과`, `이비인후과`을  추천드립니다.'],
                ['role' => 'user', 'content' => '환자는'.$age.'세의 '.$gender.' 입니다.'],
                ['role' => 'user', 'content' => '환자의 '.$part.'에서 '.$symptom.' 증상이 있습니다.'],
            ],
        ]);

        $content = $result->choices[0]->message->content;
        
        return response()->json($content);
    }
    
    public function useraddressget() {

        $id = session('id');

        $result = User::select('user_address')->where('id', $id)->get();

        return response()->json($result);
    }
}

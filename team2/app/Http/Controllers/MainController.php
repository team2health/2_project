<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Part;
use App\Models\Record;
use App\Models\Dps_link;
use App\Models\Diagnosis;
use App\Models\Part_symptom;
use App\Models\Disease_diagnosis;

class MainController extends Controller
{
    public function mainget() {
        $result = Part::orderby('part_id', 'asc')->get();

        return view('main')->with('part', $result);
    }

    public function partselectpost(Request $request) {
        $part_id = $request->part_id;
        
        $result = Part_symptom::join('symptoms', 'part_symptoms.symptom_id', '=', 'symptoms.symptom_id')
            ->select('symptoms.symptom_name', 'part_symptoms.part_symptom_id')
            ->where('part_symptoms.part_id', $part_id)
            ->orderby('symptoms.symptom_id', 'asc')
            ->get();

            return response()->json($result);
    }

    public function symptomselectpost(Request $request) {
        $part_symptom_id = $request->part_symptom_id;
        $symptomData = Part_symptom::find($part_symptom_id);
        if(session('id')) {
            $recordData = [
                'u_id' => session('id'),
                'symptom_id' => $symptomData->symptom_id,
            ];
                    
            $record = Record::create($recordData);
        }

        $result[] = Dps_link::join('diseases', 'diseases.disease_id', '=', 'dps_links.disease_id')
            ->select('diseases.disease_id', 'diseases.disease_name', 'diseases.disease_info')
            ->where('dps_links.part_symptom_id', $part_symptom_id)
            ->get();

        $result[] = session('id');

            return response()->json($result);
    }
    
    public function useraddresspost(Request $request) {

        $user_id = $request->user_id;
        $disease_id = $request->disease_id;

        $result[] = User::where('id', $user_id)->get();
        $result[] = Disease_diagnosis::join('diagnoses', 'disease_diagnoses.diagnosis_id', '=', 'diagnoses.diagnosis_id')
            ->select('diagnoses.diagnosis_name')
            ->where('disease_diagnoses.disease_id', $disease_id)
            ->get();

        return response()->json($result);
    }
}

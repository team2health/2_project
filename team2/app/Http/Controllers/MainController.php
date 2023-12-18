<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Part;
use App\Models\Part_symptom;
use App\Models\Dps_link;
use App\Models\User;
use App\Models\Disease_diagnosis;
use App\Models\Disease;
use App\Models\Diagnosis;

class MainController extends Controller
{
    public function mainget() {
        $result = Part::orderby('part_id', 'asc')->get();

        return view('main')->with('part', $result);
    }

    public function partselectpost(Request $request) {
        // Log::debug('올', $request->all());
        // Log::debug("이거", ['part_id' => $request->part_id]);
        $part_id = $request->part_id;
        // Log::debug("담았슴", ['part_id' => $part_id]);
        
        $result = Part_symptom::join('symptoms', 'part_symptoms.symptom_id', '=', 'symptoms.symptom_id')
            ->select('symptoms.symptom_name', 'part_symptoms.part_symptom_id')
            ->where('part_symptoms.part_id', $part_id)
            ->orderby('symptoms.symptom_id', 'asc')
            ->get();

            return response()->json($result);
    }

    public function symptomselectpost(Request $request) {
        // Log::debug('올', $request->all());
        // Log::debug("이거", ['part_symptom_id' => $request->part_symptom_id]);
        $part_symptom_id = $request->part_symptom_id;
        // Log::debug("담았슴", ['part_symptom_id' => $part_symptom_id]);
        
        $result[] = Dps_link::join('diseases', 'diseases.disease_id', '=', 'dps_links.disease_id')
            ->select('diseases.disease_id', 'diseases.disease_name', 'diseases.disease_info')
            ->where('dps_links.part_symptom_id', $part_symptom_id)
            ->get();

        $result[] = session('id');

            // Log::debug("dddddd", ['result' => $result]);

            return response()->json($result);
    }
    
    public function useraddresspost(Request $request) {
        Log::debug("이이이이이잉", $request->all());

        $user_id = $request->user_id;
        $disease_id = $request->disease_id;

        $result[] = User::where('id', $user_id)->get();
        // $result[] = 

        return response()->json($result);
    }
}

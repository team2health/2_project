<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Part;
use App\Models\Part_symptom;

class MainController extends Controller
{
    public function mainget() {
        $result = Part::get();

        return view('main')->with('part', $result);
    }

    public function partselectpost(Request $request) {
        Log::debug('올', $request->all());
        Log::debug("이거", ['part_id' => $request->part_id]);
        $part_id = $request->part_id;
        Log::debug("담았슴", ['part_id' => $part_id]);
        
        $result = Part_symptom::where('part_id', $part_id);

        return view('main')->with('symptom', $result);
    }
}

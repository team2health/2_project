<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;

class MainController extends Controller
{
    public function mainget() {
        $result = Part::get();

        return view('main')->with('data', $result);
    }
}

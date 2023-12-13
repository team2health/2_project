<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function registget() {
        return view('regist');
    }

    // public function registpost(Request $request) {

    // }
}

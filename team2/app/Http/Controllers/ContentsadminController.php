<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Adminauth as Middleware;


use Illuminate\Http\Request;

class ContentsadminController extends Controller
{
    //
    public function admincontents() {
        return view('adminpage.contentsmanagement');
    }

    public function contentsdeclaration() {
        return view('adminpage.declaration');
    }
}

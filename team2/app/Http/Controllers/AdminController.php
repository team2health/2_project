<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
// use Illuminate\Contracts\Auth\Adminauth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminlogin(Request $request) {
        Log::debug($request);

        $result = Admin::where('admin_id', $request->admin_id)->first();

        if(!(Hash::check($request->admin_password, $result->admin_password))) {
            return view('adminlogin');
        }

        Auth::login($result);
        if(Auth::check()) {
            session($result->only('admin_id', 'admin_name'));
        } else {
            return view('adminlogin');
        }
        return redirect()->route('adminmain');
    }
    public function adminlogout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('main.get');
    }

    public function adminmain() {
        return view('adminpage.index');
    }
}

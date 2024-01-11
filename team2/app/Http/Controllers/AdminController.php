<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Admin;
use App\Models\User;

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
            session($result->only('id', 'admin_id', 'admin_name'));
        } else {
            return view('adminlogin');
        }
        return view('adminpage.index');
    }

    public function mainget() {
        User::select('birthday')->get();
        
        // 유저 나이
        $birthday = $userinfo[0]['birthday'];

        $currentYear = date('Y');

        $birthYear = date('Y', strtotime($birthday));
    
        $age = $currentYear+1 - $birthYear;
    }
}

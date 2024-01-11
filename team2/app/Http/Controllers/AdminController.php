<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Auth\Authenticatable;
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

    public function mainget() {

        User::select()

        // SELECT CASE WHEN age < 20 THEN '10'
        //     WHEN age BETWEEN 20 AND 29 THEN '20'
        //     WHEN age BETWEEN 30 AND 39 THEN '30'
        //     WHEN age BETWEEN 40 AND 49 THEN '40'
        //     WHEN age BETWEEN 50 AND 59 THEN '50'
        //     WHEN age >= 60 THEN '60대 이상'
        //     END AS age_group
        // , COUNT(*) total_cnt
        // FROM(
        //     SELECT birthday, date_format(now(), '%Y') - date_format(birthday, '%Y') AS age
        //     FROM users
        //     ) AS c
        // GROUP BY age_group
        // ORDER BY age_group;
    }
}

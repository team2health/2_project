<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function registget() {
        return view('regist');
    }

    public function registpost(Request $request) {
        // Log::debug("*********** registpost start ***********");
        $data = $request->only('user_id', 'user_name', 'user_password', 'user_address', 'user_gender');
        // Log::debug("request data", $data);
        $data['user_password'] = Hash::make($data['user_password']);

        $result = User::create($data);

        // Log::debug("*********** registpost end ***********");
        return redirect()->route('login.get');
    }

    public function loginget() {
        return view('login');
    }

    public function loginpost(Request $request) {
        $result = User::where('user_id', $request->user_id)->first();
        if(!$result || !(Hash::check($request->user_password, $result->user_password))) {
            return redirect()->route('login.get');
        }

        Auth::login($result);
        if(Auth::check()) {
            session($result->only('user_id', 'auth'));
        } else {
            return view('login');
        }

        return redirect()->route('main');
    }

    public function logoutget() {
        Session::flush();
        Auth::logout();
        return redirect()->route('main');
    }

    // public function namechkpost(Request $request) {
    //     Log::debug("*********** namechkpost start ***********");
    //     // Log::debug("POST data".$_POST);
    //     Log::debug("이거".$request->userName);
    //     $username = $request->user_name;
    //     Log::debug("user_name:".$username);

    //     $existingUser = User::where('user_name', $username)->first();

    //     if ($existingUser) {
    //         return response()->json(['nameChk' => '1']);
    //         exit;
    //     }
    //     return response()->json(['nameChk' => '0']);
    // }
}

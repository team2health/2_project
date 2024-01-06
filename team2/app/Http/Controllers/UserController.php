<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\support\Facades\DB;




class UserController extends Controller
{
    public function registget() {
        if(Auth::check()) {
            return redirect()->route('main.get');
        }
        
        return view('regist');
    }

    public function registpost(Request $request) {
        
        $data = $request->only('user_id', 'user_name', 'user_password', 'user_address_num', 'user_address', 'user_address_detail', 'user_gender');
        $data['user_password'] = Hash::make($data['user_password']);
        $result = User::create($data);
        return redirect()->route('login.get');
    }

    public function loginget() {
        if(Auth::check()) {
            return redirect()->route('main.get');
        }
        return view('login')->with('passwordError','0');
    }

    public function loginpost(Request $request) {
        $result = User::where('user_id', $request->user_id)->first()
        ;
        // 탈퇴한 사용자 로그인 알림
        // $deleted_user = User::withTrashed()
        // ->where('id', $request->user_id)
        // ->get();

        if(isset($deleted_user)) {
            return view('login')->with('passwordError', '2');
        }

        if(!$result) {
            return view('login')->with('passwordError', '0');
        }

        if(!(Hash::check($request->user_password, $result->user_password))) {
            return view('login')->with('passwordError', '1');
        }
        
        Auth::login($result);
        if(Auth::check()) {
            session($result->only('id', 'user_name', 'user_img'));
        } else {
            return view('login');
        }

        return redirect()->route('main.get');
    }

    public function logoutget() {
        Session::flush();
        Auth::logout();
        return redirect()->route('main.get');
    }

    public function namechkpost(Request $request) {
        $username = $request->user_name;

        $existingUser = User::where('user_name', $username)->first();

        if ($existingUser) {
            return response()->json(['nameChk' => '1']);
            exit;
        }
        return response()->json(['nameChk' => '0']);
    }

    public function idchkpost(Request $request) {
        $userid = $request->user_id;

        $existingUser = User::where('user_id', $userid)->first();

        if ($existingUser) {
            return response()->json(['idChk' => '1']);
            exit;
        }
        return response()->json(['idChk' => '0']);
    }

    public function deleteaccountchk(Request $request) {

        $id = session('id');
        $user_into = $request->user_password;
        $result = User::where('id', $id)->first();

        if (Hash::check($user_into, $result->user_password)) {
            User::destroy($id);
            Log::debug("성공");
        } else {
            Log::debug("실패");
        }

    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\support\Facades\DB;
use App\Models\Board_tag;
use Illuminate\Support\Facades\Validator;




class UserController extends Controller
{
    public function registget() {
        if(Auth::check()) {
            return redirect()->route('main.get');
        }
        
        return view('regist');
    }


    public function registpost(Request $request) {

        $data = $request->only('user_email', 'user_name', 'user_password', 'user_address_num', 'user_address', 'user_address_detail', 'user_gender');
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
        $result = User::where('user_email', $request->user_email)->first();
        // 탈퇴한 사용자 로그인 알림

        $deleted_user = User::withTrashed()
        ->where('user_email', $request->user_email)
        ->whereNull('deleted_at')
        ->get();
        $deleted_user = $deleted_user->count();
        if($deleted_user === 0) {
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

        $existingUser = User::withTrashed()->where('user_name', $username)->first();

        if ($existingUser) {
            return response()->json(['nameChk' => '1']);
            exit;
        }
        return response()->json(['nameChk' => '0']);
    }

    public function idchkpost(Request $request) {

        $userid = $request->user_email;

        $existingUser = User::withTrashed()->where('user_email', $userid)->first();

        if ($existingUser) {
            return response()->json(['idChk' => '1']);
        }
        return response()->json(['idChk' => '0']);
    }

    public function deleteaccountchk(Request $request) {

        $id = session('id');
        $user_into = $request->user_password;
        $result = User::where('id', $id)->first();

        if (Hash::check($user_into, $result->user_password)) {
            User::destroy($id);
            return redirect()->route('seeyouagain');
        } else {
            Log::debug("실패");
        }
    }
    public function firstchkpassword() {
        return view('firstchkpassword');
    }
    public function changpasswordchk(Request $request) {

        $id = session('id');
        $user_password = $request->user_password;
        $user_new_password = $request->user_new_password;
        $user_new_passwordchk = $request->user_new_passwordchk;

        $rules = [
            'password_rule' => 'required|string|min:6|max:20|regex:/^[a-z0-9]+$/',
        ];

        $passwordchk = ['password_rule' => $user_new_password];

        $result = User::where('id', $id)->first();
    
        if ($user_password === $user_new_password) {
            return view('firstchkpassword')->with('passwordchk','3');
        }
        // 유효성 검사
        $validator = Validator::make($passwordchk, $rules);
        // 유효성 검사 실패 시
        if ($validator->fails()) {
            return view('firstchkpassword')->with('passwordchk','4');
        }

        if (Hash::check($user_password, $result->user_password)) {
            if( $user_new_password === $user_new_passwordchk ) {
                $user_new_password = Hash::make($user_new_password);
                DB::table('users')->where('id', $id)->update(['user_password' => $user_new_password]);
                return redirect()->route('mypage.get');
            } else {
                return view('firstchkpassword')->with('passwordchk','2');
            }
        }else {
            return view('firstchkpassword')->with('passwordchk','1');
        }
    }
}
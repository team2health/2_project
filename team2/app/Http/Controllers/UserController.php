<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\support\facades\DB;
use App\Models\User;
use App\Models\Board;

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
            session($result->only('id', 'user_name'));
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

    // 마이페이지 이동 시 로그인 유무확인 및 게시글 불러오기
    public function mypageget(Request $request) {

        // 사용자 ID 가져오기
        $result2 = session('user_id');
        $result1 = session('id');

        $result = User::where('user_id', $request->user_id)->first();
        // var_dump($result);
        // var_dump($result2);
        // exit;
        if(Auth::check()) {
            $boardresult = Board::where('u_id', $result)->get();
            // var_dump($boardresult);
            // exit;
            // var_dump($boardresult);
            // exit;
            return view('mypage')->with('data', $boardresult);
        } else {
            return view('login');
        }

    }
}
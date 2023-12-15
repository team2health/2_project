<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\support\facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Board;
use App\Models\Favorite_tag;



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

        return redirect()->route('main.get');
    }

    public function logoutget() {
        Session::flush();
        Auth::logout();
        return redirect()->route('main.get');
    }

    public function namechkpost(Request $request) {
        Log::debug("*********** namechkpost start ***********");
        // Log::debug("POST data".$_POST);
        // Log::debug("이거", $request->all());
        // Log::debug("이거".$request->user_name);
        $username = $request->user_name;
        // Log::debug("user_name:".$username);

        $existingUser = User::where('user_name', $username)->first();

        if ($existingUser) {
            return response()->json(['nameChk' => '1']);
            exit;
        }
        return response()->json(['nameChk' => '0']);
    }

    // 마이페이지 이동 시 로그인 유무확인 및 게시글 불러오기
    public function mypageget() {

        // 사용자 ID 가져오기
        $result = session('id');

        if(Auth::check()) {

            $board_result = DB::table('boards')
                ->select(
                'board_id'
                ,'u_id'
                ,'category_id'
                ,'board_title'
                ,'board_content'
                ,'board_hits'
                ,DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as created_at')
                ,'updated_at')
                ->where('u_id',$result)
                ->where('deleted_at', null)
                ->get();
            
            $user_hashtag = DB::table('favorite_tags')
                ->select(
                'favorite_tags.favorite_id'
                ,'favorite_tags.hash_id'
                ,'hashtags.hash_name'
                )
                ->join('hashtags', 'hashtags.hash_id', '=', 'favorite_tags.hash_id')
                ->where('favorite_tags.u_id', $result)
                ->where('favorite_tags.deleted_at', null)
                ->get();
            
            $user_info  = DB::table('users')
                ->select(
                    'id'
                    ,'user_id'
                    ,'user_name'
                    ,'user_address'
                    ,'user_img'
                )
                ->where('id', $result)
                ->get();

            return view('mypage')->with('data', $board_result)->with('user_hashtag', $user_hashtag);
        } else {
            return view('login');
        }
    }

    public function myhashdeletepost(Request $request) {
        Log::debug("*********START*********");
        Log::debug("받아온 거".$request->favorite_id);
        $id = $request->favorite_id;
        Log::debug("넣어준 거".$id);
        Favorite_tag::destroy($id);
        DB::commit();
    }


    public function myinfomodify() {

    }
}
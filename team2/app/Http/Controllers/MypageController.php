<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite_tag;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MypageController extends Controller
{
    // 마이페이지 이동 시 로그인 유무확인 및 게시글 불러오기
    public function mypageget() {
        
        // 사용자 ID 가져오기
        $result = session('id');

        if(!Auth::check()){
            return redirect()->route('login.get');
        }

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
            ->orderBy('board_id', 'DESC')
            ->get();

        $comment_result = DB::table('comments')
            ->select(
                'comments.comment_id'
                ,'comments.board_id'
                ,'comments.comment_content'
                ,DB::raw('DATE_FORMAT(comments.created_at, "%Y-%m-%d") as created_at')
                ,'boards.board_title'
            )->join('boards', 'boards.board_id', 'comments.board_id')
            ->where('comments.u_id',$result)
            ->where('comments.deleted_at', null)
            ->orderby('comments.comment_id', 'DESC')
            ->get();
        
        $user_hashtag = DB::table('favorite_tags')
            ->select(
            'favorite_tags.favorite_tag_id'
            ,'favorite_tags.hashtag_id'
            ,'hashtags.hashtag_name'
            )
            ->join('hashtags', 'hashtags.hashtag_id', '=', 'favorite_tags.hashtag_id')
            ->where('favorite_tags.u_id', $result)
            ->where('favorite_tags.deleted_at', null)
            ->orderBy('favorite_tags.created_at')
            ->get();
        
        $user_info  = DB::table('users')
            ->select(
                'id'
                ,'user_id'
                ,'user_name'
                ,'user_address'
                ,'user_address_detail'
                ,'user_img'
            )
            ->where('id', $result)
            ->get();

            // Log::debug("유저", ['name' => $user_info]);

        return view('mypage')->with('data', $board_result)
        ->with('user_hashtag', $user_hashtag)
        ->with('user_info', $user_info)
        ->with('comments', $comment_result);
    }
    
    
        public function allhashget(Request $request){

            Log::debug("allhashget", $request->all());
            $result = session('id');
            $user_hashtag = DB::table('favorite_tags')
            ->select(
            'favorite_tags.hashtag_id'
            )
            ->join('hashtags', 'hashtags.hashtag_id', '=', 'favorite_tags.hashtag_id')
            ->where('favorite_tags.u_id', $result)
            ->where('favorite_tags.deleted_at', null)
            ->orderBy('hashtags.hashtag_id')
            ->get();
            foreach ($user_hashtag as $key => $value) {
                $result2[] = $value->hashtag_id;
            }
    
            $hashtag  = DB::table('hashtags')
            ->select(
                'hashtags.hashtag_id'
                ,'hashtags.hashtag_name'
            );
            
            if( isset($result2)) {
                $hashtag->whereNotIn('hashtags.hashtag_id', $result2);
            }
            $hashtag->orderBy('hashtags.hashtag_id');
            $allhashtag = $hashtag->get();
            Log::debug($allhashtag);
            return response()->json($allhashtag);
        }
    
        public function myhashdeletepost(Request $request) {
            Log::debug('**********************해시태그 삭제 start***********************');
            Log::debug($request);
            
            $id = $request->myhashdelete;
            // $user_id = session('id');
            // Log::debug($id);
            // Log::debug('유저아이디');
            // Log::debug($user_id);

            // $favoritetag_id =
            // DB::table('favorite_tags')
            // ->select('favorite_tags.favorite_tag_id')
            // ->join('hashtags', 'hashtags.hashtag_id', '=', 'favorite_tags.hashtag_id')
            // ->where('favorite_tags.u_id', $user_id)
            // ->where('favorite_tags.hashtag_id', $id)
            // ->where('favorite_tags.deleted_at', null)
            // ->get();

            Log::debug($id);

            Favorite_tag::destroy($id);
        }
    
        public function addfavoritehashtagpost(Request $request) {
    
            $currentDateTime = Carbon::now();
            Log::debug("asdfasdfa", $request->all());
            $tag_id = $request->tag_id;
            $result = session('id');
            Log::debug("session", ['id' => $result]);
            $hashtag = DB::table('favorite_tags')->insert([
                'hashtag_id' => $tag_id,
                'u_id' => $result,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ]);

            $hashtaginfo =
            DB::table('favorite_tags')
            ->select(
                'favorite_tags.favorite_tag_id'
                ,'hashtags.hashtag_id'
                ,'hashtags.hashtag_name'
                )
            ->join('hashtags', 'hashtags.hashtag_id', '=', 'favorite_tags.hashtag_id')
            ->orderby('favorite_tag_id', 'desc')
            ->limit(1)
            ->get();
            Log::debug($hashtaginfo);
            Log::debug(response()->json($hashtaginfo));
            return response()->json($hashtaginfo);
        }

    public function todaytimelineget(){

        Log::debug('********************start*************');
        $created_start = Carbon::now()->format('Y-m-d');
        $user_id = session('id');
        Log::debug($created_start);
        Log::debug($user_id);

        $today_timeline = DB::table('symptoms')
        ->select(
            'records.record_id'
            ,'symptoms.symptom_id'
            ,'symptoms.symptom_name'
            ,DB::raw('DATE_FORMAT(records.created_at, "%H:%i") as created_date')
            ,'records.created_at'
        )
        ->join('records', 'records.symptom_id', '=', 'symptoms.symptom_id')
        ->where('records.u_id', $user_id)
        ->where('records.created_at', 'like', $created_start.'%')
        ->where('records.deleted_at', null)
        ->get();

        Log::debug($today_timeline);
        $result_count = $today_timeline->count();
        Log::debug($result_count);

        return view('timeline')
        ->with('data', $today_timeline)
        ->with('result_count', $result_count);
    }



    public function namechangepost(Request $request) {
        // Log::debug("*********** namechkpost start ***********");
        // Log::debug("POST data".$_POST);
        // Log::debug("이거", $request->all());
        // Log::debug("이거".$request->user_name);
        $username = $request->user_name;
        // Log::debug("user_name:".$username);
        
        $existingUser = User::where('user_name', $username)->first();
        
        if ($existingUser) {
            return response()->json(['namechange' => '1']);
            exit;
        }
        return response()->json(['namechange' => '0']);
    }

    public function userinfoupdatepost(Request $request) {
        // Log::debug("111111", $request->all());
        
        // 사용자 ID 가져오기
        $result = session('id');
        
        $imgFlg = $request->imgFlg;
        // Log::debug("efeeee", ['img' => $imgFlg]);
        
        $userinfo = User::find($result);
        
        if($imgFlg == 1) {
            $imgName = Str::uuid().'.'.$request->user_img->extension();
            $request->user_img->move(public_path('user_img'), $imgName);
            $userinfo->user_img = $imgName;
        } else if($imgFlg == 2) {
            $userinfo->user_img = '../img/default_f.png';
        }
        
        if($request->user_name) {
            $userinfo->user_name = $request->user_name;
        }
        if($request->user_address) {
            $userinfo->user_address = $request->user_address;

            if($request->user_address_detail) {
                $userinfo->user_address_detail = $request->user_address_detail;
            } else {
                $userinfo->user_address_detail = null;
            }
        }
        
        $userinfo->save();

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
            ->orderBy('board_id', 'DESC')
            ->get();
            
            $user_hashtag = DB::table('favorite_tags')
            ->select(
            'favorite_tags.favorite_tag_id'
            ,'favorite_tags.hashtag_id'
            ,'hashtags.hashtag_name'
            )
            ->join('hashtags', 'hashtags.hashtag_id', '=', 'favorite_tags.hashtag_id')
            ->where('favorite_tags.u_id', $result)
            ->where('favorite_tags.deleted_at', null)
            ->orderBy('favorite_tags.created_at')
            ->get();
            
            $user_info  = DB::table('users')
            ->select(
                'id'
                ,'user_id'
                ,'user_name'
                ,'user_address'
                ,'user_address_detail'
                ,'user_img'
            )
            ->where('id', $result)
            ->get();
            
            $comment_result = DB::table('comments')
            ->select(
                'comments.comment_id'
                ,'comments.board_id'
                ,'comments.comment_content'
                ,DB::raw('DATE_FORMAT(comments.created_at, "%Y-%m-%d") as created_at')
                ,'boards.board_title'
            )->join('boards', 'boards.board_id', 'comments.board_id')
            ->where('comments.u_id',$result)
            ->orderby('comments.comment_id', 'DESC')
            ->get();

            // Log::debug("이름", ['name' => $user_info]);
            session(['user_name' => $user_info[0]->user_name,
            'user_img' => $user_info[0]->user_img]);
            // Log::debug("유저", ['name' => $user_info]);

            
            return view('mypage')
            ->with('data', $board_result)
            ->with('user_hashtag', $user_hashtag)
            ->with('user_info', $user_info)
            ->with('comments', $comment_result);
        }

    public function daytimelinepost(Request $request) {

        log::debug("daytimelinepost", $request->all());
        $created_at = $request->date;
        Log::debug($created_at);
        $user_id = session('id');

        $timeline = DB::table('symptoms')
        ->select(
            'records.record_id'
            ,'symptoms.symptom_id'
            ,'symptoms.symptom_name'
            ,DB::raw('DATE_FORMAT(records.created_at, "%H:%i") as created_at')
        )
        ->join('records', 'records.symptom_id', '=', 'symptoms.symptom_id')
        ->where('records.u_id', $user_id)
        ->where('records.created_at', 'like', $created_at.'%')
        ->where('records.deleted_at', null)
        ->get();
        
        Log::debug($timeline);

        return response()->json($timeline);

    }
            
    public function recorddelete(Request $request) {

    $id = $request->record_id;
    $created_at = $request->created_at;
    Log::debug($id);
    Log::debug($created_at);

    Record::destroy($id);
    DB::commit();
    
    }
}
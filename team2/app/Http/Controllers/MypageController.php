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
use App\Models\Board_tag;

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
            'boards.board_id'
            ,'boards.u_id'
            ,'boards.category_id'
            ,'boards.board_title'
            ,'boards.board_content'
            ,'boards.board_hits'
            ,DB::raw('DATE_FORMAT(boards.created_at, "%Y-%m-%d") as created_at')
            ,'boards.updated_at'
            ,'board_imgs.img_address')
            ->leftJoin('board_imgs', function ($join) {
                $join->on('boards.board_id', '=', 'board_imgs.board_id')
                    ->whereRaw('board_imgs.board_img_id =
                    (SELECT MIN(board_img_id)
                    FROM board_imgs
                    WHERE board_id = boards.board_id)');
            })
            ->where('boards.u_id',$result)
            ->where('boards.deleted_at', null)
            ->orderBy('boards.board_id', 'DESC')
            ->get();

            $board_result = json_decode($board_result, true);
            $cnt = 0;
            foreach ($board_result as $item) {
                // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
                $board_result[$cnt]['board_tag'] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
                ->select('hashtags.hashtag_name')
                ->where('board_tags.board_id', $item['board_id'])
                ->orderby('board_tags.board_id', 'desc')
                ->get();
                $cnt++;
            }

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
            ->where('boards.deleted_at', null)
            ->orderby('comments.comment_id', 'DESC')
            ->limit(8)
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
                ,'user_address_num'
                ,'user_address_detail'
                ,'user_img'
            )
            ->where('id', $result)
            ->get();

        return view('mypage')->with('data', $board_result)
        ->with('user_hashtag', $user_hashtag)
        ->with('user_info', $user_info)
        ->with('comments', $comment_result);
    }
    
    // 게시글 더보기
    public function mypageboardplus(Request $request) {

        $result = session('id');
        $last_id  = $request->lastboardid;

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
        ->where('board_id', '<', $last_id)
        ->where('u_id',$result)
        ->where('deleted_at', null)
        ->orderBy('board_id', 'DESC')
        ->limit(4)
        ->get();

        return response()->json($board_result);
    }

    // 댓글 더보기
    public function mypagecommentplus(Request $request) {

        $result = session('id');
        $last_id  = $request->lastboardid;

        $comment_result = DB::table('comments')
            ->select(
                'comments.comment_id'
                ,'comments.board_id'
                ,'comments.comment_content'
                ,DB::raw('DATE_FORMAT(comments.created_at, "%Y-%m-%d") as created_at')
                ,'boards.board_title'
            )->join('boards', 'boards.board_id', 'comments.board_id')
            ->where('comments.comment_id', '<', $last_id)
            ->where('comments.u_id', $result)
            ->where('comments.deleted_at', null)
            ->where('boards.deleted_at', null)
            ->orderby('comments.comment_id', 'DESC')
            ->limit(4)
            ->get();

            return response()->json($comment_result);
    }

    public function allhashget(Request $request){

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
        return response()->json($allhashtag);
}

    public function myhashdeletepost(Request $request) {
        
        $id = $request->myhashdelete;

        Favorite_tag::destroy($id);
    }

    public function addfavoritehashtagpost(Request $request) {

        $currentDateTime = Carbon::now();
        $tag_id = $request->tag_id;
        $result = session('id');
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
        return response()->json($hashtaginfo);
    }

    public function todaytimelineget(){

        $created_start = Carbon::now()->format('Y-m-d');
        $user_id = session('id');

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

        $result_count = $today_timeline->count();

        return view('timeline')
        ->with('data', $today_timeline)
        ->with('result_count', $result_count);
    }



    public function namechangepost(Request $request) {
        $username = $request->user_name;
        
        $existingUser = User::where('user_name', $username)->first();
        
        if ($existingUser) {
            return response()->json(['namechange' => '1']);
        }
        return response()->json(['namechange' => '0']);
    }

    public function userinfoupdatepost(Request $request) {
        
        // 사용자 ID 가져오기
        $result = session('id');
        
        $imgFlg = $request->imgFlg;
        
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
            'boards.board_id'
            ,'boards.u_id'
            ,'boards.category_id'
            ,'boards.board_title'
            ,'boards.board_content'
            ,'boards.board_hits'
            ,DB::raw('DATE_FORMAT(boards.created_at, "%Y-%m-%d") as created_at')
            ,'boards.updated_at')
            ->where('boards.u_id',$result)
            ->where('boards.deleted_at', null)
            ->orderBy('boards.board_id', 'DESC')
            ->get();

            $board_result = json_decode($board_result, true);
            $cnt = 0;
            foreach ($board_result as $item) {
                // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
                $board_result[$cnt]['board_tag'] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
                ->select('hashtags.hashtag_name')
                ->where('board_tags.board_id', $item['board_id'])
                ->orderby('board_tags.board_id', 'desc')
                ->get();
                $cnt++;
            }

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
                ,'user_address_num'
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
            ->where('comments.deleted_at', null)
            ->where('boards.deleted_at', null)
            ->orderby('comments.comment_id', 'DESC')
            ->limit(8)
            ->get();

            session(['user_name' => $user_info[0]->user_name,
            'user_img' => $user_info[0]->user_img]);


            return view('mypage')
            ->with('data', $board_result)
            ->with('user_hashtag', $user_hashtag)
            ->with('user_info', $user_info)
            ->with('comments', $comment_result);
        }


    public function daytimelinepost(Request $request) {

        $created_at = $request->date;
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

        return response()->json($timeline);

    }
            
    public function recorddelete(Request $request) {

    $id = $request->record_id;
    $created_at = $request->created_at;

    Record::destroy($id);
    DB::commit();
    
    }
    public function hashtagsearch(Request $request) {
        $id = session('id');
        Log::debug($id);

        $result = trim($request->hashsearch);
        $hashget = DB::table('hashtags')
        ->select('hashtag_id')
        ->where('hashtag_name','like', '%'.$result.'%')
        ->get();

        $hashget_count = $hashget->count();
        $hashget = json_decode($hashget, true);


        Log::debug("hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh");
        Log::debug($hashget);

        if(!empty($hashget)) {
            foreach ($hashget as $item) {
                $count = DB::table('favorite_tags')
                    ->select('hashtag_id')
                    ->where('hashtag_id', $item['hashtag_id'])
                    ->whereNotNull('deleted_at')
                    ->where('u_id', $id)
                    ->get();
                }
                $count = json_decode($count, true);
                Log::debug('countcountcountcount');
                Log::debug($count);
        }
        
        if(empty($count)){
            $result_set = $hashget;
        } else {
            $result_set = array_diff($hashget, $count);
        }
        Log::debug('differencedifferencedifferencedifference');
        Log::debug($result_set);


        if($result_set != null) {
            // 검색결과 있음
            foreach($result_set as $item){
                $hashtag_search = DB::table('hashtags')
                ->select('hashtag_id', 'hashtag_name')
                ->where('hashtag_id',$item['hashtag_id'])
                ->orderBy('hashtag_id', 'desc')
                ->get();
            }
            return response()->json($hashtag_search);
        } else {
            return response()->json('false');
        }
    }
    public function seeyouagainget() {
        return view('byebye');
    }

}
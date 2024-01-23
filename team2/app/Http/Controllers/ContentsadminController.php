<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Adminauth as Middleware;
use Illuminate\Support\Facades\Mail;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\User;
use App\Mail\ComplaintMail;
use App\Models\Comment;
use App\Models\Board_report;
use App\Models\Comment_report;
use Carbon\Carbon;

class ContentsadminController extends Controller
{
    //
    
    // 게시글 날짜 검색 
    public function contentsearch(Request $request) {
        $start_date =  $request->start_year.$request->start_month.$request->start_day;
        $end_date = $request->end_year.$request->end_month.$request->end_day;
        // $date[] = $start_date;
        // $date[] = $end_date;


        if(session()->has('align_board')) {
            $align_board = session('align_board');
            return redirect()->route('admin.admincontentsset',
            ['align_board' => $align_board, 'start_date' => $start_date, 'end_date' => $end_date]);
        } else {
            return redirect()->route('admin.admincontentsset', ['align_board' => '1', 'start_date' => $start_date, 'end_date' => $end_date]);
        }
        // if(session()->has('align_board')) {
        //     $align_board = session('align_board');
        //     return $this->admincontentsset($align_board, $start_date, $end_date);
        // } else {
        //     return $this->admincontentsset('1', $start_date, $end_date);
        // }
    }

    public function contentssort(Request $request) {

        $result = $request->align_board;
        // 세션에 값 저장
        session(['align_board' => $result]);
        return $this->admincontents($result, null);
    }
    
    public function admincontents($result, $date = null) {
        if (!$date) {
            $date = date('Ymd');
            $oneMonthAgo = Carbon::now()->subMonth();
            $result = $oneMonthAgo->format('Ymd');
        }
        
        if(session()->has('align_board')) {
            $align_board = session('align_board');
            return redirect()->route('admin.admincontentsset',
            ['align_board' => $align_board, 'start_date' => $result, 'end_date' => $date]);
        } else {
            return redirect()->route('admin.admincontentsset',
            ['align_board' => '1', 'start_date' => $result, 'end_date' => $date]);
        }
    }

    public function admincontentsset($align_board, $start_date, $end_date) {
        $boards = DB::table('boards')
        ->select(
            'boards.board_id',
            'users.user_email',
            'categories.category_name',
            'boards.board_title',
            'boards.board_content',
            'boards.board_hits',
            DB::raw('count(comments.comment_id) as comcount'),
            'boards.created_at'
        )
        ->whereNull('boards.deleted_at')
        ->leftJoin('users', 'users.id', 'boards.u_id')
        ->leftJoin('comments', 'comments.board_id', 'boards.board_id')
        ->leftJoin('categories', 'categories.category_id', 'boards.category_id');
        if($end_date !== null) {
            $boards = $boards->whereBetween('boards.created_at', [$start_date.'000000', $end_date.'235959']);
        }
        $boards->wherenull('boards.board_show_flg')
        ->groupBy(
            'boards.board_id',
            'users.user_email',
            'categories.category_name',
            'boards.board_title',
            'boards.board_hits',
            'boards.created_at',
            'boards.board_content'
        );
        if($align_board == '0') {
            $boards = $boards->orderBy('boards.board_hits', 'desc');
        } else {
            $boards = $boards->orderBy('boards.created_at', 'desc');
        }

        $data = $boards->paginate(10);

        $date = [$start_date, $end_date];
        return view('adminpage.contentsmanagement')
        ->with('data', $data)
        ->with('date', $date);
    }

    public function admincomments($date = null) {
        if (!$date) {
            $start_date = Carbon::now()->subMonth()->format('Ymd');
            $end_date = date('Ymd');
        }
        return $this->admincommentsset($start_date, $end_date);
    }
    // 댓글 날짜 검색
    public function commentsearch(Request $request) {
        $start_date =  $request->start_year.$request->start_month.$request->start_day;
        $end_date = $request->end_year.$request->end_month.$request->end_day;

        return redirect()->route('admin.admincommentsset', 
        ['start_date' => $start_date, 'end_date' => $end_date]);
    }
    
    public function admincommentsset($date, $date2) {

        $start_date = $date;
        $end_date = $date2;
        // if(count($date) > 1) {
        //     $start_date = $date[0];
        //     $end_date = $date[1];
        // } else {
        //     $start_date = $date[0];
        //     $end_date = date('Ymd');
        // }

        $comment = DB::table('comments')
        ->select(
            'comments.comment_id'
            , 'users.user_email'
            , 'comments.comment_content'
            , 'comments.created_at'
            , 'boards.board_id'
            , 'boards.board_title'
            , 'users.user_name')
        ->join('boards', 'boards.board_id', 'comments.board_id')
        ->join('users', 'users.id', 'comments.u_id')
        ->whereNull('comments.deleted_at')
        ->where('comments.created_at','>=', $start_date.'000000')
        ->where('comments.created_at','<=', $end_date.'235959')
        ->orderBy('comments.created_at', 'desc')
        ->paginate(10); 

        $date = [$start_date, $end_date];
        return view('adminpage.admincomments')
        ->with('comment', $comment)
        ->with('date', $date);
    }


    public function contentsdeclaration() {
        $data = DB::table('board_reports')
        ->select(
            'board_reports.board_id',
            'boards.board_title',
            'boards.board_content',
            'boards.created_at',
            'users.user_name',
            'users.user_email',
            'boards.board_hits',
            'detotal',
            'commenttotal'
        )
        ->join('boards', 'board_reports.board_id', 'boards.board_id')
        ->join('users', 'boards.u_id', 'users.id')
        ->leftJoin('comments', 'comments.board_id', 'boards.board_id')
        ->leftJoin(
            DB::raw('(SELECT board_id, COUNT(board_id) as detotal FROM board_reports GROUP BY board_id) as detotal_table'),
            'detotal_table.board_id',
            '=',
            'board_reports.board_id'
        )
        ->leftJoin(
            DB::raw('(SELECT board_id, COUNT(comment_id) as commenttotal FROM comments GROUP BY board_id) as commenttotal_table'),
            'commenttotal_table.board_id',
            '=',
            'board_reports.board_id'
        )
        ->where('board_reports.board_report_complete', '0')
        ->wherenull('boards.deleted_at')
        ->groupBy(
            'board_reports.board_id',
            'boards.board_title',
            'boards.board_content',
            'users.user_name',
            'boards.created_at',
            'users.user_email',
            'boards.board_hits',
            'detotal',
            'commenttotal'
        )
        ->orderBy('detotal', 'desc')
        ->paginate(10);


    foreach ($data as $item) {
        // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
        $item->user
        = Board_report::join('users','board_reports.u_id', 'users.id')
        ->select(
        'users.user_name'
        , 'users.user_email'
        , 'board_reports.board_reason_flg'
        ,  DB::raw('DATE_FORMAT(board_reports.created_at, "%Y-%m-%d") as created_at')
        )
        ->where('board_reports.board_id', $item->board_id)
        ->where('board_report_complete', '0')
        ->orderby('board_reports.created_at', 'desc')
        ->get();
    }


    return view('adminpage.declaration')->with('data', $data);
    }

    // 카테고리 업데이트
    public function changecategory(Request $request) {

        $id = $request->board_id;
        $category_id = $request->category_id;
        Board::find($id)->update([
                'category_id' => $category_id,
        ]);

        return redirect()->route('admin.contents', ['align_board' => 1]);
    }


    // 보드 flg추가 후 휴지통으로 전달
    public function deleteboard(Request $request) {
        if(!isset($request['board_id'])) {
            return redirect()->route('admin.contents', ['align_board' => 1]);
        }
        $today = Carbon::now();
        $today_set = $today->format('Y-m-d H:i:s');
        foreach ($request['board_id'] as $board_id) {
            DB::table('boards')
            ->where('board_id', $board_id)
            ->update(['board_show_flg' => 1, 'updated_at' => $today_set]);
        }
        return redirect()->route('admin.contents', ['align_board' => 1]);
    }

    // 댓글 삭제
    public function deletecomments(Request $request) {
        if(!isset($request['comment_id'])) {
            return redirect()->route('admin.comments');
        }
        foreach ($request['comment_id'] as $comment_id) {
            Comment::destroy([$comment_id]);
        }
        return redirect()->route('admin.comments');
    }

    public function deletedcontentdate($align_board, $date = null) {
        if (!$date) {
            $end_date = date('Ymd');
            $date = Carbon::now()->subMonth();
            $start_date = $date->format('Ymd');
        }
        if(!isset($align_board)) {
            $align_board = '1';
        }
        // exit;
        return redirect()->route('deletedcontent.get',
            ['align_board' => $align_board, 'start_date' => $start_date, 'end_date' => $end_date]);
    }
    public function deletedsearch(Request $request) {
        $start_date =  $request->start_year.$request->start_month.$request->start_day;
        $end_date = $request->end_year.$request->end_month.$request->end_day;

        return redirect()->route('deletedcontent.get', 
        ['align_board' => '1', 'start_date' => $start_date, 'end_date' => $end_date]);
    }
    // 휴지통
    public function deletedcontent($align_board, $start_date, $end_date) {

        $query = DB::table('boards')
        ->select(
            'boards.board_id'
            ,'boards.board_title'
            ,'boards.board_content'
            ,'boards.updated_at'
            ,'users.user_name'
            ,'users.user_email'
            ,'boards.board_hits'
            ,'categories.category_name'
            ,DB::raw('count(board_reports.board_id) as total')
            ,DB::raw('count(comments.comment_id) as comcount')
        )
        ->leftJoin('board_reports', 'board_reports.board_id', 'boards.board_id')
        ->leftJoin('categories', 'categories.category_id', 'boards.category_id')
        ->leftJoin('users','boards.u_id', 'users.id')
        ->leftJoin('comments','comments.board_id', 'boards.board_id')
        ->where('boards.updated_at','>=', $start_date.'000000')
        ->where('boards.updated_at','<=', $end_date.'235959')
        ->whereNotNULL('boards.board_show_flg')
        ->whereNULL('boards.deleted_at')
        ->groupBy('boards.board_id'
                ,'boards.board_title'
                ,'boards.board_content'
                ,'users.user_name'
                ,'boards.updated_at'
                ,'users.user_email'
                ,'boards.board_hits'
                ,'comments.board_id'
                ,'categories.category_name'
        );
        if ($align_board == '0') {
            $query->orderBy('boards.updated_at', 'asc');
        } else if ($align_board == '1') {
            $query->orderBy('boards.updated_at', 'desc');
        }
        $date = [$start_date, $end_date];
        $data = $query->paginate(10);
        return view('adminpage.deletedcontent')->with('data',$data)->with('date', $date);
    }

    // 게시글 플래그 1 등록
    public function temporarilydelete(Request $request) {
        if(!isset($request['board_id'])) {
            return redirect()->route('contents.declaration');
        }
        foreach ($request['board_id'] as $board_id) {
            DB::table('board_reports')
            ->where('board_id', $board_id)
            ->update(['board_report_complete' => '1']);
        }
        return redirect()->route('contents.declaration');
    }

    // 게시글 플래그 등록
    public function deletedeclarationboard(Request $request) {
        if(!isset($request['board_id'])) {
            return redirect()->route('contents.declaration');
        }
        foreach ($request['board_id'] as $board_id) {
            Board::destroy($board_id);
            
            // 신고 메일 보내는 쿼리문
            $result[] = DB::table('board_reports')
            ->select('users.id'
            , 'boards.board_title'
            , 'boards.board_content'
            , 'boards.created_at')
            ->join('users','board_reports.u_id','users.id')
            ->join('boards', 'boards.board_id', 'board_reports.board_id')
            ->where('boards.board_id', $board_id)
            ->where('board_reports.board_report_complete', '0')
            ->whereNull('users.deleted_at')
            ->get();
        }
        $result = $result[0];
        $result = json_decode($result, true);
        foreach ($result as $index => $mail_get) {
            $id = $mail_get["id"];
            $user = User::find($id);
            $info = [
                'user_name' => $user->user_name
                , 'created_at' => $result[$index]["created_at"]
                , 'board_title' => $result[$index]["board_title"]
                , 'board_content' => $result[$index]["board_content"]
            ];
            if ($user) {
                Mail::to($user->user_email)->send(new ComplaintMail($info));
            }
            $info = [];
        }
        return redirect()->route('contents.declaration');
    }

    // 게시글 플래그 삭제(유저가 다시 볼 수 있게)
    public function boardsetshow(Request $request) {

        if(!isset($request['board_id'])) {
            return redirect()->route('deletedcontent.get', ['align_board' => '1']);
        }
        // 값이 없을 시 return 추가 예정
        foreach ($request['board_id'] as $board_id) {
            DB::table('boards')
            ->where('board_id', $board_id)
            ->update(['board_show_flg' => null]);
        }
        return redirect()->route('admin.deletedcontentdate', ['align_board' => '1']);
    }

    // 게시글 관리자 기준 삭제
    public function boardsoftdelete(Request $request) {

        if(!isset($request['board_id'])) {
            return redirect()->route('deletedcontent.get', ['align_board' => '1']);
        }

        foreach ($request['board_id'] as $board_id) {
            board::destroy([$board_id]);
        }
        return redirect()->route('admin.deletedcontentdate', ['align_board' => '1']);
    }
    // 댓글 신고 페이지
    public function commentsdeclaration() {

        $comment = DB::table('comments')
        ->select(
            'comments.comment_id'
            , 'users.user_email'
            , 'comments.comment_content'
            , 'comments.created_at'
            , 'boards.board_id'
            , 'boards.board_title'
            , 'users.user_name'
            ,DB::raw('count(comment_reports.comment_id) as total'))
        ->join('comment_reports', 'comments.comment_id', 'comment_reports.comment_id')
        ->join('boards', 'boards.board_id', 'comments.board_id')
        ->join('users', 'users.id', 'comments.u_id')
        ->where('comment_reports.comment_report_complete', '0')
        ->whereNull('comments.deleted_at')
        ->groupby(
            'comments.comment_id'
            , 'users.user_email'
            , 'comments.comment_content'
            , 'comments.created_at'
            , 'boards.board_id'
            , 'boards.board_title'
            , 'users.user_name')
        ->orderby('comments.created_at', 'desc')
        ->paginate(10);

        $cnt = 0;
        foreach ($comment as $item) {
            // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            $item->user
            = Comment_report::join('users','comment_reports.u_id', 'users.id')
            ->select(
            'users.user_name'
            , 'users.user_email'
            , 'comment_reports.comment_reason_flg'
            ,  DB::raw('DATE_FORMAT(comment_reports.created_at, "%Y-%m-%d") as created_at')
            )
            ->where('comment_reports.comment_id', $item->comment_id)
            ->where('comment_report_complete', '0')
            ->orderby('comment_reports.created_at', 'desc')
            ->get();
            $cnt++;
        }

        return view('adminpage.declarationcomment')->with('comment', $comment);
    }

    public function admindeletecomment(Request $request) {
        if(!isset($request['comment_id'])) {
            return redirect()->route('comments.declaration');
        }
        foreach ($request['comment_id'] as $comment_id) {
            Comment::destroy([$comment_id]);
        }
        return redirect()->route('comments.declaration');
    }

    public function setcommentflg(Request $request) {
        if(!isset($request['comment_id'])) {
            return redirect()->route('comments.declaration');
        }
        foreach ($request['comment_id'] as $comment_id) {
            DB::table('comment_reports')
            ->where('comment_id', $comment_id)
            ->update(['comment_report_complete' => 1]);
        }
        return redirect()->route('comments.declaration');
    }

    // 신고자 조회
    // public function userdeclaration(Request $request) {

    //     $user = DB::table('board_reports')
    //     ->join('users','board_reports.u_id', 'users.id')
    //     ->select(
    //     'users.user_name'
    //     , 'users.user_email'
    //     , 'board_reports.board_reason_flg'
    //     ,  'board_reports.created_at'
    //     )
    //     ->where('board_reports.board_id', $request->board_id)
    //     ->orderby('board_reports.created_at', 'desc')
    //     ->get();

    //     return response()->json($user);
    //     }

    // 삭제된 게시글 정렬
    public function deletedcontentsort(Request $request) {
        $result = $request->sort;
        return $this->deletedcontentdate($result);
    }
}
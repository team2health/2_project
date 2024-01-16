<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Adminauth as Middleware;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Comment;

class ContentsadminController extends Controller
{
    //
    
    // 게시글 날짜 검색 
    public function contentsearch(Request $request) {
        Log::debug('게시글 날짜를 검색해서 넘겨주는 애');
        $start_date =  $request->start_year.$request->start_month.$request->start_day;
        $end_date = $request->end_year.$request->end_month.$request->end_day;
        // $date[] = $start_date;
        // $date[] = $end_date;
        Log::debug($start_date);
        Log::debug($end_date);


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
        Log::debug('정렬 세션에 저장해서 값 넘겨주는 애');
        Log::debug($request);

        $result = $request->align_board;
        // 세션에 값 저장
        session(['align_board' => $result]);
        return $this->admincontents($result, null);
    }
    
    public function admincontents($result, $date = null) {
        Log::debug('날짜 세팅하는 애');
        Log::debug($date);
        if (!$date) {
            $date = date('Ymd');
        }
        if(session()->has('align_board')) {
            Log::debug('if문');
            $align_board = session('align_board');
            return redirect()->route('admin.admincontentsset',
            ['align_board' => $align_board, 'start_date' => '19700101', 'end_date' => $date]);
        } else {
            Log::debug('else문');
            return redirect()->route('admin.admincontentsset',
            ['align_board' => '1', 'start_date' => '19700101', 'end_date' => $date]);
        }
        
    }

    public function admincontentsset($align_board, $start_date, $end_date) {
        Log::debug('쿼리문 작성하는 get');
        Log::debug($align_board);
        Log::debug($start_date);
        Log::debug($end_date);
        // $start_date = $date[0];
        // $date_count = count($date);
        // if($date_count > 1) {
        //     $end_date = $date[1];
        //     Log::debug($end_date);
        // }
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
        ->leftJoin('users', 'users.id', 'boards.u_id')
        ->leftJoin('comments', 'comments.board_id', 'boards.board_id')
        ->leftJoin('categories', 'categories.category_id', 'boards.category_id');
        if($end_date !== null) {
            Log::debug('if null이 아닐 경우 실행');
            Log::debug($start_date);
            Log::debug($end_date);
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
            Log::debug('align_board가 0일 경우');
            $boards = $boards->orderBy('boards.board_hits', 'desc');
        } else {
            Log::debug('아닐 경우');
            $boards = $boards->orderBy('boards.created_at', 'desc');
        }
        
        $data = $boards->paginate(10);
        Log::debug($data);
        return view('adminpage.contentsmanagement')
        ->with('data', $data);
    }

    public function admincomments($date = null) {
        if (!$date) {
            $date[] = date('Y-m-d');
        }
        return $this->admincommentsset($date);
    }
    public function admincommentsset($date) {
        $start_date = $date[0];
        $date_count = count($date);
        if($date_count > 1) {
            $end_date = $date[1];
        }

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
        ->whereNull('comments.deleted_at');

        if(isset($end_date)) {
                $comment = $comment->where('comments.created_at','>=', $start_date.'000000');
                $comment = $comment->where('comments.created_at','<=', $end_date.'000000');
            } else {
                $comment = $comment->where('comments.created_at','>=', $start_date.'23:59:59');
            }
            $comment =  $comment->orderBy('comments.comment_id', 'desc')->paginate(10);

        return view('adminpage.admincomments')
        ->with('comment', $comment);
    }


    public function contentsdeclaration() {
    $data = DB::table('board_reports')
    ->select(
        'board_reports.board_id'
        ,'boards.board_title'
        ,'boards.board_content'
        ,'boards.created_at'
        ,'users.user_name'
        ,'users.user_email'
        ,'boards.board_hits'
        ,DB::raw('count(board_reports.board_id) as total')
        ,DB::raw('count(comments.comment_id) as commenttotal')
    )
    ->leftJoin('boards', 'board_reports.board_id', 'boards.board_id')
    ->leftJoin('users','boards.u_id', 'users.id')
    ->leftJoin('comments','comments.board_id', 'boards.board_id')
    ->where('board_reports.board_report_complete','0')
    ->wherenull('boards.deleted_at')
    ->groupBy('board_reports.board_id'
            ,'boards.board_title'
            ,'boards.board_content'
            ,'users.user_name'
            ,'boards.created_at'
            ,'users.user_email'
            ,'boards.board_hits'
            ,'comments.board_id'
            )
    ->orderBy('total', 'desc')
    ->paginate(10);

    // $info = DB::table('board_reports')
    // ->select(
    //     'users.user_email'
    //     ,'users.user_name'
    //     ,'board_reports.board_reason_flg'
    //     ,'users.id'
    //     ,'board_reports.created_at'
    // )
    // ->join('users', 'users.id','board_reports.u_id')
    // ->where('board_reports.board_report_complete','0')
    // ->get();

    return view('adminpage.declaration')->with('data', $data);
    }
    // 댓글 날짜 검색
    public function commentsearch(Request $request) {
        $start_date =  $request->start_year.$request->start_month.$request->start_day;
        $end_date = $request->end_year.$request->end_month.$request->end_day;
        $date[] = $start_date;
        $date[] = $end_date;
        return $this->admincommentsset($date);
    }

    // 카테고리 업데이트
    public function changecategory(Request $request) {
        $id = $request->board_id;
        $category_id = $request->category_id;
        $record = Board::find($id);
        if ($record) {
            $record->update([
                'category_id' => $category_id,
            ]);
            return redirect()->route('admin.contents', ['align_board' => 1]);
        }
    }

    // 보드 flg추가 후 휴지통으로 전달
    public function deleteboard(Request $request) {
        foreach ($request['board_id'] as $board_id) {
            DB::table('boards')
            ->where('board_id', $board_id)
            ->update(['board_show_flg' => 1]);
        }
            return redirect()->route('admin.contents', ['align_board' => 1]);
    }

    // 댓글 삭제
    public function deletecomments(Request $request) {

        foreach ($request['comment_id'] as $comment_id) {
            Comment::destroy([$comment_id]);
        }
        return redirect()->route('admin.comments');
    }
    // 휴지통 이동
    public function deletedcontent() {
        $data = DB::table('boards')
        ->select(
            'boards.board_id'
            ,'boards.board_title'
            ,'boards.board_content'
            ,'boards.created_at'
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
        ->whereNotNULL('boards.board_show_flg')
        ->whereNULL('boards.deleted_at')
        ->groupBy('boards.board_id'
                ,'boards.board_title'
                ,'boards.board_content'
                ,'users.user_name'
                ,'boards.created_at'
                ,'users.user_email'
                ,'boards.board_hits'
                ,'comments.board_id'
                ,'categories.category_name'
                )
        ->orderBy('boards.created_at', 'desc')
        ->paginate(10);
        return view('adminpage.deletedcontent')->with('data',$data);
    }

    // 게시글 플래그 1 등록
    public function temporarilydelete(Request $request) {
        foreach ($request['board_id'] as $board_id) {
            DB::table('board_reports')
            ->where('board_id', $board_id)
            ->update(['board_report_complete' => '1']);
        }
        return redirect()->route('contents.declaration');
    }

    // 게시글 플래그 등록
    public function deletedeclarationboard(Request $request) {
        foreach ($request['board_id'] as $board_id) {
            DB::table('board_reports')
            ->where('board_id', $board_id)
            ->update(['board_show_flg' => '1']);
        }
        return redirect()->route('contents.declaration');
    }

    // 게시글 플래그 삭제(유저가 다시 볼 수 있게)
    public function boardsetshow(Request $request) {
        foreach ($request['board_id'] as $board_id) {
            DB::table('boards')
            ->where('board_id', $board_id)
            ->update(['board_show_flg' => null]);
        }
        return redirect()->route('deletedcontent.get');
    }

    // 게시글 관리자 기준 삭제
    public function boardsoftdelete(Request $request) {
        foreach ($request['board_id'] as $board_id) {
            board::destroy([$board_id]);
        }
        return redirect()->route('deletedcontent.get');
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

        return view('adminpage.declarationcomment')->with('comment', $comment);
    }

    public function admindeletecomment(Request $request) {
        foreach ($request['comment_id'] as $comment_id) {
            Comment::destroy([$comment_id]);
        }
        return redirect()->route('comments.declaration');
    }

    public function setcommentflg(Request $request) {
        foreach ($request['comment_id'] as $comment_id) {
            DB::table('comment_reports')
            ->where('comment_id', $comment_id)
            ->update(['comment_report_complete' => 1]);
        }
        return redirect()->route('comments.declaration');
    }
}
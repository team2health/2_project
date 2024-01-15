<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Adminauth as Middleware;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Board;

class ContentsadminController extends Controller
{
    //
    
    public function admincontents($align_board) {

        Log::debug($align_board);
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
        ->leftJoin('categories', 'categories.category_id', 'boards.category_id')
        ->groupBy(
            'boards.board_id',
            'users.user_email',
            'categories.category_name',
            'boards.board_title',
            'boards.board_hits',
            'boards.created_at',
            'boards.board_content'
        );
    
    if(isset($align_board)) {
        if($align_board == '0') {
            Log::debug('if문 실행');
            $boards = $boards->orderBy('boards.board_hits', 'desc');
        } else {
            Log::debug('else문 실행');
            $boards = $boards->orderBy('boards.board_id', 'desc');
        }
    } else {
        $boards = $boards->orderBy('boards.board_id', 'desc');
    }
        $data = $boards->paginate(10);
        return view('adminpage.contentsmanagement')
        ->with('data', $data);
    }

    public function admincontetsboard() {
        
    }

    public function admincomments($date = null) {
        if (!$date) {
            $date[] = date('Y-m-d');
        }
        return $this->admincommentsset($date);
    }
    public function admincommentsset($date) {
        $start_date = $date[0];
        Log::debug($date); 
        $date_count = count($date);
        if($date_count > 1) {
            Log::debug('if문 end_date 세팅'); 
            $end_date = $date[1];
            Log::debug($end_date);
        }

        $comment = DB::table('comments')
        ->select(
            'comments.comment_id'
            , 'users.user_email'
            , 'comments.comment_content'
            , 'comments.created_at'
            , 'boards.board_id'
            , 'boards.board_title')
        ->join('boards', 'boards.board_id', 'comments.board_id')
        ->join('users', 'users.id', 'comments.u_id');

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
        'boards.board_id'
        ,'boards.board_title'
        ,'boards.board_content'
        ,'users.user_name'
        ,DB::raw('SUM(board_reports.board_id) as total')
    )
    ->join('boards', 'board_reports.board_id', 'boards.board_id')
    // ->join('users','board_reports.u_id', 'users.id')
    ->join('boards','boards.u_id', 'users.id')
    ->where('board_reports.board_report_complete','0')
    ->groupBy('board_reports.board_id')
    ->orderBy('boards.board_id', 'asc')
    ->get();

    $info = DB::table('board_reports')
    ->select(
        'users.user_email'
        ,'users.user_name'
        ,'board_reports.board_reason_flg'
        ,'users.use'
        ,'board_reports.created_at'
    )
    ->join('users', 'users.id','board_reports.u_id')
    

    Log::debug($data);

    return view('adminpage.declaration')->with('data', $data);
    }
    public function contentssort(Request $request) {
        $result = $request->align_board;
        return $this->admincontents($result);
    }
    // 날짜 검색
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
    

}
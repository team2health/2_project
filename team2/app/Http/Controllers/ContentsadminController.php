<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Middleware\Adminauth as Middleware;
use Illuminate\support\Facades\DB;
use Illuminate\Database\Query\Builder;


use Illuminate\Http\Request;

class ContentsadminController extends Controller
{
    //
    
    public function admincontents() {

        $data = DB::table('boards')
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
            )
            ->orderBy('boards.board_id', 'desc')
            ->paginate(10);
        
        return view('adminpage.contentsmanagement')->with('data', $data);
    }

    public function contentsdeclaration() {
        return view('adminpage.declaration');
    }
}

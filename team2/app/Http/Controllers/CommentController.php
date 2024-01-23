<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use Illuminate\Support\Facades\Log;
use App\Models\Comment;
use App\Models\Comment_report;


class CommentController extends Controller
{
    public function store(Request $request)
    {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $request->validate([
            'comment_content' => 'required',            
            'board_id'=>'required',
        ]);

        Comment::create([
            'u_id' => session('id'),
            'board_id'=> $request->board_id,            
            'comment_content' => $request->comment_content,
        ]);

        return redirect()->back();
    }
    // public function commentreport(Request $request){
    //     $commentId = $request->input('comment_id');
    //     $userId = $request->input('u_id');
    //     $flg=$request->input('values');
    //     Comment_report::create([
    //         'comment_id' =>$commentId,
    //         'u_id' => $userId,
    //         'comment_reason_flg' =>$flg           
    //     ]);  
    //     return redirect()->back();
    // }
    
    public function commentreport(Request $request){
        $commentId = $request->input('comment_id');
    $userId = $request->input('u_id');
    $mouReport = Comment_report::where('comment_id',$commentId)
                                       ->where('u_id', $userId)
                                       ->first();
                                    $query = Comment_report::where('comment_id', $commentId)
                       ->where('u_id', $userId)
                       ->toSql();
        if ($mouReport) {
            // 사용자가 이미 이 게시글을 신고했음을 알림
            return redirect()->back()->with('error', '이미 신고한 댓글입니다.');
        }
    $flg=$request->input('values');
        Comment_report::create([
            'comment_id' =>$commentId ,
            'u_id' => $userId,
            'comment_reason_flg' =>$flg           
        ]);  
        return redirect()->back();
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request)
    {
    
    }

    public function destroy($comment_id)
    {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }
            
        Comment::destroy($comment_id);
        return redirect()-> back();
    }

    public function deleteadminboard(Request $request) {
        
    }
}
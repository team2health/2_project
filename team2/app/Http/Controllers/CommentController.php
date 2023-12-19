<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Board;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment_content' => 'required',            
            'board_id'=>'required',
        ]);

        Comment::create([
            'u_id' => Auth::id(),
            'board_id'=> $request->board_id,            
            'comment_content' => $request->comment_content,
        ]);

        return response()->json(['message' => '댓글이 성공적으로 작성되었습니다.']);
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request)
    {
       
    }

    public function destroy($comment_id)
    {
        $comment = Comment::find($comment_id);

        $comment->delete();

        return redirect()->route('categoryboard', ['board' => $comment->board_id])->with('success', '댓글이 성공적으로 삭제되었습니다.');
    }

}

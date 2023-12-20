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
        Comment::destroy($comment_id);
        return redirect()-> back();
        // $comment = Comment::find($comment_id);

        // if (!$comment) {
        //     return response()->json(['error' => '댓글을 찾을 수 없습니다.'], 404);
        // }

        // // Check if the authenticated user is the owner of the comment
        // if (Auth::id() !== $comment->u_id) {
        //     return response()->json(['error' => '댓글 삭제 권한이 없습니다.'], 403);
        // }

        // $comment->delete();

        // return response()->json(['message' => '댓글이 성공적으로 삭제되었습니다.']);
    //     try {
    //         $comment = Comment::find($comment_id);
    
    //         if (!$comment) {
    //             return response()->json(['error' => '댓글을 찾을 수 없습니다.'], 404);
    //         }
    
    //         $comment->delete();
    
    //         return response()->json(['message' => '댓글이 성공적으로 삭제되었습니다.', 'deleted_comment_id' => $comment_id]);
    //     } catch (\Exception $e) {
    //         // 오류 로그 추가
    //         \Log::error('Error deleting comment: ' . $e->getMessage());
    
    //         // 클라이언트에게 오류 응답 전송
    //         return response()->json(['error' => '댓글 삭제 중 오류가 발생했습니다.'], 500);
    //     }
    // }

    }
}
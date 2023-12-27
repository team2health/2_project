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
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $request->validate([
            'comment_content' => 'required',            
            'board_id'=>'required',
        ]);

        Comment::create([
            'u_id' => Auth::id(),
            'board_id'=> $request->board_id,            
            'comment_content' => $request->comment_content,
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
}
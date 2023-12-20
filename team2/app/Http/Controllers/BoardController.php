<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use App\Models\Board;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        if(!Auth::check()){
        return redirect()->route('login.get');
        }
        $result=Board::get();
        return view('community')->with('data',$result);
    }
    public function categoryboard(){

        $result=Board::get();
        return view('categoryboard')->with('data',$result);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $arrData = [
        //       'u_id' => Auth::id(),
        //       'category_id' => $request->input('category_id'),
        //   ];
    
        
        //  if ($request->filled('board_title')) {
        //      $arrData['board_title'] = $request->input('board_title');
        //  }
    
        //  if ($request->filled('board_content')) {
        //      $arrData['board_content'] = $request->input('board_content');
        //  }  
        $path = $request->file('file')->store('public');
        
        $u_id = auth()->id();
        
         $arrData = $request->only('board_title','board_content');
         $arrData['u_id'] = $u_id;
         $arrData['category_id'] = $request->input('category_id', 1);
        $result = Board::create($arrData);
        
        
        return redirect()->route('categoryboard');
    }
    public function upload(Request $request){
        $request->file->store('public');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($board_id)
    {
        $result = Board::with(['user', 'images'])->find($board_id);
        // dd($result);
        $result->board_hits++;
        $result->timestamps = false;        
        $result->save();

    return view('detail')->with('data', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($board_id)
    {
        $result=Board::find($board_id);
        return view('update')->with('data',$result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $board_id)
    {
        $result = Board::find($board_id);
        $result->update([
            'board_title' => $request->input('u_title'),
            'board_content' => $request->input('u_content'),
        ]);
        return redirect()-> route('board.show',['board'=> $result->board_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($board_id)
    {
        Board::destroy($board_id);
        return redirect()-> route('categoryboard');
    }
    public function getBoardByCategory($categoryId)
    {
        $result = Board::where('category_id', $categoryId)->get();
        return response()->json($result);
    }
}

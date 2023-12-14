<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\facades\Auth;
use Illuminate\support\facades\DB;
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
        return view('categoryboard');
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
        $arrData = [
            'u_id' => Auth::id(),
            'category_id' => $request->input('category_id'),
        ];
    
        
        if ($request->filled('u_title')) {
            $arrData['board_title'] = $request->input('u_title');
        }
    
        if ($request->filled('u_content')) {
            $arrData['board_content'] = $request->input('u_content');
        } 
        
    
        $result = Board::create($arrData);
    
        return redirect()->route('categoryboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($board_id)
    {
        $result=Board::find($board_id);
        

        // 조회수 올리기
        $result->board_hits++;//조회수 1증가
        
        // 업데이트 처리
        $result->save();

        return view('detail')->with('data',$result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

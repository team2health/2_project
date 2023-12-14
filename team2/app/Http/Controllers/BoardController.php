<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // 유효성 검사를 추가할 수 있습니다.
        
        $result = Board::create([
            'board_title' => $request->input('u_title'),
            'board_content' => $request->input('u_content'),
            'category' => $request->input('board'), // category_id 대신에 category를 사용
        ]);
    
        foreach (['img1', 'img2', 'img3'] as $imageField) {
            if ($request->hasFile($imageField)) {
                $imagePath = $request->file($imageField)->store('public/img');
                
                // Board 모델에 대한 관계를 설정하고 이미지를 저장합니다.
                $boardImg = new Board_Img(['img_address' => $imagePath]);
                $result->boardImgs()->save($boardImg);
            }
        }
    
        return redirect()->route('board.create')->with('success', '글 작성이 완료되었습니다.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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

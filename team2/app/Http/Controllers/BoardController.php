<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Board;
use App\Models\Board_img;
use App\Models\Category;
use Illuminate\Support\Str;

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
        $result=Board::orderBy('board_hits', 'desc')->get();
        return view('community')->with('data',$result);
    }
    public function categoryboard(){
        $category_board=Board::where('category_id', '1')->orderby('board_id', 'desc')->get();
        $category_id = Category::orderby('category_id', 'asc')->get();
        $category_name = Category::where('category_id', '1')->get();
        $result = [$category_board, $category_id, $category_name];

        // Log::debug($category_id);

        return view('categoryboard')->with('data', $result);
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
        $u_id = auth()->id();        
        $boardData = $request->only('board_title', 'board_content', 'category_id');
        $boardData['u_id'] = $u_id;
        // $boardData['category_id'] = $request->input('category_id', 1);
        $board = Board::create($boardData);

        // Save Hashtag (if provided)
       // $hashtag = $request->input('hashtag');
        //if (!empty($hashtag)) {
            // Save or update the hashtag logic goes here
            // You may create a separate table for hashtags and associate them with boards
        //}

        // Save Images to Board_img
        //이미지넣기
        // if ($request->hasFile('board_img')) {
        //     $image = $request->file('board_img');
        //     $imageName = Str::uuid().'.'.$image->extension();
        //     $image->move(public_path('board_img'), $imageName);
            
        //     // Save the image path to the Board_img model
        //     $boardImage = new Board_img(['img_address' => $imageName]);
        //     $board->images()->save($boardImage);
        // }
        if ($request->hasFile('board_img')) {
            $images = $request->file('board_img');
    
        //     // Limit the number of images to 3
        //     $imageCount = count($images);
        //     $maxImages = 3;
        //     if ($imageCount > $maxImages) {
        //         // If more than 3 images are uploaded, take the first 3
        //         $images = array_slice($images, 0, $maxImages);
        //     }
    
            foreach ($images as $image) {
                $imageName = Str::uuid() . '.' . $image->extension();
                $image->move(public_path('board_img'), $imageName);
    
                // Save the image path to the Board_img model
                $boardImage = new Board_img(['img_address' => $imageName]);
                $board->images()->save($boardImage);
            }
        
        }

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
        $result = Board::with(['user', 'images'])->find($board_id);

        //  dd($result->images);
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
        if ($request->hasFile('board_img')) {
        // 기존 이미지 삭제
        $result->images()->delete();

        $images = $request->file('board_img');

        foreach ($images as $image) {
            $imageName = Str::uuid() . '.' . $image->extension();
            $image->move(public_path('board_img'), $imageName);

            // Save the image path to the Board_img model
            $boardImage = new Board_img(['img_address' => $imageName]);
            $result->images()->save($boardImage);
        }
    }
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

    public function boardcategoryget($categoryId) {
        // Log::debug($categoryId);
        $category_board = Board::where('category_id', $categoryId)->orderby('board_id', 'desc')->get();

        $category_id = Category::orderby('category_id', 'asc')->get();

        // Log::debug($result);
        // Log::debug($category_id);
        $category_name = Category::where('category_id', $categoryId)->get();
        $result = [$category_board, $category_id, $category_name];

        return view('categoryboard')->with('data', $result);
    }
}


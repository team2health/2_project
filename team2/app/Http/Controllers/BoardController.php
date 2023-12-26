<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Board;
use App\Models\Board_tag;
use App\Models\Board_img;
use App\Models\Pandemic;
use App\Models\Category;
use App\Models\User;
use App\Models\Hashtag;
use Carbon\Carbon;
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
        $u_id = session('id');

        if(!Auth::check()){
        return redirect()->route('login.get');
        }

        $weekAgo = Carbon::now()->subWeek();
        
        $hotboard = Board::orderBy('board_hits', 'desc')
        ->where('created_at', '>=', $weekAgo)
        ->limit(10)
        ->get();

        $pandemicboard = Pandemic::get();

        $favoriteboard = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
            ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
            ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
            ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
            ->select('boards.board_id', 'boards.board_title', 'boards.board_content')
            ->where('users.id', $u_id)
            ->where('favorite_tags.deleted_at', null)
            ->orderby('boards.board_id', 'desc')
            ->groupBy('boards.board_id', 'boards.board_title', 'boards.board_content')
            ->limit(4)
            ->get();

        $lastboard = Board::orderBy('board_id', 'desc')->limit(4)->get();

        $favoritetag = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->select('hashtags.hashtag_name')
        ->where('users.id', $u_id)
        ->where('favorite_tags.deleted_at', null)
        ->orderby('hashtags.hashtag_id')
        ->get();

        $cnt = 0;

        foreach ($favoriteboard as $item) {
            // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            $favoriteboard[$cnt]['board_tag'] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            ->select('hashtags.hashtag_name')
            ->where('board_tags.board_id', $item->board_id)
            ->orderby('board_tags.board_id', 'desc')
            ->get();
            // Log::debug($item->board_id);
            $cnt++;
        }

        // dd($favoriteboard);
        // Log::debug($boardfavorite);
        // Log::debug($favoriteboard);

        $result = [$hotboard, $pandemicboard, $favoriteboard, $lastboard, $favoritetag];

        return view('community')->with('data',$result);
    }

    public function categoryboard(){
        $category_board=Board::where('category_id', '1',)->orderBy('board_id', 'desc')->paginate(5);
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
        $result= Hashtag::all();
        return view('insert')->with('data', $result);
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
        $board = Board::create($boardData);
        
        if ($request->hasFile('board_img')) {
            $images = $request->file('board_img');   
            foreach ($images as $image) {
                $imageName = Str::uuid() . '.' . $image->extension();
                $image->move(public_path('board_img'), $imageName);
    
                // Save the image path to the Board_img model
                $boardImage = new Board_img(['img_address' => $imageName]);
                $board->images()->save($boardImage);
            }
        
        }  

        $board_id = $board->board_id;
        
        
        $hashtag_ids = explode(',', $request->input('hashtag'));
        $hashtag_ids = array_map('trim', $hashtag_ids);
        foreach ($hashtag_ids as $hashtag_name) {
            // Check if the hashtag already exists
            $hashtag = Hashtag::where('hashtag_name', $hashtag_name)->first();
        
            // If not, create a new hashtag
            if (!$hashtag) {
                $hashtag = Hashtag::create(['hashtag_name' => $hashtag_name]);
            }
        
            // Insert the relationship into board_tags table
            DB::table('board_tags')->insert([
                'board_id' => $board_id,
                'hashtag_id' => $hashtag->hashtag_id,
            ]);
        }
        
       
    $board_detail_get = DB::table('boards as b')
    ->select(
        'hashtags.hashtag_id',
        'hashtags.hashtag_name as hashtag_name', // 변경된 부분
        'b.category_id',
        'b.board_id',
        'b.board_title',
        'b.board_content',
        'b.board_hits',
        'b.created_at'
    )
    ->join('board_tags as bt', 'bt.board_id', '=', 'b.board_id')
    ->join('hashtags', 'hashtags.hashtag_id', '=', 'bt.hashtag_id')
    ->where('b.board_id', $board_id)
    ->get();

    // return redirect()->route('detail', ['board' => $board_id])->with('data', $hashtag_id);
    return redirect()->route('detail', ['board' => $board_id])->with('data', $board_detail_get);
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
        

    $result = Board::find($board_id);
    $allHashtags = Hashtag::all();
    return view('update', compact('result', 'allHashtags'));

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
    
    $board = Board::find($board_id);

// 새로운 해시태그 추가 또는 기존 해시태그 갱신
$hashtagInput = $request->input('hashtag');
$hashtag_names = explode(',', $hashtagInput);
$hashtag_names = array_map('trim', $hashtag_names);

$hashtagIds = [];

foreach ($hashtag_names as $hashtag_name) {
    // Check if the hashtag already exists
    $hashtag = Hashtag::where('hashtag_name', $hashtag_name)->first();

    // If not, create a new hashtag
    if (!$hashtag) {
        $hashtag = Hashtag::create(['hashtag_name' => $hashtag_name]);
    }

    // Collect hashtag IDs
    $hashtagIds[] = $hashtag->hashtag_id;
}

// Sync hashtags for the board
$board->hashtags()->sync($hashtagIds);

// 다시 불러오기
$board_detail_get = Board::with(['hashtags'])
    ->where('board_id', $board_id)
    ->first();
        
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
        $category_board = Board::where('category_id', $categoryId)->orderby('board_id', 'desc')->paginate(5);

        $category_id = Category::orderby('category_id', 'asc')->get();

        // Log::debug($result);
        // Log::debug($category_id);
        $category_name = Category::where('category_id', $categoryId)->get();
        $result = [$category_board, $category_id, $category_name];

        return view('categoryboard')->with('data', $result);
    }
    
    public function nextboardpost(Request $request) {
        // Log::debug($request);

        $result = Board::where('board_id', '<', $request->last_num)
            ->orderby('board_id', 'desc')
            ->limit(4)
            ->get();

        // Log::debug($result);
        return response()->json($result);
    }

    public function favoritenextboardpost(Request $request) {
        // Log::debug($request);
        $u_id = session('id');

        $result = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
        ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
        ->select('boards.board_id', 'boards.board_title', 'boards.board_content')
        ->where('users.id', $u_id)
        ->where('boards.board_id', '<', $request->favorite_num)
        ->orderby('boards.board_id', 'desc')
        ->groupBy('boards.board_id', 'boards.board_title', 'boards.board_content')
        ->limit(4)
        ->get();

        $cnt = 0;

        foreach ($result as $item) {
            // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            $result[$cnt]['board_tag'] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            ->select('hashtags.hashtag_name')
            ->where('board_tags.board_id', $item->board_id)
            ->orderby('board_tags.board_id', 'desc')
            ->get();
            // Log::debug($item->board_id);
            $cnt++;
        }

        Log::debug($result);
        return response()->json($result);
    }

    public function lastboardget() {
        $lastboard = Board::orderBy('board_id', 'desc')->paginate(5);

        return view('lastboard')->with('data', $lastboard);
    }

    public function hotboardget() {
        $hotboard = Board::orderBy('board_hits', 'desc')->paginate(5);

        return view('hotboard')->with('data', $hotboard);
    }

    public function favoriteboardget() {
        $u_id = session('id');

        $favoriteboard = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
        ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
        ->select('boards.board_id', 'boards.board_title', 'boards.board_content', 'boards.created_at')
        ->where('users.id', $u_id)
        ->where('favorite_tags.deleted_at', null)
        ->orderby('boards.board_id', 'desc')
        ->groupBy('boards.board_id', 'boards.board_title', 'boards.board_content', 'boards.created_at')
        ->get();

        return view('favoriteboard')->with('data', $favoriteboard);
    }
}


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
        $hotboard = Board::orderBy('board_hits', 'desc')->get();

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

        $board_id = $board->board_id;

// 유저가 선택한 해시태그 목록 불러오기
        // $hashtag_id = DB::table('hashtags')
        // ->select(
        // 'hashtags.hashtag_id'
        // )
        // ->where('hashtags.hashtag_id', $hash_id)
        // ->get();
        
        // Log::debug($hashtag_id);
// 유저가 선택한 해시태그 목록을 입력
        // $hashtag_insert = DB::table('board_tags')->insert([
        //     'board_id' => $new_board_id,
        //     'hashtag_id' => $hashtag_id,
        // ]);
        // Log::debug($hashtag_insert);        
        // 이부분 반복문 써서 완성
        $hashtag_ids = explode(',', $request->input('hashtag'));

        // 유저가 선택한 해시태그 목록을 입력
        foreach ($hashtag_ids as $hashtag_id) {
            DB::table('board_tags')->insert([
                'board_id' => $board_id,
                'hashtag_id' => $hashtag_id,
            ]);
        }
//         $hashtag_ids = explode(',', $request->input('hashtag'));
// $tagIds = [];

// foreach ($hashtag_ids as $hashtag) {
//     // 숫자만 추출
//     $hashtag_id = filter_var($hashtag, FILTER_SANITIZE_NUMBER_INT);

//     // 빈 문자열이 아닌 경우에만 처리
//     if ($hashtag_id !== '') {
//         DB::table('board_tags')->insert([
//             'board_id' => $board_id,
//             'hashtag_id' => $hashtag_id,
//         ]);

//         // 각 해시태그의 ID를 $tagIds 배열에 추가
//         $tagIds[] = $hashtag_id;
//     }
// }
//         $hashtag_names = explode(',', $request->input('hashtag'));

// foreach ($hashtag_names as $hashtag_name) {
//     // Find or create the Hashtag model
//     $hashtag = Hashtag::firstOrCreate(['hashtag_name' => $hashtag_name]);
    
//     // Insert data into board_tags table
//     DB::table('board_tags')->insert([
//         'board_id' => $board_id,
//         'hashtag_id' => $hashtag->hashtag_id,  
//     ]);
// }
        // $hashtag_names = explode(',', $request->input('hashtag'));

        // foreach ($hashtag_names as $hashtag_name) {
        //     // Find or create the Hashtag model
        //     $hashtag = Hashtag::firstOrCreate(['hashtag_name' => $hashtag_name]);
        
        //     // Insert data into board_tags table
        //     DB::table('board_tags')->insert([
        //         'board_id' => $board_id,
        //         'hashtag_id' => $hashtag->hashtag_id,  // 또는 'id'에 따라 상황에 맞게 변경
        //     ]);
        // }
// $hashtag_names = explode(',', $request->input('hashtag'));

// 유저가 선택한 해시태그 목록을 입력
// foreach ($hashtag_names as $hashtag_name) {
//     // Find or create the Hashtag model
//     $hashtag = Hashtag::firstOrCreate(['hashtag_name' => $hashtag_name]);

//     // Insert data into board_tags table
//     DB::table('board_tags')->insert([
//         'board_id' => $board_id,
//         'hashtag_id' => $hashtag->hashtag_id,
//     ]);
// }


//         $hashtags = $request->input('hashtag');
// if (!empty($hashtags)) {
//     // Split hashtags by comma and trim spaces
//     $hashtagsArray = array_map('trim', explode(',', $hashtags));

//     // Save each hashtag to the Hashtags table and link it to the board
//     foreach ($hashtagsArray as $hashtag) {
//         $hashtagModel = Hashtag::firstOrCreate(['hashtag_name' => $hashtag]);
        
//         // Save the relationship in the BoardTag pivot table
//         Board_tag::create([
//             'board_id' => $board->id,
//             'hashtag_id' => $hashtagModel->id,
//         ]);
//     }

// $hashtags = explode(',', $request->input('hashtag'));

// foreach ($hashtags as $hashtag) {
//     $tag = Hashtag::where('hashtag_name', $hashtag)->first();

//     if ($tag) {
//         $board->tags()->attach($tag->hashtag_id);
//     }}
// $hashtags = explode(',', $request->input('hashtag'));
// $board->tags()->detach();

// // 그런 다음 sync 메서드를 사용하여 새로운 태그와의 관계를 설정합니다.
// foreach ($hashtags as $hashtag) {
//     $tag = Hashtag::where('hashtag_name', $hashtag)->first();

//     if ($tag) {
//         $tagIds[] = $tag->hashtag_id;
//     }
// }

// $board->tags()->sync($tagIds); 
// $hashtags = explode(',', $request->input('hashtag'));

// foreach ($hashtags as $hashtag) {
//     $tag = Hashtag::where('hashtag_name', $hashtag)->first();

//     if ($tag) {
//         $board->tags()->attach($tag->id);
//     } else {
//         // 해당 해시태그가 존재하지 않는 경우에 대한 처리
//         // 예를 들어, 새로운 해시태그를 만들어서 사용하거나 다른 방법으로 처리할 수 있습니다.
//     }
// }
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
            foreach ($images as $image) {
                $imageName = Str::uuid() . '.' . $image->extension();
                $image->move(public_path('board_img'), $imageName);
    
                // Save the image path to the Board_img model
                $boardImage = new Board_img(['img_address' => $imageName]);
                $board->images()->save($boardImage);
            }
        
        }

        // 유저가 선택한 해시태그 목록 불러오기
    //     $board_detail_get = DB::table('boards as b')
    // ->select(
    //     'hashtags.hashtag_id',
    //     'hashtags.hashtag_name',
    //     'b.category_id',
    //     'b.board_id',
    //     'b.board_title',
    //     'b.board_content',
    //     'b.board_hits',
    //     'b.created_at'
    // )
    // ->join('board_tags as bt', 'bt.board_id', '=', 'b.board_id')
    // ->join('hashtags', 'hashtags.hashtag_id', '=', 'bt.hashtag_id')
    // ->where('b.board_id', $board_id)
    // ->get();
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
// Log::debug($board_detail_get);

// var_dump($board_id);
// var_dump($hashtag_id);
// var_dump($hashtag_insert);
// var_dump($board_detail_get);
// exit;
return redirect()->route('detail', ['board' => $board_id])->with('data', $hashtag_id);
//  return redirect()->route('detail', ['board' => $board_id])->with('data', $hashtag_id);

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
        ->limit(4)
        ->get();

        Log::debug($result);
        return response()->json($result);
    }

    public function lastboardget() {
        $lastboard = Board::orderBy('board_id', 'desc')->get();

        return view('lastboard')->with('data', $lastboard);
    }

    public function hotboardget() {
        $hotboard = Board::orderBy('board_hits', 'desc')->get();

        return view('hotboard')->with('data', $hotboard);
    }

    // public function favoriteboardget() {
    // }
}


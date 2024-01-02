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
use App\Models\Comment;
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
        ->where('deleted_at', null)
        ->limit(10)
        ->get();

        $pandemicboard = Pandemic::where('deleted_at', null)->get();

        $favoriteboard = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
            ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
            ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
            ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
            ->select('boards.board_id', 'boards.board_title', 'boards.board_content')
            ->where('users.id', $u_id)
            ->where('favorite_tags.deleted_at', null)
            ->where('boards.deleted_at', null)
            ->orderby('boards.board_id', 'desc')
            ->groupBy('boards.board_id', 'boards.board_title', 'boards.board_content')
            ->limit(4)
            ->get();

        $lastboard = Board::orderBy('board_id', 'desc')
        ->where('deleted_at', null)->limit(4)->get();

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
            $cnt++;
        }

        $result = [$hotboard, $pandemicboard, $favoriteboard, $lastboard, $favoritetag];

        return view('community')->with('data',$result);
    }

    public function categoryboard(){
        
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $category_board=Board::where('category_id', '1',)->where('deleted_at', null)->orderBy('board_id', 'desc')->paginate(5);
        $category_id = Category::orderby('category_id', 'asc')->get();
        $category_name = Category::where('category_id', '1')->get();
        $result = [$category_board, $category_id, $category_name];
        

        

        return view('categoryboard')->with('data', $result);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

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
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $u_id = auth()->id();   
        // 요청에서 게시글 데이터를 가져옵니다.     
        $boardData = $request->only('board_title', 'board_content', 'category_id');        
        // 게시글 내용에서 줄 바꿈을 HTML <br> 태그로 변환
        $boardData['board_content'] = nl2br($boardData['board_content']);        
        // 게시글 데이터에 사용자 ID를 추가합니다.
        $boardData['u_id'] = $u_id;
        $board = Board::create($boardData);
        
        // 요청에 게시글 이미지가 포함되어 있는지 확인합니다.
        if ($request->hasFile('board_img')) {
            // 업로드된 이미지들을 가져옵니다.
            $images = $request->file('board_img');   
            foreach ($images as $image) {
                // UUID와 원본 파일 확장자를 사용하여 고유한 이미지 이름을 생성합니다.                
                $imageName = Str::uuid() . '.' . $image->extension();
                $image->move(public_path('board_img'), $imageName);
    
                
                $boardImage = new Board_img(['img_address' => $imageName]);
                 // 현재 게시글과 이미지를 연결하고 저장합니다. 모델끼리 연결해 주어야 함
                $board->images()->save($boardImage);
            }
        
        }  
        // 새로 생성된 게시글의 ID를 가져옵니다.
        $board_id = $board->board_id;
        // 요청에 해시태그가 있는지 확인합니다.
        if($request->hashtag) {
            // 입력에서 해시태그 ID를 추출하고 공백을 제거합니다.
            $hashtag_ids = explode(',', $request->input('hashtag'));
            //array_map 함수는 배열의 각 요소에 콜백 함수를 적용하는데 사용
            $hashtag_ids = array_map('trim', $hashtag_ids);
            foreach ($hashtag_ids as $hashtag_name) {
                // 데이터베이스에서 이름으로 해시태그를 찾습니다.
                $hashtag = Hashtag::where('hashtag_name', $hashtag_name)->first();
                // 해시태그가 존재하면 'board_tags' 테이블에 레코드를 삽입합니다.                
                if ($hashtag) {
                    DB::table('board_tags')->insert([
                        'board_id' => $board_id,
                        'hashtag_id' => $hashtag->hashtag_id,
                    ]);
                }
            }

            $board_detail_get = DB::table('boards as b')
            ->select(
                'hashtags.hashtag_id',
                'hashtags.hashtag_name',
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
        } else {
            $board_detail_get = Board::get()->where('board_id', $board_id);
        }
           
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
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

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
        if(!Auth::check()){
            return redirect()->route('login.get');
        }

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
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $result = Board::find($board_id);
        $result->update([
            'board_title' => $request->input('u_title'),
            'board_content' => $request->input('u_content'),
        ]);
        //$request에서 hashtag 파라미터의 존재 여부를 확인합니다.
        //<input type="hidden" id="selectedHashtagsInput" name="hashtag" />
        if($request->hashtag) {       

        // 새로운 해시태그 추가 또는 기존 해시태그 갱신
        //hashtag 파라미터의 값을 가져와서 $hashtagInput 변수에 저장합니다.
        $hashtagInput = $request->input('hashtag');
        //$hashtagInput 값을 쉼표로 구분하여 배열로 변환합니다. 
        //이렇게 함으로써 여러 개의 해시태그를 나누어 처리할 수 있습니다.
        $hashtag_names = explode(',', $hashtagInput);
        //각 해시태그의 양쪽 공백을 제거합니다.
        $hashtag_names = array_map('trim', $hashtag_names);
        
       foreach ($hashtag_names as $hashtag_name) {
        // $hashtag_name에 해당하는 해시태그를 데이터베이스에서 찾거나 새로 생성합니다. 
        // firstOrCreate 메서드는 주어진 조건으로 검색하여 해당하는 모델을 찾거나 생성합니다.
            $hashtag = Hashtag::firstOrCreate(['hashtag_name' => $hashtag_name]);
            //현재 반복 중인 해시태그의 ID를 $hashtagIds 배열에 추가합니다.
            $hashtagIds[] = $hashtag->hashtag_id;
        }

        //$result 모델의 hashtags 관계를 동기화합니다.
        //$hashtagIds 배열에 있는 해시태그 ID들과 현재 모델의 해시태그 간의 관계를 업데이트합니다. 
        //sync 메서드는 중간 테이블을 조작하여 관계를 동기화합니다
        $result->hashtags()->sync($hashtagIds);
    }
        
        

    if ($request->hasFile('board_img')) {
        // 기존 이미지 삭제
        // $result->images()->delete();     
        
        
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
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        Board::destroy($board_id);
        Comment::where('board_id', $board_id)->delete();
        return redirect()-> route('categoryboard');
    }

    public function boardcategoryget($categoryId) {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }
        $category_board = Board::where('category_id', $categoryId)
        ->where('deleted_at', null)->orderby('board_id', 'desc')->paginate(5);

        $category_id = Category::orderby('category_id', 'asc')->get();

        $category_name = Category::where('category_id', $categoryId)->get();
        $result = [$category_board, $category_id, $category_name];

        return view('categoryboard')->with('data', $result);
    }
    
    public function nextboardpost(Request $request) {
        

        $result = Board::where('board_id', '<', $request->last_num)
            ->where('deleted_at', null)
            ->orderby('board_id', 'desc')
            ->limit(4)
            ->get();

        
        return response()->json($result);
    }

    public function favoritenextboardpost(Request $request) {
        
        $u_id = session('id');

        $result = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
        ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
        ->select('boards.board_id', 'boards.board_title', 'boards.board_content')
        ->where('users.id', $u_id)
        ->where('favorite_tags.deleted_at', null)
        ->where('boards.deleted_at', null)
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
            
            $cnt++;
        }

        return response()->json($result);
    }

    public function lastboardget() {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $lastboard = Board::orderBy('board_id', 'desc')
        ->where('deleted_at', null)->paginate(5);

        return view('lastboard')->with('data', $lastboard);
    }

    public function hotboardget() {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $hotboard = Board::orderBy('board_hits', 'desc')
        ->where('deleted_at', null)->paginate(5);

        return view('hotboard')->with('data', $hotboard);
    }

    public function favoriteboardget() {
        if(!Auth::check()){
            return redirect()->route('login.get');
            }

        $u_id = session('id');

        $favoriteboard = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->join('board_tags', 'hashtags.hashtag_id', '=', 'board_tags.hashtag_id')
        ->join('boards', 'board_tags.board_id', '=', 'boards.board_id')
        ->select('boards.board_id', 'boards.board_title', 'boards.board_content', 'boards.created_at')
        ->where('users.id', $u_id)
        ->where('favorite_tags.deleted_at', null)
        ->where('boards.deleted_at', null)
        ->orderby('boards.board_id', 'desc')
        ->groupBy('boards.board_id', 'boards.board_title', 'boards.board_content', 'boards.created_at')
        ->paginate(5);

        $count = 0;
        foreach ($favoriteboard as $item) {
            // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            $favoriteboard[$count]['userinfo'] = Board::join('users', 'boards.u_id', '=', 'users.id')
            ->select('users.user_img', 'users.user_name')
            ->where('boards.deleted_at', null)
            ->where('boards.board_id', $item->board_id)
            ->orderby('boards.board_id', 'desc')
            ->get();

            $count++;
        }

        $cnt = 0;

        foreach ($favoriteboard as $item) {
            // $boardfavorite[] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            $favoriteboard[$cnt]['board_tag'] = Board_tag::join('hashtags', 'board_tags.hashtag_id' ,'=', 'hashtags.hashtag_id')
            ->select('hashtags.hashtag_name')
            ->where('board_tags.board_id', $item->board_id)
            ->orderby('board_tags.board_id', 'desc')
            ->get();
            
            $cnt++;
        }

        $favoritetag = User::join('favorite_tags', 'users.id', '=', 'favorite_tags.u_id')
        ->join('hashtags', 'favorite_tags.hashtag_id', '=', 'hashtags.hashtag_id')
        ->select('hashtags.hashtag_name')
        ->where('users.id', $u_id)
        ->where('favorite_tags.deleted_at', null)
        ->orderby('hashtags.hashtag_id')
        ->get();

        return view('favoriteboard')->with('data', $favoriteboard)->with('tag', $favoritetag);
    }
}


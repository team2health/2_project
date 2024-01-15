<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Session;
use Illuminate\support\facades\DB;
use App\Models\Admin;
use App\Models\Board;
use App\Models\Comment;
use App\Models\Record;
use App\Models\User;
use App\Models\Symptom;
use App\Models\Hashtag;
use App\Models\Board_tag;
use App\Models\favorite_tag;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminget() {
        return view('adminpage.adminlogin');
    }
    public function adminlogin(Request $request) {

        $result = Admin::where('admin_id', $request->admin_id)->first();

        if(!(Hash::check($request->admin_password, $result->admin_password))) {
            return redirect()->route('admin');
        }

        Auth::login($result);
        if(Auth::check()) {
            session($result->only('admin_id', 'admin_name'));
        } else {
            return view('adminpage.adminlogin');
        }
        return redirect()->route('admin.main');
    }
    public function adminlogout() {
        Session::flush();
        Auth::logout();
        return redirect()->route('main.get');
    }

    public function adminmain() {
        $result = [];
        $result[0] = DB::select("
            SELECT 
                CASE 
                    WHEN age < 20 THEN '10대'
                    WHEN age BETWEEN 20 AND 29 THEN '20대'
                    WHEN age BETWEEN 30 AND 39 THEN '30대'
                    WHEN age BETWEEN 40 AND 49 THEN '40대'
                    WHEN age BETWEEN 50 AND 59 THEN '50대'
                    WHEN age >= 60 THEN '60대 이상'
                END AS name,
                COUNT(*) as value
            FROM (
                SELECT 
                    date_format(now(), '%Y') - date_format(birthday, '%Y') AS age
                FROM 
                    users
                WHERE deleted_at IS NULL
            ) AS c
            GROUP BY name
            ORDER BY name;
        ");

                
        $result[1] = DB::table('users')
        ->whereNull('deleted_at')
        ->select('user_gender', DB::raw('COUNT(*) as gender_count'))
        ->groupBy('user_gender')
        ->get();

        $result[2] = Board::select(
            DB::raw('DATE_FORMAT(created_at, "%a") AS week'),
            DB::raw('COUNT(DATE_FORMAT(created_at, "%a")) AS cnt')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%a")'))
        ->orderByRaw("FIELD(DATE_FORMAT(created_at, '%a'), 'Mon', 'Tue', 'Wed', 'Thu', 'Fri')")
        ->get();

        $result[3] = Comment::select(
            DB::raw('DATE_FORMAT(created_at, "%a") AS week'),
            DB::raw('COUNT(DATE_FORMAT(created_at, "%a")) AS cnt')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%a")'))
        ->orderByRaw("FIELD(DATE_FORMAT(created_at, '%a'), 'Mon', 'Tue', 'Wed', 'Thu', 'Fri')")
        ->get();

        $result[4] = Record::select(
            DB::raw('part_symptom_id'),
            DB::raw('COUNT(part_symptom_id) AS cnt')
        )
        ->where('created_at', '>', 20240101)
        ->groupBy('part_symptom_id')
        ->get();

        Log::debug($result[4]);

        return view('adminpage.index')->with('result', $result);
    }

    public function adminhashtagget() {

        $result = Hashtag::get();

        $cnt = 0;
        foreach ($result as $value) {
            $result[$cnt]['board_hashtag'] = Board_tag::where('hashtag_id', $value->hashtag_id)->count();

            $cnt++;
        }
        
        $count = 0;
        foreach ($result as $value) {
            $result[$count]['favorite_hashtag'] = favorite_tag::where('hashtag_id', $value->hashtag_id)->count();

            $count++;
        }


        return view('adminpage.hashtagmanagement')->with('result', $result);
    }

    public function hashtagdeletepost(Request $request) {

        foreach ($request->hashtag_id as $value) {
            Hashtag::destroy($value);
        }

        return redirect()->route('adminhashtag.get');
    }

    public function hashtaginsertpost(Request $request) {
        Hashtag::create([
            'hashtag_name' => $request->hashtag_name
        ]);

        $result = Hashtag::orderBy('hashtag_id', 'desc')->first();

        $result['board_hashtag'] = Board_tag::where('hashtag_id', $result->hashtag_id)->count();
        $result['favorite_hashtag'] = favorite_tag::where('hashtag_id', $result->hashtag_id)->count();


        return response()->json($result);
    }

    public function adminuser(){
        $userData = DB::table('users')
        ->select('id', 'user_name', 'user_email', 'created_at')
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->paginate(10); // 페이징 적용

    // 뷰를 반환할 때 조회한 사용자 정보를 함께 전달합니다.
    return view('adminpage.usermanagement')->with('data', $userData);
    }
    public function userdestroy(Request $request){
    //     // dd($request);
    //     $selectedIds = $request->input('id');
    //     // dd($selectedIds);
    //     User::destroy($selectedIds);
    //     return redirect()-> route('admin.usermanagement');
    // }
    if (!$request->has('id')) {
        // 값이 없으면 경고 메시지를 반환하거나 원하는 작업 수행
        return back()->with('warning', '삭제할 항목을 선택해주세요.');
    }

    $selectedIds = $request->input('id');
    
    // dd($selectedIds);
    User::destroy($selectedIds);    
    
    return redirect()->route('admin.usermanagement');
}
    public function searchUsers(Request $request)
    {
        $searchKeyword = $request->input('search_keyword');

        $users = User::where('user_name', 'like', "%$searchKeyword%")
                    ->orWhere('user_email', 'like', "%$searchKeyword%")
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('adminpage.usermanagement')->with('data', $users);
    }
    public function symptomsmng(){
        $symptomData = DB::table('symptoms')
        ->select('symptom_id', 'symptom_name',)
        ->orderBy('symptom_id', 'desc')
        ->paginate(10); // 페이징 적용

    // 뷰를 반환할 때 조회한 사용자 정보를 함께 전달합니다.
    return view('adminpage.symptomsmanagement')->with('data', $symptomData);
    }
    public function symptomdestroy(Request $request){
        // dd($request);
        if (!$request->has('symptom_id')) {
            // 값이 없으면 경고 메시지를 반환하거나 원하는 작업 수행
            return back();
        }
        $selectedsymptoms = $request->input('symptom_id');
        // dd($selectedIds);
        Symptom::destroy($selectedsymptoms);
        return redirect()-> route('admin.symptomsmanagement');
    }
    public function searchsymptoms(Request $request)
    {
        $searchKeyword = $request->input('search_keyword_sym');

        $symptoms = Symptom::where('symptom_name', 'like', "%$searchKeyword%")
                    ->orWhere('symptom_id', 'like', "%$searchKeyword%")
                    ->orderBy('symptom_id', 'desc')
                    ->paginate(10);
        return view('adminpage.symptomsmanagement')->with('data', $symptoms);
    }
    

}

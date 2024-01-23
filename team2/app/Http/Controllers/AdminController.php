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
use App\Models\Part;
use App\Models\Part_symptom;
use App\Models\Pandemic;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminget() {
        return view('adminpage.adminlogin');
    }
    public function adminlogin(Request $request) {

        $result = Admin::where('admin_id', $request->admin_id)->first();

        if(!$result) {
            return view('adminpage.adminlogin')->with('adminPassword', '1');
        }
        if(!(Hash::check($request->admin_password, $result->admin_password))) {
            return view('adminpage.adminlogin')->with('adminPassword', '2');
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
        $admin_id = session('admin_id');
        if(!isset($admin_id)) {
            return redirect()->route('main.get');
        }
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

        $result[2] = Board::whereRaw('YEARWEEK(created_at) = YEARWEEK(CURDATE())')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%a") AS week'),
            DB::raw('COUNT(DATE_FORMAT(created_at, "%a")) AS cnt')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%a")'))
        ->orderByRaw("FIELD(DATE_FORMAT(created_at, '%a'), 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat')")
        ->get();

        $result[3] = Comment::whereRaw('YEARWEEK(created_at) = YEARWEEK(CURDATE())')
        ->select(
            DB::raw('DATE_FORMAT(created_at, "%a") AS week'),
            DB::raw('COUNT(DATE_FORMAT(created_at, "%a")) AS cnt')
        )
        ->groupBy(DB::raw('DATE_FORMAT(created_at, "%a")'))
        ->orderByRaw("FIELD(DATE_FORMAT(created_at, '%a'), 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat')")
        ->get();

        $result[4] = Record::whereRaw('YEAR(created_at) = YEAR(CURDATE())')
        ->select('part_symptom_id', DB::raw('COUNT(part_symptom_id) as cnt'))
        ->orderBy(DB::raw('COUNT(part_symptom_id)'), 'desc')
        ->groupBy('part_symptom_id')
        ->limit(6)
        ->get();

        $cnt = 0;
        foreach ($result[4] as $value) {
            $result[4][$cnt]['part_name'] = Part_symptom::join('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
            ->select('parts.part_name')
            ->where('part_symptoms.part_symptom_id', $value->part_symptom_id)
            ->get();
            
            $result[4][$cnt]['symptom_name'] = Part_symptom::join('symptoms', 'part_symptoms.symptom_id', '=', 'symptoms.symptom_id')
            ->select('symptoms.symptom_name')
            ->where('part_symptoms.part_symptom_id', $value->part_symptom_id)
            ->get();

            $cnt++;
        }

        $last_year_cnt = Record::whereRaw('YEAR(created_at) = YEAR(CURDATE())-1')
        ->select('part_symptom_id', DB::raw('COUNT(part_symptom_id) as cnt'))
        ->orderBy(DB::raw('COUNT(part_symptom_id)'), 'desc')
        ->groupBy('part_symptom_id')
        ->limit(6)
        ->get();

        $c = 0;
        foreach ($result[4] as $value) {
            $diff = $value->cnt - $last_year_cnt[$c]->cnt;
            $result[4][$c]['last_year'] = floor(($diff/$last_year_cnt[$c]->cnt) * 100);
            $result[4][$c]['last_year_cnt'] = $last_year_cnt[$c]->cnt;

            $c++;
        }

        $result[5] = Pandemic::orderBy('created_at', 'desc')->get();

        $result[6] = DB::select("
            SELECT
                age_ranges.age_range,
                COALESCE(tmp.part_symptom_id, 0) AS part_symptom_id,
                COALESCE(tmp.cnt, 0) AS cnt
            FROM
            (
                SELECT '10대이하' AS age_range
                UNION SELECT '20대'
                UNION SELECT '30대'
                UNION SELECT '40대'
                UNION SELECT '50대'
                UNION SELECT '60대이상'
            ) age_ranges
            LEFT JOIN (
                SELECT
                    CASE
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 20 YEAR) AND usr.birthday < DATE_ADD(DATE(NOW()), interval 1 DAY) THEN '10대이하'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 30 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 20 YEAR) THEN '20대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 40 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 30 YEAR) THEN '30대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 50 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 40 YEAR) THEN '40대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 60 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 50 YEAR) THEN '50대'
                        ELSE '60대이상'
                    END AS age_range,
                    rec.part_symptom_id,
                    COUNT(rec.part_symptom_id) AS cnt,
                    ROW_NUMBER() OVER (PARTITION BY age_range ORDER BY cnt DESC) AS row_num
                FROM users usr
                JOIN records rec ON usr.id = rec.u_id
                WHERE YEAR(rec.created_at) = YEAR(CURDATE())
                GROUP BY age_range, rec.part_symptom_id
            ) tmp ON age_ranges.age_range = tmp.age_range AND tmp.row_num = 1;
        ");


        $count = 0;
        foreach ($result[6] as $value) {
            $value->part_name = Part_symptom::join('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
            ->select('parts.part_name')
            ->where('part_symptoms.part_symptom_id', $value->part_symptom_id)
            ->get();
            
            $value->symptom_name = Part_symptom::join('symptoms', 'part_symptoms.symptom_id', '=', 'symptoms.symptom_id')
            ->select('symptoms.symptom_name')
            ->where('part_symptoms.part_symptom_id', $value->part_symptom_id)
            ->get();

            $count++;
        }

        $last_year = DB::select("
            SELECT
                age_ranges.age_range,
                COALESCE(tmp.part_symptom_id, 0) AS part_symptom_id,
                COALESCE(tmp.cnt, 0) AS cnt
            FROM
            (
                SELECT '10대이하' AS age_range
                UNION SELECT '20대'
                UNION SELECT '30대'
                UNION SELECT '40대'
                UNION SELECT '50대'
                UNION SELECT '60대이상'
            ) age_ranges
            LEFT JOIN (
                SELECT
                    CASE
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 20 YEAR) AND usr.birthday < DATE_ADD(DATE(NOW()), interval 1 DAY) THEN '10대이하'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 30 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 20 YEAR) THEN '20대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 40 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 30 YEAR) THEN '30대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 50 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 40 YEAR) THEN '40대'
                        WHEN usr.birthday > DATE_SUB(DATE(NOW()), INTERVAL 60 YEAR) AND usr.birthday < DATE_SUB(DATE(NOW()), INTERVAL 50 YEAR) THEN '50대'
                        ELSE '60대이상'
                    END AS age_range,
                    rec.part_symptom_id,
                    COUNT(rec.part_symptom_id) AS cnt,
                    ROW_NUMBER() OVER (PARTITION BY age_range ORDER BY cnt DESC) AS row_num
                FROM users usr
                JOIN records rec ON usr.id = rec.u_id
                WHERE YEAR(rec.created_at) = YEAR(CURDATE())-1
                GROUP BY age_range, rec.part_symptom_id
            ) tmp ON age_ranges.age_range = tmp.age_range AND tmp.row_num = 1;
        ");


        $c = 0;
        foreach ($result[6] as $value) {
            $diff1 = $value->cnt - $last_year[$c]->cnt;
            if ($last_year[$c]->cnt != 0) {
                $value->last_year = floor(($diff1 / $last_year[$c]->cnt) * 100);
            } else {
                $value->last_year = '0';
            }
            $value->last_year_cnt = $last_year[$c]->cnt;

            $c++;
        }

        return view('adminpage.index')->with('result', $result);
    }

    public function pandemicdelete(Request $request) {
        foreach ($request->pandemic_id as $value) {
            Pandemic::destroy($value);
        }

        return redirect()->route('admin.main');
    }

    public function pandemicinsertpost(Request $request) {
        Pandemic::create([
            'pandemic_name' => $request->pandemic_name,
            'pandemic_symptoms' => $request->pandemic_symptom
        ]);

        $result = Pandemic::orderBy('pandemic_id', 'desc')->first();

        return response()->json($result);
    }

    public function adminhashtagget() {

        $result = Hashtag::orderBy('created_at', 'desc')->get();

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

    public function hashtagdelete(Request $request) {
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

    public function adminregistpost(Request $request) {
        $admin = $request->only('admin_id', 'admin_name', 'admin_password');

        $admin['admin_password'] = Hash::make($admin['admin_password']);

        $result = Admin::create($admin);

        return response()->json($result);
    }

    public function admindeleteget() {

        $result = Admin::whereNot('id', 1)->get();


        return view('adminpage.admindelete')->with('result', $result);
    }

    public function admindeletegodelete(Request $request) {
        foreach ($request->admin as $value) {
            Admin::destroy($value);
        }

        return redirect()->route('admindelete.get');
    }

    public function adminuser(){
        $userData = DB::table('users')
        ->select('id', 'user_name', 'user_email', 'created_at')
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->paginate(10); // 페이징 적용

    // 뷰를 반환할 때 조회한 사용자 정보를 함께 전달합니다.
    return view('adminpage.adminusermanagement')->with('data', $userData);
    }
    public function adminuserdestroy(Request $request){
    //     $selectedIds = $request->input('id');
    //     User::destroy($selectedIds);
    //     return redirect()-> route('admin.usermanagement');
    // }
    
    $selectedIds = $request->input('id');
    User::destroy($selectedIds);    
    
    return redirect()->route('admin.adminusermanagement');
}
    public function adminsearchUsers(Request $request)
    {
        $searchKeyword = $request->input('search_keyword');

        $users = User::where('user_name', 'like', "%$searchKeyword%")
                    ->orWhere('user_email', 'like', "%$searchKeyword%")
                    ->orderBy('id', 'desc')
                    ->paginate(10);
        return view('adminpage.adminusermanagement')->with('data', $users);
    }
    // public function symptomsmng(){
    //     $symptomData = DB::table('symptoms')
    //     ->select('symptom_id', 'symptom_name',)
    //     ->orderBy('symptom_id', 'desc')
    //     ->paginate(10); // 페이징 적용

    // // 뷰를 반환할 때 조회한 사용자 정보를 함께 전달합니다.
    // return view('adminpage.symptomsmanagement')->with('data', $symptomData);
    // }
    // public function symptomsmng(){
    //     $symptomData = DB::table('symptoms')
    //         ->select('symptoms.symptom_id', 'symptoms.symptom_name', DB::raw('group_concat(parts.part_id) as symptom_part_ids'), DB::raw('group_concat(parts.part_name) as symptom_parts'))
    //         ->leftJoin('part_symptoms', 'symptoms.symptom_id', '=', 'part_symptoms.symptom_id')
    //         ->leftJoin('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
    //         ->groupBy('symptoms.symptom_id', 'symptoms.symptom_name')
    //         ->orderBy('symptoms.symptom_id', 'desc')
    //         ->paginate(10);
    
    //     return view('adminpage.symptomsmanagement')->with('data', $symptomData);
    // }
//     public function symptomsmng()
// {
//     $symptomData = Symptom::with('parts')
//         ->select('symptoms.*') // 모든 컬럼을 선택
//         ->orderBy('symptoms.symptom_id', 'desc')
//         ->paginate(10); // 페이징 적용

//     return view('adminpage.symptomsmanagement')->with('data', $symptomData);
// }
public function adminsymptomsmng()
{
    $symptomData = Symptom::join('part_symptoms', 'symptoms.symptom_id', '=', 'part_symptoms.symptom_id')
    ->join('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
    ->select('symptoms.symptom_id', 'symptoms.symptom_name','parts.part_id as part_id', 'parts.part_name')
    ->orderBy('symptoms.symptom_id', 'desc')
    ->paginate(10);// 페이징 적용

    $partsData = Part::all(); // 모든 부위 데이터를 가져옴

    return view('adminpage.adminsymptomsmanagement')->with('data', $symptomData)->with('partsData', $partsData);
}
    // public function symptomsmng(){
    //     $symptomData = DB::table('symptoms')
    //         ->select('symptoms.symptom_id', 'symptoms.symptom_name', 'parts.part_name', 'parts.part_id')
    //         ->leftJoin('part_symptoms', 'symptoms.symptom_id', '=', 'part_symptoms.symptom_id')
    //         ->leftJoin('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
    //         ->orderBy('symptoms.symptom_id', 'desc')
    //         ->paginate(10); // 페이징 적용
    
    //     return view('adminpage.symptomsmanagement')->with('data', $symptomData);
    // }
    // public function symptomdestroy(Request $request){
    //     if (!$request->has('symptom_id')) {
    //         // 값이 없으면 경고 메시지를 반환하거나 원하는 작업 수행
    //         return back();
    //     }
    //     $selectedsymptoms = $request->input('symptom_id');
    //     Symptom::destroy($selectedsymptoms);
    //     return redirect()-> route('admin.symptomsmanagement');
    // }
    public function adminsymptomdestroy(Request $request){
        if (!$request->has('id')) {
            return back();
        }
        $symptomId = $request->input('id');
        $partSymptomId = Part_symptom::where('symptom_id', $symptomId)->value('part_symptom_id');
        Part_symptom::where('part_symptom_id', $partSymptomId)->delete();
        Record::where('part_symptom_id', $partSymptomId)->delete();

        // // 관련된 part_symptoms 데이터 삭제
        // Part_symptom::whereIn('symptom_id', $selectedsymptoms)->delete();
        // Part_symptom::whereNotIn('symptom_id', $selectedsymptoms)->delete();
        // Part_symptom::whereNotIn('symptom_id', $selectedsymptoms)->whereIn('part_id', $selectedParts)->delete();
        // 증상 데이터 삭제
        // Symptom::destroy($selectedsymptoms);
    
        return redirect()->route('admin.adminsymptomsmanagement');
    }
    
    // public function searchsymptoms(Request $request)
    // {
    //     $searchKeyword = $request->input('search_keyword_sym');

    //     $symptoms = Symptom::where('symptom_name', 'like', "%$searchKeyword%")
    //                 ->orWhere('symptom_id', 'like', "%$searchKeyword%")
    //                 ->orderBy('symptom_id', 'desc')
    //                 ->paginate(10);
    //     return view('adminpage.symptomsmanagement')->with('data', $symptoms);
    // }
    public function adminsearchsymptoms(Request $request)
    {
        $searchKeyword = $request->input('search_keyword_sym');

        $symptoms = Symptom::join('part_symptoms', 'symptoms.symptom_id', '=', 'part_symptoms.symptom_id')
            ->join('parts', 'part_symptoms.part_id', '=', 'parts.part_id')
            ->where('symptoms.symptom_name', 'like', "%$searchKeyword%")
            ->orWhere('symptoms.symptom_id', 'like', "%$searchKeyword%")
            ->orWhere('parts.part_name', 'like', "%$searchKeyword%")
            ->orderBy('symptoms.symptom_id', 'desc')
            ->paginate(10);

            $symptoms->appends(['search_keyword_sym' => $searchKeyword]);
            $partsData = Part::all();

        return view('adminpage.adminsymptomsmanagement')->with('data', $symptoms)->with('partsData', $partsData);
    }

    // public function addsymptom(Request $request){        
    //     $partId = $request->input('part_id');
    //     $symptomname = $request->input('symptom_name');
    //     $symptom = Symptom::create([            
    //         'symptom_name'=> $symptomname,
    //     ]);
    //     $symptom->parts()->sync($partId);
        
    //     return redirect()->route('admin.symptomsmanagement');
    // }
    // public function addsymptom(Request $request){        
    //     $partId = $request->input('part_id');
    //     $symptomname = $request->input('symptom_name');
    //     // 이미 존재하는 증상을 확인
    //     $existingSymptom = Symptom::where('symptom_name', $symptomname)->first();

    //     if ($existingSymptom) {
    //         // 이미 존재하는 경우, 기존 증상을 가져와서 새로운 부위와 연결
    //         $existingSymptom->parts()->attach($partId);
    //     } else {
    //         // 존재하지 않는 경우, 새로운 증상을 생성하고 부위와 연결
    //         $symptom = Symptom::create([
    //             'symptom_name' => $symptomname,
    //         ]);

    //         $symptom->parts()->sync($partId);
            
    //         return redirect()->route('admin.symptomsmanagement');
    //     }
    // }
    // public function addsymptom(Request $request) {
    //     $partId = $request->input('part_id');
    //     $symptomname = $request->input('symptom_name');
    
    //     // 같은 증상이 같은 부위에 이미 존재하는지 확인
    //     $existingSamePartSymptom = Part_symptom::where('part_id', $partId)
    //         ->whereHas('connectsymptoms', function ($query) use ($symptomname) {
    //             $query->where('symptom_name', $symptomname);
    //         })
    //         ->exists();
    
    //     // 같은 증상이 다른 부위에 이미 존재하는지 확인
    //     $existingDifferentPartSymptom = Part_symptom::where('part_id', '<>', $partId)
    //         ->whereHas('connectsymptoms', function ($query) use ($symptomname) {
    //             $query->where('symptom_name', $symptomname);
    //         })
    //         ->exists();
    
    //     if (!$existingSamePartSymptom && !$existingDifferentPartSymptom) {
    //         // 같은 증상이 같은 부위나 다른 부위에 존재하지 않는 경우, 생성하고 연결
    //         $symptom = Symptom::firstOrCreate(['symptom_name' => $symptomname]);
    //         $symptom->parts()->attach($partId);
    
    //         return redirect()->route('admin.symptomsmanagement');
    //     } else {
    //         // 이미 존재하는 경우, 에러 메시지를 표시하거나 다른 조치를 취할 수 있습니다.
    //         return redirect()->route('admin.symptomsmanagement')->withErrors('이미 동일한 증상이 해당 부위에 또는 다른 부위에 연결되어 있습니다.');
    //     }
    // }
    public function adminaddsymptom(Request $request) {
        $partId = $request->input('part_id');
        $symptomname = $request->input('symptom_name');
    
        // 입력하려는 부위에 해당하는 증상이 symptom 테이블에 존재하는지 확인
        $existingSymptom = Symptom::where('symptom_name', $symptomname)->first();
    
        if ($existingSymptom) {
            // 입력하려는 부위에 해당하는 증상이 이미 존재하는 경우,
            // 해당 부위와 연결이 되어 있지 않은 경우에만 연결
            if (!$existingSymptom->parts->contains($partId)) {
                $existingSymptom->parts()->attach($partId);
            }else {
                // 이미 해당 증상과 부위가 연결되어 있는 경우 에러 메시지 출력
                return redirect()->route('admin.adminsymptomsmanagement')->with('error', '이미 해당 증상과 부위가 연결되어 있습니다.');
            }
        } else {
            // 입력하려는 부위에 해당하는 증상이 symptom 테이블에 존재하지 않는 경우,
            // symptom 테이블에 해당 증상을 생성하고, 부위와 연결
            $symptom = Symptom::create(['symptom_name' => $symptomname]);
            $symptom->parts()->attach($partId);
        }
    
        return redirect()->route('admin.adminsymptomsmanagement');
    }
    
}

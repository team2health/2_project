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

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin() {
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
}

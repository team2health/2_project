<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SignupEmail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\MailVerify;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\support\Facades\DB;

class MailController extends Controller
{
	function emailchkget () {
		return view('emailpage');
	}

	function emailchkpost(Request $request) {


		$user_email = $request->user_email;

		$origin_result = DB::table('users')
		->select('id')
		->where('user_email', $user_email)
		->get();

		if(count($origin_result) > 0) {
			return response()->json('1');
		} else {
			$verification_code = mt_rand(100000, 999999);
	
			$data = [
				'user_email' => $request->user_email
				,'verification_code' => $verification_code
			];
	
			MailVerify::create([
				'user_email' => $request->user_email
				,'verification_code' => $verification_code
			]);
			
			Mail::to($user_email)->send(new SendMail($data));
			return response()->json($user_email);
		}
	}

	function emailchkset(Request $request) {
		$user_email = $request->user_email;
		$verification_code = $request->verificationcode;
		$minuites = Carbon::now()->subMinutes(5);

		$result = DB::table('mail_verification')
		->select('verification_code')
		->where('user_email', $user_email)
		->where('created_at', '>=', $minuites)
		->orderby('mail_id','desc')
		->get();

		if($result) {
			$currentTime = Carbon::now();
			Session::put('email', $user_email, $currentTime->addMinutes(5));
			
			$code = $result[0]->verification_code;
		} else {
			return response()->json('2');
		}
		
		if($code == $verification_code) {
			return response()->json(['status' => 'success', 'email' => $user_email]);
		} else {
			return response()->json('2');
		}
	}
}
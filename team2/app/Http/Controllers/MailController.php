<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SignupEmail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
	function emailchkget () {
		return view('emailpage');
	}

	function emailchkpost(Request $request) {
		$verification_code = mt_rand(100000, 999999);
		$user_email = $request->user_email;

		$data = [
			'user_email' => $request->user_email
			,'verification_code' => $verification_code
		];
		Session::put('user_email', $request->user_email);
		Session::put('verification_code', $verification_code);
		Session::put('email_verification_expiry', now()->addMinutes(5));

		Mail::to($user_email)->send(new SendMail($data));
		return view('emailpage');
	}

	function emailchkset(Request $request) {
		Log::debug($request);
		exit;
	}
}
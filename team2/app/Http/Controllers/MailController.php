<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\SignupEmail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendMail;

class MailController extends Controller
{
	function emailchkpost(Request $req) {
		$email = 'team2.healthproject@gmail.com';
		Mail::to($email)->send(new SendMail($email));
		return '메일 확인';
	}
}
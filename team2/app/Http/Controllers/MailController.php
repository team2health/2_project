<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SignupEmail;

class MailController extends Controller
{
    public static function sendSignupEmail($user_email, $verification_code) {
        $data = [
            'name' => $user_email,
            'verification_code' => $verification_code
        ];
        Mail::to($user_email)->send(new SignupEmail($data));
    }

    
}

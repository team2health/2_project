<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        // 항목 리스트
        $arrBaseKey = [
            'user_email'
            , 'user_name'
            , 'user_password'
            , 'user_password_check'
        ];
        // 유효성 체크 리스트
        $arrBaseValidation = [
            'user_email'     => 'required|email|max:50'
            , 'user_name'    => 'required|regex:/^[가-힣a-zA-Z0-9]{2,}$/'
            , 'user_password'=> 'required'
            , 'user_password_check' => 'same:user_password'
        ];

        // request 파라미터
        $arrRequestParam = [];

        foreach($arrBaseKey as $val) {
            if($request->has($val)) {
                $arrRequestParam[$val] = $request->$val;
            } else {
                unset($arrBaseValidation[$val]);
            }
        }

        // 유효성 검사
        $validator = Validator::make($arrRequestParam, $arrBaseValidation);

        // 유효성 검사 실패 시ㄴ (호)처리
        if($validator->fails()){
            return redirect()->route('regist.get');
        }
        return $next($request);
    }
}

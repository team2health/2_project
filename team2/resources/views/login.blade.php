@extends('layout.layout')

@section('title', 'login')

@section('main')

	<div class="mini-container">
		<div class="lr-box">
			<form action="{{ route('login.post') }}" method="POST" id="login_form">
				@csrf
				<span id="error_login_id" class="not-login-id">이메일을 입력해주세요.</span>
				<input type="text" class="login-input" autocomplete="on" placeholder="이메일" id="login_user_email" name="user_email">
				<input type="password" class="login-input" placeholder="비밀번호"
				autocomplete="off" id="login_user_password" name="user_password">
				<button type="button" class="login-button" onkeyup= "enterkey() return false" onclick="logingo(); return false;" id="loginBtn">로그인</button>
				<br>
				<div class="display-flex lr-text">
					<a href=""></a>
					<a href="/regist">회원가입</a>
				</div>
			</form>

			@if(isset($passwordError))
				<input type="hidden" id="passwordError" value="{{$passwordError}}">
			@else
				<input type="hidden" id="passwordError" value="0">
			@endif
			

						
			{{-- <input type="hidden" id="idError" value="{{$idError}}"> --}}
		</div>
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<script src="../js/login.js"></script>
@endsection
@extends('layout.layout')

@section('title', 'login')

@section('main')
	<div class="mini-container">
		<div class="lr-box">
			<form action="{{ route('login.post') }}" method="POST" id="login_form">
				@csrf
				<span id="error_login_id" class="not-login-id">한글, 영문, 숫자로 4글자 이상 입력해주세요</span>
				<input type="text" class="login-input" placeholder="아이디" id="login_user_id" name="user_id">
				<input type="password" class="login-input" placeholder="비밀번호" id="login_user_password" name="user_password">
				<button type="button" class="login-button" onkeyup= "enterkey() return false" onclick="logingo(); return false;" id="loginBtn" >로그인</button>
				<br>
				<div class="display-flex lr-text">
					<a href="">아이디/비밀번호 찾기</a>
					<a href="/regist">회원가입</a>
				</div>
			</form>
			<input type="hidden" id="passwordError" value="{{$passwordError}}">
			{{-- <input type="hidden" id="idError" value="{{$idError}}"> --}}
		</div>
	</div>
	<script src="../js/login.js"></script>
@endsection
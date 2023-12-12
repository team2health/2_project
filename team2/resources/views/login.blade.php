@extends('layout.layout')

@section('title', 'login')

@section('main')
	<div class="mini-container">
		<div class="lr-box">
			<form action="">
				<input type="text" class="login-input" placeholder="아이디">
				<input type="password" class="login-input" placeholder="비밀번호">
				<button type="submit" class="login-button">로그인</button>
				<br>
				<div class="display-flex lr-text">
					<a href="">아이디/비밀번호 찾기</a>
					<a href="/regist">회원가입</a>
				</div>
			</form>
		</div>
	</div>
@endsection
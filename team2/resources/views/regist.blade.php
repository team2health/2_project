@extends('layout.layout')

@section('title','Regist')

@section('main')
<div class="mini-container">
	<div class="regist-container">
		<form action="{{ route('regist.post') }}" method="POST">
			@csrf
			<p style="width: 60px;" class="ptag">닉네임</p><span id="error_name" class="error"></span>
			<input type="text" class="login-input" name="user_name" id="user_name">

			<p style="width: 60px;" class="ptag">아이디</p><span id="error_id" class="error"></span>
			<input type="text" class="login-input" name="user_id" id="user_id">

			<p style="width: 80px;" class="ptag">비밀번호</p><span id="error_password" class="error"></span>
			<input type="password" class="login-input" name="user_password" id="user_password">

			<p style="width: 120px;" class="ptag">비밀번호 확인</p><span id="error_password_check" class="error"></span>
			<input type="password" class="login-input" name="user_password_check" id="user_password_check">
			
			<div class="adress-box">
				<input type="text" id="sample4_postcode" placeholder="우편번호" class="adress-short">
				<input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="adress-btn"><br>
				<span id="guide" style="color:#999;display:none"></span>
				<input type="text" id="sample4_roadAddress" placeholder="도로명주소" class="adress-long" name="user_adress_f">
				<br>
				<input type="text" id="sample4_detailAddress" placeholder="상세주소" class="adress-long" name="user_adress_s">
			</div>

			<p>성별</p>
			<div class="gender-box">
				<input type="radio" name="gender" value="1" class="input-radio"><span class="gender-text male">남</span>
				<input type="radio" name="gender" value="2" class="input-radio"><span class="gender-text female">여</span>
				<br>
				<a href="/login" class="regist-button">돌아가기</a>
				<button type="submit" class="regist-button" onclick="registgo(); return false;">가입하기</button>
			</div>
		</form>
	</div>
</div>
@endsection
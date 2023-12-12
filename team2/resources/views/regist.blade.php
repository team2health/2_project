@extends('layout.layout')

@section('title','Regist')

@section('main')
<div class="mini-container">
	<div class="regist-container">
		<form action="">
			<p>닉네임</p>
			<input type="text" class="login-input">
			<p>아이디</p>
			<input type="text" class="login-input">
			<p>비밀번호</p>
			<input type="password" class="login-input">
			<p>비밀번호 확인</p>
			<input type="password" class="login-input">
			
			<div class="adress-box">
				<input type="text" id="sample4_postcode" placeholder="우편번호" class="adress-short">
				<input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="adress-btn"><br>
				<span id="guide" style="color:#999;display:none"></span>
				<input type="text" id="sample4_roadAddress" placeholder="도로명주소" class="adress-long">
				<br>
				<input type="text" id="sample4_detailAddress" placeholder="상세주소" class="adress-long">
			</div>

			<p>성별</p>
			<div class="gender-box">
				<input type="radio" name="gender" value="m" class="input-radio"><span class="gender-text male">남</span>
				<input type="radio" name="gender" value="f" class="input-radio"><span class="gender-text female">여</span>
				<br>
				<a href="/login" class="regist-button">돌아가기</a>
				<button type="submit" class="regist-button">가입하기</button>
			</div>
		</form>
	</div>
</div>
@endsection
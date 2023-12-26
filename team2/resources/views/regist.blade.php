@extends('layout.layout')

@section('title','Regist')

@section('main')
<div class="mini-container">
	<div class="regist-container">
		<form action="{{ route('regist.post') }}" method="POST" id="regist_form">
			@csrf
			<p style="width: 60px;" class="ptag">닉네임</p><span id="error_name" class="not-error-name">한글, 영문, 숫자로 2글자 이상 입력해주세요</span>
			<div class="input-div-box">
				<input type="text" class="login-input-short" name="user_name" id="user_name">
				<div class="input-check" onclick="checkName(); return false;">닉네임 확인</div>
			</div>
			<br>

			<p style="width: 60px;" class="ptag">아이디</p><span id="error_id" class="not-error-id">한글, 영문, 숫자로 4글자 이상 입력해주세요</span>
			<div class="input-div-box">
				<input type="text" class="login-input-short" name="user_id" id="user_id">
				<div class="input-check" onclick="checkId(); return false;">아이디 확인</div>
			</div>
			<br>

			<p style="width: 80px;" class="ptag">비밀번호</p>
			<input type="password" class="login-input" name="user_password" id="user_password">
			<br>

			<p style="width: 120px;" class="ptag">비밀번호 확인</p><span id="error_password_check" class="not-error-passwordchk">비밀번호와 일치하지 않습니다</span>
			<input type="password" class="login-input" name="user_password_check" id="user_password_check">
			<br>
			
			<div class="adress-box">
				<input type="text" id="sample4_postcode" placeholder="우편번호" class="adress-short" name="user_address_num" readonly>
				<input type="button" onclick="sample4_execDaumPostcode()" value="우편번호 찾기" class="adress-btn"><br>
				<span id="guide" style="color:#999;display:none"></span>
				<input type="text" id="sample4_roadAddress" placeholder="도로명주소" class="adress-long" name="user_address" readonly>
				<br>
				<input type="text" id="sample4_detailAddress" placeholder="상세주소" class="adress-long" name="user_address_detail">
			</div>
			<br>

			<p>성별</p>
			<div class="gender-box">
				<div class="gender-div" onclick="genderMcheck(); return false;" id="gender-male">남</div>
				<div class="gender-div" onclick="genderFcheck(); return false;" id="gender-female">여</div>
				<input type="hidden" name="user_gender" id="gender-input">
				<br>
				<a href="/login" class="regist-button">돌아가기</a>
				<button type="button" class="regist-button" onclick="registgo(); return false;">가입하기</button>
			</div>
		</form>
	</div>
</div>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/regist.js"></script>
@endsection
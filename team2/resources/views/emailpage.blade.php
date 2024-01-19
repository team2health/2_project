@extends('layout.layout')

@section('title','emailpage')

@section('main')

<div style="overflow: hidden">
    <form action="" method="post"  class="email-check-page" id="emailChkPageForm">
        @csrf
        <div class="emailchkpage-form">
            <div id="emailSendForm" class="emailSendForm">
                <span id="emailError" class="email-error"></span>
                <br>
                <label for="user_email">이메일을 입력해주세요.</label>
                <input type="email" class="login-input" placeholder="user@email.com"
                name="user_email" id="user_email" required>
                <button type="button" class="mypage-btn" onclick="emailSendBtn(); return false;" style="width: 90%; max-width:440px;"> 이메일 인증하기</button>
            </div>
        </div>
        <div class="emailchkpage-form">
            <div style="display: none; flex-direction: column; align-items: center;" id="verificationChkPageFrom">
                <label for="verificationcode" class="notice-orange">인증코드를 입력해주세요.</label>
                <input type="text" name="verification_code" class="login-input" id="verificationcode" placeholder="인증코드">
                <button type="button" style="width: 440px; max-width: 90%;" id="verificationcodeBtn" class="mypage-btn" disabled onclick="emailVerifySubmit(); return false;">인증하기</button>
            </div>
        </div>
    </form>
</div>
<script src="/js/mail.js"></script>

@endsection
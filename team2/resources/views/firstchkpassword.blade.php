@extends('layout.layout')

@section('title','firstchkpassword')
    

@section('main')

<div class="mypage-change-password" >
    <form action="/changpasswordchk" method="POST" id="passwordChangeFirstChk">
        @method('POST')
        @csrf
        <div class="password-pass-main-div">
            <div class="mypage-password-first-grid">
                {{-- <div class="mypage-change-password-msg">비밀번호를 입력해주세요.</div> --}}
                <div class="mypage-change-password-errorMsg" id="mypageChangePasswordErrorMsg">에러메세지 출력구간</div>
            </div>
            <div class="mypage-password-second-grid">
                <label class="mypage-info-label" for="password-change-chk"> 현재 비밀번호</label>
                <input class="password-pass" autocomplete="new-password" name="user_password" type="password" placeholder="비밀번호를 입력해주세요." id="password-change-chk">
                <label class="mypage-info-label" for="user-new-password">새 비밀번호</label>
                <input class="password-pass" autocomplete="new-password" name="user_new_password" type="password" placeholder="비밀번호를 입력해주세요." id="user-new-password">
                <label class="mypage-info-label" for="user-new-passwordchk">새 비밀번호 확인</label>
                <input class="password-pass" autocomplete="new-password" name="user_new_passwordchk" type="password" placeholder="비밀번호를 입력해주세요." id="user-new-passwordchkrd-chk">
            </div>
            @if (isset($passwordchk))
                <input type="hidden" value="{{$passwordchk}}" id="passwordChangeErrorValue">
            @else
                <input type="hidden" value="0" id="passwordChangeErrorValue">
            @endif
            <button type="submit" class="mypage-btn">변경완료</button>
        </div>
    </form>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>

<script src="/js/passwordchange.js"></script>
@endsection
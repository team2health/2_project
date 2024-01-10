@extends('layout.layout')

@section('title','emailpage')

@section('main')

<form action="{{route('email.post')}}" method="post" class="emailchkpage-form">
    @csrf
    <div>
        <label for="user_email">이메일을 입력해주세요.</label>
        <input type="email" class="login-input" placeholder="user@email.com"
        name="user_email" id="user_email" required>
    </div>
    <button type="submit" class="mypage-btn"> 이메일 인증하기</button>
</form>

@endsection
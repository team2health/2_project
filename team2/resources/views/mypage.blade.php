@extends('layout.layout')

@section('title','mypage')
    

@section('main')

<div class="mypage-main">
    <div class="mypage-main-grid">
        {{-- 나의 프로필과 아이디 띄우는 곳 --}}
        <div class="mypage-myProfile">
            <div class="mypage-myProfile-btn">
                <img src="/img/default_f.png" alt="">
                <div class="mypage-myProfile-btn-name">닉네임</div>
            </div>
        </div>
        {{-- 정보수정 --}}
        <div class="mypage-myInfo">
            {{-- 비밀번호 변경--}}
            <div class="mypage-myInfo-first">
                <div class="mypage-main-btn">
                    <img src="/img/password.png" alt="">
                    <div class="mypage-main-btn-name">비밀번호 변경</div>
                </div>

            </div>
            {{-- 나의 정보 --}}
            <div class="mypage-myInfo-second">
                <div class="mypage-main-btn">
                    <img src="/img/userinfo.png" alt="">
                    <div class="mypage-main-btn-name">나의 정보</div>
                </div>

            </div>
            {{-- 나의 게시글 목록 --}}
            <div class="mypage-myInfo-third">
                <div class="mypage-main-btn">
                    <img src="/img/myboard.png" alt="">
                    <div class="mypage-main-btn-name">게시글 목록</div>
                </div>
            </div>
        </div>

        <div class="mypage-gap"></div>

        {{-- 관심태그 --}}
        <div class="mypage-favoriteTag">
            {{-- 관심태그 버튼 --}}
            <div class="mypage-main-btn">
                <img src="/img/favoritetag.png" alt="">
                <div class="mypage-main-btn-name">관심태그 목록</div>
            </div>

        </div>
    </div>

    <div class="mypage-logout">로그아웃</div>



</div>


<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="/js/mypage.js"></script>
@endsection
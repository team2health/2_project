@extends('layout.layout')

@section('title','mypage')
    

@section('main')



<div class="mypage-all">

    <div class="mypage-content">
        <div class="mypage-myboards">
            <span>2023-12-12</span>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
        </div>
        <div class="mypage-myboards">
            <span>2023-12-11</span>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
            <div class="mypage-boardbox">
                <div class="mypage-bord-title">제목입니다.</div>
                <div class="mypage-bord-detailbox">상세내용입니다.</div>
            </div>
        </div>
        <div class="mypage-mycoments">
    
        </div>
    </div>

    <div class="mypage-mainbar">
        <div class="mypage-btn-layout">
            <div class="mypage-btn-line">
                <div class="mypage-btn">정보수정</div>
                <div class="mypage-btn">타임라인</div>
            </div>
            <div class="mypage-btn2">나의 게시물</div>
        </div>

        <div class="mypage-title">
            내가 찜한 관심 태그
            <div>
                관심태그 추가하기
            </div>
        </div>

    </div>
</div>

@endsection
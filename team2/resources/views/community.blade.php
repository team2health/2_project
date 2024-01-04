@extends('layout.layout')

@section('title','Community')

@section('main')
<main class="community-container">
    <div class="community-big-div">
        <a class="community-nav-bar" onclick="toggleDropdown()">카테고리</a>
        <a class="community-nav-bar">최신글</a>
        <a class="community-nav-bar">인기글</a>
        <a class="community-nav-bar">관심태그</a>
    </div>
    <div class="dropdown-content" id="myDropdown">
        <form method="get" id="category_id_form">
            @csrf
                <div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
                <div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
                <div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
                <div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
        </form>
    </div>
</main>
<script src="/js/community.js"></script>
@endsection

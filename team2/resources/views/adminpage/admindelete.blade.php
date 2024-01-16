@extends('adminpage/adminlayout.layout')

@section('title','관리자 계정 삭제')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
            <div class="button-box">
                <input type="text" name="hashtag_name" id="insert_hashtag" class="insert-hashtag-input">
                <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="insertHashtag(); return false;">+</button>
            </div>
            <br>
                <div class="card-header pandemic-border-bottom1">
                    <div>
                        <div class="admin-index-ps">
                            <div class="hashtagnsbox">
                                <span>선택</span>
                                <span class="pandemic-name11">해시태그명</span>
                                <span class="pandemic-symptom11">게시글 사용횟수</span>
                                <span class="pandemic-symptom11">관심태그 사용횟수</span>
                            </div>
                            <span>생성일자</span>
                        </div>
                    </div>
                </div>
                <form action="/hashtagdelete" method="post" id="hashtagdeletebox">
                    @csrf
                    @method('DELETE')
                    <div class="card-header">
                        <div class="admin-index-ps">
                            <div class="hashtagnsbox">
                                <span><input type="checkbox" name="hashtag_id[]" value=""></span>
                                <span class="pandemic-name"></span>
                                <span class="pandemic-symptom2 hashtag-margin-right">번 사용</span>
                                <span class="pandemic-symptom2 hashtag-margin-right">번 사용</span>
                            </div>
                            <span></span>
                        </div>
                    </div>
                    <br>
                    <div class="button-box">
                        <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
                    </div>
                </form>
        </div>  
    </div>  
</div>  
<script src="/js/adminhashtag.js"></script>
@endsection
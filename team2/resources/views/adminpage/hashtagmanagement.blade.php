@extends('adminpage/adminlayout.layout')

@section('title','hashtagmanagement.blade.php')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
            <div class="button-box">
                <input type="text" name="hashtag_name" id="insert_hashtag" class="insert-hashtag-input">
                <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="insertHashtag(); return false;">+</button>
            </div>
            <br>
            <table class="table table-striped">
                <colgroup>
                    <col width="20%;">
                    <col width="20%;">
                    <col width="20%;">
                    <col width="20%;">
                    <col width="20%;">
                </colgroup>
                <thead class="contesmanagement-tr">
                    <tr>
                        <th scope="col">선택</th>
                        <th scope="col">해시태그명</th>       
                        <th scope="col">게시글 사용횟수</th>
                        <th scope="col">관심태그 사용횟수</th>                     
                        <th scope="col">생성날짜</th>
                    </tr>
                </thead>
                <form action="/hashtagdelete" method="POST">
                    @csrf
                    <tbody id="hashtagbody">
                        @foreach ($result as $item)
                            <tr>
                                <th scope="row"><input type="checkbox" name="hashtag_id[]" value="{{$item->hashtag_id}}"></th>
                                <td>{{$item->hashtag_name}}</td>
                                <td>{{$item->board_hashtag}}번 사용</td>
                                <td>{{$item->favorite_hashtag}}번 사용</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="button-box">
                    <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
                </div>
                </form>
        </div>  
    </div>  
</div>  
<script src="/js/adminhashtag.js"></script>
@endsection
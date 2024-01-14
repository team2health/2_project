@extends('adminpage/adminlayout.layout')

@section('title','hashtagmanagement.blade.php')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
            <div class="input-group mb-3">
            </div>             
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
                            <th scope="col">번호</th>
                            <th scope="col">해시태그명</th>       
                            <th scope="col">게시글 사용횟수</th>
                            <th scope="col">관심태그 사용횟수</th>                     
                            <th scope="col">생성날짜</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $item)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{$item->hashtag_name}}</td>
                                <td>{{$item->board_hashtag}}</td>
                                <td>{{$item->favorite_hashtag}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="button-box">
                    <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
                </div>
            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">삭제확인</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>정말 삭제하시겠습니까?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                            <button type="button" class="btn btn-primary">확인</button>
                        </div>
                    </div>
                </div>
        </div>
@endsection
@extends('adminpage/adminlayout.layout')

@section('title','관리자 계정')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
            <br>
                <div class="card-header pandemic-border-bottom1">
                    <div>
                        <div class="admin-index-ps">
                            <div class="hashtagnsbox">
                                <span>선택</span>
                                <span class="pandemic-name11">관리자 id</span>
                                <span class="pandemic-symptom11">관리자 이름</span>
                            </div>
                            <span>생성일자</span>
                        </div>
                    </div>
                </div>
                <form action="/admin/admindeletego" method="post" id="admindeleteform">
                    @csrf
                    @method('DELETE')
                    @foreach ($result as $index => $item)
                        <div class="card-header" style="background-color: #f8f9fa;">
                        <div class="admin-index-ps">
                            <div class="hashtagnsbox">
                                <span><input type="checkbox" name="admin[]" value="{{$item->id}}"></span>
                                <span class="pandemic-name">{{$item->admin_id}}</span>
                                <span class="pandemic-symptom2 hashtag-margin-right">{{$item->admin_name}}</span>
                            </div>
                            <span>{{$item->created_at}}</span>
                        </div>
                    </div>
                    @endforeach
                    <br>
                    <div class="button-box">
                        <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="admindelete(); return false;">삭제</button>
                    </div>
                </form>
        </div>  
    </div>  
</div>  
<script src="/js/admindelete.js"></script>
@endsection
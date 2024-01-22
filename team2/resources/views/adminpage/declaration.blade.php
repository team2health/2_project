@extends('adminpage/adminlayout.layout')

@section('title','게시글 신고관리')

@section('main')
<div class="declaration-main">
    <div class="contents-tab-btn">
        <a href="{{route('contents.declaration')}}"><div id="contentsTaBoard" class="contents-tab-board-btn tab-active">게시글 신고 내역</div></a>
        <a href="{{route('comments.declaration')}}"><div id="contentsTaComments" class="contents-tab-comments-btn">댓글 신고 내역</div></a>
    </div>
    <div class="contentsmanagement-tab-second-zone">
        <form method="post" id="setDeclationFlg">
            @csrf
            <div class="contentsmanagement-select-btn-gridzone">
                <div>
                    <input type="checkbox" id="allselectcheck">
                    <label for="allselectcheck">전체선택</label>
                </div>
                <button type="button" class="admin-custom-btn custom-common-btn" style="width: 160px;" onclick="setDeclarationflg(); return false;"> 신고 횟수 초기화 </button>
                <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="deleteDeclaration(); return false;">삭제</button>
            </div>
            <table class="table">
                <colgroup>
                    <col width="2%;">
                    <col width="3%;">
                    <col width="4%;">
                    <col width="20%;">
                    <col width="30%;">
                    <col width="16%;">
                    <col width="8%;">
                    <col width="7%;">
                    <col width="5%;">
                    <col width="5%;">
                </colgroup>
                <thead>
                <tr class="contesmanagement-tr">
                    <th></th>
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">게시글 제목</th>
                    <th scope="col">게시글 내용</th>
                    <th scope="col">게시글 작성일</th>
                    <th scope="col">작성자</th>
                    <th scope="col">신고 횟수</th>
                    <th scope="col">조회수</th>
                    <th scope="col">댓글수</th>
                </tr>
                </thead>
                <tbody id="setDeclarationUserProfile">
                    @forelse ($data as $index => $item)
                        <tr id="setCommentTr{{$item->board_id}}" style="background-color: #f8f9fa;">
                            <th><button style="border: none;" type="button" onclick="showDeclarationUser({{$item->board_id}}); return false;">▼</button></th>
                            <th><input type="checkbox" name="board_id[]" value="{{$item->board_id}}" class="contens-checkbox"></th>
                            <th scope="row">{{$item->board_id}}</th>
                            <td>{{Str::limit($item->board_title, 30, '...')}}</td>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->board_content, 40, '...')}}</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{ isset($item->detotal) ? $item->detotal : '0' }}</td>
                            <td>{{$item->board_hits}}</td>
                            <td>{{ isset($item->commenttotal) ? $item->commenttotal : '0' }}</td>
                        </tr>
                        @foreach ($item->user as $user)
                            <tr style="background-color:rgb(231, 231, 231); display:none;" id="childrenTr{{$item->board_id}}">
                                <td>{{ $loop->iteration }} </td>
                                <td colspan="2">{{$user->user_name}}</td>
                                <td>{{$user->user_email}}</td>
                                <td colspan="2" class="user-board-reason-flg">{{$user->board_reason_flg}}</td>
                                <td colspan="4">{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                    @empty
                    @endforelse

                </tbody>
            </table>
        </form>
        {{-- 페이지네이션 --}}
        <nav aria-label="Page navigation example">
            <div class="pagination">    
                @if ($data->currentPage() > 1)
                    <a href="{{ $data->url(1) }}">&lt;&lt;</a>
                    <a class="page_pre" href="{{ $data->previousPageUrl() }}">이전</a>
                @endif
            
                @for ($i = max(1, $data->currentPage() - 2); $i <= min($data->lastPage(), $data->currentPage() + 2); $i++)
                    @if ($i == $data->currentPage())
                        <span class="pagination-current">{{ $i }}</span>
                    @else
                        <a href="{{ $data->url($i) }}" class="pagination-link">{{ $i }}</a>
                    @endif
                @endfor
            
                @if ($data->currentPage() < $data->lastPage())
                    <a class="page_pre" href="{{ $data->nextPageUrl() }}">다음</a>
                    <a href="{{ $data->url($data->lastPage()) }}">&gt;&gt;</a>
                @endif
            </div>
        </nav>
    </div>
</div>
<script src="/js/declaration.js"></script>




@endsection
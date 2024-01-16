@extends('adminpage/adminlayout.layout')

@section('title','댓글 신고관리')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab-btn">
        <a href="{{route('contents.declaration')}}"><div id="contentsTaBoard" class="contents-tab-board-btn">게시글 신고 내역</div></a>
        <a href="{{route('comments.declaration')}}"><div id="contentsTaComments" class="contents-tab-comments-btn tab-active">댓글 신고 내역</div></a>
    </div>
    <div class="contentsmanagement-tab-second-zone">
        <form method="post" id="AlignValueForm">
            @csrf
            <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
        </form>

        <form method="post" id="CommentSetDeclationFlg">
            @csrf
            <div class="contentsmanagement-select-btn-gridzone">
                <div>
                    <input type="checkbox" id="allselectcheck">
                    <label for="allselectcheck">전체선택</label>
                </div>
                <button type="button" class="admin-custom-btn custom-common-btn" style="width: 160px;" onclick="SetCommentFlg(); return false;"> 신고 횟수 초기화 </button>
                <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="deleteDeclarationComment(); return false;">삭제</button>
            </div>
            <table class="table table-striped">
                <colgroup>
                    <col width="3%;">
                    <col width="5%;">
                    <col width="15%">
                    <col width="30%">
                    <col width="15%;">
                    <col width="7%;">
                    <col width="10%;">
                    <col width="6%;">
                </colgroup>
                <thead>
                <tr class="contesmanagement-tr">
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">게시글 제목</th>
                    <th scope="col">댓글 내용</th>
                    <th scope="col">댓글 작성일</th>
                    <th scope="col">작성자</th>
                    <th scope="col">작성자 닉네임</th>
                    <th scope="col">신고 횟수</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($comment as $index => $item)
                        <tr>
                            <th><input type="checkbox" name="comment_id[]" value="{{$item->comment_id}}" id="commentChkBox{{$index}}" class="contens-checkbox"></th>
                            <th scope="row">{{$item->comment_id}}</th>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->board_title, 20, '...')}}</a></td>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->comment_content, 50, '...')}}</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->total}}</td>
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
        </form>
        {{-- 페이지네이션 --}}
        <nav aria-label="Page navigation example">
            <div class="pagination">    
                @if ($comment->currentPage() > 1)
                    <a href="{{ $comment->url(1) }}">&lt;&lt;</a>
                    <a class="page_pre" href="{{ $comment->previousPageUrl() }}">이전</a>
                @endif
            
                @for ($i = max(1, $comment->currentPage() - 2); $i <= min($comment->lastPage(), $comment->currentPage() + 2); $i++)
                    @if ($i == $comment->currentPage())
                        <span class="pagination-current">{{ $i }}</span>
                    @else
                        <a href="{{ $comment->url($i) }}" class="pagination-link">{{ $i }}</a>
                    @endif
                @endfor
            
                @if ($comment->currentPage() < $comment->lastPage())
                    <a class="page_pre" href="{{ $comment->nextPageUrl() }}">다음</a>
                    <a href="{{ $comment->url($comment->lastPage()) }}">&gt;&gt;</a>
                @endif
            </div>
        </nav>
    </div>
</div>
<script src="/js/declaration.js"></script>
@endsection
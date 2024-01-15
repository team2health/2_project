@extends('adminpage/adminlayout.layout')

@section('title','declaration')

@section('main')
<div class="declaration-main">
    <div class="contents-tab-btn">
        <a href="{{route('admin.contents', ['align_board' => 1])}}"><div id="contentsTaBoard" class="contents-tab-board-btn">게시글 관리</div></a>
        <a href="{{route('admin.comments')}}"><div id="contentsTaComments" class="contents-tab-comments-btn tab-active">댓글 관리</div></a>
    </div>
    <div class="contentsmanagement-tab-second-zone">
        <form action="#" method="post" id="AlignValueForm">
            @csrf
            <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
        </form>

        <form action="#" method="post">
            @csrf
            <div class="contentsmanagement-select-btn-zone">
                <div>
                    <input type="checkbox" id="allselectcheck">
                    <label for="allselectcheck">전체선택</label>
                </div>
                <button class="admin-custom-btn custom-common-delete-btn" onclick="commentsDelete(); return false;">삭제</button>
            </div>
            <table class="table table-striped">
                <colgroup>
                    <col width="3%;">
                    <col width="20%;">
                    <col width="45%;">
                    <col width="14%;">
                    <col width="6%;">
                    <col width="6%;">
                    <col width="6%;">
                </colgroup>
                <thead>
                <tr class="contesmanagement-tr">
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">게시글 제목</th>
                    <th scope="col">게시글 내용</th>
                    <th scope="col">게시글 작성일</th>
                    <th scope="col">신고 횟수</th>
                    <th scope="col">조회수</th>
                    <th scope="col">댓글수</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <th><input type="checkbox" value="{{$data->board_id}}" id="commentChkBox{{$item->comment_id}}"></th>
                            <th scope="row">{{$data->board_id}}</th>
                            <td>{{Str::limit($data->board_title, 20, '...')}}</td>
                            <td><a href="{{ route('board.show',['board'=>$data->board_id]) }}">{{Str::limit($data->board_id, 35, '...')}}</a></td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->user_email}}</td>
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
<script src="/js/admincomments.js"></script>




@endsection
@extends('adminpage/adminlayout.layout')

@section('title','commentsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab-btn">
        <a href="{{route('admin.contents', ['align_board' => 1])}}"><div id="contentsTaBoard" class="contents-tab-board-btn">게시글 관리</div></a>
        <a href="{{route('admin.comments')}}"><div id="contentsTaComments" class="contents-tab-comments-btn tab-active">댓글 관리</div></a>
    </div>
    <div class="contentsmanagement-tab-second-zone">
        <form action="/admin/commentsearch" method="post" id="searchCommentDateForm">
            @csrf
            <div class="contentsmanagement-board-btn-zone2">
                <div class="boardsearch-calendar">
                    <div id="searchDate" class="start-date">
                        <select class="search-date-box" id="start-year" name="start_year">
                        <option disabled selected>연도</option>
                        </select>
                        <select class="search-date-box" id="start-month" name="start_month">
                            <option disabled selected>월</option>
                        </select>
                        <select class="search-date-box" id="start-day" name="start_day">
                            <option disabled selected>일</option>
                        </select>
                    </div>
                </div>
                <span>-</span>
                    <div class="boardsearch-calendar">
                        <div id="searchDate" class="birthday">
                            <select class="search-date-box" id="end-year" name="end_year">
                            <option disabled selected>연도</option>
                            </select>
                            <select class="search-date-box" id="end-month" name="end_month">
                                <option disabled selected>월</option>
                            </select>
                            <select class="search-date-box" id="end-day" name="end_day">
                                <option disabled selected>일</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="admin-custom-btn custom-common-btn" onclick="searchCommentDate(); return false;">검색</button>
                    <div>
                        {{-- <div class="admin-custom-btn custom-common-btn" id="contentsmanagementSearchAlign">정렬</div> --}}
                    </div>
                </div>
        </form>
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
                    <col width="5%;">
                    <col width="25%;">
                    <col width="45%;">
                    <col width="15%;">
                    <col width="7%;">
                </colgroup>
                <thead>
                <tr class="contesmanagement-tr">
                    <th></th>
                    <th scope="col">#</th>
                    <th scope="col">게시글 제목</th>
                    <th scope="col">댓글 내용</th>
                    <th scope="col">댓글 작성일</th>
                    <th scope="col">작성자</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($comment as $item)
                        <tr>
                            <th><input type="checkbox" value="{{$item->comment_id}}" id="commentChkBox{{$item->comment_id}}"></th>
                            <th scope="row">{{$item->comment_id}}</th>
                            <td>{{Str::limit($item->board_title, 20, '...')}}</td>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->comment_content, 35, '...')}}</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
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
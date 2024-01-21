@extends('adminpage/adminlayout.layout')

@section('title','commentsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab-btn">
        <a href="{{route('admin.contents', ['align_board' => 1])}}"><div id="contentsTaBoard" class="contents-tab-board-btn">게시글 관리</div></a>
        <a href="{{route('admin.comments')}}"><div id="contentsTaComments" class="contents-tab-comments-btn tab-active">댓글 관리</div></a>
    </div>
    <div class="contentsmanagement-tab-second-zone">
        <form action="/admin/commentsearch" method="post">
            @php
            $year = now()->format('Y');
            $start = $date[0];
            $start_year = substr($start, 0, 4);
            $start_month = substr($start, 4, 2);
            $start_day = substr($start, 6, 2);
            $end = $date[1];
            $end_year = substr($end, 0, 4);
            $end_month = substr($end, 4, 2);
            $end_day = substr($end, 6, 2);
        @endphp
        @csrf
        <div class="contentsmanagement-board-btn-zone">
            @csrf
            <div class="boardsearch-calendar">
                <div id="searchDate" class="start-date">
                    <select class="search-date-box" id="start-year" name="start_year">
                        @for ($i = 2020; $i <= $year; $i++)
                            <option value="{{ $i }}" @if($start_year == $i) selected @endif>{{ $i }}년</option>
                        @endfor
                    </select>
                    <select class="search-date-box" id="start-month" name="start_month">
                        @for ($i = 1; $i <= 12; $i++)
                        @php
                        $start_month_set = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <option value="{{ $start_month_set }}" @if($start_month == $start_month_set) selected @endif>{{ $i }}월</option>
                        @endfor
                    </select>
                    <select class="search-date-box" id="start-day" name="start_day">
                        @for ($i = 1; $i <= 31; $i++)
                        @php
                        $start_day_set = str_pad($i, 2, '0', STR_PAD_LEFT);
                        @endphp
                        <option value="{{ $start_day_set }}" @if($start_day == $start_day_set) selected @endif>{{ $i }}일</option>
                        @endfor
                    </select>
                </div>
            </div>
            <span>-</span>
                <div class="boardsearch-calendar">
                    <div id="searchDate" class="birthday">
                        <select class="search-date-box" id="end-year" name="end_year">
                            @for ($i = 2020; $i <= $year; $i++)
                            <option value="{{ $i }}" @if($end_year == $i) selected @endif>{{ $i }}년</option>
                            @endfor
                        </select>
                        <select class="search-date-box" id="end-month" name="end_month">
                            @for ($i = 1; $i <= 12; $i++)
                            @php
                            $end_month_set = str_pad($i, 2, '0', STR_PAD_LEFT);
                            @endphp
                            <option value="{{ $end_month_set }}" @if($end_month == $end_month_set) selected @endif>{{ $i }}월</option>
                            @endfor
                        </select>
                        <select class="search-date-box" id="end-day" name="end_day">
                            @for ($i = 1; $i <= 31; $i++)
                            @php
                            $end_day_set = str_pad($i, 2, '0', STR_PAD_LEFT);
                            @endphp
                            <option value="{{ $end_day_set }}" @if($end_day == $end_day_set) selected @endif>{{ $i }}일</option>
                            @endfor
                        </select>
                    </div>
                </div>
                    <button class="admin-custom-btn custom-common-btn">검색</button>
                    {{-- <div>
                        <div class="admin-custom-btn custom-common-btn" id="contentsmanagementSearchAlign">정렬</div>
                        <div class="contentsmanagement-search-align admin-display-none" id="contentsmanagementSearchAlignDiv">
                            <div class="alignValueSet" id="alignValueSet">인기순</div>
                            <div class="alignValueSet" id="alignValueSet2">최신순</div>
                            <input type="hidden" name="sort" id="sortValue">
                        </div>
                    </div> --}}
            </div>
        </form>
        <form action="#" method="post" id="AlignValueForm">
            @csrf
            <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
        </form>

        <form action="/admin/deletecomments" method="post">
            @csrf
            <div class="contentsmanagement-select-btn-zone">
                <div>
                    <input type="checkbox" id="allselectcheck">
                    <label for="allselectcheck">전체선택</label>
                </div>
                <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
            </div>
            <table class="table table-striped">
                <colgroup>
                    <col width="3%;">
                    <col width="5%;">
                    <col width="25%;">
                    <col width="40%;">
                    <col width="15%;">
                    <col width="7%;">
                    <col width="5%;">
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
                </tr>
                </thead>
                <tbody>
                    @forelse ($comment as $index => $item)
                        <tr>
                            <th><input type="checkbox" name="comment_id[]" value="{{$item->comment_id}}" id="commentChkBox{{$index}}" class="contens-checkbox"></th>
                            <th scope="row">{{$item->comment_id}}</th>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->board_title, 20, '...')}}</a></td>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->comment_content, 35, '...')}}</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->user_name}}</td>
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

@endsection
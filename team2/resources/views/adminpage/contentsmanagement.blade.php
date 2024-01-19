@extends('adminpage/adminlayout.layout')

@section('title','contentsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contents-tab-btn">
            <a href="{{route('admin.contents')}}"><div id="contentsTaBoard" class="contents-tab-board-btn tab-active">게시글 관리</div></a>
            <a href="{{route('admin.comments')}}"><div id="contentsTaComments" class="contents-tab-comments-btn">댓글 관리</div></a>
        </div>
        <div class="contentsmanagement-tab-first-zone tab-show">
            <form action="/admin/contentsearch" method="post">
                @csrf
                <div class="contentsmanagement-board-btn-zone">
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
                        <button class="admin-custom-btn custom-common-btn">검색</button>
                        <div>
                            <div class="admin-custom-btn custom-common-btn" id="contentsmanagementSearchAlign">정렬</div>
                            <div class="contentsmanagement-search-align admin-display-none" id="contentsmanagementSearchAlignDiv">
                                <div class="alignValueSet" id="alignValueSet">인기순</div>
                                <div class="alignValueSet" id="alignValueSet2">최신순</div>
                                <input type="hidden" name="sort" id="sortValue">
                            </div>
                        </div>
                    </div>
            </form>
            <form action="/admin/contentssort" method="post" id="AlignValueForm">
                @csrf
                <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
            </form>
            <form action="/admin/deleteboard" method="post">
                @csrf
                <div class="contentsmanagement-select-btn-zone">
                    <div>
                        <input type="checkbox" id="allselectcheck" name="board_name">
                        <label for="allselectcheck">전체선택</label>
                    </div>
                    <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
                </div>
                <table class="table table-striped">
                    <colgroup>
                        <col width="3%;">
                        <col width="5%;">
                        <col width="10%;">
                        <col width="20%;">
                        <col width="30%;">
                        <col width="15%;">
                        <col width="7%;">
                        <col width="5%;">
                        <col width="5%;">
                    </colgroup>
                    <thead class="contesmanagement-tr">
                        <tr>
                            <th></th>
                            <th scope="col">#</th>
                            <th scope="col">카테고리</th>
                            <th scope="col">제목</th>
                            <th scope="col">내용</th>
                            <th scope="col">작성날짜</th>
                            <th scope="col">작성자</th>
                            <th scope="col">조회수</th>
                            <th scope="col">댓글수</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <th><input type="checkbox" name="board_id[]" value="{{$item->board_id}}" class="contens-checkbox"></th>
                            <th scope="row">{{$item->board_id}}</th>
                </form>
                            <td>
                                <form action="/admin/changecategory" id="deleteAdminContent{{$item->board_id}}" method="post">
                                    @csrf
                                    <select id="getCategorySelectValue{{$item->board_id}}" name="category_id" onchange="categoryChange({{$item->board_id}}); return false;">
                                        <option value="1" {{ ($item->category_name) == '자유게시판' ? 'selected' : '' }}>자유게시판</option>
                                        <option value="2" {{ ($item->category_name) == '정보게시판' ? 'selected' : '' }}>정보게시판</option>
                                        <option value="3" {{ ($item->category_name) == '친목게시판' ? 'selected' : '' }}>친목게시판</option>
                                        <option value="4" {{ ($item->category_name) == '질문게시판' ? 'selected' : '' }}>질문게시판</option>
                                    </select>
                                    <input type="hidden" name="board_id" value="{{$item->board_id}}">
                                </form>
                            </td>
                            <td>{{Str::limit($item->board_title, 20, '...')}}</td>
                            <td><a href="{{ route('board.show',['board'=>$item->board_id]) }}">{{Str::limit($item->board_content, 50, '...')}}</a></td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->board_hits}}</td>
                            <td>{{$item->comcount}}</td>
                            <input type="hidden" value="제목아이디">
                        </tr>
                            @empty
                                
                            @endforelse
                    </tbody>
                </table>
            {{-- </form> --}}

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
</div>
<script src="/js/adminboard.js"></script>

@endsection
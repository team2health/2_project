@extends('adminpage/adminlayout.layout')

@section('title','contentsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
            <form action="#" method="action">
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
                        <button type="submit" class="admin-custom-btn custom-common-btn">검색</button>
                        <div>
                            <div class="admin-custom-btn custom-common-btn" id="contentsmanagementSearchAlign">정렬</div>
                            <div class="contentsmanagement-search-align admin-display-none" id="contentsmanagementSearchAlignDiv">
                                <div class="alignValueSet" id="alignValueSet">최신순</div>
                                <div class="alignValueSet" id="alignValueSet2">인기순</div>
                            </div>
                        </div>
                    </div>
            </form>
            <form action="#" method="post" id="AlignValueForm">
                @csrf
                <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
            </form>
            <form action="{{route('admin.destroy')}}" method="post">
                @csrf
                @method('DELETE')
                <div class="contentsmanagement-select-btn-zone">
                    <div>
                        <input type="checkbox" id="allselectcheck">
                        <label for="allselectcheck">전체선택</label>
                    </div>
                    <button class="admin-custom-btn custom-common-delete-btn">삭제</button>
                </div>
            
                <table class="table table-striped">
                    <colgroup>
                        <col width="3%;">
                        <col width="5%;">
                        <col width="10%;">
                        <col width="20%;">
                        <col width="35%;">
                        <col width="10%;">
                        <col width="7%;">                        
                    </colgroup>
                    <thead class="contesmanagement-tr">
                        <tr>
                            <th></th>
                            <th scope="col">가입순서</th>
                            <th scope="col">USER_name</th>                            
                            <th scope="col">u_email</th>
                            <th scope="col">생성날짜</th>
                            <th scope="col">작성한게시글</th>                            
                            <th scope="col">작성한댓글</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            <th><input type="checkbox"></th>
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>{{$item->user_email}}</td>
                            
                            
                            <input type="hidden" value="제목아이디">
                        </tr>
                            @empty
                                
                            @endforelse
                    </tbody>
                </table>
            </form>

            {{-- 페이지네이션 --}}
            <nav aria-label="Page navigation example">
                {{-- <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul> --}}
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
<script src="/js/usermanagement.js"></script>
@endsection
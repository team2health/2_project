@extends('adminpage/adminlayout.layout')

@section('title','휴지통')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone tab-show">
            <form method="post">
                @csrf
                <div class="contentsmanagement-board-btn-zone3">
                    <div>
                        <div class="admin-custom-btn custom-common-btn" id="contentsmanagementSearchAlign">정렬</div>
                        <div class="contentsmanagement-search-align admin-display-none" id="contentsmanagementSearchAlignDiv">
                            <div class="alignValueSet" id="alignValueSet">오래된순</div>
                            <div class="alignValueSet" id="alignValueSet2">최신순</div>
                            <input type="hidden" name="sort" id="sortValue">
                        </div>
                    </div>
                    <button type="button" class="admin-custom-btn custom-common-btn" onclick="restoreBoardSet(); return false;">복구</button>
                </div>
            </form>
            <form method="post" id="AlignValueForm">
                @csrf
                <input type="hidden" id="contentsmanagementSearchAlignValue" name="align_board">
            </form>
            <form method="post" id="deletedContentMainForm">
                @csrf
                <div class="contentsmanagement-select-btn-zone">
                    <div>
                        <input type="checkbox" id="allselectcheck" name="board_name">
                        <label for="allselectcheck">전체선택</label>
                    </div>
                    <button type="button" class="admin-custom-btn custom-common-delete-btn" onclick="deletecontent(); return false;">삭제</button>
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
                            <td>{{Str::limit($item->category_name, 20, '...')}}</td>
                            <td>{{Str::limit($item->board_title, 40, '...')}}</td>
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
            </form>
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
<script src="/js/deletedcontent.js"></script>

@endsection
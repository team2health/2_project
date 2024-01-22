@extends('adminpage/adminlayout.layout')

@section('title', 'usermanagement')

@section('main')
    <div class="contentsmanagement-main">
        <div class="contents-tab">
            <div class="contentsmanagement-tab-first-zone" data-order="1">
                <form action="{{ route('admin.adminsearchUsers') }}" method="get">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="유저 검색" name="search_keyword">
                        <button class="btn btn-outline-secondary" type="submit">검색</button>
                    </div>
                </form>
                <form id="deleteForm" action="{{ route('admin.adminuserdestroy') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <table style="background-color: #f8f9fa;" class="table">
                        <colgroup>
                            <col width="10%;">
                            <col width="15%;">
                            <col width="20%;">
                            <col width="25%;">
                            <col width="25%;">
                        </colgroup>
                        <thead class="contesmanagement-tr">
                            <tr>
                                <th scope="col">영구강퇴</th>
                                <th scope="col">가입순서</th>
                                <th scope="col">닉네임</th>
                                <th scope="col">이메일</th>
                                <th scope="col">생성날짜</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr>
                                    <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                                    <th scope="row">{{ $item->id }}</th>
                                    <td>{{ $item->user_name }}</td>
                                    <td>{{ $item->user_email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">검색 결과가 없습니다.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="button" class="admin-custom-btn custom-common-delete-btn delete-comment-btn" onclick="confirmDelete()" style="float:right;">삭제</button>
                    {{-- <a href="{{route('admin.adminusermanagement')}}" style="text-decoration: none; line-height: 30px;"
                        class="text-decoration-none admin-custom-btn custom-common-btn ">뒤로 가기</a> --}}
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
        <script src="/js/usermanagement.js"></script>

    @endsection
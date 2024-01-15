@extends('adminpage/adminlayout.layout')

@section('title','usermanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
        <form action="{{ route('admin.searchUsers') }}" method="get">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="유저 검색" name="search_keyword">
                <button class="btn btn-outline-secondary" type="submit">검색</button>
            </div>
        </form>
            <form id="deleteForm" action="{{ route('admin.userdestroy') }}" method="post">
                @csrf
                @method('DELETE')                              
                <table class="table table-striped">
                    <colgroup>
                        <col width="15%;">
                        
                        <col width="15%;">
                        <col width="15%;">
                        <col width="35%;">
                        <col width="20%;">
                                               
                    </colgroup>
                    <thead class="contesmanagement-tr">
                        <tr>
                            
                            <th scope="col">가입순서</th>
                            <th scope="col">USER_name</th>                            
                            <th scope="col">u_email</th>
                            <th scope="col">생성날짜</th>
                            <th scope="col">영구강퇴</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->user_name}}</td>
                            <td>{{$item->user_email}}</td>
                            <td>{{$item->created_at}}</td>
                           <td><input type="checkbox" name="id[]" value="{{ $item->id }}"></td>
                        </tr>
                            @empty
                            <tr>
                                <td colspan="5">검색 결과가 없습니다.</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                <button type="button" class="admin-custom-btn custom-common-delete-btn" data-bs-toggle="modal" data-bs-target="#confirmationModal">삭제</button>
                <a href="{{ url()->previous() }}" style="text-decoration: none;" class="text-decoration-none admin-custom-btn custom-common-btn ">뒤로 가기</a>
            </form>
            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">삭제 확인</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>정말 삭제하시겠습니까?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                            <button type="submit" class="btn btn-primary" onclick="deleteConfirmed()">확인</button>
                        </div>
                    </div>
                </div>
            </div>

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
        <script>function confirmDelete() {
        // 여기에 삭제 전 확인 작업을 수행할 로직 추가
        return true; // 확인되면 true 반환
    }

    function deleteConfirmed() {
        // 여기에 실제 삭제 작업을 수행하는 로직 추가
        document.getElementById('deleteForm').submit();
    }</script>
@endsection
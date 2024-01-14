@extends('adminpage/adminlayout.layout')

@section('title','symptomsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
        <form action="{{ route('admin.searchsymptoms') }}" method="get">
            @csrf
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="증상 검색" name="search_keyword_sym">
                <button class="btn btn-outline-secondary" type="submit">검색</button>
            </div>
        </form>
            <form id="deleteForm" action="{{ route('admin.symptomdestroy') }}" method="post" id="deleteForm" onsubmit="return confirm('정말로 삭제하시겠습니까?');">
                @csrf
                @method('DELETE')                              
                <table class="table table-striped">
                    <colgroup>
                        <col width="40%;">                        
                        <col width="40%;">
                        <col width="20%;">
                        
                                               
                    </colgroup>
                    <thead class="contesmanagement-tr">
                        <tr>
                            
                            <th scope="col">증상번호</th>
                            <th scope="col">증상이름</th>                            
                            <th scope="col">u_email</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>
                            
                            <th scope="row">{{$item->symptom_id}}</th>
                            <td>{{$item->symptom_name}}</td>
                            
                           <td><input type="checkbox" name="id[]" value="{{ $item->symptom_id}}"></td>
                        </tr>
                            @empty
                            <tr>
                                <td colspan="5">검색 결과가 없습니다.</td>
                            </tr>
                            @endforelse
                    </tbody>
                </table>
                <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
                <a href="{{ url()->previous() }}" style="text-decoration: none;" class="admin-custom-btn custom-common-btn">뒤로 가기</a>
            </form>
            <div class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">삭제확인</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>정말 삭제하시겠습니까?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">취소</button>
                            <button type="button" class="btn btn-primary">확인</button>
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
@endsection
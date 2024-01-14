@extends('adminpage/adminlayout.layout')

@section('title','contentsmanagement')

@section('main')
<div class="contentsmanagement-main">
    <div class="contents-tab">
        <div class="contentsmanagement-tab-first-zone" data-order="1">
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
                                
                            @endforelse
                    </tbody>
                </table>
                <button type="submit" class="admin-custom-btn custom-common-delete-btn">삭제</button>
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
@endsection
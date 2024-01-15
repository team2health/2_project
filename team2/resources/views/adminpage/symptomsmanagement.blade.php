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
            <form id="deleteForm" action="{{ route('admin.symptomdestroy') }}" method="post">
                @csrf
                @method('DELETE')                              
                <table class="table table-striped">
                    <colgroup>
                        <col width="30%;">                        
                        <col width="30%;">
                        <col width="30%;">
                        <col width="10%;">
                        
                                               
                    </colgroup>
                    <thead class="contesmanagement-tr">
                        <tr>
                            
                            <th scope="col">증상번호</th>
                            <th scope="col">증상부위</th>
                            <th scope="col">증상이름</th>
                            <th scope="col">증상삭제</th>

                            
                            
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                        <tr>                            
                            <th scope="row">{{$item->symptom_id}}</th>
                            <td>{{$item->part_name}}</td>                            
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
                <button type="button" class="admin-custom-btn custom-common-delete-btn" data-bs-toggle="modal" data-bs-target="#confirmationModal">삭제</button>
                <button type="button" class="admin-custom-btn custom-common-btn" data-bs-toggle="modal" data-bs-target="#addSymptomModal">증상 추가</button>
                <a href="{{ url()->previous() }}" style="text-decoration: none;" class="admin-custom-btn custom-common-btn">뒤로 가기</a>
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
                            <button type="submit" class="btn btn-primary" onclick="console.log('버튼이 클릭되었습니다.'); deleteConfirmed()">확인</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addSymptomModal" tabindex="-1" role="dialog" aria-labelledby="addSymptomModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addSymptomModalLabel">증상 추가</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- 증상 추가 폼 -->
                            <form action="{{ route('admin.addsymptom') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="part_id" class="form-label">부위 선택</label>
                                    <select class="form-select" id="part_id" name="part_id" required>
                                        <option value="" disabled selected>부위를 선택하세요</option>
                                        @foreach ($partsData as $part)
                                            <option value="{{ $part->part_id }}">{{ $part->part_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="symptom_name" class="form-label">증상 이름</label>
                                    <input type="text" class="form-control" id="symptom_name" name="symptom_name" required>
                                </div>
                                <!-- 필요한 증상 추가 폼 요소들을 여기에 추가하세요 -->
                                <button type="submit" class="btn btn-primary">추가</button>
                            </form>
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
        <script>
function confirmDelete() {
    // 여기에 삭제 전 확인 작업을 수행할 로직 추가
    return true; // 확인되면 true 반환
}

function deleteConfirmed() {
    // 여기에 실제 삭제 작업을 수행하는 로직 추가
    if (confirmDelete()) {
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endsection
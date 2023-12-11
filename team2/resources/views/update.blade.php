@extends('layout.layout')

@section('title','Update')

@section('main')

<main>
    <!-- <p>이미지 경로: {{ asset('storage/' . $data->image_path) }}</p>

    @if ($data->image_path)
        <div>
            
            <img src="{{ asset('storage/' . $data->image_path) }}" alt="게시글 이미지">
        </div>
    @endif -->
	
	<div class="mb-3">
		<p>글번호</p>
        <p>{$data->u_id}</p>
	</div>
	<div class="mb-3">
        <p>제목</p>
        <p>{$data->u_title}</p>
	</div>
    <div class="mb-3">
        <p>내용</p>
        <p>{$data->u_content}</p>
	</div>
    <div class="mb-3">
        <p>작성일</p>
        <p>{$data->created_at}</p>
	</div>
    <div class=>
        <p>수정일</p>
        <p>{$data->updated_at}</p>
	</div>
			
	
		 
	
    <div class="card-footer">
    <form action="{{route('board.destroy',['board'=>$data->u_id])}}" method = "POST">
        @csrf
        @method('DELETE')
    <a class="btn_cancel" href="{{url()->previous()}}">취소</a>	
    <button type="submit" class="btn btn-danger">삭제</button>
    <a href="{{route('board.edit',['board'=>$data->u_id])}}" class=" btn btn-dark">수정</a>
    </form>
    </div>
    </main>

@endsection
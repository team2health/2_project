@extends('layout.layout')

@section('title','Insert')

@section('main')

<main class="last_main">
		
		<form method="POST"  action="" enctype="multipart/form-data">
			@include('layout.errorlayout')
			@csrf
            <label for="board">게시판 선택:</label>
				<select name="board" id="board">
					<option value="freelist">자유게시판</option>
					<option value="questionlist">질문 게시판</option>
                    <option value="amitylist">친목 게시판</option>
                    <option value="informationlist">정보 게시판</option>
				</select>
			
			
			<div class="">
			  <label for="u_title" class="form-label">제목</label>
			  <input type="text" class="form-control" id="u_title" name="u_title">			  
			</div>
			
            <div class="mb-3">
				<label for="u_content" class="form-label">내용</label>			  
				<textarea name="u_content" id="u_content" ></textarea>
			</div>
			
            <a class="a_cancel" href="{{url()->previous()}}">취소</a>
			
			<button type="submit" class="btn_complete">작성완료</button>
			<div class="form-group">
    			<label for="img"></label>
    			<input type="file" name="img" class="form-control-file">
			</div>
			
		  </form>
	</main>

@endsection
@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<div class="insert_hidden_container">
		<form class="detail_form" method="POST"  action="{{route('board.update',['board'=>$data->board_id])}}" enctype="multipart/form-data">
			@csrf
			@method('PUT')            
			<div class="insert_container">           
            <div class="insert_img">
			@foreach($data->images as $image)
            <div class="detail_board_content">
                <img src="/board_img/{{ $image->img_address }}" alt="Board Image">
            </div>    
            @endforeach  
			</div>
            

				<!-- <label for="board">카테고리:</label> -->
				<div class="insert_select_container">
					<select name="board" id="board" class="insert_select">
						
						<option value="1">자유게시판</option>
						<option value="2">정보 게시판</option>
						<option value="3">친목 게시판</option>
						<option value="4">질문 게시판</option>
					</select>
				</div>	
			
			
				<div class="insert_input_container">
				<label for="u_title" class="">제목</label><br>
				<input type="text" class="insert_input" id="u_title" name="u_title" value="{{ $data->board_title }}">			  
				</div>
				
				<div class="insert_textarea_container">
					<label for="u_content" >내용</label><br>			  
					<textarea name="u_content" id="u_content" class="insert_textarea" >		
					
					{{ $data->board_content }}
							
					</textarea>
				</div>
				
				<div class="insert_hashtag_container">
				<label for="hashtag" class="label_hashtag">#해시태그</label>
				<input type="text" class="insert_hashtag" id="hashtag" name="hashtag" value="디테일에서 가져온값">			  
				</div>
			</div>
			<div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button class="insert_btn">취소</button></a>		
				<button type="submit" class="insert_btn">수정완료</button>	
			</div>				
		</form>		
	</div>		
</main>

@endsection
<script src="/js/insert.js"></script>
@extends('layout.layout')

@section('title','Insert')

@section('main')

<main class="insert_main">
	<div class="insert_hidden_container">
		<form class="detail_form" method="POST"  action="{{route('board.store')}}" enctype="multipart/form-data" >
			@csrf
			{{-- @include('layout.errorlayout') --}}
			<div class="insert_container">
				<div class="insert_img">
					<label for="file0">
						<img id="preview0" src="{{ asset('img/plus.png') }}" alt="">
					</label>
					<input type="file" name="board_img[]" id="file0" style="display:none;" onchange="previewImage('file0', 'preview0')" accept="image/*" >
					<label for="file1">
						<img id="preview1" src="{{ asset('img/plus.png') }}" alt="">
					</label>
					<input type="file" name="board_img[]" id="file1" style="display:none;" onchange="previewImage('file1', 'preview1')" accept="image/*" >
					<label for="file2">
						<img id="preview2" src="{{ asset('img/plus.png') }}" alt="">
					</label>
					<input type="file" name="board_img[]" id="file2" style="display:none;" onchange="previewImage('file2', 'preview2')" accept="image/*" >
				</div>
				
				<div class="insert_select_container">
					<select name="category_id" id="category_id" class="insert_select">						
						<option value="1">자유게시판</option>
						<option value="2">정보 게시판</option>
						<option value="3">친목 게시판</option>
						<option value="4">질문 게시판</option>
					</select>
				</div>	
			
			
				<div class="insert_input_container">
					<label for="board_title" class="">제목</label><br>
					<input type="text" class="insert_input" id="board_title" name="board_title" required>			  
				</div>
				
				<div class="insert_textarea_container">
					<label for="board_content" >내용</label><br>			  
					<textarea name="board_content" id="board_content" class="insert_textarea" required ></textarea>
				</div>				
				<div class="insert_hashtag_container">
					<label for="hashtag" class="label_hashtag">#해시태그</label>
					<div class="insert_hashtag" id="hashtagContainer"></div>
					<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>

					<!-- Hidden container for hashtag data -->
					<div id="hiddenHashtags" style="display: none;">
						@foreach ($data as $item)
							<span class='tag' data-tag="{{ $item->hashtag_name }}">{{ $item->hashtag_name }}</span>
						@endforeach
					</div>

					<!-- Input for selected hashtags -->
					<input type="hidden" id="selectedHashtagsInput" name="hashtag" />
				</div>				
			</div>
			<div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button type="button" class="insert_btn">취소</button></a>			
				<button type="submit" class="insert_btn">작성완료</button>	
			</div>				
		</form>		
	</div>		
</main>
       
<script src="/js/insert.js"></script>
@endsection
@extends('layout.layout')

@section('title','Insert')

@section('main')

<main class="insert_main">	
		<form class="detail_form" method="POST"  action="{{route('board.store')}}" enctype="multipart/form-data" onsubmit="return validateForm()">
			@csrf
			<div id="myModal" class="modal">
				<div class="comment_modal_content">  
				@foreach ($categories as $category)
					<p class="category-item" data-category-id="{{ $category->category_name }}" onclick="toggleCategorySelection(this)">
						{{ $category->category_name }}
					</p>
				@endforeach		
					<!-- <a href="{{url()->previous()}}"> -->
						<span class="close" onclick="closeModal()">취소</span>
					</a>             
				</div>
    		</div>  
			<div class="insert_bottom_button">
				<a href="{{url()->previous()}}"><button type="button" class="insert_btn"><</button></a>
				<p>글쓰기</p>
				<button type="submit" class="insert_btn">작성완료</button>	
			</div>
			
			{{-- @include('layout.errorlayout') --}}
			<div class="insert_container">
				<!-- <div class="insert_img">
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
				</div> -->
				
				
				<div class="insert_select_container">
					<div class="insert_select" id="selectedCategoriesContainer" onclick="openModal()">게시판을 선택해주세요</div>
				</div>
				<input type="hidden" name="category_id" id="selectedCategoriesInput" />
				
			
			
				<div class="insert_input_container">
					<label for="board_title">
						<input type="text" class="insert_input" id="board_title" name="board_title" required placeholder="제목을 입력해 주세요">
					</label>
					<br>								  
				</div>
				
				<div class="insert_textarea_container">
					<label for="board_content" >
						<textarea name="board_content" id="board_content" class="insert_textarea" required  placeholder="내용을 입력해 주세요"></textarea>
					</label>
					<br>				
				</div>		
				<div class="insert_hashtag" id="hashtagContainer"></div>		
				<div class="insert_hashtag_container">
					<!-- <label for="hashtag" class="label_hashtag">#해시태그</label> -->
					
					<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>
					<label class="insert_img" for="file0">
						<img id="preview0" src="{{ asset('img/camera2.png') }}" alt="">사진
					</label>
					<input type="file" name="board_img[]" id="file0" style="display:none;" onchange="previewImage('file0', 'preview0')" accept="image/*">
					<!-- Hidden container for hashtag data -->
					
				</div>
				<div id="hiddenHashtags" style="display: none;">
						@foreach ($hashtags as $item)
							<span class='tag' data-tag="{{ $item->hashtag_name }}">{{ $item->hashtag_name }}</span>
						@endforeach
					</div>

					<!-- Input for selected hashtags -->
					<input type="hidden" id="selectedHashtagsInput" name="hashtag" />				
			</div>
			<!-- <div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button type="button" class="insert_btn">취소</button></a>			
				<button type="submit" class="insert_btn">작성완료</button>	
			</div>				 -->
		</form>		
			
</main>
       
<script src="/js/insert.js"></script>
@endsection
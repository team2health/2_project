@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<form class="detail_form" method="POST"  action="{{route('board.update',['board'=>$result->board_id])}}" enctype="multipart/form-data">
		@csrf
		@method('PUT')       
		<div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button type="button" class="insert_btn"><</button></a>	
			<p>글 수정</p>	
			<button type="submit" class="insert_btn">수정완료</button>	
		</div>	     
		<div class="insert_container">			
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
			<div class="insert_select_container" onclick="openModal()">			
				<div class="insert_select" id="selectedCategoriesContainer">{{ $result->category->category_name }}</div>
				<input type="hidden" name="category_id" id="selectedCategoriesInput" />	
			</div>		
			<div class="insert_input_container">
				<label for="u_title" class="">
				<input type="text" class="insert_input" id="u_title" name="u_title" value="{{ $result->board_title }}"></label>	<br>		  
			</div>		
			<div class="insert_textarea_container">
				<label for="u_content" >			  
				<textarea name="u_content" id="u_content" class="insert_textarea" >{{ $result->board_content }}</textarea></label><br>
			</div>	
			<div id="hashtagContainer" class="insert_hashtag" >
					@foreach ($result->hashtags as $hashtag)
						
						<span class='selected-tag' data-selected-tag="{{ $hashtag->hashtag_name }}">
							{{ $hashtag->hashtag_name }} 
							<button type="button" onclick="removeSelectedTag('{{ $hashtag->hashtag_name }}')">X</button>
						</span>
					@endforeach
					@foreach($result->images as $key => $image)
					<div class="detail_board_content">
						<img src="/board_img/{{ $image->img_address }}" alt="Board Image" id="preview{{ $key }}">
						<label for="file{{ $key }}">
							<button type="button" onclick="openFile('file{{ $key }}')">파일변경</button>
						</label>
						<input type="file" name="board_img[]" id="file{{ $key }}" style="display:none;" onchange="previewImage('file{{ $key }}', 'preview{{ $key }}')" accept="image/*">
						
					</div>
				@endforeach
				<div class="insert_img_div">
					<div id="imageContainer">
		<!-- 이미지를 추가할 부분 -->
					</div>
					<!-- <input type="hidden" id="selectedImagesInput" name="selected_images" /> -->
				</div>
			</div>

			<div class="insert_hashtag_container">
			
				<!-- <div class="label_hashtag">#해시태그</div> -->
				
				<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>
				
				<!-- Input for selected hashtags -->
				<input type="hidden" id="selectedHashtagsInput" name="hashtag" />
				<div class="insert_img" id="imageContainer">
						<input type="file" name="board_img[]" id="fileInput1" style="display:none;" onchange="handleFileSelect(event)" accept="image/*" multiple>
						<label for="fileInput1">
							<img id="addImageIcon" src="{{ asset('img/camera2.png') }}" alt="Add Image">사진
						</label>						
					</div>	
			</div>
			<div id="hiddenHashtags" style="display: none;">
				@foreach ($allHashtags as $hashtag)
					<span class='tag' data-tag="{{ $hashtag->hashtag_name }}" onclick="handleTagClick(this)">
						{{ $hashtag->hashtag_name }}
					</span>
				@endforeach
			</div>			
		</div>
		<!-- <div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button type="button" class="insert_btn">취소</button></a>		
			<button type="submit" class="insert_btn">수정완료</button>	
		</div>				 -->
	</form>			
</main>
<script src="/js/update.js"></script>

@endsection

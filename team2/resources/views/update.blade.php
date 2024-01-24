@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<form class="detail_form" method="POST"  action="{{route('board.update',['board'=>$result->board_id])}}" enctype="multipart/form-data" onsubmit="return validateForm()">
		@csrf
		@method('PUT')       
		<div class="insert_bottom_button">
			<a href="{{url()->previous()}}"><button type="button" class="insert_btn_cancle"><</button></a>	
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
				<textarea name="u_content" id="u_content" class="insert_textarea" >{!! $result->board_content !!}</textarea></label><br>
			</div>	
			
			<input type="hidden" name="imgUrl" id="inputHiddenImgUrl">
			@foreach($result->images as $image)
			
					<div class="detail_board_content">						
						<img class="detail_board_content_img" src="/board_img/{{ $image->img_address }}" alt="Board Image" id="preview{{$image->board_img_id }}">
						<label for="file{{ $image->board_img_id }}">
							<button type="button" onclick="openFile('file{{ $image->board_img_id }}','preview{{ $image->board_img_id }}')">파일변경</button>
						</label>
						<input type="file" name="selectFile[]" id="file{{ $image->board_img_id }}" style="display:none;" onchange="previewImage('file{{ $image->board_img_id }}', 'preview{{ $image->board_img_id }}')" accept="image/*">
						<button type="button" onclick="removeImage('{{ $image->board_img_id }}')">이미지 삭제</button>
						
					</div>
					
				@endforeach
				
				<div class="insert_img_div">					
					<div id='image_zone'></div>	
				</div>
			<div id="hashtagContainer" class="insert_hashtag" >
					@foreach ($result->hashtags as $hashtag)
						
					<button type="button" onclick="removeSelectedTag('{{ $hashtag->hashtag_name }}')">
						<span class='selected-tag' data-selected-tag="{{ $hashtag->hashtag_name }}">
							{{ $hashtag->hashtag_name }} X
						</span></button>
					@endforeach
					
			</div>

			<div class="insert_hashtag_container">
			
				<!-- <div class="label_hashtag">#해시태그</div> -->
				
				<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>
				
				<!-- Input for selected hashtags -->
				<input type="hidden" id="selectedHashtagsInput" name="hashtag"/>
				<input type="hidden" id="hashtagflg" name="hashtagflg">
				<div class="insert_img" id="imageContainer">
					<input class="update_img" type='file' name='selectFile[]' id='selectFile'style="display:none;" multiple='multiple' accept='image/*'>
					<label for="selectFile">
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
	<br><br><br><br>	
</main>
<script src="/js/update.js"></script>

@endsection

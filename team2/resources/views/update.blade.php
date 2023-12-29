@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<div class="insert_hidden_container">
		<form class="detail_form" method="POST"  action="{{route('board.update',['board'=>$result->board_id])}}" enctype="multipart/form-data">
			@csrf
			@method('PUT')            
			<div class="insert_container">           
				
	<div class="insert_img">
    @for ($i = 0; $i < 3; $i++)
        @php
            $imgId = 'preview' . $i;
            $fileId = 'file' . $i;
            $defaultImage = asset('img/plus.png');
            $previewImage = isset($result->images[$i]) ? asset('board_img/' . $result->images[$i]->img_address) : $defaultImage;
        @endphp

        <label for="{{ $fileId }}">
            <img id="{{ $imgId }}" src="{{ $previewImage }}" alt="">
			<input type="hidden" name="origin_board_img[]" value="{{ isset($result->images[$i]) ? $result->images[$i] : '' }}">
        </label>
        <input type="file" name="board_img[]" id="{{ $fileId }}" style="display:none;" onchange="previewImage('{{ $fileId }}', '{{ $imgId }}')" accept="image/*">
    @endfor
</div>
 	

				<div class="insert_select_container">
					<select name="board" id="board" class="insert_select" >
						{{-- <option value="{{ $result->category_id }}">{{ $result->category->category_name }}</option> --}}
						<option value="1" {{$result->category_id === 1 ? 'selected' : ''}}>자유게시판</option>
						<option value="2" {{$result->category_id === 2 ? 'selected' : ''}}>정보 게시판</option>
						<option value="3" {{$result->category_id === 3 ? 'selected' : ''}}>친목 게시판</option>
						<option value="4" {{$result->category_id === 4 ? 'selected' : ''}}>질문 게시판</option>
					</select>
				</div>		
				<div class="insert_input_container">
					<label for="u_title" class="">제목</label><br>
					<input type="text" class="insert_input" id="u_title" name="u_title" value="{{ $result->board_title }}">			  
				</div>		
				<div class="insert_textarea_container">
					<label for="u_content" >내용</label><br>			  
					<textarea name="u_content" id="u_content" class="insert_textarea" >{{ $result->board_content }}</textarea>
				</div>	
			<div class="insert_hashtag_container">
				<label for="hashtag" class="label_hashtag">#해시태그</label>
				<div id="hashtagContainer" class="insert_hashtag" onclick="toggleHashtags()">
					@foreach ($result->hashtags as $hashtag)
						
						<span class='selected-tag' data-selected-tag="{{ $hashtag->hashtag_name }}">
							{{ $hashtag->hashtag_name }} 
							<button type="button" onclick="removeSelectedTag('{{ $hashtag->hashtag_name }}')">x</button>
						</span>
					@endforeach
				</div>
				<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>
				<div id="hiddenHashtags" style="display: none;">
					@foreach ($allHashtags as $hashtag)
						<span class='tag' data-tag="{{ $hashtag->hashtag_name }}" onclick="handleTagClick(this)">
							{{ $hashtag->hashtag_name }}
						</span>
					@endforeach
				</div>
				<!-- Input for selected hashtags -->
				<input type="hidden" id="selectedHashtagsInput" name="hashtag" />
			</div>
			
	
				
			
			
	</div>
		<div class="insert_bottom_button">
		<a href="{{url()->previous()}}"><button type="button" class="insert_btn">취소</button></a>		
			<button type="submit" class="insert_btn">수정완료</button>	
		</div>				
	</form>			
</main>
<script src="/js/update.js"></script>
@endsection

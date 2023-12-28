@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<div class="insert_hidden_container">
		<form class="detail_form" method="POST"  action="{{route('board.update',['board'=>$result->board_id])}}" enctype="multipart/form-data">
			@csrf
			@method('PUT')            
			<div class="insert_container">           
				<!-- <div class="insert_img">
					{{-- @foreach($result->images as $key => $image) --}}
						<div class="detail_board_content">
							{{-- <img src="/board_img/{{ $image->img_address }}" alt="Board Image" id="preview{{ $key }}"> --}}
							{{-- <label for="file{{ $key }}"> --}}
								{{-- <button type="button" onclick="openFile('file{{ $key }}')">파일변경</button> --}}
							</label>
							{{-- <input type="file" name="board_img[]" id="file{{ $key }}" style="display:none;" onchange="previewImage('file{{ $key }}', 'preview{{ $key }}')" accept="image/*"> --}}
						</div>
					{{-- @endforeach --}}
				</div>	
				<div class="detail_board_content">
        
        <label for="file_new">
			{{-- <img id="preview_new" src="{{ asset('img/plus.png') }}" alt=""> --}}
        </label>
        <input type="file" name="board_img[new]" id="file_new" style="display:none;" onchange="previewImage('file_new', 'preview_new')" accept="image/*">
    </div> -->
	<!-- <div class="insert_img">
    @for ($i = 0; $i < 3; $i++)
        @php
            $imgId = 'preview' . $i;
            $fileId = 'file' . $i;
            $defaultImage = asset('img/plus.png');
            $previewImage = isset($result->images[$i]) ? asset('board_img/' . $result->images[$i]->img_address) : $defaultImage;
        @endphp

        <label for="{{ $fileId }}">
            <img id="{{ $imgId }}" src="{{ $previewImage }}" alt="">
			<input type="hidden" name="origin_board_img[]" value="{{ $result->images[$i] }}">
        </label>
        <input type="file" name="board_img[]" id="{{ $fileId }}" style="display:none;" onchange="previewImage('{{ $fileId }}', '{{ $imgId }}')" accept="image/*">
    @endfor
</div> -->
 	
<div class="insert_img">
    <label for="file0">
        <img id="preview0" src="{{ isset($result->images[0]) ? asset('board_img/' . $result->images[0]->img_address) : asset('img/plus.png') }}" alt="{{ isset($result->images[0]) ? 'Image 1' : 'Placeholder Image' }}">
    </label>
    <input type="file" name="board_img[]" id="file0" style="display:none;" onchange="previewImage('file0', 'preview0')" accept="image/*" >

    <label for="file1">
        <img id="preview1" src="{{ isset($result->images[1]) ? asset('board_img/' . $result->images[1]->img_address) : asset('img/plus.png') }}" alt="{{ isset($result->images[1]) ? 'Image 2' : 'Placeholder Image' }}">
    </label>
    <input type="file" name="board_img[]" id="file1" style="display:none;" onchange="previewImage('file1', 'preview1')" accept="image/*" >

    <label for="file2">
        <img id="preview2" src="{{ isset($result->images[2]) ? asset('board_img/' . $result->images[2]->img_address) : asset('img/plus.png') }}" alt="{{ isset($result->images[2]) ? 'Image 3' : 'Placeholder Image' }}">
    </label>
    <input type="file" name="board_img[]" id="file2" style="display:none;" onchange="previewImage('file2', 'preview2')" accept="image/*" >
</div>
				<div class="insert_select_container">
					<select name="board" id="board" class="insert_select">
					
						<option value="{{ $result->category_id }}">{{ $result->category->category_name }}</option>
					
						<option value="1">자유게시판</option>
						<option value="2">정보 게시판</option>
						<option value="3">친목 게시판</option>
						<option value="4">질문 게시판</option>
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
			
	
			<!-- <div class="insert_hashtag_container">
				<label for="hashtag" class="label_hashtag">#해시태그</label>
				<input class="insert_hashtag" id="hashtagContainer" value="{{ implode(',', $result->hashtags->pluck('hashtag_name')->toArray()) }}" readonly>
				<button type="button" id="toggleHashtagsBtn" onclick="toggleHashtags()">해시태그 펼치기/접기</button>
				<div id="hiddenHashtags" style="display: none;">
					@foreach ($allHashtags as $hashtag)
						<span class='tag' data-tag="{{ $hashtag->hashtag_name }}">							
							{{ $hashtag->hashtag_name }}
						</span>
					@endforeach
				</div>
				Input for selected hashtags
				<input type="hidden" id="selectedHashtagsInput" name="hashtag" />
			</div> -->
							
			
			
	</div>
		<div class="insert_bottom_button">
		<a href="{{url()->previous()}}"><button class="insert_btn">취소</button></a>		
			<button type="submit" class="insert_btn">수정완료</button>	
		</div>				
	</form>			
</main>
<script src="/js/update.js"></script>
@endsection

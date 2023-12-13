@extends('layout.layout')

@section('title','Update')

@section('main')

<main class="insert_main">
	<div class="insert_hidden_container">
		<form method="POST"  action="" enctype="multipart/form-data">
			@include('layout.errorlayout')
			@csrf
            
			<div class="insert_container">           
            
				<div class="insert_img">
					<label for="img1"><img src="../img/plus.png" alt=""></label>
					<input type="file" name="img1" id="img1" style="display:none;">
					<label for="img2"><img src="../img/camera2.png" alt=""></label>
					<input type="file" name="img2" id="img2" style="display:none;">
					<label for="img3"><img src="../img/camera2.png" alt=""></label>
					<input type="file" name="img3" id="img3" style="display:none;">
				</div>
            

				<!-- <label for="board">카테고리:</label> -->
				<div class="insert_select_container">
					<select name="board" id="board" class="insert_select">
						<option value="">카테고리</option>
						<option value="freelist">자유게시판</option>
						<option value="questionlist">질문 게시판</option>
						<option value="amitylist">친목 게시판</option>
						<option value="informationlist">정보 게시판</option>
					</select>
				</div>	
			
			
				<div class="insert_input_container">
				<label for="u_title" class="">제목</label><br>
				<input type="text" class="insert_input" id="u_title" name="u_title" value="디테일에서 가져온값">			  
				</div>
				
				<div class="insert_textarea_container">
					<label for="u_content" >내용</label><br>			  
					<textarea name="u_content" id="u_content" class="insert_textarea" >디테일에서 가져온값</textarea>
				</div>
				
				<div class="insert_hashtag_container">
				<label for="hashtag" class="label_hashtag">#해시태그</label>
				<input type="text" class="insert_hashtag" id="hashtag" name="hashtag" value="디테일에서 가져온값">			  
				</div>
			</div>
			<div class="insert_bottom_button">
				<button class="insert_btn"><a class="a_cancel" href="{{url()->previous()}}">취소</a></button>			
				<button type="submit" class="insert_btn">수정완료</button>	
			</div>				
		</form>		
	</div>		
</main>

@endsection
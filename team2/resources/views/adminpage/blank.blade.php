@extends('adminpage/adminlayout.layout')

@section('title','로그인은 왜있지?')

@section('main')

			<main class="content">
				<div class="container-fluid p-0" style="font-size:2rem;">
					메인영역입니다. 여기 넣으시면 돼요!
					<br>
					1. nav 영역에 route 링크 추가
					(추가할 때 아이콘도 넣어주기)
					<br>
					2. 삭제 버튼 빨간색 <br>
					<button class="admin-custom-btn custom-common-delete-btn">삭제</button>
					<br>
					3. 일반 버튼 (css 나중에 수정해도 되니까 일단 이거 복붙) <br>
					<button class="admin-custom-btn custom-common-btn">버튼이름</button>
				</div>
					
					
			</main>
@endsection
<header>
	<div class="header-community-container">
		<a class="cate_btn header-community-nav" onclick="toggleDropdown()">카테고리</a>
		<div class="dropdown-content" id="myDropdown">
			<form method="get" id="category_id_form">
				@csrf
					<div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
					<div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
					<div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
					<div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
			</form>
		</div>
		<a href="" class="header-community-nav">최신글</a>
		<a href="" class="header-community-nav">인기글</a>
		<a href="" class="header-community-nav">관심태그</a>
	</div>
</header>
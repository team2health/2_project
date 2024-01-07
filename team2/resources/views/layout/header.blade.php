<header>
	@if (request()->path() === 'board')
		<div class="header-community-container">
			<a class="cate_btn header-community-nav" onclick="toggleDropdown()" id="headerCategory">카테고리</a>
			<div class="dropdown-content" id="myDropdown">
				<form method="get" id="category_id_form">
					@csrf
						<div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
						<div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
						<div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
						<div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
				</form>
			</div>
			<a href="{{route('lastboard.get')}}" class="header-community-nav">최신글</a>
			<a href="{{route('hotboard.get')}}" class="header-community-nav">인기글</a>
			<a href="{{route('favoriteboard.get')}}" class="header-community-nav">관심태그</a>
		</div>
	@endif

	@if (Str::contains(request()->url(), 'login') || Str::contains(request()->url(), 'regist')
	|| Str::contains(request()->url(), 'mypage') || Str::contains(request()->url(), 'categoryboard')
	|| Str::contains(request()->url(), 'boardcategory') || Str::contains(request()->url(), 'lastboard')
	|| Str::contains(request()->url(), 'hotboard')	|| Str::contains(request()->url(), 'timeline')
	|| Str::contains(request()->url(), 'favoriteboard') || Str::contains(request()->url(), 'board/')
	|| Str::contains(request()->url(), 'hotboard') || Str::contains(request()->url(), 'firstchkpassword'))
	<div class="header-mobile">
		<div class="header-mobile-backBtn"> < </div>
		<div class="header-pageName" id="headerPageName"></div>
	</div>
	@endif
</header>
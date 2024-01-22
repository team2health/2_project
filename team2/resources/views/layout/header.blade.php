<header>
	@if ((request()->path() === 'login') || Str::contains(request()->url(), 'regist'))
	<div class="header-community-container1" id="headerMainDiv"><a href="/" class="header-main-go">main으로 이동</a></div>
	@else
	<div class="header-community-container" id="headerMainDiv">
		@if ((request()->path() === '/') || (request()->path() === 'timeline') || (request()->path() === 'firstchkpassword') || Str::contains(request()->url(), 'changpasswordchk') || (request()->path() === 'mypage'))
			<div class="header-community-container-mini2" id="headerThirdDiv">
		@endif
		@if ((request()->path() === 'lastboard') || (request()->path() === 'favoriteboard') || (request()->path() === 'hotboard')
		|| Str::contains(request()->url(), 'boardcategory') || Str::contains(request()->url(), 'board/') || (request()->path() === 'categoryboard') || Str::contains(request()->url(), 'detail'))
			<div class="header-community-container-mini3" id="headerThirdDiv">
		@endif
		@if ((request()->path() === 'board'))
			<div class="header-community-container-mini" id="headerThirdDiv">
		@endif
			<div class="header-community-box">
				@if ((request()->path() === '/'))
				@endif
				@if (!(request()->path() === '/') && !(request()->path() === 'board'))
					<a class="header-btn1" href="{{route('main.get')}}" id="searchHealth" class="pc-header-button-main">증상검색</a>
				@endif
				@if ((request()->path() === 'board'))
					<a class="header-btn2" href="{{route('main.get')}}" id="searchHealth" class="pc-header-button-main">증상검색</a>
				@endif
				@if ((request()->path() === 'board'))
					
				@else
					<a class="header-btn1" id="headerComunityHome" href="{{route('board.index')}}" class="header-community-nav">커뮤니티</a>
				@endif
					@if ((request()->path() === '/') || (request()->path() === 'timeline') || (request()->path() === 'firstchkpassword') || Str::contains(request()->url(), 'changpasswordchk') || (request()->path() === 'mypage'))
						
					@else
						<a class="header-btn1 cate_btn header-community-nav" onclick="toggleDropdown(); return false;" id="headerCategory">카테고리</a>
						<div class="dropdown-content" id="myDropdown">
							<form method="get" id="category_id_form">
								@csrf
									<div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
									<div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
									<div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
									<div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
							</form>
						</div>
						<a class="header-btn1" href="{{route('lastboard.get')}}" class="header-community-nav" id="headerLastBoard">최신글</a>
						<a class="header-btn1" href="{{route('hotboard.get')}}" class="header-community-nav" id="headerHotBoard">인기글</a>
						<a class="header-btn1" href="{{route('favoriteboard.get')}}" class="header-community-nav" id="headerFavoriteBoard">관심태그</a>
					@endif
			</div>
			@if (session('id'))
				<div class="header-timeline-mypage-box">
					<a class="header-mypage-timeline-box" href="{{route('todaytimeline.get')}}" class="pc-header-button-mypage">타임라인</a>
					<a  class="header-mypage-timeline-box" href="{{route('mypage.get')}}" class="pc-header-button-mypage">마이페이지</a>
				</div>
			@else
				<div class="header-timeline-mypage-box">
					<a  class="header-mypage-timeline-box" href="{{route('login.get')}}" class="pc-header-button-mypage">로그인</a>
				</div>
			@endif
		</div>

	</div>

	@endif
		
		@if (Str::contains(request()->url(), 'login') || Str::contains(request()->url(), 'regist')
		|| Str::contains(request()->url(), 'mypage') || Str::contains(request()->url(), 'categoryboard')
		|| Str::contains(request()->url(), 'boardcategory') || Str::contains(request()->url(), 'lastboard')
		|| Str::contains(request()->url(), 'hotboard')	|| Str::contains(request()->url(), 'timeline')
		|| Str::contains(request()->url(), 'favoriteboard') || Str::contains(request()->url(), 'board/')
		|| Str::contains(request()->url(), 'hotboard') || Str::contains(request()->url(), 'firstchkpassword') || Str::contains(request()->url(), 'changpasswordchk') || Str::contains(request()->url(), 'detail'))
		<div class="header-mobile">
			<div class="header-mobile-backBtn" onclick="goBack(); return false;"> < </div>
			<div class="header-pageName" id="headerPageName"></div>
		</div>
		@endif
</header>
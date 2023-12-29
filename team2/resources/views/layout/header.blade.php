@if (Str::contains(request()->url(), 'http://112.222.157.156:6002'))
<header>
	@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist')
	<div class="container">
		<div class="inmypageheader">
			<div style="color: rgb(182, 182, 182)" class="div-margin font-small">
				<div id="time-year"></div>
				<div id="time-day"></div>
			</div>
			<div style="color: rgb(182, 182, 182)" class="mypagegohome">
				<a href="{{route('main.get')}}">
				<span class="gohome header-margin-top">HOME</span>
				</a>
			</div>
		</div>
	@else
	<div class="mini-container">
	@endif
	@auth
		<div class="display-flex">
			@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist')
				<div class="div-display-lnlineBlock display-none">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@else
				<div class="div-display-lnlineBlock div-margin-auto">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@endif
			@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist')
				<div class="display-flex-center">
					<div style="margin-right: 10px" class="div-display-lnlineBlock"><img src="/user_img/{{ session('user_img') }}" alt="" class="btn-img b-radius"></div>
					<div class="div-display-lnlineBlock">
						<a href="/mypage"><span class="font-weight font-color">{{ session('user_name') }}</span>님 안녕하세요</a>
						@if (request()->url() !== 'http://112.222.157.156:6002/mypage')
							<a href="/mypage" class="display-flex font-small">
								{{-- {{dd(session('user_img'))}} --}}
								<span>welcome</span>
								<span class="font-color">마이페이지 이동</span>
							</a>
						@else
							<a href="{{ route('logout.get') }}" class="display-flex font-small">
								<span class="font-color logout-btn">로그아웃</span>
							</a>
						@endif
					</div>
				</div>
			@endif
		</div>
	@endauth
	@guest
		<div class="display-flex">
			@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist')
				<div class="div-display-lnlineBlock display-none">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@else
				<div class="div-display-lnlineBlock div-margin-auto">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@endif
			@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist')
				<div class="display-flex-center">
					<div style="margin-right: 10px" class="div-display-lnlineBlock"><img src="/img/default_f.png" alt="" class="btn-img b-radius"></div>
					<div class="div-display-lnlineBlock">
						<a href="{{ route('login.get') }}"><span class="font-weight font-color">로그인</span>을 해주세요.</a>
						@if (request()->url() !== 'http://112.222.157.156:6002/mypage')
							<a href="{{ route('login.get') }}" class="display-flex font-small">
								<span>welcome</span>
							</a>
						@else
							<a href="{{ route('logout.get') }}" class="display-flex font-small">
								<span class="font-color logout-btn">로그아웃</span>
							</a>
						@endif
					</div>
				</div>
			@endif
		</div>
	@endguest

		@if (request()->url() !== 'http://112.222.157.156:6002/login' && request()->url() !== 'http://112.222.157.156:6002/regist'
		&& request()->url() !== 'http://112.222.157.156:6002/mypage' && request()->url() !== 'http://112.222.157.156:6002/categoryboard'
		&& !Str::contains(request()->url(), 'boardcategory') && !Str::contains(request()->url(), 'board/') 
		&& request()->url() !== 'http://112.222.157.156:6002/hotboard' && request()->url() !== 'http://112.222.157.156:6002/lastboard' && request()->url() !== 'http://112.222.157.156:6002/favoriteboard'
		&& !Str::contains(request()->url(), '/detail/'))
			<div class="container-category display-flex-around div-padding">
				@if (request()->url() === 'http://112.222.157.156:6002')
					<a href="{{route('main.get')}}" class="div-display-lnlineBlock main-line-height page-select-font-color">증상 검색</a>
				@else
					<a href="{{route('main.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">증상 검색</a>
				@endif
				@if (request()->url() === 'http://112.222.157.156:6002/board')
					<a href="{{ route('board.index') }}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">커뮤니티</a>
				@else
					<a href="{{ route('board.index') }}" class="div-display-lnlineBlock main-line-height category_font_hover">커뮤니티</a>
				@endif
				@if (request()->url() === 'http://112.222.157.156:6002/timeline')
					<a href="{{ route('todaytimeline.get') }}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">타임라인</a>
				@else
					<a href="{{ route('todaytimeline.get') }}" class="div-display-lnlineBlock main-line-height category_font_hover">타임라인</a>
				@endif
			</div>
		@endif
		@if (request()->url() === 'http://112.222.157.156:6002/categoryboard' || Str::contains(request()->url(), 'board/') || Str::contains(request()->url(), 'boardcategory') ||
		request()->url() === 'http://112.222.157.156:6002/hotboard' || request()->url() === 'http://112.222.157.156:6002/lastboard' || request()->url() === 'http://112.222.157.156:6002/favoriteboard'
		|| Str::contains(request()->url(), '/detail/'))
			<div class="container-category display-flex-around div-padding">
				@if (request()->url() === 'http://112.222.157.156:6002/lastboard')
					<a href="{{route('lastboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">최근 게시글</a>
				@else
					<a href="{{route('lastboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">최근 게시글</a>
				@endif
				@if (request()->url() === 'http://112.222.157.156:6002/hotboard')
					<a href="{{route('hotboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">핫게시글</a>
				@else
					<a href="{{route('hotboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">핫게시글</a>
				@endif
				@if (request()->url() === 'http://112.222.157.156:6002/favoriteboard')
					<a href="{{route('favoriteboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">관심태그</a>
				@else
					<a href="{{route('favoriteboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">관심태그</a>
				@endif
				@if (Str::contains(request()->url(), 'boardcategory') || Str::contains(request()->url(), 'categoryboard'))
					<a class="div-display-lnlineBlock main-line-height cate_btn page-select-font-color" onclick="toggleDropdown()">카테고리</a>
				@else
					<a class="div-display-lnlineBlock main-line-height cate_btn" onclick="toggleDropdown()">카테고리</a>
				@endif
				<div class="dropdown">
					<div class="dropdown-content" id="myDropdown">
						<form method="get" id="category_id_form">
							@csrf
								<div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	</div>
</header>
@endif

@if (Str::contains(request()->url(), 'http://127.0.0.1:8000'))
<header>
	@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
	<div class="container">
		<div class="inmypageheader">
			<div style="color: rgb(182, 182, 182)" class="div-margin font-small">
				<div id="time-year"></div>
				<div id="time-day"></div>
			</div>
			<div style="color: rgb(182, 182, 182)" class="mypagegohome">
				<a href="{{route('main.get')}}">
				<span class="gohome header-margin-top">HOME</span>
				</a>
			</div>
		</div>
	@else
	<div class="mini-container">
	@endif
	@auth
		<div class="display-flex">
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="div-display-lnlineBlock display-none">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@else
				<div class="div-display-lnlineBlock div-margin-auto">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@endif
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="display-flex-center">
					<div style="margin-right: 10px" class="div-display-lnlineBlock"><img src="/user_img/{{ session('user_img') }}" alt="" class="btn-img b-radius"></div>
					<div class="div-display-lnlineBlock">
						<a href="/mypage"><span class="font-weight font-color">{{ session('user_name') }}</span>님 안녕하세요</a>
						@if (request()->url() !== 'http://127.0.0.1:8000/mypage')
							<a href="/mypage" class="display-flex font-small">
								{{-- {{dd(session('user_img'))}} --}}
								<span>welcome</span>
								<span class="font-color">마이페이지 이동</span>
							</a>
						@else
							<a href="{{ route('logout.get') }}" class="display-flex font-small">
								<span class="font-color logout-btn">로그아웃</span>
							</a>
						@endif
					</div>
				</div>
			@endif
		</div>
	@endauth
	@guest
		<div class="display-flex">
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="div-display-lnlineBlock display-none">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@else
				<div class="div-display-lnlineBlock div-margin-auto">
					<a href="{{route('main.get')}}" class="gohome">HOME</a>
				</div>
			@endif
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="display-flex-center">
					<div style="margin-right: 10px" class="div-display-lnlineBlock"><img src="/img/default_f.png" alt="" class="btn-img b-radius"></div>
					<div class="div-display-lnlineBlock">
						<a href="{{ route('login.get') }}"><span class="font-weight font-color">로그인</span>을 해주세요.</a>
						@if (request()->url() !== 'http://127.0.0.1:8000/mypage')
							<a href="{{ route('login.get') }}" class="display-flex font-small">
								<span>welcome</span>
							</a>
						@else
							<a href="{{ route('logout.get') }}" class="display-flex font-small">
								<span class="font-color logout-btn">로그아웃</span>
							</a>
						@endif
					</div>
				</div>
			@endif
		</div>
	@endguest

		@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist'
		&& request()->url() !== 'http://127.0.0.1:8000/mypage' && request()->url() !== 'http://127.0.0.1:8000/categoryboard'
		&& !Str::contains(request()->url(), 'boardcategory') && !Str::contains(request()->url(), 'board/') 
		&& request()->url() !== 'http://127.0.0.1:8000/hotboard' && request()->url() !== 'http://127.0.0.1:8000/lastboard' && request()->url() !== 'http://127.0.0.1:8000/favoriteboard'
		&& !Str::contains(request()->url(), '/detail/'))
			<div class="container-category display-flex-around div-padding">
				@if (request()->url() === 'http://127.0.0.1:8000')
					<a href="{{route('main.get')}}" class="div-display-lnlineBlock main-line-height page-select-font-color">증상 검색</a>
				@else
					<a href="{{route('main.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">증상 검색</a>
				@endif
				@if (request()->url() === 'http://127.0.0.1:8000/board')
					<a href="{{ route('board.index') }}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">커뮤니티</a>
				@else
					<a href="{{ route('board.index') }}" class="div-display-lnlineBlock main-line-height category_font_hover">커뮤니티</a>
				@endif
				@if (request()->url() === 'http://127.0.0.1:8000/timeline')
					<a href="{{ route('todaytimeline.get') }}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">타임라인</a>
				@else
					<a href="{{ route('todaytimeline.get') }}" class="div-display-lnlineBlock main-line-height category_font_hover">타임라인</a>
				@endif
			</div>
		@endif
		@if (request()->url() === 'http://127.0.0.1:8000/categoryboard' || Str::contains(request()->url(), 'board/') || Str::contains(request()->url(), 'boardcategory') ||
		request()->url() === 'http://127.0.0.1:8000/hotboard' || request()->url() === 'http://127.0.0.1:8000/lastboard' || request()->url() === 'http://127.0.0.1:8000/favoriteboard'
		|| Str::contains(request()->url(), '/detail/'))
			<div class="container-category display-flex-around div-padding">
				@if (request()->url() === 'http://127.0.0.1:8000/lastboard')
					<a href="{{route('lastboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">최근 게시글</a>
				@else
					<a href="{{route('lastboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">최근 게시글</a>
				@endif
				@if (request()->url() === 'http://127.0.0.1:8000/hotboard')
					<a href="{{route('hotboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">핫게시글</a>
				@else
					<a href="{{route('hotboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">핫게시글</a>
				@endif
				@if (request()->url() === 'http://127.0.0.1:8000/favoriteboard')
					<a href="{{route('favoriteboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover page-select-font-color">관심태그</a>
				@else
					<a href="{{route('favoriteboard.get')}}" class="div-display-lnlineBlock main-line-height category_font_hover">관심태그</a>
				@endif
				@if (Str::contains(request()->url(), 'boardcategory') || Str::contains(request()->url(), 'categoryboard'))
					<a class="div-display-lnlineBlock main-line-height cate_btn page-select-font-color" onclick="toggleDropdown()">카테고리</a>
				@else
					<a class="div-display-lnlineBlock main-line-height cate_btn" onclick="toggleDropdown()">카테고리</a>
				@endif
				<div class="dropdown">
					<div class="dropdown-content" id="myDropdown">
						<form method="get" id="category_id_form">
							@csrf
								<div class="board-mouse-cursor" onclick="showBoard(1); return false;">자유게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(2); return false;">정보게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(3); return false;">친목게시판</div>
								<div class="board-mouse-cursor" onclick="showBoard(4); return false;">질문게시판</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	</div>
</header>
@endif
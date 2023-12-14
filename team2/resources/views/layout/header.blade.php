<header>
	@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
	<div class="container">
		<div class="inmypageheader">
			<div style="color: rgb(182, 182, 182)" class="div-margin font-small">
				<div>2023.12.11</div>
				<div>월요일</div>
			</div>
			@if (request()->url() == 'http://127.0.0.1:8000/mypage')
			<div style="color: rgb(182, 182, 182)" class="mypagegohome">
				<a href="{{route('main')}}">메인으로</a>
			</div>
			@endif
		</div>
	@else
	<div class="mini-container">
	@endif
		<div class="display-flex">
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="div-display-lnlineBlock display-none">
					<a href="/">
						<img src="../img/d.jpg" alt="" class="btn-img">
					</a>
				</div>
			@else
				<div class="div-display-lnlineBlock div-margin-auto">
					<a href="/">
						<img src="../img/d.jpg" alt="" class="img-width">
					</a>
				</div>
			@endif
			@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist')
				<div class="display-flex-center">
					<div style="margin-right: 10px" class="div-display-lnlineBlock"><img src="../img/default_f.png" alt="" class="btn-img b-radius"></div>
					<div class="div-display-lnlineBlock">
						<a href="/mypage"><span class="font-weight font-color">동글이</span>님 안녕하세요</a>
						<a href="/mypage" class="display-flex font-small">
							<span>welcome</span>
							<span class="font-color">마이페이지 이동</span>
						</a>
					</div>
				</div>
			@endif
		</div>

		@if (request()->url() !== 'http://127.0.0.1:8000/login' && request()->url() !== 'http://127.0.0.1:8000/regist'
		&& request()->url() !== 'http://127.0.0.1:8000/mypage')
			<div class="container-category display-flex-around div-padding">
				<a href="/" class="div-display-lnlineBlock">증상 검색</a>
				<a href="/" class="div-display-lnlineBlock">커뮤니티</a>
				<a href="{{ route('timeline') }}" class="div-display-lnlineBlock">타임라인</a>
			</div>
		@endif
	</div>
</header>
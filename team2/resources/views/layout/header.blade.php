<header>
	<div class="container">
		<div class="div-margin">
			<div>2023.12.11</div>
			<div>월요일</div>
		</div>

		<div class="display-flex">
			<div class="div-display-lnlineBlock display-none">
				<button type="submit">
					<img src="../img/d.jpg" alt="" class="btn-img">
				</button>
			</div>
			@if (request()->url() !== 'http://localhost:8000/login')
				<div class="display-flex-center">
					<div class="div-display-lnlineBlock"><img src="../img/f-img.png" alt="" class="btn-img"></div>
					<div class="div-display-lnlineBlock">
						<div><span class="font-weight font-color">동글이</span>님 안녕하세요</div>
						<a href="/" class="display-flex font-small">
							<span>welcome</span>
							<span class="font-color">마이페이지 이동</span>
						</a>
					</div>
				</div>
			@endif
		</div>

		@if (request()->url() !== 'http://localhost:8000/login')
			<div class="container-category display-flex-around div-padding">
				<a href="/" class="div-display-lnlineBlock">증상 검색</a>
				<a href="/" class="div-display-lnlineBlock">커뮤니티</a>
				<a href="/" class="div-display-lnlineBlock">타임라인</a>
			</div>
		@endif
	</div>
</header>
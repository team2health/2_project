<footer>
	{{-- <div class="footer">
		ⓒ 2023. team2 Co. all rights reserved.
	</div> --}}
	@if (!Str::contains(request()->url(), 'login') && !Str::contains(request()->url(), 'regist') && !Str::contains(request()->url(), 'categoryboard')
	&& !Str::contains(request()->url(), 'boardcategory') && !Str::contains(request()->url(), 'board/') 
	&& !Str::contains(request()->url(), 'hotboard') && !Str::contains(request()->url(), 'lastboard') && !Str::contains(request()->url(), 'favoriteboard')
	&& !Str::contains(request()->url(), '/detail/'))
		<div class="footer-container">
			<div class="footer-icon-div">
				<a href="{{route('main.get')}}"><img class="footer-icon" src="/img/main.png" alt=""></a>
			</div>
			<div class="footer-icon-div">
				<a href="{{route('board.index')}}"><img class="footer-icon" src="/img/community.png" alt=""></a>
			</div>
			<div class="footer-icon-div">
				<a href="{{route('todaytimeline.get')}}"><img class="footer-icon" src="/img/home.png" alt=""></a>
			</div>
			<div class="footer-icon-div">
				<a href="{{route('mypage.get')}}"><img class="footer-icon" src="/img/mypage.png" alt=""></a>
			</div>
		</div>
	@endif
</footer>
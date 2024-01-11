<footer>
		<div class="footer-container">
			@if ((request()->path() === '/'))
				<div class="footer-icon-div">
					<a href="{{route('main.get')}}"><img class="footer-icon" src="/img/main.png" alt=""></a>
				</div>
			@else
				<div class="footer-icon-div footer-icon-div-opacity">
					<a href="{{route('main.get')}}"><img class="footer-icon" src="/img/main.png" alt=""></a>
				</div>
			@endif
			@if ((request()->path() === 'board'))
				<div class="footer-icon-div">
					<a href="{{route('board.index')}}"><img class="footer-icon" src="/img/community.png" alt=""></a>
				</div>
			@else
				<div class="footer-icon-div footer-icon-div-opacity">
					<a href="{{route('board.index')}}"><img class="footer-icon" src="/img/community.png" alt=""></a>
				</div>
			@endif
			@if ((request()->path() === 'timeline'))
				<div class="footer-icon-div">
					<a href="{{route('todaytimeline.get')}}"><img class="footer-icon" src="/img/timeline.png" alt=""></a>
				</div>
			@else
				<div class="footer-icon-div footer-icon-div-opacity">
					<a href="{{route('todaytimeline.get')}}"><img class="footer-icon" src="/img/timeline.png" alt=""></a>
				</div>
			@endif
			@if ((request()->path() === 'mypage'))
				<div class="footer-icon-div">
					<a href="{{route('mypage.get')}}"><img class="footer-icon" src="/img/mypage.png" alt=""></a>
				</div>
			@else
				<div class="footer-icon-div footer-icon-div-opacity">
					<a href="{{route('mypage.get')}}"><img class="footer-icon" src="/img/mypage.png" alt=""></a>
				</div>
			@endif
		</div>
</footer>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/mypage.css">
	<link rel="stylesheet" href="/css/board.css">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', 'main')</title>
</head>
<body>
	@include('layout.header')
    @yield('main')
	
	<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script src="/js/main.js"></script>
	<script src="/js/board.js"></script>
</body>
</html>
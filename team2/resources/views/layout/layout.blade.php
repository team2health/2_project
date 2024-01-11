<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/css/main.css">
	<link rel="stylesheet" href="/css/mypage.css">
	<link rel="stylesheet" href="/css/board.css">
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/timeline.css">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title', 'main')</title>
</head>
<body>
	@include('layout.header')
	@yield('main')
	@include('layout.section')
	@include('layout.footer')
	
	<script src="/js/common.js"></script>
</body>
</html>
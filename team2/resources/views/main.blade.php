@extends('layout.layout')

@section('title', 'main')

@section('main')
	<div class="container" id="part-display">
		<br>
		<div style="color: #2C2B71" class="text-center bc-purple">
			<br><br>
			<div><span class="text-part">#부위</span>를 선택해 주세요</div>
			<br><br>
			<div class="part-box">
				<div onclick="partCheck(0); return false;">머리</div>
				<div onclick="partCheck(1); return false;">눈</div>
				<div onclick="partCheck(2); return false;">코</div>
				<div onclick="partCheck(3); return false;">입</div>
				<div onclick="partCheck(4); return false;">목</div>
				<div onclick="partCheck(5); return false;">어깨</div>
				<div onclick="partCheck(6); return false;">팔</div>
				<div onclick="partCheck(7); return false;">손</div>
				<div onclick="partCheck(8); return false;">다리</div>
				<div onclick="partCheck(9); return false;">발</div>
			</div>
			<br><br>
		</div>
	</div>
	<div class="container" id="symptom-display">
		<br>
		<div style="color: #2C2B71" class="text-center bc-purple">
			<br><br>
			<div><span class="text-part">#증상</span>을 선택해 주세요</div>
			<br><br>
			<div class="part-box">
				<div onclick="symptomCheck(0); return false;">아포</div>
				<div onclick="symptomCheck(1); return false;">아파이브</div>
				<div onclick="symptomCheck(2); return false;">아식스</div>
				<div onclick="symptomCheck(3); return false;">아세븐</div>
			</div>
			<br><br>
		</div>
	</div>
	<div class="container" id="disease-display">
		<br>
		<div style="background-color: #F9F5F0" class="text-center">
			<br><br>
			<div>꾀병이오</div>
			<br><br>
			<div id="map-display"><img style="width: 400px" src="../img/a.jpg" alt=""></div>
			<div class="display-flex">
				<a href="/" class="check-button">다시 검사</a>
				<span class="check-button" onclick="mapDisplay(); return false;">병원 찾기</span>
			</div>
		</div>
	</div>
@endsection
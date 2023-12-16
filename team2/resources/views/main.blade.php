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
				@forelse ($part as $item)
				<div onclick="partCheck({{$item->part_id}}); return false;">{{$item->part_name}}</div>
				@empty
					
				@endforelse
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
				@forelse ($symptom as $item)
				<div onclick="symptomCheck({{$item->symptom_id}}); return false;">{{$item->part_id}}</div>
				@empty
					
				@endforelse
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
				<a href="{{route('main.get')}}" class="check-button">다시 검사</a>
				<span class="check-button" onclick="mapDisplay(); return false;">병원 찾기</span>
			</div>
		</div>
	</div>
	<script src="../js/main.js"></script>
@endsection
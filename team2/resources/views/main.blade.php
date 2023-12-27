@extends('layout.layout')

@section('title', 'main')

@section('main')
<main class="wrapper">
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
					<div>추가 될 예정입니다. 기다려주세용</div>
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
			<div class="part-box" id="symptom-box">
				{{-- @forelse ($symptom as $item)
				<div onclick="symptomCheck({{$item->symptom_id}}); return false;">{{$item->symptom_id}}</div>
				@empty
					
				@endforelse --}}
			</div>
			<br><br>
		</div>
	</div>
	<div class="container" id="disease-display">
		<br>
		<div style="background-color: #F9F5F0" class="text-center">
			<br><br>
			<div id="diesase-name"></div>
			<br><br>
			<div style="font-weight: 500" id="diesase-info"></div>
			<br><br>
			<div id="map-display"><div id="map" style="width:100%; height:350px;"></div></div>
			<div class="display-flex-hospital">
				<a href="{{route('main.get')}}" class="check-button">다시 검사</a>
				@if (session('id'))
				<span id="hospital" class="check-button">병원 찾기</span>
				@else
					
				@endif
				{{-- onclick="mapDisplay({{ json_encode(session('id')) }}); return false;" --}}
			</div>
		</div>
	</div>
</main>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6b402b118a5747fb73298eeccdc8b838&libraries=services"></script>
	<script src="../js/main.js"></script>
@endsection
@extends('layout.layout')

@section('title', 'main')

@section('main')
<main class="wrapper">
	<div class="container" id="part-display">
		<div style="color: #2C2B71" class="text-center bc-purple">
			<br>
			<div><span class="text-part">#부위</span>를 선택해 주세요</div>
			<br>
			<div class="part-box">
				<img class="partchk-body" src="/img/body.png" usemap="#partchk" alt="사람이미지">
				<map name="partchk">
					<area onmouseover="on_mouse(1)" onmouseout="off_mouse(1)" shape="poly" coords="153,16,131,26,121,44,127,61,129,79,138,91,142,105,144,113,165,116,172,106,175,89,182,76,187,57,187,40,179,26,165,15,152,17" href=""/>
					<area onmouseover="on_mouse(2)" onmouseout="off_mouse(2)" shape="poly" coords="90,144,67,152,56,180,59,201,60,210,51,248,51,271,45,288,44,310,39,337,39,362,35,379,22,396,20,410,49,419,51,411,48,384,51,367,66,330,72,299,73,264,82,245,93,215,96,144,91,143" href=""/>
					<area onmouseover="on_mouse(2)" onmouseout="off_mouse(2)" shape="poly" coords="223,136,246,152,256,178,254,195,258,212,264,236,266,260,266,277,272,293,276,335,277,367,290,386,293,404,272,419,266,418,263,391,264,369,256,348,248,316,243,292,240,263,230,234,225,226,218,146,219,136" href=""/>
					<area onmouseover="on_mouse(3)" onmouseout="off_mouse(3)" shape="poly"coords="109,136,140,118,187,123,210,140,216,174,219,213,206,239,184,241,150,241,123,238,104,234,96,223,94,197,96,181,99,155,107,137,112,134" href=""/>
					<area onmouseover="on_mouse(4)" onmouseout="off_mouse(4)" shape="poly" coords="100,247,104,278,103,295,109,324,103,338,146,345,176,345,209,344,219,339,219,322,214,312,217,297,218,257,218,247,171,244,124,244,100,247" href=""/>
					<area onmouseover="on_mouse(5)" onmouseout="off_mouse(5)" shape="poly" coords="101,353,95,383,95,405,114,417,158,430,193,425,230,415,229,397,225,361,221,353,159,352,102,351,102,351" href=""/>
					<area onmouseover="on_mouse(6)" onmouseout="off_mouse(6)" shape="poly" coords="89,436,88,460,90,481,95,497,108,502,128,502,136,493,141,477,144,460,148,446,151,435,145,427,135,419,121,413,101,407,95,407,89,416,89,428,89,434" href=""/>
					<area onmouseover="on_mouse(6)" onmouseout="off_mouse(6)" shape="poly" coords="168,435,181,424,192,417,207,411,222,408,230,410,234,427,236,452,234,472,232,494,229,501,218,503,201,503,190,506,187,502,184,492,180,481,173,464,170,443,168,435" href=""/>
					<area onmouseover="on_mouse(7)" onmouseout="off_mouse(7)" shape="poly" coords="96,512,92,529,94,552,88,563,85,590,83,611,83,632,84,653,86,675,87,694,85,706,77,717,70,727,64,734,58,741,51,751,51,759,57,765,62,765,70,760,76,754,80,750,84,744,86,741,94,738,99,734,104,727,105,719,105,707,104,701,103,693,105,675,108,662,107,649,109,634,119,619,124,610,126,600,126,588,124,575,123,560,122,549,125,542,127,531,127,520,126,512,105,510,95,510,96,513" href=""/>
					<area onmouseover="on_mouse(7)" onmouseout="off_mouse(7)" shape="poly" coords="195,521,205,517,216,514,227,513,230,517,234,530,234,542,234,551,237,562,239,570,240,581,241,590,242,600,242,607,242,617,242,624,242,631,243,635,243,641,244,648,243,658,242,671,242,687,242,695,242,703,250,713,261,728,268,738,278,754,282,765,270,768,257,765,247,758,238,741,227,736,220,727,220,710,221,700,218,677,215,656,212,642,207,627,203,619,200,610,197,595,198,575,200,562,201,551,196,545,194,528,193,522" href=""/>
				</map>
				<img id="partchk-head" class="partchk-head" src="/img/head.png" alt="">
				<img id="partchk-left-arm" class="partchk-left-arm" src="/img/arm.png" alt="">
				<img id="partchk-right-arm" class="partchk-right-arm" src="/img/arm2.png" alt="">
				<img id="partchk-front" class="partchk-front" src="/img/front.png" alt="">
				<img id="partchk-stomach" class="partchk-stomach" src="/img/stomach.png" alt="">
				<img id="partchk-pan" class="partchk-pan" src="/img/pan.png" alt="">
				<img id="partchk-left-leg" class="partchk-left-leg" src="/img/leg.png" alt="">
				<img id="partchk-right-leg" class="partchk-right-leg" src="/img/leg2.png" alt="">
				<img id="partchk-left-leg2" class="partchk-left-leg2" src="/img/leg3.png" alt="">
				<img id="partchk-right-leg2" class="partchk-right-leg2" src="/img/leg4.png" alt="">
			</div>
			<div class="main-body-button">
				<div class="main-body-front-back-btn">정면</div>
				<div class="main-body-front-back">후면</div>
			</div>
			<br>
		</div>
	</div>
	{{-- <div class="container" id="symptom-display">
		<br>
		<div style="color: #2C2B71" class="text-center bc-purple">
			<br><br>
			<div><span class="text-part">#증상</span>을 선택해 주세요</div>
			<br><br>
			<div class="part-box" id="symptom-box">
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
			</div>
		</div>
	</div> --}}
</main>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6b402b118a5747fb73298eeccdc8b838&libraries=services"></script>
	<script src="../js/main.js"></script>
@endsection
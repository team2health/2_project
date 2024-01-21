@extends('layout.layout')

@section('title', 'main')

@section('main')
<main class="wrapper">
	<div class="container" id="part-display">
		<div style="color: #2C2B71" class="text-center bc-purple" id="partChkContainer">
			<input type="hidden" id="main-user_id" value="{{ session('id') }}">
			<br>
			<div><span class="text-part" id="partSelect">#부위</span>을/를 선택해 주세요</div>
			<br>
			<div class="part-box" id="body-part-chk">
				<img class="partchk-body" src="/img/body.png" usemap="#partchk" alt="">
				<map name="partchk">
					<area onmouseover="on_mouse(1); return false;" onmouseout="off_mouse(1); return false;" onclick="partclick(1); return false;" shape="poly" coords="153,16,131,26,121,44,127,61,129,79,138,91,142,105,144,113,165,116,172,106,175,89,182,76,187,57,187,40,179,26,165,15,152,17" href=""/>
					<area onmouseover="on_mouse(2); return false;" onmouseout="off_mouse(2); return false;" onclick="partclick(2); return false;" shape="poly" coords="90,144,67,152,56,180,59,201,60,210,51,248,51,271,45,288,44,310,39,337,39,362,35,379,22,396,20,410,49,419,51,411,48,384,51,367,66,330,72,299,73,264,82,245,93,215,96,144,91,143" href=""/>
					<area onmouseover="on_mouse(2); return false;" onmouseout="off_mouse(2); return false;" onclick="partclick(2); return false;" shape="poly" coords="223,136,246,152,256,178,254,195,258,212,264,236,266,260,266,277,272,293,276,335,277,367,290,386,293,404,272,419,266,418,263,391,264,369,256,348,248,316,243,292,240,263,230,234,225,226,218,146,219,136" href=""/>
					<area onmouseover="on_mouse(3); return false;" onmouseout="off_mouse(3); return false;" onclick="partclick(3); return false;" shape="poly"coords="109,136,140,118,187,123,210,140,216,174,219,213,206,239,184,241,150,241,123,238,104,234,96,223,94,197,96,181,99,155,107,137,112,134" href=""/>
					<area onclick="partSelect(12); return false;" onmouseover="on_mouse(4); return false;" onmouseout="off_mouse(4); return false;" shape="poly" coords="100,247,104,278,103,295,109,324,103,338,146,345,176,345,209,344,219,339,219,322,214,312,217,297,218,257,218,247,171,244,124,244,100,247" href=""/>
					<area onmouseover="on_mouse(5); return false;" onmouseout="off_mouse(5); return false;" onclick="partclick(4); return false;" shape="poly" coords="101,353,95,383,95,405,114,417,158,430,193,425,230,415,229,397,225,361,221,353,159,352,102,351,102,351" href=""/>
					<area onclick="partSelect(15); return false;" onmouseover="on_mouse(6); return false;" onmouseout="off_mouse(6); return false;" shape="poly" coords="89,436,88,460,90,481,95,497,108,502,128,502,136,493,141,477,144,460,148,446,151,435,145,427,135,419,121,413,101,407,95,407,89,416,89,428,89,434" href=""/>
					<area onclick="partSelect(15); return false;" onmouseover="on_mouse(6); return false;" onmouseout="off_mouse(6); return false;" shape="poly" coords="168,435,181,424,192,417,207,411,222,408,230,410,234,427,236,452,234,472,232,494,229,501,218,503,201,503,190,506,187,502,184,492,180,481,173,464,170,443,168,435" href=""/>
					<area onmouseover="on_mouse(7); return false;" onmouseout="off_mouse(7); return false;" onclick="partclick(5); return false;" shape="poly" coords="96,512,92,529,94,552,88,563,85,590,83,611,83,632,84,653,86,675,87,694,85,706,77,717,70,727,64,734,58,741,51,751,51,759,57,765,62,765,70,760,76,754,80,750,84,744,86,741,94,738,99,734,104,727,105,719,105,707,104,701,103,693,105,675,108,662,107,649,109,634,119,619,124,610,126,600,126,588,124,575,123,560,122,549,125,542,127,531,127,520,126,512,105,510,95,510,96,513" href=""/>
					<area onmouseover="on_mouse(7); return false;" onmouseout="off_mouse(7); return false;" onclick="partclick(5); return false;" shape="poly" coords="195,521,205,517,216,514,227,513,230,517,234,530,234,542,234,551,237,562,239,570,240,581,241,590,242,600,242,607,242,617,242,624,242,631,243,635,243,641,244,648,243,658,242,671,242,687,242,695,242,703,250,713,261,728,268,738,278,754,282,765,270,768,257,765,247,758,238,741,227,736,220,727,220,710,221,700,218,677,215,656,212,642,207,627,203,619,200,610,197,595,198,575,200,562,201,551,196,545,194,528,193,522" href=""/>
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

			<div class="head-part-box" id="head-part-chk">
				<img class="head-detail" src="/img/head-detail.png" usemap="#headpartchk" alt="">
				<map name="headpartchk">
					<area onclick="partSelect(1); return false;" onmouseover="on_mouse_head(1); return false;" onmouseout="off_mouse_head(1); return false;" shape="poly" coords="170,44,151,44,129,49,107,63,92,76,82,87,75,97,70,106,70,120,80,128,95,142,112,151,132,161,152,163,178,167,201,162,228,154,247,145,268,135,276,122,274,108,265,90,253,73,237,58,212,46,184,43,169,44,169,44" href=""/>
					<area onclick="partSelect(2); return false;" onmouseover="on_mouse_head(2); return false;" onmouseout="off_mouse_head(2); return false;" shape="poly" coords="143,181,132,172,123,163,109,160,89,160,76,168,76,181,78,192,83,199,90,205,103,207,114,206,129,205,142,204,145,196,145,186,145,182" href=""/>
					<area onclick="partSelect(2); return false;" onmouseover="on_mouse_head(2); return false;" onmouseout="off_mouse_head(2); return false;" shape="poly" coords="243,164,234,161,221,159,215,162,207,164,197,174,198,186,205,197,222,203,233,204,250,201,263,197,268,189,268,175,264,166,254,161,242,161,239,162" href=""/>
					<area onclick="partSelect(3); return false;" onmouseover="on_mouse_head(3); return false;" onmouseout="off_mouse_head(3); return false;" shape="poly" coords="171,172,162,173,153,184,150,199,150,218,150,238,157,248,177,250,186,247,197,238,198,222,194,203,193,188,186,178,175,173,174,173" href=""/>
					<area onclick="partSelect(4); return false;" onmouseover="on_mouse_head(4); return false;" onmouseout="off_mouse_head(4); return false;" shape="poly" coords="111,257,112,283,116,300,133,304,161,311,186,312,207,309,226,298,236,288,239,267,237,254,215,252,196,257,182,260,162,260,145,253,122,250,114,252,112,258" href=""/>
					<area onclick="partSelect(5); return false;" onmouseover="on_mouse_head(5); return false;" onmouseout="off_mouse_head(5); return false;" shape="poly" coords="171,315,153,314,135,318,115,323,109,334,107,348,114,361,126,368,139,369,156,369,176,369,222,368,231,360,242,348,242,333,230,321,205,315,174,314,171,314" href=""/>
				</map>

				<img id="partchk-head-brain" class="partchk-head-brain" src="/img/brain.png" alt="">
				<img id="partchk-head-eye" class="partchk-head-eye" src="/img/eye.png" alt="">
				<img id="partchk-head-eye2" class="partchk-head-eye2" src="/img/eye2.png" alt="">
				<img id="partchk-head-nose" class="partchk-head-nose" src="/img/nose.png" alt="">
				<img id="partchk-head-mouse" class="partchk-head-mouse" src="/img/mouse.png" alt="">
				<img id="partchk-head-neck" class="partchk-head-neck" src="/img/neck.png" alt="">
			</div>

			<div class="arm-part-box" id="arm-part-chk">
				<img class="arm-detail" src="/img/arm-detail.png" usemap="#armpartchk" alt="">
				<map name="armpartchk">
					<area onclick="partSelect(6); return false;" onmouseover="on_mouse_arm(1); return false;" onmouseout="off_mouse_arm(1); return false;" shape="poly" coords="142,28,127,39,110,55,97,74,93,96,93,108,95,121,114,136,137,154,144,159,143,30" href=""/>
					<area onclick="partSelect(7); return false;" onmouseover="on_mouse_arm(2); return false;" onmouseout="off_mouse_arm(2); return false;" shape="poly" coords="141,179,139,169,130,161,115,151,99,141,91,141,85,161,79,188,75,213,75,232,77,243,71,259,65,283,63,309,62,329,105,342,113,315,123,285,120,247,132,222,141,180" href=""/>
					<area onclick="partSelect(8); return false;" onmouseover="on_mouse_arm(3); return false;" onmouseout="off_mouse_arm(3); return false;" shape="poly" coords="60,389,59,401,62,409,75,413,86,405,89,391,99,371,99,360,89,354,75,350,61,350,59,363,60,387" href=""/>
					<area onclick="partSelect(9); return false;" onmouseover="on_mouse_arm(4); return false;" onmouseout="off_mouse_arm(4); return false;" shape="poly" coords="48,414,37,426,29,458,42,467,78,488,88,472,88,428,70,416,49,413" href=""/>
				</map>

				<img id="partchk-arm-shoulder" class="partchk-arm-shoulder" src="/img/shoulder.png" alt="">
				<img id="partchk-arm-arm" class="partchk-arm-arm" src="/img/arm3.png" alt="">
				<img id="partchk-arm-wrist" class="partchk-arm-wrist" src="/img/wrist.png" alt="">
				<img id="partchk-arm-hand" class="partchk-arm-hand" src="/img/hand.png" alt="">
			</div>

			<div class="front-part-box" id="front-part-chk">
				<img class="front-detail" src="/img/front-detail.png" usemap="#frontpartchk" alt="">
				<map name="frontpartchk">
					<area onclick="partSelect(11); return false;" onmouseover="on_mouse_front(1); return false;" onmouseout="off_mouse_front(1); return false;" shape="poly" coords="241,94,232,97,214,104,207,112,205,128,205,142,209,157,219,170,238,186,256,194,279,197,292,187,292,157,288,126,271,103,244,94,243,94" href=""/>
					<area onclick="partSelect(10); return false;" onmouseover="on_mouse_front(2); return false;" onmouseout="off_mouse_front(2); return false;" shape="poly" coords="161,61,148,64,134,73,124,84,114,96,108,105,103,122,98,137,94,152,92,170,90,183,90,196,90,207,91,213,93,225,95,235,97,242,100,250,106,259,116,263,131,263,142,258,157,249,171,240,180,232,190,223,196,213,197,201,195,192,191,181,187,173,188,160,187,137,184,121,182,100,182,87,182,69,177,60,164,59" href=""/>
				</map>

				<img id="partchk-front-heart" class="partchk-front-heart" src="/img/heart.png" alt="">
				<img id="partchk-front-lung" class="partchk-front-lung" src="/img/lung.png" alt="">
			</div>

			<div class="pan-part-box" id="pan-part-chk">
				<img class="pan-detail" src="/img/pan-detail.png" usemap="#panpartchk" alt="">
				<map name="panpartchk">
					<area onclick="partSelect(13); return false;" onmouseover="on_mouse_pan(1); return false;" onmouseout="off_mouse_pan(1); return false;" shape="poly" coords="85,27,79,59,80,84,95,98,136,111,167,114,171,96,149,80,129,48,109,29,84,20,84,26" href=""/>
					<area onclick="partSelect(13); return false;" onmouseover="on_mouse_pan(1); return false;" onmouseout="off_mouse_pan(1); return false;" shape="poly" coords="185,109,190,115,199,114,216,109,226,108,240,103,258,96,268,89,273,82,276,73,274,59,271,44,268,31,268,13,265,8,259,6,248,13,240,23,234,33,231,43,224,59,220,70,202,83,184,100,185,109" href=""/>
					<area onclick="partSelect(14); return false;" onmouseover="on_mouse_pan(2); return false;" onmouseout="off_mouse_pan(2); return false;" shape="poly" coords="127,14,166,10,221,11,229,12,229,21,224,37,217,50,207,67,193,83,185,88,173,89,158,74,150,60,138,36,132,19,128,13" href=""/>
				</map>

				<img id="partchk-pan-pelvis" class="partchk-pan-pelvis" src="/img/pelvis.png" alt="">
				<img id="partchk-pan-pelvis2" class="partchk-pan-pelvis2" src="/img/pelvis2.png" alt="">
				<img id="partchk-pan-genital" class="partchk-pan-genital" src="/img/genital.png" alt="">
			</div>

			<div class="leg-part-box" id="leg-part-chk">
				<img class="leg-detail" src="/img/leg-detail.png" usemap="#legpartchk" alt="">
				<map name="legpartchk">
					<area onclick="partSelect(16); return false;" onmouseover="on_mouse_leg(1); return false;" onmouseout="off_mouse_leg(1); return false;" shape="poly" coords="133,18,126,20,120,25,120,34,117,47,116,61,116,75,118,83,118,88,112,99,118,106,138,109,152,111,171,114,181,112,187,108,185,98,185,95,187,89,192,80,193,65,193,48,193,37,194,35,188,25,172,20,138,18,132,18" href=""/>
					<area onclick="partSelect(17); return false;" onmouseover="on_mouse_leg(2); return false;" onmouseout="off_mouse_leg(2); return false;" shape="poly" coords="111,127,110,145,108,158,105,171,102,192,102,204,102,219,101,233,100,255,101,269,103,290,104,306,107,315,113,323,124,325,140,325,152,325,155,320,157,309,159,298,160,291,160,283,162,267,165,257,169,245,174,234,179,222,185,208,186,200,189,181,189,171,189,159,188,152,187,143,181,134,168,130,145,128,117,127,111,126,111,129" href=""/>
					<area onclick="partSelect(18); return false;" onmouseover="on_mouse_leg(3); return false;" onmouseout="off_mouse_leg(3); return false;" shape="poly" coords="108,333,107,349,105,363,102,375,102,383,115,386,131,387,149,388,154,384,154,376,154,366,153,357,150,345,146,335,132,335,118,333,109,333" href=""/>
					<area onclick="partSelect(19); return false;" onmouseover="on_mouse_leg(4); return false;" onmouseout="off_mouse_leg(4); return false;" shape="poly" coords="80,414,67,431,51,449,41,459,33,464,26,477,35,486,48,488,55,493,64,496,73,480,83,478,95,473,103,467,110,456,121,444,130,440,143,431,150,420,155,409,158,403,157,394,154,397,135,389,114,387,99,387,92,397,82,407,81,411" href=""/>
				</map>

				<img id="partchk-leg-knee" class="partchk-leg-knee" src="/img/knee.png" alt="">
				<img id="partchk-leg-calf" class="partchk-leg-calf" src="/img/calf.png" alt="">
				<img id="partchk-leg-ankle" class="partchk-leg-ankle" src="/img/ankle.png" alt="">
				<img id="partchk-leg-foot" class="partchk-leg-foot" src="/img/foot.png" alt="">
			</div>

			<div class="part-box" id="body-part-chk-back">
				<img class="partchk-body-back" src="/img/body-back.png" usemap="#partchk-back" alt="">
				<map name="partchk-back">
					<area onclick="partSelect(20); return false;" onmouseover="on_mouse_back(1); return false;" onmouseout="off_mouse_back(1); return false;"  shape="poly" coords="160,144,136,147,116,151,106,160,96,175,94,185,94,197,97,215,106,228,113,237,125,243,140,245,175,246,197,246,219,238,228,224,231,207,224,176,207,148,183,142,161,143" href="">
					<area onclick="partSelect(21); return false;" onmouseover="on_mouse_back(2); return false;" onmouseout="off_mouse_back(2); return false;"  shape="poly" coords="52,246,50,258,51,266,52,270,52,274,49,279,47,284,46,289,45,292,47,296,57,298,66,299,74,299,77,296,78,282,77,275,79,267,84,255,82,249,56,242,52,246,52,246" href="">
					<area onclick="partSelect(21); return false;" onmouseover="on_mouse_back(2); return false;" onmouseout="off_mouse_back(2); return false;"  shape="poly" coords="262,244,250,245,238,250,234,256,237,264,241,270,243,282,243,294,250,295,260,298,271,296,276,292,269,270,270,247,263,244" href="">
					<area onclick="partSelect(22); return false;" onmouseover="on_mouse_back(3); return false;" onmouseout="off_mouse_back(3); return false;"  shape="poly" coords="103,319,100,333,103,345,100,356,98,365,226,365,220,336,223,331,218,308,221,285,220,270,102,269,102,295,103,319" href="">
					<area onclick="partSelect(23); return false;" onmouseover="on_mouse_back(4); return false;" onmouseout="off_mouse_back(4); return false;"  shape="poly" coords="100,372,223,372,230,390,235,414,237,431,210,438,164,430,122,439,89,428,93,399,98,375" href="">
				</map>

				<img id="partchk-back-back" class="partchk-back-back" src="/img/back.png" alt="">
				<img id="partchk-back-elbow" class="partchk-back-elbow" src="/img/elbow.png" alt="">
				<img id="partchk-back-elbow2" class="partchk-back-elbow2" src="/img/elbow2.png" alt="">
				<img id="partchk-back-waist" class="partchk-back-waist" src="/img/waist.png" alt="">
				<img id="partchk-back-hip" class="partchk-back-hip" src="/img/hip.png" alt="">
			</div>

			<div class="main-body-button">
				<div class="main-body-front-back" id="body-front" onclick="bodyChkFront(); return false;">앞면</div>
				<div class="main-body-front-back" id="body-back" onclick="bodyChkBack(); return false;">후면</div>
			</div>
			<br>
		</div>
		<div style="color: #2C2B71" class="text-center bc-purple" id="symptomChkContainer">
			<br><br><br>
			<div><span class="text-part">#증상</span>을/를 선택해 주세요</div>
			<br>
			<div class="symptomChkbox-container">
				<form action="" id="symptomChkbox">
					@csrf
				</form>
			</div>
		</div>
		<div style="color: #2C2B71" class="text-center bc-purple" id="resultContainer">
		<div class="progress-bar-box" id="progress-bar-box">
			<div class="progress_bar_font">진단 중입니다 잠시만 기다려주십시오.</div>
				<div class="progress-bar">
					<div class="loader"></div>
				</div>
		</div>
			<br>
			<div class="go-doctor">※정확한 진단은 의사와 상담하시길 바랍니다.※</div>
			<div class="mainResultTextBox">
				<div class="mainResultText" id="mainResultText"></div>
			</div>
			<div class="mainResultBox">
				<a href="{{route('main.get')}}" class="diagnoseAgain">다시 진단하기</a>
				<div class="hospitalSearch" onclick="mapopen(); return false;">주위 병원 찾기</div>
				<input type="hidden" name="hospitalGo" id="hospitalGo">
			</div>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
		<div style="color: #2C2B71" class="text-center bc-purple" id="hospitalContainer">
			<br>
			<div id="map" style="height:500px;"></div>
			<div class="mainResultBox">
				<a href="{{route('main.get')}}" class="diagnoseAgain">다시 진단하기</a>
			</div>
		</div>
	</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</main>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6b402b118a5747fb73298eeccdc8b838&libraries=services"></script>
	<script src="../js/main.js"></script>
@endsection
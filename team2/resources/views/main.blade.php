@extends('layout.layout')

@section('title', 'main')

@section('main')
<main class="wrapper">
	<div class="container" id="part-display">
		<div style="color: #2C2B71" class="text-center bc-purple">
			<br>
			<div><span class="text-part">#부위</span>를 선택해 주세요</div>
			<br>
			<div class="part-box" id="body-part-chk">
				<img class="partchk-body" src="/img/body.png" usemap="#partchk" alt="사람이미지">
				<map name="partchk">
					<area onmouseover="on_mouse(1); return false;" onmouseout="off_mouse(1); return false;" onclick="partclick(1); return false;" shape="poly" coords="153,16,131,26,121,44,127,61,129,79,138,91,142,105,144,113,165,116,172,106,175,89,182,76,187,57,187,40,179,26,165,15,152,17" href=""/>
					<area onmouseover="on_mouse(2); return false;" onmouseout="off_mouse(2); return false;" onclick="partclick(2); return false;" shape="poly" coords="90,144,67,152,56,180,59,201,60,210,51,248,51,271,45,288,44,310,39,337,39,362,35,379,22,396,20,410,49,419,51,411,48,384,51,367,66,330,72,299,73,264,82,245,93,215,96,144,91,143" href=""/>
					<area onmouseover="on_mouse(2); return false;" onmouseout="off_mouse(2); return false;" onclick="partclick(2); return false;" shape="poly" coords="223,136,246,152,256,178,254,195,258,212,264,236,266,260,266,277,272,293,276,335,277,367,290,386,293,404,272,419,266,418,263,391,264,369,256,348,248,316,243,292,240,263,230,234,225,226,218,146,219,136" href=""/>
					<area onmouseover="on_mouse(3); return false;" onmouseout="off_mouse(3); return false;" onclick="partclick(3); return false;" shape="poly"coords="109,136,140,118,187,123,210,140,216,174,219,213,206,239,184,241,150,241,123,238,104,234,96,223,94,197,96,181,99,155,107,137,112,134" href=""/>
					<area onmouseover="on_mouse(4); return false;" onmouseout="off_mouse(4); return false;" shape="poly" coords="100,247,104,278,103,295,109,324,103,338,146,345,176,345,209,344,219,339,219,322,214,312,217,297,218,257,218,247,171,244,124,244,100,247" href=""/>
					<area onmouseover="on_mouse(5); return false;" onmouseout="off_mouse(5); return false;" onclick="partclick(4); return false;" shape="poly" coords="101,353,95,383,95,405,114,417,158,430,193,425,230,415,229,397,225,361,221,353,159,352,102,351,102,351" href=""/>
					<area onmouseover="on_mouse(6); return false;" onmouseout="off_mouse(6); return false;" shape="poly" coords="89,436,88,460,90,481,95,497,108,502,128,502,136,493,141,477,144,460,148,446,151,435,145,427,135,419,121,413,101,407,95,407,89,416,89,428,89,434" href=""/>
					<area onmouseover="on_mouse(6); return false;" onmouseout="off_mouse(6); return false;" shape="poly" coords="168,435,181,424,192,417,207,411,222,408,230,410,234,427,236,452,234,472,232,494,229,501,218,503,201,503,190,506,187,502,184,492,180,481,173,464,170,443,168,435" href=""/>
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
					<area onmouseover="on_mouse_head(1); return false;" onmouseout="off_mouse_head(1); return false;" shape="poly" coords="124,35,110,35,99,35,87,43,74,51,69,56,63,62,61,69,60,73,58,79,55,84,55,88,55,93,56,98,60,101,76,107,79,108,84,108,91,110,101,115,113,116,119,117,126,118,137,117,144,116,152,113,163,109,170,108,174,105,179,104,184,100,188,98,191,95,193,92,193,83,190,73,183,62,178,51,170,47,152,37,128,33,114,34" href=""/>
					<area onmouseover="on_mouse_head(2); return false;" onmouseout="off_mouse_head(2); return false;" shape="poly" coords="66,127,66,135,68,142,71,144,75,145,84,145,97,146,106,146,112,143,113,138,111,131,105,123,99,118,90,116,80,114,68,114,65,116,65,123,65,125,66,128" href=""/>
					<area onmouseover="on_mouse_head(2); return false;" onmouseout="off_mouse_head(2); return false;" shape="poly" coords="149,145,155,145,165,145,179,145,183,143,184,141,187,137,187,135,187,132,184,123,182,116,175,113,169,114,155,117,148,119,142,124,141,129,141,134,145,142,146,142,149,143,149,143" href=""/>
					<area onmouseover="on_mouse_head(3); return false;" onmouseout="off_mouse_head(3); return false;" shape="poly" coords="126,132,120,136,116,139,115,144,112,153,112,160,112,165,112,168,116,172,119,174,126,176,131,176,134,175,139,173,141,168,141,164,143,157,143,154,142,150,141,148,141,142,138,139,136,134,133,133,129,132" href=""/>
					<area onmouseover="on_mouse_head(4); return false;" onmouseout="off_mouse_head(4); return false;" shape="poly" coords="126,182,118,181,113,181,105,181,100,182,92,186,85,191,83,197,84,202,87,209,92,212,99,215,105,216,115,216,122,216,134,217,141,218,147,218,154,216,157,215,161,212,163,209,164,206,164,202,164,200,163,196,160,193,155,189,153,188,143,185,130,182,119,182,120,181" href=""/>
					<area onmouseover="on_mouse_head(5); return false;" onmouseout="off_mouse_head(5); return false;" shape="poly" coords="87,227,86,240,86,246,88,252,94,255,98,257,110,259,117,259,126,259,138,256,154,257,160,256,164,254,166,250,168,245,168,239,168,235,166,231,164,229,156,229,151,227,148,228,140,229,135,229,120,230,102,228,95,224,89,226,85,226" href=""/>
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
					<area onmouseover="on_mouse_arm(1); return false;" onmouseout="off_mouse_arm(1); return false;" shape="poly" coords="99,22,91,27,82,34,76,45,70,62,67,72,67,86,68,95,72,104,80,111,92,122,96,127,99,130,99,22" href=""/>
					<area onmouseover="on_mouse_arm(2); return false;" onmouseout="off_mouse_arm(2); return false;" shape="poly" coords="64,106,60,129,56,142,54,161,56,171,53,182,49,197,47,217,47,231,45,242,56,246,65,247,72,246,74,236,78,221,82,208,82,187,82,175,84,166,92,148,94,138,93,130,70,111,64,105" href=""/>
					<area onmouseover="on_mouse_arm(3); return false;" onmouseout="off_mouse_arm(3); return false;" shape="poly" coords="41,271,41,280,46,286,52,286,58,283,60,280,63,273,65,267,68,259,68,254,63,251,55,249,46,248,43,249,42,261,42,266" href=""/>
					<area onmouseover="on_mouse_arm(4); return false;" onmouseout="off_mouse_arm(4); return false;" shape="poly" coords="32,299,29,304,25,313,23,323,29,325,32,327,32,337,34,341,39,335,43,335,41,343,42,346,45,345,49,341,51,343,52,348,58,348,61,344,60,335,60,328,60,316,61,306,60,298,52,293,43,292,33,293,30,301" href=""/>
				</map>

				<img id="partchk-arm-shoulder" class="partchk-arm-shoulder" src="/img/shoulder.png" alt="">
				<img id="partchk-arm-arm" class="partchk-arm-arm" src="/img/arm3.png" alt="">
				<img id="partchk-arm-wrist" class="partchk-arm-wrist" src="/img/wrist.png" alt="">
				<img id="partchk-arm-hand" class="partchk-arm-hand" src="/img/hand.png" alt="">
			</div>

			<div class="front-part-box" id="front-part-chk">
				<img class="front-detail" src="/img/front-detail.png" usemap="#frontpartchk" alt="">
				<map name="frontpartchk">
					<area onmouseover="on_mouse_front(1); return false;" onmouseout="off_mouse_front(1); return false;" shape="poly" coords="147,111,145,91,174,85,200,88,210,109,205,132,199,159,192,163,169,157,155,133,148,114" href=""/>
					<area onmouseover="on_mouse_front(2); return false;" onmouseout="off_mouse_front(2); return false;" shape="poly" coords="120,47,101,54,86,65,73,83,67,119,71,159,79,175,90,174,121,164,139,143,136,120,133,118,133,85,133,61,121,47" href=""/>
				</map>

				<img id="partchk-front-heart" class="partchk-front-heart" src="/img/heart.png" alt="">
				<img id="partchk-front-lung" class="partchk-front-lung" src="/img/lung.png" alt="">
			</div>

			<div class="pan-part-box" id="pan-part-chk">
				<img class="pan-detail" src="/img/pan-detail.png" usemap="#panpartchk" alt="">
				<map name="panpartchk">
					<area onmouseover="on_mouse_pan(1); return false;" onmouseout="off_mouse_pan(1); return false;" shape="poly" coords="73,37,72,50,69,64,66,81,71,95,89,100,112,107,133,109,143,107,145,101,143,92,138,83,133,78,125,73,121,66,114,55,106,46,90,38,76,34,72,39" href=""/>
					<area onmouseover="on_mouse_pan(1); return false;" onmouseout="off_mouse_pan(1); return false;" shape="poly" coords="230,26,235,40,239,55,243,70,247,88,243,98,231,98,210,100,190,103,175,102,176,93,182,85,192,81,197,77,202,72,207,63,212,54,217,43,219,36,223,31,227,27" href=""/>
					<area onmouseover="on_mouse_pan(2); return false;" onmouseout="off_mouse_pan(2); return false;" shape="poly" coords="156,27,130,28,119,33,124,44,131,62,141,78,148,88,155,95,162,91,173,82,180,75,187,65,191,53,198,40,199,30,182,28,158,26,152,28" href=""/>
				</map>

				<img id="partchk-pan-pelvis" class="partchk-pan-pelvis" src="/img/pelvis.png" alt="">
				<img id="partchk-pan-pelvis2" class="partchk-pan-pelvis2" src="/img/pelvis2.png" alt="">
				<img id="partchk-pan-genital" class="partchk-pan-genital" src="/img/genital.png" alt="">
			</div>

			<div class="leg-part-box" id="leg-part-chk">
				<img class="leg-detail" src="/img/leg-detail.png" usemap="#legpartchk" alt="">
				<map name="legpartchk">
					
				</map>
			</div>

			<div class="main-body-button">
				<div class="main-body-front-back-btn">정면</div>
				<div class="main-body-front-back">후면</div>
			</div>
			<br>
		</div>
	</div>
	
</main>

	<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6b402b118a5747fb73298eeccdc8b838&libraries=services"></script>
	<script src="../js/main.js"></script>
@endsection
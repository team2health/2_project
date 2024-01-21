let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAPDISPLAY = document.getElementById('map-display');
let PARTSELCT = document.getElementById('partSelect');
let PARTCHKCONTAINER = document.getElementById('partChkContainer');
let SYMPTOMCHKCONTAINER = document.getElementById('symptomChkContainer');
let RESULTCONTAINER = document.getElementById('resultContainer');
let HOSPITALCONTAINER = document.getElementById('hospitalContainer');
let USERID = document.getElementById('main-user_id');

let PROGRESSBOX = document.getElementById('progress-bar-box');
let progressBarElem = document.querySelector('.progress-bar__bar');

SYMPTOMCHKCONTAINER.style.display = 'none';
RESULTCONTAINER.style.display = 'none';
HOSPITALCONTAINER.style.display = 'none';

function bodyChkFront() {
	document.getElementById('body-part-chk').style.display = 'block';
	document.getElementById('body-part-chk-back').style.display = 'none';
	document.getElementById('body-front').style.display = 'none';
	document.getElementById('body-back').style.display = 'inline-block';
}

function bodyChkBack() {
	document.getElementById('body-part-chk').style.display = 'none';
	document.getElementById('body-part-chk-back').style.display = 'block';
	document.getElementById('body-front').style.display = 'inline-block';
	document.getElementById('body-back').style.display = 'none';
}

document.getElementById('body-front').style.display = 'none';
document.getElementById('body-part-chk-back').style.display = 'none';
document.getElementById('head-part-chk').style.display = 'none';
document.getElementById('arm-part-chk').style.display = 'none';
document.getElementById('front-part-chk').style.display = 'none';
document.getElementById('pan-part-chk').style.display = 'none';
document.getElementById('leg-part-chk').style.display = 'none';

function on_mouse(index) {
	if(index === 1) {
		document.getElementById('partchk-head').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#머리';
	}
	if(index === 2) {
		document.getElementById('partchk-left-arm').style.opacity = '1';
		document.getElementById('partchk-right-arm').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#팔';
	}
	if(index === 3) {
		document.getElementById('partchk-front').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#가슴';
	}
	if(index === 4) {
		document.getElementById('partchk-stomach').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#배';
	}
	if(index === 5) {
		document.getElementById('partchk-pan').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#골반';
	}
	if(index === 6) {
		document.getElementById('partchk-left-leg').style.opacity = '1';
		document.getElementById('partchk-right-leg').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#허벅지';
	}
	if(index === 7) {
		document.getElementById('partchk-left-leg2').style.opacity = '1';
		document.getElementById('partchk-right-leg2').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#다리';
	}
}

function off_mouse(index) {
	if(index === 1) {
		document.getElementById('partchk-head').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-left-arm').style.opacity = '0.5';
		document.getElementById('partchk-right-arm').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 3) {
		document.getElementById('partchk-front').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 4) {
		document.getElementById('partchk-stomach').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 5) {
		document.getElementById('partchk-pan').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 6) {
		document.getElementById('partchk-left-leg').style.opacity = '0.5';
		document.getElementById('partchk-right-leg').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 7) {
		document.getElementById('partchk-left-leg2').style.opacity = '0.5';
		document.getElementById('partchk-right-leg2').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_head(index) {
	if(index === 1) {
		document.getElementById('partchk-head-brain').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#머리';
	}
	if(index === 2) {
		document.getElementById('partchk-head-eye').style.opacity = '1';
		document.getElementById('partchk-head-eye2').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#눈';
	}
	if(index === 3) {
		document.getElementById('partchk-head-nose').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#코';
	}
	if(index === 4) {
		document.getElementById('partchk-head-mouse').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#입';
	}
	if(index === 5) {
		document.getElementById('partchk-head-neck').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#목';
	}
}

function off_mouse_head(index) {
	if(index === 1) {
		document.getElementById('partchk-head-brain').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-head-eye').style.opacity = '0.5';
		document.getElementById('partchk-head-eye2').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 3) {
		document.getElementById('partchk-head-nose').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 4) {
		document.getElementById('partchk-head-mouse').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 5) {
		document.getElementById('partchk-head-neck').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_arm(index) {
	if(index === 1) {
		document.getElementById('partchk-arm-shoulder').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#어깨';
	}
	if(index === 2) {
		document.getElementById('partchk-arm-arm').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#팔';
	}
	if(index === 3) {
		document.getElementById('partchk-arm-wrist').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#손목';
	}
	if(index === 4) {
		document.getElementById('partchk-arm-hand').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#손';
	}
}

function off_mouse_arm(index) {
	if(index === 1) {
		document.getElementById('partchk-arm-shoulder').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-arm-arm').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 3) {
		document.getElementById('partchk-arm-wrist').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 4) {
		document.getElementById('partchk-arm-hand').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_front(index) {
	if(index === 1) {
		document.getElementById('partchk-front-heart').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#심장';
	}
	if(index === 2) {
		document.getElementById('partchk-front-lung').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#폐';
	}
}

function off_mouse_front(index) {
	if(index === 1) {
		document.getElementById('partchk-front-heart').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-front-lung').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_pan(index) {
	if(index === 1) {
		document.getElementById('partchk-pan-pelvis').style.opacity = '1';
		document.getElementById('partchk-pan-pelvis2').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#골반';
	}
	if(index === 2) {
		document.getElementById('partchk-pan-genital').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#생식기';
	}
}

function off_mouse_pan(index) {
	if(index === 1) {
		document.getElementById('partchk-pan-pelvis').style.opacity = '0.5';
		document.getElementById('partchk-pan-pelvis2').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-pan-genital').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_leg(index) {
	if(index === 1) {
		document.getElementById('partchk-leg-knee').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#무릎';
	}
	if(index === 2) {
		document.getElementById('partchk-leg-calf').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#종아리';
	}
	if(index === 3) {
		document.getElementById('partchk-leg-ankle').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#발목';
	}
	if(index === 4) {
		document.getElementById('partchk-leg-foot').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#발';
	}
}

function off_mouse_leg(index) {
	if(index === 1) {
		document.getElementById('partchk-leg-knee').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-leg-calf').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 3) {
		document.getElementById('partchk-leg-ankle').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 4) {
		document.getElementById('partchk-leg-foot').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function on_mouse_back(index) {
	if(index === 1) {
		document.getElementById('partchk-back-back').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#등';
	}
	if(index === 2) {
		document.getElementById('partchk-back-elbow').style.opacity = '1';
		document.getElementById('partchk-back-elbow2').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#팔꿈치';
	}
	if(index === 3) {
		document.getElementById('partchk-back-waist').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#허리';
	}
	if(index === 4) {
		document.getElementById('partchk-back-hip').style.opacity = '1';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#엉덩이';
	}
}

function off_mouse_back(index) {
	if(index === 1) {
		document.getElementById('partchk-back-back').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 2) {
		document.getElementById('partchk-back-elbow').style.opacity = '0.5';
		document.getElementById('partchk-back-elbow2').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 3) {
		document.getElementById('partchk-back-waist').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
	if(index === 4) {
		document.getElementById('partchk-back-hip').style.opacity = '0.5';
		PARTSELCT.innerHTML = '';
		PARTSELCT.innerHTML = '#부위';
	}
}

function partclick(index) {
	if(!USERID.value) {
		alert('로그인을 해주세요.')
		return false;
	}
	
	document.getElementById('body-front').style.display = 'none';
	document.getElementById('body-back').style.display = 'none';

	if(index === 1) {
		document.getElementById('body-part-chk').style.display = 'none';
		document.getElementById('head-part-chk').style.display = 'block';
	}
	if(index === 2) {
		document.getElementById('body-part-chk').style.display = 'none';
		document.getElementById('arm-part-chk').style.display = 'block';
	}
	if(index === 3) {
		document.getElementById('body-part-chk').style.display = 'none';
		document.getElementById('front-part-chk').style.display = 'block';
	}
	if(index === 4) {
		document.getElementById('body-part-chk').style.display = 'none';
		document.getElementById('pan-part-chk').style.display = 'block';
	}
	if(index === 5) {
		document.getElementById('body-part-chk').style.display = 'none';
		document.getElementById('leg-part-chk').style.display = 'block';
	}
}

function partSelect(index) {
	if(!USERID.value) {
		alert('로그인을 해주세요.')
		return false;
	}
	
	PARTCHKCONTAINER.style.display = 'none';
	SYMPTOMCHKCONTAINER.style.display = 'block';

	let formData = new FormData();
	formData.append('part_id', index);

	fetch('/partselect', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		let SYMPTOMBOX = document.getElementById('symptomChkbox');
		let SYMPTOMINPUT = [];
		let SYMPTOMLABEL = [];
	
		for(let i = 0; i < data[0].length; i++) {
			SYMPTOMINPUT[i] = document.createElement('input');
			SYMPTOMLABEL[i] = document.createElement('label');
			SYMPTOMINPUT[i].type = 'checkbox';
			SYMPTOMINPUT[i].name = 'symptom_id';
			SYMPTOMINPUT[i].id = 'symptomchk'+[i];
			SYMPTOMINPUT[i].classList = 'symptomchk-input';
			SYMPTOMINPUT[i].value = data[0][i].part_symptom_id;
			SYMPTOMLABEL[i].innerHTML = data[0][i].symptom_name;
			SYMPTOMLABEL[i].setAttribute('for', 'symptomchk'+[i]);
			SYMPTOMLABEL[i].classList = 'symptomchk-label';

			SYMPTOMBOX.appendChild(SYMPTOMINPUT[i]);
			SYMPTOMBOX.appendChild(SYMPTOMLABEL[i]);
		}

		let SYMPTOMBTNBOX = document.createElement('div');
		let SYMPTOMBTN = document.createElement('button');
		let SYMPTOMA = document.createElement('a');
		SYMPTOMBTNBOX.classList = 'symptom-button-box';
		SYMPTOMBOX.appendChild(SYMPTOMBTNBOX);
		SYMPTOMBTNBOX.appendChild(SYMPTOMA);
		SYMPTOMBTNBOX.appendChild(SYMPTOMBTN);
		SYMPTOMBTN.innerHTML = '검사하기';
		SYMPTOMA.innerHTML = '돌아가기';
		SYMPTOMA.href = '/';
		SYMPTOMBTN.type = 'button';
		SYMPTOMBTN.classList = 'symptom-button';
		SYMPTOMA.classList = 'symptom-button1';
		SYMPTOMBTN.setAttribute('onclick', 'symptomChk()');

	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
}
// let AA = document.getElementById('aa');
// AA.addEventListener('click', function () {
// 	progressBarElem.classList.add('active');
// })


function symptomChk() {
	PROGRESSBOX.style.display = 'block';
	RESULTCONTAINER.style.display = 'block';
	SYMPTOMCHKCONTAINER.style.display = 'none';
	let checkboxes = document.querySelectorAll('input[name="symptom_id"]:checked');
	let values = Array.from(checkboxes).map(checkbox => checkbox.value);
	let HOSPITALGO = document.getElementById('hospitalGo');

	fetch('/symptomselect', {
		method: 'POST',
		body: JSON.stringify({ part_symptom_id: values}),
		headers: {
		'Content-Type': 'application/json'
    }
	})
	.then(response => response.json())
	.then(data => {
		PROGRESSBOX.style.display = 'none';
		let MAINRESULTTEXT = document.getElementById('mainResultText');
        let result = data.replace(/\.\s/g, '<br>');
		MAINRESULTTEXT.innerHTML = result;
		let regex = /`([^`]+)`/g;
		let matches = [];
		let match;

		while ((match = regex.exec(data)) !== null) {
			matches.push(match[1]);
		}
		
		let str = matches.join(', ');
		HOSPITALGO.value = str;

	})
	.catch(error => {
		console.error(error.stack);
	})
}

function mapopen() {
	RESULTCONTAINER.style.display = 'none';
	HOSPITALCONTAINER.style.display = 'block';
	let HOS = document.getElementById('hospitalGo').value;

	let arr = HOS.split(', ');

	fetch('/useraddress', {
		method: 'GET',
	})
	.then(response => response.json())
	.then(data => {
		user_address = data[0].user_address;

		let mapx;
		let mapy;

		var geocoder = new kakao.maps.services.Geocoder();

		var callback = function(result, status) {
			if (status === kakao.maps.services.Status.OK) {
				mapx = result[0].y;
				mapy = result[0].x;

				mapgo();
			}
		};

		geocoder.addressSearch(user_address, callback);

		function mapgo() {
			// 마커를 클릭하면 장소명을 표출할 인포윈도우 입니다
			var infowindow = new kakao.maps.InfoWindow({zIndex:1});
	
			var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
				mapOption = {
					center: new kakao.maps.LatLng(mapx, mapy), // 지도의 중심좌표
					level: 3 // 지도의 확대 레벨
				};  
	
			// 지도를 생성합니다    
			var map = new kakao.maps.Map(mapContainer, mapOption); 
			var ps = [];
	
			for(let i = 0; i < arr.length; i++) {

				// 장소 검색 객체를 생성합니다
				ps[i] = new kakao.maps.services.Places(); 
		
				// 키워드로 장소를 검색합니다
				ps[i].keywordSearch(user_address+arr[i], placesSearchCB);
		
				// 키워드 검색 완료 시 호출되는 콜백함수 입니다
				function placesSearchCB (data, status, pagination) {
					if (status === kakao.maps.services.Status.OK) {
		
						// 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
						// LatLngBounds 객체에 좌표를 추가합니다
						var bounds = new kakao.maps.LatLngBounds();
		
						for (var i=0; i<data.length; i++) {
							displayMarker(data[i]);
							bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
						}       
		
						// 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
						map.setBounds(bounds);
					} 
				}
		
				// 지도에 마커를 표시하는 함수입니다
				function displayMarker(place) {
					
					// 마커를 생성하고 지도에 표시합니다
					var marker = new kakao.maps.Marker({
						map: map,
						position: new kakao.maps.LatLng(place.y, place.x) 
					});
		
					// 마커에 클릭이벤트를 등록합니다
					kakao.maps.event.addListener(marker, 'click', function() {
						// 마커를 클릭하면 장소명이 인포윈도우에 표출됩니다
						infowindow.setContent('<div style="padding:5px;font-size:12px;">' + place.place_name + '</div>');
						infowindow.open(map, marker);
					});
				}
			}
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
}
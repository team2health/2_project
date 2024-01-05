let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAPDISPLAY = document.getElementById('map-display');

document.getElementById('head-part-chk').style.display = 'none';
document.getElementById('arm-part-chk').style.display = 'none';
document.getElementById('front-part-chk').style.display = 'none';
document.getElementById('pan-part-chk').style.display = 'none';
document.getElementById('leg-part-chk').style.display = 'none';

function on_mouse(index) {
	if(index === 1) {
		document.getElementById('partchk-head').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-left-arm').style.opacity = '1';
		document.getElementById('partchk-right-arm').style.opacity = '1';
	}
	if(index === 3) {
		document.getElementById('partchk-front').style.opacity = '1';
	}
	if(index === 4) {
		document.getElementById('partchk-stomach').style.opacity = '1';
	}
	if(index === 5) {
		document.getElementById('partchk-pan').style.opacity = '1';
	}
	if(index === 6) {
		document.getElementById('partchk-left-leg').style.opacity = '1';
		document.getElementById('partchk-right-leg').style.opacity = '1';
	}
	if(index === 7) {
		document.getElementById('partchk-left-leg2').style.opacity = '1';
		document.getElementById('partchk-right-leg2').style.opacity = '1';
	}
}

function off_mouse(index) {
	if(index === 1) {
		document.getElementById('partchk-head').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-left-arm').style.opacity = '0.5';
		document.getElementById('partchk-right-arm').style.opacity = '0.5';
	}
	if(index === 3) {
		document.getElementById('partchk-front').style.opacity = '0.5';
	}
	if(index === 4) {
		document.getElementById('partchk-stomach').style.opacity = '0.5';
	}
	if(index === 5) {
		document.getElementById('partchk-pan').style.opacity = '0.5';
	}
	if(index === 6) {
		document.getElementById('partchk-left-leg').style.opacity = '0.5';
		document.getElementById('partchk-right-leg').style.opacity = '0.5';
	}
	if(index === 7) {
		document.getElementById('partchk-left-leg2').style.opacity = '0.5';
		document.getElementById('partchk-right-leg2').style.opacity = '0.5';
	}
}

function on_mouse_head(index) {
	if(index === 1) {
		document.getElementById('partchk-head-brain').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-head-eye').style.opacity = '1';
		document.getElementById('partchk-head-eye2').style.opacity = '1';
	}
	if(index === 3) {
		document.getElementById('partchk-head-nose').style.opacity = '1';
	}
	if(index === 4) {
		document.getElementById('partchk-head-mouse').style.opacity = '1';
	}
	if(index === 5) {
		document.getElementById('partchk-head-neck').style.opacity = '1';
	}
}

function off_mouse_head(index) {
	if(index === 1) {
		document.getElementById('partchk-head-brain').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-head-eye').style.opacity = '0.5';
		document.getElementById('partchk-head-eye2').style.opacity = '0.5';
	}
	if(index === 3) {
		document.getElementById('partchk-head-nose').style.opacity = '0.5';
	}
	if(index === 4) {
		document.getElementById('partchk-head-mouse').style.opacity = '0.5';
	}
	if(index === 5) {
		document.getElementById('partchk-head-neck').style.opacity = '0.5';
	}
}

function on_mouse_arm(index) {
	if(index === 1) {
		document.getElementById('partchk-arm-shoulder').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-arm-arm').style.opacity = '1';
	}
	if(index === 3) {
		document.getElementById('partchk-arm-wrist').style.opacity = '1';
	}
	if(index === 4) {
		document.getElementById('partchk-arm-hand').style.opacity = '1';
	}
}

function off_mouse_arm(index) {
	if(index === 1) {
		document.getElementById('partchk-arm-shoulder').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-arm-arm').style.opacity = '0.5';
	}
	if(index === 3) {
		document.getElementById('partchk-arm-wrist').style.opacity = '0.5';
	}
	if(index === 4) {
		document.getElementById('partchk-arm-hand').style.opacity = '0.5';
	}
}

function on_mouse_front(index) {
	if(index === 1) {
		document.getElementById('partchk-front-heart').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-front-lung').style.opacity = '1';
	}
}

function off_mouse_front(index) {
	if(index === 1) {
		document.getElementById('partchk-front-heart').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-front-lung').style.opacity = '0.5';
	}
}

function on_mouse_pan(index) {
	if(index === 1) {
		document.getElementById('partchk-pan-pelvis').style.opacity = '1';
		document.getElementById('partchk-pan-pelvis2').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-pan-genital').style.opacity = '1';
	}
}

function off_mouse_pan(index) {
	if(index === 1) {
		document.getElementById('partchk-pan-pelvis').style.opacity = '0.5';
		document.getElementById('partchk-pan-pelvis2').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-pan-genital').style.opacity = '0.5';
	}
}

function on_mouse_leg(index) {
	if(index === 1) {
		document.getElementById('partchk-leg-knee').style.opacity = '1';
	}
	if(index === 2) {
		document.getElementById('partchk-leg-calf').style.opacity = '1';
	}
	if(index === 3) {
		document.getElementById('partchk-leg-ankle').style.opacity = '1';
	}
	if(index === 4) {
		document.getElementById('partchk-leg-foot').style.opacity = '1';
	}
}

function off_mouse_leg(index) {
	if(index === 1) {
		document.getElementById('partchk-leg-knee').style.opacity = '0.5';
	}
	if(index === 2) {
		document.getElementById('partchk-leg-calf').style.opacity = '0.5';
	}
	if(index === 3) {
		document.getElementById('partchk-leg-ankle').style.opacity = '0.5';
	}
	if(index === 4) {
		document.getElementById('partchk-leg-foot').style.opacity = '0.5';
	}
}

function partclick(index) {
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

function mapopen(disease_id, user_id) {

	let user_address;

	let formData = new FormData();
	formData.append('user_id', user_id);
	formData.append('disease_id', disease_id);

	fetch('/useraddress', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		user_address = data[0][0].user_address;

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
	
			for(let i = 0; i < data[1].length; i++) {

				// 장소 검색 객체를 생성합니다
				ps[i] = new kakao.maps.services.Places(); 
		
				// 키워드로 장소를 검색합니다
				ps[i].keywordSearch(user_address+data[1][i].diagnosis_name, placesSearchCB);
		
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

function partCheck(index) {

	let formData = new FormData();
	formData.append('part_id', index);

	fetch('/partselect', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {

		let SYMPTOMDIV = [];
		
		for(let i = 0; i < data.length; i++) {
			let SYMPTOMBOX = document.getElementById('symptom-box');
			SYMPTOMDIV[i] = document.createElement('div');

			SYMPTOMBOX.appendChild(SYMPTOMDIV[i]);
			SYMPTOMDIV[i].innerHTML = data[i].symptom_name;
			SYMPTOMDIV[i].setAttribute('onclick', `symptomCheck(${data[i].part_symptom_id})`)
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
	
	PART.style.display = 'none';
	SYMPTOM.removeAttribute('display');
	SYMPTOM.style.display = 'block';
}

function symptomCheck(index) {

	let formData = new FormData();
	formData.append('part_symptom_id', index);

	fetch('/symptomselect', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
	
		let DIESASENAME = document.getElementById('diesase-name');
		let DIESASEINFO = document.getElementById('diesase-info');

		DIESASENAME.innerHTML = data[0][0].disease_name;
		DIESASEINFO.innerHTML = data[0][0].disease_info;
		
		let HOSPITAL = document.getElementById('hospital');
		HOSPITAL.setAttribute('onclick', `mapDisplay(${data[0][0].disease_id}, ${data[1]})`)
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})


	SYMPTOM.style.display = 'none';
	DISEASE.removeAttribute('display');
	DISEASE.style.display = 'block';
}

function mapDisplay(disease_id, user_id) {
	MAPDISPLAY.removeAttribute('display');
	MAPDISPLAY.style.display = 'block';
	document.getElementById('hospital').style.display = 'none';

	mapopen(disease_id, user_id);
}
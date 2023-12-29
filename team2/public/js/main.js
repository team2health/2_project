let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAPDISPLAY = document.getElementById('map-display');

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


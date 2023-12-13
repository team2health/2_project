function sample4_execDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var roadAddr = data.roadAddress; // 도로명 주소 변수
			var extraRoadAddr = ''; // 참고 항목 변수

			// 법정동명이 있을 경우 추가한다. (법정리는 제외)
			// 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
			if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
				extraRoadAddr += data.bname;
			}
			// 건물명이 있고, 공동주택일 경우 추가한다.
			if(data.buildingName !== '' && data.apartment === 'Y'){
				extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
			}
			// 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
			if(extraRoadAddr !== ''){
				extraRoadAddr = ' (' + extraRoadAddr + ')';
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
			document.getElementById('sample4_postcode').value = data.zonecode;
			document.getElementById("sample4_roadAddress").value = roadAddr;

			var guideTextBox = document.getElementById("guide");
			// 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
			if(data.autoRoadAddress) {
				var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
				guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
				guideTextBox.style.display = 'block';

			} else if(data.autoJibunAddress) {
				var expJibunAddr = data.autoJibunAddress;
				guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
				guideTextBox.style.display = 'block';
			} else {
				guideTextBox.innerHTML = '';
				guideTextBox.style.display = 'none';
			}
		}
	}).open();
}

let PART = document.getElementById('part-display');
let SYMPTOM = document.getElementById('symptom-display');
let DISEASE = document.getElementById('disease-display');
let MAP = document.getElementById('map-display');

function partCheck(index) {
	console.log(index);
	PART.style.display = 'none';
	SYMPTOM.removeAttribute('display');
	SYMPTOM.style.display = 'block';
}

function symptomCheck(index) {
	console.log(index);
	SYMPTOM.style.display = 'none';
	DISEASE.removeAttribute('display');
	DISEASE.style.display = 'block';
}

function mapDisplay() {
	MAP.removeAttribute('display');
	MAP.style.display = 'block';
}

let USERNAME = document.getElementById('user_name');
let ERRORNAME = document.getElementById('error_name');
let USERID = document.getElementById('user_id');
let ERRORID = document.getElementById('error_id');
let USERPASSWORD = document.getElementById('user_password');
let ERRORPASSWORD = document.getElementById('error_password');
let USERPASSWORDCHECK = document.getElementById('user_password_check');
let ERRORPASSWORDCHECK = document.getElementById('error_password_check');

USERNAME.addEventListener('input', function() {
    const value = USERNAME.value;
    const regex = /^[가-힣a-zA-Z0-9]+$/;

    if (!regex.test(value)) {
        ERRORNAME.innerHTML='닉네임을 다시 입력해주세요'
    } else {
		ERRORNAME.innerHTML=''
	}
});

USERID.addEventListener('input', function() {
    const value = USERNAME.value;
    const regex = /^[가-힣a-zA-Z0-9]+$/;

    if (!regex.test(value)) {
        ERRORID.innerHTML='아이디를 다시 입력해주세요'
    } else {
		ERRORID.innerHTML=''
	}
});

USERPASSWORDCHECK.addEventListener('input', function() {
    const value = USERPASSWORD.value;
    const regex = USERPASSWORDCHECK.value;

    if (value !== regex) {
        ERRORPASSWORDCHECK.innerHTML='비밀번호와 일치하지 않습니다'
    } else {
		ERRORPASSWORDCHECK.innerHTML=''
	}
});

// function registgo() {

// }
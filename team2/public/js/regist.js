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

let USERNAME = document.getElementById('user_name');
let USERID = document.getElementById('user_id');
let USERPASSWORD = document.getElementById('user_password');
let USERPASSWORDCHECK = document.getElementById('user_password_check');
// let USERADRESSF = document.getElementById('sample4_roadAddress');
// let USERADRESSS = document.getElementById('sample4_detailAddress');
let namechkflg = 0;
let idchkflg = 0;
let nameFlg = 0;
let idFlg = 0;

let ERRORNAME = document.getElementById('error_name');
let ERRORID = document.getElementById('error_id');
let ERRORPASSWORDCHECK = document.getElementById('error_password_check');
let regex = /^[가-힣a-zA-Z0-9]{2,}$/;
let regex2 = /^[가-힣a-zA-Z0-9]{4,}$/;

USERNAME.addEventListener('input', function() {
    const value = USERNAME.value;

    if (!regex.test(value)) {
		ERRORNAME.removeAttribute('class');
    } else {
        ERRORNAME.setAttribute('class', 'not-error-name');
	}
});

USERID.addEventListener('input', function() {
    const value = USERID.value;

    if (!regex2.test(value)) {
        ERRORID.removeAttribute('class');
    } else {
		ERRORID.setAttribute('class', 'not-error-id');
	}
});

USERPASSWORDCHECK.addEventListener('input', function() {
    const value = USERPASSWORD.value;
    const regex = USERPASSWORDCHECK.value;

    if (value !== regex) {
        ERRORPASSWORDCHECK.removeAttribute('class');
    } else {
		ERRORPASSWORDCHECK.setAttribute('class', 'not-error-passwordchk');
	}
});

let MALE = document.getElementById('gender-male');
let FEMALE = document.getElementById('gender-female');
let GENDERINPUT = document.getElementById('gender-input');

function genderMcheck() {
	FEMALE.style.backgroundColor = '#F5F5F5';
	MALE.style.backgroundColor = '#FF9900';
	GENDERINPUT.setAttribute('value', '1');
}

function genderFcheck() {
	MALE.style.backgroundColor = '#F5F5F5';
	FEMALE.style.backgroundColor = '#FF9900';
	GENDERINPUT.setAttribute('value', '2');
}

function registgo() {
	let USERNAMEVALUE = document.getElementById('user_name').value;
	let USERIDVALUE = document.getElementById('user_id').value;
	let USERPASSWORDVALUE = document.getElementById('user_password').value;
	let USERPASSWORDCHECKVALUE = document.getElementById('user_password_check').value;
	let USERADRESSFVALUE = document.getElementById('sample4_roadAddress').value;
	let GENDERINPUTVALUE = document.getElementById('gender-input');

	if(USERNAMEVALUE === '') {
		alert('닉네임은 필수사항입니다.');
		return false;
	} else if(namechkflg === 0) {
		alert('닉네임 중복확인을 해주세요.');
		return false;
	} else if(!regex.test(USERNAMEVALUE)) {
		alert('닉네임을 다시 확인해주세요.');
		return false;
	} else if(nameFlg === 1) {
        alert('사용 중인 닉네임입니다.\n닉네임을 다시 입력해주세요.');
        return false;
    } else if(USERIDVALUE === '') {
		alert('아이디는 필수사항입니다.');
		return false;
	} else if(idchkflg === 0) {
		alert('아이디 중복확인을 해주세요.');
		return false;
	} else if(!regex2.test(USERIDVALUE)) {
		alert('아이디를 다시 확인해주세요.');
		return false;
	}  else if(idFlg === 1) {
        alert('사용 중인 아이디입니다.\n아이디를 다시 입력해주세요.');
        return false;
    } else if(USERPASSWORDVALUE === '') {
		alert('비밀번호는 필수사항입니다.');
		return false;
	} else if(USERPASSWORDCHECKVALUE === '') {
		alert('비밀번호 확인을 입력해주세요.');
		return false;
	} else if(USERPASSWORDVALUE !== USERPASSWORDCHECKVALUE) {
		alert('비밀번호와 비밀번호 확인이 일치하지 않습니다.')
		return false;
	} else if(USERADRESSFVALUE === '') {
		alert('주소는 필수사항입니다.');
		return false;
	} else if(GENDERINPUTVALUE.value === '') { 
		alert('성별을 선택해주세요.');
		return false;
	}

	document.getElementById('regist_form').submit();
}

function checkName() {
	let nameChk = document.getElementById('user_name').value;

	if(nameChk === '') {
		alert('닉네임을 입력해주세요');
		return false;
	} else if(!regex.test(nameChk)) {
		alert('사용할 수 없는 닉네임입니다.');
		return false;
	}

	const formData = new FormData();
	formData.append('user_name', nameChk);
	fetch('/namechk', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		if(data['nameChk'] === '0') {
			alert('사용가능한 닉네임 입니다.');
			nameFlg = 0;
		} else if(data['nameChk'] === '1') {
			alert('이미 존재하는 닉네임 입니다.');
			nameFlg = 1;
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
	namechkflg = 1;
}

function checkId() {
	let idChk = document.getElementById('user_id').value;

	if(idChk === '') {
		alert('아이디를 입력해주세요');
		return false;
	} else if(!regex2.test(idChk)) {
		alert('사용할 수 없는 아이디입니다.');
		return false;
	}

	const formData = new FormData();
	formData.append('user_id', idChk);
	fetch('/idchk', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		if(data['idChk'] === '0') {
			alert('사용가능한 아이디 입니다.');
			idFlg = 0;
		} else if(data['idChk'] === '1') {
			alert('이미 존재하는 아이디 입니다.');
			idFlg = 1;
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
	idchkflg = 1;
}
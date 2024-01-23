
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
// let USERID = document.getElementById('user_email');
let USERPASSWORD = document.getElementById('user_password');
let USERPASSWORDCHECK = document.getElementById('user_password_check');
// let USERADRESSF = document.getElementById('sample4_roadAddress');
// let USERADRESSS = document.getElementById('sample4_detailAddress');
let namechkflg = 0;
// let idchkflg = 0;
let nameFlg = 0;
let idFlg = 0;

let ERRORNAME = document.getElementById('error_name');
let ERRORID = document.getElementById('error_id');
let ERRORPASSWORDCHECK = document.getElementById('error_password_check');
let regex = /^[가-힣a-zA-Z0-9]{2,}$/;
let regex2 = /^[가-힣a-zA-Z0-9]{4,}$/;

USERNAME.addEventListener('input', function() {
    namechkflg = 0;
    const value = USERNAME.value;

	inputCheckBtn[0].disabled = false;
	inputCheckBtn[0].classList.replace('input-check-end', 'input-check');

	if(inputCheckName == value) {
		inputCheckBtn[0].disabled = true;
		inputCheckBtn[0].classList.replace('input-check', 'input-check-end');
	}
    if (!regex.test(value)) {
		ERRORNAME.removeAttribute('class');
    } else {
        ERRORNAME.setAttribute('class', 'not-error-name');
	}
});

// USERID.addEventListener('input', function() {
//     const value = USERID.value;

// 	inputCheckBtn[1].disabled = false;
// 	inputCheckBtn[1].classList.replace('input-check-end', 'input-check');

// 	if(inputCheckId == value) {
// 		inputCheckBtn[1].disabled = true;
// 		inputCheckBtn[1].classList.replace('input-check', 'input-check-end');
// 	}
	
//     // if (!regex2.test(value)) {
//     //     ERRORID.removeAttribute('class');
//     // } else {
// 	// 	ERRORID.setAttribute('class', 'not-error-id');
// 	// }
// });

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

//생년월일 박스 
// '출생 연도' 셀렉트 박스 option 목록 동적 생성
const birthYearEl = document.querySelector('#birth-year')
// option 목록 생성 여부 확인
isYearOptionExisted = false;
birthYearEl.addEventListener('focus', function () {
  // year 목록 생성되지 않았을 때 (최초 클릭 시)
	if(!isYearOptionExisted) {
    isYearOptionExisted = true
		for(var i = 1940; i <= 2022; i++) {
		// option element 생성
			const YearOption = document.createElement('option');
			YearOption.setAttribute('value', i);
			YearOption.innerText = i;
		// birthYearEl의 자식 요소로 추가
			this.appendChild(YearOption);
		}
	}
});
// '출생 달' 셀렉트 박스 option 목록 동적 생성
const birthMonthEl = document.querySelector('#birth-month')
// option 목록 생성 여부 확인
isMonthOptionExisted = false;
birthMonthEl.addEventListener('focus', function () {
  // year 목록 생성되지 않았을 때 (최초 클릭 시)
	if(!isMonthOptionExisted) {
		isMonthOptionExisted = true
		let day;
		for(var i = 1; i <= 12; i++) {
		// option element 생성
			const MonthOption = document.createElement('option');
			if(i<10) {
				day = "0" + i;
			} else {
				day = i;
			}
			MonthOption.setAttribute('value', day);
			MonthOption.innerText = i;
		// birthMonthEl의 자식 요소로 추가
			this.appendChild(MonthOption);
		}
	}
});

// '출생 날짜' 셀렉트 박스 option 목록 동적 생성
const birthDateEl = document.querySelector('#birth-day')
// option 목록 생성 여부 확인
isDateOptionExisted = false;
birthDateEl.addEventListener('focus', function () {
  // year 목록 생성되지 않았을 때 (최초 클릭 시)
	if(!isDateOptionExisted) {
		isDateOptionExisted = true;
		
		let date;
		for(var i = 1; i <= 31; i++) {
		// option element 생성
			if(i<10) {
				date = "0" + i;
			} else {
				date = i;
			}
			const DayOption = document.createElement('option');
			DayOption.setAttribute('value', date);
			DayOption.innerText = i
		// birthMonthEl의 자식 요소로 추가
			this.appendChild(DayOption);
		}
	}
});

function registgo() {
	let BIRTHYEAR = document.getElementById('birth-year').value;
	let BIRTHMONTH = document.getElementById('birth-month').value;
	let BIRTHDATE = document.getElementById('birth-day').value;
	let USERNAMEVALUE = document.getElementById('user_name').value;
	// let USERIDVALUE = document.getElementById('user_email').value;
	let USERPASSWORDVALUE = document.getElementById('user_password').value;
	let USERPASSWORDCHECKVALUE = document.getElementById('user_password_check').value;
	let USERADRESSFVALUE = document.getElementById('sample4_roadAddress').value;
	let GENDERINPUTVALUE = document.getElementById('gender-input');
	let AGREEMENTFLG = document.getElementById('agreement_flg');
	if(USERNAMEVALUE === '') {
		alert('닉네임은 필수사항입니다.');
		return false;
	} else if(!AGREEMENTFLG.checked) { 
		alert('이용약관 동의는 필수입니다.');
		return false;
	} else if(namechkflg === 0) {
		alert('닉네임 중복확인을 해주세요.');
		return false;
	} else if(!regex.test(USERNAMEVALUE)) {
		alert('닉네임을 다시 확인해주세요.');
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
	} else if(BIRTHYEAR === '출생 연도') {
		alert('생년월일은 필수사항입니다.')
		return false;
	} else if(BIRTHMONTH === '월') {
		alert('생년월일은 필수사항입니다.')
		return false;
	} else if(BIRTHDATE === '일') {
		alert('생년월일은 필수사항입니다.')
		return false;
	}

	// else if(nameFlg === 1) {
    //     alert('사용 중인 닉네임입니다.\n닉네임을 다시 입력해주세요.');
    //     return false;
    // } else if(USERIDVALUE === '') {
	// 	alert('이메일은 필수사항입니다.');
	// 	return false;
	// } else if(idchkflg === 0) {
	// 	alert('이메일 중복확인을 해주세요.');
	// 	return false;
	// } else if(idFlg === 1) {
    //     alert('사용 중인 이메일입니다.\n이메일을 다시 입력해주세요.');
    //     return false;
    // }

	document.getElementById('regist_form').submit();
}

let inputCheckBtn = document.querySelectorAll('.input-check');
let inputCheckName;

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
			inputCheckBtn[0].disabled = true;
			inputCheckBtn[0].classList.replace('input-check', 'input-check-end');
			inputCheckName = nameChk;
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

// let inputCheckId;
// function checkId() {
// 	let idChk = document.getElementById('user_email').value;

// 	if(idChk === '') {
// 		alert('이메일을 입력해주세요');
// 		return false;
// 	} 
// 	// else if(!regex2.test(idChk)) {
// 	// 	alert('사용할 수 없는 이메일입니다.');
// 	// 	return false;
// 	// }

// 	const formData = new FormData();
// 	formData.append('user_email', idChk);
// 	fetch('/idchk', {
// 		method: 'POST',
// 		body: formData,
// 	})
// 	.then(response => response.json())
// 	.then(data => {
// 		if(data['idChk'] === '0') {
// 			alert('사용가능한 이메일 입니다.');
// 			inputCheckBtn[1].disabled = true;
// 			inputCheckBtn[1].classList.replace('input-check', 'input-check-end');
// 			inputCheckId = idChk;
// 			idFlg = 0;
// 		} else if(data['idChk'] === '1') {
// 			alert('사용할 수 없는 이메일 입니다.');
// 			idFlg = 1;
// 		}
// 	})
// 	.catch(error => {
// 		console.error('오류 발생:', error);
// 	})
// 	idchkflg = 1;
// }

function agreementErrorSet () {
	let agreementError = document.getElementById('agreementError').value;
	if(agreementError === '1') {
		let agreementError = document.getElementById('agreementError');
		agreementError.innerHTML = '이용약관 동의는 필수입니다.';
	} else {
		
	}
}
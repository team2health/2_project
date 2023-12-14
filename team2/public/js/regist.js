let USERNAME = document.getElementById('user_name');
let USERID = document.getElementById('user_id');
let USERPASSWORD = document.getElementById('user_password');
let USERPASSWORDCHECK = document.getElementById('user_password_check');
// let USERADRESSF = document.getElementById('sample4_roadAddress');
// let USERADRESSS = document.getElementById('sample4_detailAddress');

let ERRORNAME = document.getElementById('error_name');
let ERRORID = document.getElementById('error_id');
let ERRORPASSWORDCHECK = document.getElementById('error_password_check');

USERNAME.addEventListener('input', function() {
    const value = USERNAME.value;
    const regex = /^[가-힣a-zA-Z0-9]+$/;

    if (!regex.test(value)) {
		ERRORNAME.removeAttribute('class');
    } else {
        ERRORNAME.setAttribute('class', 'not-error-name');
	}
});

USERID.addEventListener('input', function() {
    const value = USERID.value;
    const regex = /^[가-힣a-zA-Z0-9]+$/;

    if (!regex.test(value)) {
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
	let USERADRESSSVALUE = document.getElementById('sample4_detailAddress').value;
	let GENDERINPUTVALUE = document.getElementById('gender-input');

	if(USERNAMEVALUE === '') {
		alert('닉네임은 필수사항입니다.');
		return false;
	} else if(USERIDVALUE === '') {
		alert('아이디는 필수사항입니다.');
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

	let ADRESS = document.getElementById('adress-fullname');
	ADRESS.setAttribute('value', USERADRESSFVALUE+' '+USERADRESSSVALUE);

	document.getElementById('regist_form').submit();
}

// function checkName() {
// 	let nameChk = document.getElementById('user_name').value;
// 	const formData = new FormData();
// 	formData.append('user_name', nameChk);

// 	fetch('/namechk', {
// 		method: 'POST',
// 		headers: {
// 			'Content-Type': 'multipart/form-data',
// 		},
// 		body: formData,
// 	})
// 	.then(response => response.json())
// 	.then(data => {
// 		console.log(data);
// 	})
// 	.catch(error => {
// 		console.error('오류 발생:', error);
// 	})
// }
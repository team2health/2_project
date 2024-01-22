let LOGINUSERID = document.getElementById('login_user_email');
let ERRORLOGINID = document.getElementById('error_login_id');
let regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

let PASSWORDERROR = document.getElementById('passwordError');
// let IDERROR = document.getElementById('idError');

window.addEventListener('load', function() {
    loginonload();
})

function loginonload() {

	if(PASSWORDERROR.value == '3') {
		alert('아이디와 비밀번호를 다시 확인해주세요.');
	}


	if(PASSWORDERROR.value == '1') {
		alert('비밀번호가 일치하지 않습니다.');
	}
	// if(IDERROR.value === '1') {
	// 	alert('아이디를 다시 확인해주세요.');
	// }
	if(PASSWORDERROR.value == '2') {
		alert('탈퇴한 회원입니다.');
	}
}


LOGINUSERID.addEventListener('input', function() {
    const value = LOGINUSERID.value;

    if (!regex.test(value)) {
        ERRORLOGINID.removeAttribute('class');
    } else {
		ERRORLOGINID.setAttribute('class', 'not-error-id');
	}
});

function logingo() {
	let LOGINUSERIDVALUE = document.getElementById('login_user_email').value;
	let LOGINUSERPWVALUE = document.getElementById('login_user_password').value;

	if(LOGINUSERIDVALUE === '') {
		alert('아이디를 입력해주세요.');
		return false;
	} else if(!regex.test(LOGINUSERIDVALUE)) {
		alert('아이디를 다시 확인해주세요.')
	} else if(LOGINUSERPWVALUE === '') {
		alert('비밀번호를 입력해주세요.');
		return false;
	} 
	document.getElementById('login_form').submit();
}


let loginForm = document.getElementById("login_form");
loginForm.addEventListener("keyup", function(event) {
    if (event.key === "Enter" || event.keyCode == 13) {
        loginForm.submit();
    }
});

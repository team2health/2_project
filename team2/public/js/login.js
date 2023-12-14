let LOGINUSERID = document.getElementById('login_user_id');
let ERRORLOGINID = document.getElementById('error_login_id');

LOGINUSERID.addEventListener('input', function() {
    const value = LOGINUSERID.value;
    const regex = /^[가-힣a-zA-Z0-9]+$/;

    if (!regex.test(value)) {
        ERRORLOGINID.removeAttribute('class');
    } else {
		ERRORLOGINID.setAttribute('class', 'not-error-id');
	}
});

function logingo() {
	let LOGINUSERIDVALUE = document.getElementById('login_user_id').value;
	let LOGINUSERPWVALUE = document.getElementById('login_user_password').value;

	if(LOGINUSERIDVALUE === '') {
		alert('아이디를 입력해주세요.');
		return false;
	} else if(LOGINUSERPWVALUE === '') {
		alert('비밀번호를 입력해주세요.');
		return false;
	}

	document.getElementById('login_form').submit();
}
window.addEventListener('load', function() {
    passwordChkErrorMsg(); //마이페이지 해시태그 불러오기
});

let USERPASSWORD = document.getElementById('user_password');
let USERPASSWORDCHECK = document.getElementById('user_password_check');
let ERRORPASSWORDCHECK = document.getElementById('error_password_check');

USERPASSWORDCHECK.addEventListener('input', function() {
    const value = USERPASSWORD.value;
    const regex = USERPASSWORDCHECK.value;

    if (value !== regex) {
        ERRORPASSWORDCHECK.removeAttribute('class');
    } else {
		ERRORPASSWORDCHECK.setAttribute('class', 'not-error-passwordchk');
	}
});

function passwordChkErrorMsg () {
    let passwordChangeErrorValue = document.getElementById('passwordChangeErrorValue');
    let mypageChangePasswordErrorMsg = document.getElementById('mypageChangePasswordErrorMsg');
    let value = passwordChangeErrorValue.value;

    if(value == '0') {
        mypageChangePasswordErrorMsg.innerHTML = '';
    } else if ( value == '1') {
        mypageChangePasswordErrorMsg.innerHTML = '';
        mypageChangePasswordErrorMsg.innerHTML = ' 현재 비밀번호를 다시 한 번 확인해주세요.';
    } else if (value == '2' ) {
        mypageChangePasswordErrorMsg.innerHTML = '';
        mypageChangePasswordErrorMsg.innerHTML = '비밀번호 확인이 일치하지 않습니다.';
    } else if (value == '3' ) {
        mypageChangePasswordErrorMsg.innerHTML = '';
        mypageChangePasswordErrorMsg.innerHTML = '기존 비밀번호와 다르게 설정해주세요.';
    } else if (value == '4' ) {
        mypageChangePasswordErrorMsg.innerHTML = '';
        mypageChangePasswordErrorMsg.innerHTML = '비밀번호는 영어소문자/숫자를 조합하여 6~20글자로 입력해주세요.';
    }
}
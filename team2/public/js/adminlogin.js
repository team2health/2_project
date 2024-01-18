window.addEventListener('load', function () {
    adminPasswordChkAlert();
})

function adminPasswordChkAlert() {
    let adminPasswordChk = document.getElementById('adminPasswordChk').value;
    if(adminPasswordChk === '1') {
        alert('아이디와 비밀번호를 다시 확인해주세요.');
    
    } else if (adminPasswordChk === '2') {
        alert('아이디와 비밀번호를 다시 확인해주세요.');
    }
}
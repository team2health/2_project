// window.addEventListener('beforeunload', function (event) {
//     event.returnValue = '';
//     let message = '페이지를 새로고침하면 변경 사항이 저장되지 않을 수 있습니다.';
//     confirm(message);
// });


let emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	// return emailRegex.test(email);


function emailSendBtn() {
    let emailError = document.getElementById('emailError');
    let emailvalue = document.getElementById('user_email').value;
    emailError.innerHTML = '';
	if(emailvalue === '') {
		emailError.innerHTML ='이메일 형식으로 입력해주세요.';
		return false;
	} else if (!emailRegex.test(emailvalue)) {
		emailError.innerHTML ='이메일 형식으로 작성해주세요.';
        return false;
	} else if (emailRegex.test(emailvalue)) {
        emailError.innerHTML ='이메일을 전송했습니다. 잠시 기다려주세요.';
        emailError.classList.add('notice-green');
	}
    let formData = new FormData();
    formData.append('user_email', emailvalue);

    fetch('/emailchkgo', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
        if(data) {
            if( data === '1') {
                alert('이미 존재하는 이메일입니다.');
            } else {
                let emailSendForm = document.getElementById('emailSendForm');
                emailSendForm.innerHTML = '';
                let divCreate = document.createElement('div');
                divCreate.classList.add('email-chk-end');
                divCreate.innerHTML = data;
                let hiddenInput = document.createElement('input');
                hiddenInput.id = 'userEmailSet'
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'user_email');
                hiddenInput.setAttribute('value', data);
                emailSendForm.appendChild(divCreate);
                emailSendForm.appendChild(hiddenInput);
                let verificationcodeBtn = document.getElementById('verificationcodeBtn');
                verificationcodeBtn.removeAttribute('disabled');
                document.getElementById('verificationChkPageFrom').style.display = 'flex';
            }
        }
	})
	.catch(error => {
		console.error(error.stack);
	})
}

let userEmailSetVal = '';

function emailVerifySubmit() {
    
    if(verificationcode === '') {
        emailError.innerHTML ='인증 번호를 입력해주세요.';
		return false;
	} else {
        let verificationcode = document.getElementById('verificationcode').value;
        let userEmailSet = document.getElementById('userEmailSet');
        let userEmailSetVal = userEmailSet.value;

        let formData = new FormData();
        formData.append('user_email', userEmailSetVal);
        formData.append('verificationcode', verificationcode);
    
        fetch('/emailchkset', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = '/registpage/' + encodeURIComponent(data.email);
            } else {
                alert('인증코드를 다시 확인해주세요.');
            }
        })
    }
}
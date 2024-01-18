let allselectcheck = document.getElementById('allselectcheck');
let contents = document.getElementsByClassName('contens-checkbox');
allselectcheck.addEventListener('change', function() {
    for(let i = 0; i < 10; i++) {
        let isChecked = this.checked;
        contents[i].checked = isChecked;
    }
})

let form = document.getElementById('setDeclationFlg');
function setDeclarationflg() {
    form.setAttribute('action', '/admin/temporarilydelete');
    form.submit();
}

function deleteDeclaration() {
    form.setAttribute('action', '/admin/deletedeclarationboard');
    form.submit();
}

let commentform = document.getElementById('CommentSetDeclationFlg');
function deleteDeclarationComment() {
    commentform.setAttribute('action', '/admin/admindeletecomment');
    commentform.submit();
}

function SetCommentFlg() {
    commentform.setAttribute('action', '/admin/setcommentflg');
    commentform.submit();
}

// 신고 내역 조회
let showDeclarationUserFLg = 0;

function showDeclarationUser(data) {
    let trIndex = document.getElementById('setTr'+data).value;

    let formData = new FormData();
	formData.append('board_id', data);

	fetch('/admin/userdeclaration', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => { console.log(data);

        let tbody = document.querySelector('#setDeclarationUserProfile');
        for(let i = data.length-1; i >= 0; i--) {

            let tr = document.createElement('tr');
            let td1 = document.createElement('td');
            let td2 = document.createElement('td');
            let td3 = document.createElement('td');
            let td4 = document.createElement('td');
            let td5 = document.createElement('td');
            td2.setAttribute('colspan', '2');
            td4.setAttribute('colspan', '2');
            td5.setAttribute('colspan', '2');
            td1.innerHTML = i+1;
            td2.innerHTML = data[i].user_name;
            td3.innerHTML = data[i].user_email;
            if (data[i].board_reason_flg == 1) {
                td4.innerHTML = ' 언어폭력';
            } else if ( data[i].board_reason_flg == 2) {
                td4.innerHTML = '사기';
            } else if ( data[i].board_reason_flg == 3) {
                td4.innerHTML = '허위사실 유포';
            } else if ( data[i].board_reason_flg == 4) {
                td4.innerHTML = '스팸';
            } else if ( data[i].board_reason_flg == 5) {
                td4.innerHTML = '불법 또는 규제상품 판매';
            } else if ( data[i].board_reason_flg == 6) {
                td4.innerHTML = '성희롱';
            } else if ( data[i].board_reason_flg == 7) {
                td4.innerHTML = ' 혐오감을 주는 발언 또는 상징';
            } else {
                td4.innerHTML = ' 마음에 들지 않습니다.';
            };
            td5.innerHTML = data[i].created_at

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            let childNum = tbody.children[trIndex]; // n번째 자식
            tbody.insertBefore(tr, childNum.nextSibling);
        }
    })
	.catch(error => {
		console.error(error.stack);
	})
}
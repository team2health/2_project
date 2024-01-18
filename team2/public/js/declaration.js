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
        for(let i = 0; i < data.length; i++) {

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
                td4.innerHTML = '신고사유1';
            } else if ( data[i].board_reason_flg == 2) {
                td4.innerHTML = '신고사유2';
            } else if ( data[i].board_reason_flg == 3) {
                td4.innerHTML = '신고사유3';
            } else if ( data[i].board_reason_flg == 4) {
                td4.innerHTML = '신고사유4';
            } else if ( data[i].board_reason_flg == 5) {
                td4.innerHTML = '신고사유5';
            } else if ( data[i].board_reason_flg == 6) {
                td4.innerHTML = '신고사유6';
            } else if ( data[i].board_reason_flg == 7) {
                td4.innerHTML = '신고사유7';
            } else {
                td4.innerHTML = '신고사유8';
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
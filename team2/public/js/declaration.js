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
    let selectedItems = document.querySelectorAll('input[name="board_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 게시글이 없습니다.');
        return false;
    } else {
        form.setAttribute('action', '/admin/temporarilydelete');
        form.submit();
    }
}

function deleteDeclaration() {
    let selectedItems = document.querySelectorAll('input[name="board_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 게시글이 없습니다.');
        return false;
    } else {
    form.setAttribute('action', '/admin/deletedeclarationboard');
    form.submit();
    }
}

let commentform = document.getElementById('CommentSetDeclationFlg');
function deleteDeclarationComment() {
    let selectedItems = document.querySelectorAll('input[name="comment_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 댓글이 없습니다.');
        return false;
    } else {
        commentform.setAttribute('action', '/admin/admindeletecomment');
        commentform.submit();
    }
}

function SetCommentFlg() {
    let selectedItems = document.querySelectorAll('input[name="comment_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 댓글이 없습니다.');
        return false;
    } else {
        commentform.setAttribute('action', '/admin/setcommentflg');
        commentform.submit();
    }
}

// 신고 내역 조회

// function showDeclarationUser(data) {
//     let trIndex = document.getElementById('setTr'+data).value;

//     let formData = new FormData();
// 	formData.append('board_id', data);

// 	fetch('/admin/userdeclaration', {
// 		method: 'POST',
// 		body: formData,
// 	})
// 	.then(response => response.json())
// 	.then(data => { console.log(data);

//         let tbody = document.querySelector('#setDeclarationUserProfile');
//         for(let i = data.length-1; i >= 0; i--) {

//             let tr = document.createElement('tr');
//             let td1 = document.createElement('td');
//             let td2 = document.createElement('td');
//             let td3 = document.createElement('td');
//             let td4 = document.createElement('td');
//             let td5 = document.createElement('td');
//             td2.setAttribute('colspan', '2');
//             td4.setAttribute('colspan', '2');
//             td5.setAttribute('colspan', '2');
//             td1.innerHTML = i+1;
//             td2.innerHTML = data[i].user_name;
//             td3.innerHTML = data[i].user_email;
//             if (dcontent == 1) {
//                 td4.innerHTML = ' 언어폭력';
//             } else if ( dcontent == 2) {
//                 td4.innerHTML = '사기';
//             } else if ( dcontent == 3) {
//                 td4.innerHTML = '허위사실 유포';
//             } else if ( dcontent == 4) {
//                 td4.innerHTML = '스팸';
//             } else if ( dcontent == 5) {
//                 td4.innerHTML = '불법 또는 규제상품 판매';
//             } else if ( dcontent == 6) {
//                 td4.innerHTML = '성희롱';
//             } else if ( dcontent == 7) {
//                 td4.innerHTML = ' 혐오감을 주는 발언 또는 상징';
//             } else {
//                 td4.innerHTML = ' 마음에 들지 않습니다.';
//             };
//             td5.innerHTML = data[i].created_at

//             tr.appendChild(td1);
//             tr.appendChild(td2);
//             tr.appendChild(td3);
//             tr.appendChild(td4);
//             tr.appendChild(td5);
//             let childNum = tbody.children[trIndex]; // n번째 자식
//             tbody.insertBefore(tr, childNum.nextSibling);
//         }
//     })
// 	.catch(error => {
// 		console.error(error.stack);
// 	})
// }

// 이유 세팅
window.addEventListener('load', function() {
    boardReasonSet();
})

function boardReasonSet() {
    let all = document.querySelectorAll('.user-board-reason-flg');
    
    for (let i = 0; i < all.length; i++) {

        let content = all[i].textContent;

        if (content == 1) {
            all[i].innerHTML = ' 언어폭력';
        } else if ( content == 2) {
            all[i].innerHTML = '사기';
        } else if ( content == 3) {
            all[i].innerHTML = '허위사실 유포';
        } else if ( content == 4) {
            all[i].innerHTML = '스팸';
        } else if ( content == 5) {
            all[i].innerHTML = '불법 또는 규제상품 판매';
        } else if ( content == 6) {
            all[i].innerHTML = '성희롱';
        } else if ( content == 7) {
            all[i].innerHTML = ' 혐오감을 주는 발언 또는 상징';
        } else {
            all[i].innerHTML = ' 마음에 들지 않습니다.';
        };
    }
}

let userInfoShowFlg = 0;
function showDeclarationUser(data) {
    let children = document.querySelectorAll('#childrenTr'+data);
    if(userInfoShowFlg === 0) {
        for (let i = 0; i < children.length; i++) {
            children[i].style.display = '';
            userInfoShowFlg = 1;
        }
    } else {
        for (let i = 0; i < children.length; i++) {
            children[i].style.display = 'none';
            userInfoShowFlg = 0;
        }
    }
}

let userCommentInfoShowFlg = 0;
function showCommentDeclarationUser(data) {
    let children = document.querySelectorAll('#childrenCommentTr'+data);
    if(userCommentInfoShowFlg === 0) {
        for (let i = 0; i < children.length; i++) {
            children[i].style.display = '';
            userCommentInfoShowFlg = 1;
        }
    } else {
        for (let i = 0; i < children.length; i++) {
            children[i].style.display = 'none';
            userCommentInfoShowFlg = 0;
        }
    }
}
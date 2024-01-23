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

window.addEventListener('load', function() {
    addallfavoritetag(); //마이페이지 해시태그 불러오기
});

// 삭제 모달
function recorddeletemodalopen() {
    let modalopen = document.getElementById('mypageFourth');
    modalopen.style.display = 'block';
}

// 삭제 모달 닫기
function deletemodalclose() {
    let modalclose = document.getElementById('mypageFourth');
    modalclose.style.display = 'none';
}

// 삭제 모달 확인 버튼 
function recorddeletebtn() {
    let recorddelete = document.getElementById('recordDeleteTest');
    recorddelete.style.display = 'none';
    deletemodalclose();
}

// 정보 수정 창으로 교체
function userinforupdate() {
    let mypagecontent = document.getElementById('mypageContent');
    mypagecontent.style.display = 'none';

    let userinfomodify = document.getElementById('mypageContent2');
    userinfomodify.style.display = 'block';
}

// 나의 게시글 창으로 교체
let userinfomodify = document.getElementById('mypageContent2');
let mypagecontent = document.getElementById('mypageContent');
let userboardmodal = document.getElementById('UserboardModal');
let mypageContentModal = document.getElementById('mypageContentModal');

function userboardshow() {
        userinfomodify.style.display = 'none';
        mypagecontent.style.display = 'block';

    if ( window.innerWidth <= 700 ) {
        userboardmodal.classList.toggle('UserboardModal');
        mypageContentModal.classList.toggle('mypage-content-modal-block');
        }
}

// 모달창 닫는 버튼
// function mypagemodalclosebtn() {
//     let userboardmodal = document.getElementById('UserboardModal');
//     userboardmodal.classList.toggle('UserboardModal');
//     mypageContentModal.classList.toggle('mypage-content-modal-block');
// }

// 관심 해시태그 삭제 버튼
function favoritehashdelete(data) {

    if ( confirm("삭제하시겠습니까?") ) { 
        alert("삭제되었습니다.");

        let favoritehashtext = document.getElementById('favoritehashtext' + data);
        let favoritehashtextget = favoritehashtext.innerHTML;
        let favoritetag = document.getElementById('favoriteHashtagId'+data);
        favoritetag.remove();

        let deletedfavoritehashtag = document.createElement('div')
        let deletefavoritespan = document.createElement('span');
        
        deletedfavoritehashtag.id = 'allHashtagtext' + data;
        deletefavoritespan.id = 'favoritehashtext'+data;
        deletefavoritespan.setAttribute('value', data );
        deletefavoritespan.setAttribute('onclick', `hashtagFirstCheck(${data})`);
        deletefavoritespan.innerHTML = favoritehashtextget;
        deletedfavoritehashtag.appendChild(deletefavoritespan);
        
        let mypageHashtagOpen = document.getElementById('mypageHashtagOpen');
        if (mypageHashtagOpen) {
            mypageHashtagOpen.prepend(deletedfavoritehashtag);
        }
        
        let formData = new FormData();
        formData.append('myhashdelete', data);

        fetch('/myhashdelete', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)})
        .catch(error => {
            console.error('오류 발생:', error);
        });

    } else {
        //
    } 

    let mypageHashtagChk = document.getElementById('mypageHashtag');
    if (mypageHashtagChk.innerHTML.trim() === '') {
        let noticeThatFavoriteNone = document.createElement('span');
        noticeThatFavoriteNone.id = 'noticeThatFavoriteNone';
        noticeThatFavoriteNone.classList.add('notice-that-favorite-none');
        noticeThatFavoriteNone.innerHTML = '관심태그로 등록한 해시태그가 없습니다.';
        mypageHashtagChk.appendChild(noticeThatFavoriteNone);
    }
}

// let addallfavoritetagevent = document.getElementById('addallfavoritetag');
// let favoriteFlg = 0;
// let addallfavoritetagtext = document.getElementById('addallfavoritetag');
// addallfavoritetagtext.innerHTML = '';
// addallfavoritetagtext.innerHTML = '관심태그 추가하기';

// // 관심 해시태그 추가 창 열기
// addallfavoritetagevent.addEventListener('click', function(){
//     if( favoriteFlg == 0) {
//         addallfavoritetag();
//         addallfavoritetagevent.removeEventListener('click', addallfavoritetag);
//         favoriteFlg = '1';
//     }
//     if ( favoriteFlg == 1 ) {
//         addallfavoritetagevent.addEventListener('click', closeoption);
//         addallfavoritetagtext.innerHTML = '';
//         addallfavoritetagtext.innerHTML = '닫기 ';
//     }
// });

// 해시태그 테스트
let targetArray = [];
function setArrayHash(data){
    let TargetValueHash = document.getElementById('favoritehashtext'+data).value;
    targetArray = TargetValueHash;
}

// 관심 해시태그 목록 불러오기 및 추가
function addallfavoritetag() {
    let createtagmaindiv = document.createElement('div');
    let createplustag = document.createElement('div');
    createplustag.classList.add('mypage-hashtag');
    createplustag.id = 'mypageHashtagOpen'
    let addtagbtndiv = document.createElement('mypage-btn-line');
    // let hashplusokbtn = document.createElement('span');
    // let hashplusclosebtn = document.createElement('span');
    addtagbtndiv.classList.add('mypage-btn-line');
    createtagmaindiv.id = 'creaTagMainDiv';
    createtagmaindiv.classList.add('create-tag-main-div');
    // hashplusokbtn.innerHTML = '저장';
    // hashplusclosebtn.innerHTML = '닫기';
    // hashplusokbtn.classList.add('mypage-btn');
    // hashplusclosebtn.classList.add('mypage-btn');

    fetch('/allhashtag')
    .then(response => response.json())
    .then(data => {

        for(let i = 0; i < data.length; i++) {
            let hashtagdiv = document.createElement('div');
            let hashspan = document.createElement('span');
            hashtagdiv.id = 'allHashtagId'+data[i].hashtag_id;
            // hashplusbtn.setAttribute("value", data[i].hashtag_id);
            hashspan.setAttribute('onclick', `hashtagFirstCheck(${data[i].hashtag_id})`);
            hashspan.id = 'allHashtagtext'+ data[i].hashtag_id;
            hashspan.setAttribute('value', data[i].hashtag_id);
            hashspan.innerHTML = data[i].hashtag_name;
            hashtagdiv.appendChild(hashspan);
            createplustag.appendChild(hashtagdiv);

        }
        let mypageTagTitle = document.getElementById('mypageCanGetAllTag');
        mypageTagTitle.appendChild(createtagmaindiv);
        createtagmaindiv.appendChild(createplustag);
        // addtagbtndiv.appendChild(hashplusokbtn);
        // addtagbtndiv.appendChild(hashplusclosebtn);
        createtagmaindiv.appendChild(addtagbtndiv);
        
        // let noticeThatFavoriteNone = document.createElement('noticeThatFavoriteNone');
        // if (noticeThatFavoriteNone) {
        //     noticeThatFavoriteNone.remove();
        // }


    })
    .catch(error => console.error(error));
    
    // hashplusclosebtn.addEventListener('click', closeoption);
    // hashplusokbtn.addEventListener('click', closeoption);

}

let hashtagIdGet = '';

// 관심 해시태그 추가
function addhashtag(data) {

    let deleteNotice = document.getElementById('noticeThatFavoriteNone');
    if (deleteNotice) {
        deleteNotice.remove();
    }

    let formData = new FormData();
    formData.append('tag_id', data);

    // 추가할 해시태그 가져오기
    if(document.getElementById('allHashtagId'+data)) {
        let allhashtag = document.getElementById('allHashtagId'+data);
        allhashtag.remove();
    }
    // let deletefavoritehashtext = document.getElementById('allHashtagtext'+data).value;
    let mypageHashtag = document.getElementById('mypageHashtag');
    let deletedfavoritehashtag = document.createElement('div')
    let makefavoritespan = document.createElement('span');

    fetch('/addfavoritehashtag', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {

        // 즉시 추가
        deletedfavoritehashtag.id = 'favoriteHashtagId' + data[0].hashtag_id;
        makefavoritespan.id = 'favoritehashtext'+data[0].hashtag_id;
        makefavoritespan.setAttribute('value', data[0].hashtag_id );
        makefavoritespan.setAttribute('onclick', `favoritehashdelete(${data[0].hashtag_id})`);
        makefavoritespan.innerHTML = data[0].hashtag_name;
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });

    deletedfavoritehashtag.appendChild(makefavoritespan);
    mypageHashtag.appendChild(deletedfavoritehashtag);
    
}


// value값 변경해야함

let nameChk = document.getElementById('usermodifyname');
let nameChkc = nameChk.value;
let NAMEINFOBTN = document.getElementById('name-info-btn');
let regex = /^[가-힣a-zA-Z0-9]{2,}$/;
let imgFlg = 0;
let nameflg = 0;
let nameinput = 0;
let namechkflg = 0;

NAMEINFOBTN.style.visibility = 'hidden';

nameChk.addEventListener('input', function() {
    namechkflg = 0;

    if(nameinput === 0) {
        nameinput = 1;
        NAMEINFOBTN.style.visibility = 'visible';
    }

    if(document.getElementById('usermodifyname').value === nameChkc) {
        nameinput = 0;
        NAMEINFOBTN.style.visibility = 'hidden';
    }

});

function nameChange() {
	if(nameChk.value === '') {
		alert('닉네임을 입력해주세요');
		return false;
	} else if(!regex.test(nameChk.value)) {
        alert('닉네임을 다시 확인해주세요.');
        return false;
    }

	const formData = new FormData();
	formData.append('user_name', nameChk.value);
	fetch('/namechange', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		if(data['namechange'] === '0') {
			alert('사용가능한 닉네임 입니다.');
            nameflg = 0;
		} else if(data['namechange'] === '1') {
			alert('이미 존재하는 닉네임 입니다.');
            nameflg = 1;
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
    namechkflg = 1;
}

let fileInput = document.getElementById('profilephoto');
let userImgUrl = document.getElementById('user-img-url');
let PROFILEPHOTOVIEW = document.getElementById('profilephotoview');

fileInput.addEventListener('change', function() {
    if (!fileInput.files[0].type.startsWith('image')) {
        imgFlg = 2;
        PROFILEPHOTOVIEW.style.backgroundImage = "url(/img/default_f.png)";

        userImgUrl.innerHTML = '이미지만 선택 가능합니다.';
        document.getElementById('user-info-img-remove').style.visibility = 'visible';
        return false;
    }
    
    if (fileInput.files[0].size / 1048576 > 5) {
        imgFlg = 2;
        
        userImgUrl.innerHTML = '이미지의 용량이 너무 큽니다.';
        PROFILEPHOTOVIEW.style.backgroundImage = "url(/img/default_f.png)";
        document.getElementById('user-info-img-remove').style.visibility = 'visible';

        return false;
    }

    userImgUrl.innerHTML = '';
    userImgUrl.innerHTML = fileInput.files[0].name;
    if (fileInput.files.length > 0) {
        imgFlg = 1;
    }

    var file = fileInput.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        PROFILEPHOTOVIEW.style.backgroundImage = `url(${reader.result})`;
    };

    if (file) {
        reader.readAsDataURL(file);
    }

    document.getElementById('user-info-img-remove').style.visibility = 'visible';
});

function userimgremove() {
    imgFlg = 2;
    userImgUrl.innerHTML = '';
    userImgUrl.innerHTML = '사진이 삭제되었습니다.';
    
    document.getElementById('user-info-img-remove').style.visibility = 'hidden';
    PROFILEPHOTOVIEW.style.backgroundImage = "url(/img/default_f.png)";
}

function userinfoupdate() {
    if(nameinput === 1) {
        if(nameChk.value === '') {
            alert('닉네임을 입력해주세요');
            return false;
        } 
        if(namechkflg === 0) {
            alert('닉네임 중복체크를 해주세요.');
            return false;
        }
        if(nameflg === 1) {
            alert('사용 중인 아이디입니다.\n아이디를 다시 입력해주세요.');
            return false;
        }
    }

    let IMGFLG = document.getElementById('imgflg');
    IMGFLG.setAttribute('value', imgFlg);

	document.getElementById('userinfo_form').submit();
}

// 게시글 탭
const tab = document.querySelector(".tab");
// const tabListItem = document.querySelectorAll(".mypage-board-show-btn");
const firstTab = document.getElementById('tabBtnFirst');
const secondTab = document.getElementById('tabBtnSecond');
const tabContent1 = document.querySelectorAll(".tab-contents");
const tabContent2 = document.querySelectorAll(".tab-contents2");
const data1 = document.querySelectorAll('[data-order="1"]');
const data2 = document.querySelectorAll('[data-order="2"]');

let tabflg = 1;
firstTab.addEventListener('click', function () {
    if(tabflg === 2) {
            data1.forEach(element => {
                // element.style.display = 'block';
                element.classList.add('tab-show');
            });
            data2.forEach(element => {
                // element.style.display = 'none';
                element.classList.remove('tab-show');

            });
        firstTab.classList.add('timeline-active');
        secondTab.classList.remove('timeline-active');
        tabflg = 1;
    } 
})

secondTab.addEventListener('click', function () {
    if (tabflg === 1) {
            data2.forEach(element => {
                // element.style.display = 'block';
                element.classList.add('tab-show');
            });
            data1.forEach(element => {
                // element.style.display = 'none';
                element.classList.remove('tab-show');
            });
        firstTab.classList.remove('timeline-active');
        secondTab.classList.add('timeline-active');
        tabflg = 2;
    }
})


// 게시글 더보기
function plusMypageBoard() {
    
    let mypageContent = document.getElementById('mypageBoard');
    let lastSpanSelect = document.querySelectorAll('#mypageBoard .mypage-board-date');
    let lastSpanDate = lastSpanSelect[lastSpanSelect.length - 1].innerHTML;
    let boardId = document.getElementById('mypageBoardPlusBtn').value;

    let formData = new FormData();
    formData.append('lastboardid', boardId);

    fetch('/mypageboardplus', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
            for (let i = 0; i < data.length; i++) {
                let boardTitlePlus = data[i].board_title;
                let boardContentPlus = data[i].board_content;
                
                // 글자 자르기
                if (data[i].board_title.length > 30) {
                    boardTitlePlus.substring(0, 30) + '...';
                }
                if (data[i].board_content.length > 75) {
                    boardContentPlus.substring(0, 75) + '...';
                }

                if(data[0].created_at !== lastSpanDate && i == 0) {
                    let createdAt = data[0].created_at;
                    let mypageDateToday = document.createElement('div');
                    mypageDateToday.classList.add('mypage-date-today');
                    let mypageBoardDate = document.createElement('span');
                    mypageBoardDate.classList.add('mypage-board-date');
                    mypageBoardDate.innerHTML = createdAt;

                    mypageDateToday.appendChild(mypageBoardDate);
                    mypageContent.appendChild(mypageDateToday);
                } 
                if(i > 0) {
                    if(data[i-1].created_at !== data[i].created_at) {
                        let mypageDateToday = document.createElement('div');
                        mypageDateToday.classList.add('mypage-date-today');
                        let mypageBoardDate = document.createElement('span');
                        mypageBoardDate.classList.add('mypage-board-date');
                        mypageBoardDate.innerHTML = data[i].created_at;

                        mypageDateToday.appendChild(mypageBoardDate);
                        mypageContent.appendChild(mypageDateToday);
                    } 
                }

                // 게시글
                let outATag = document.createElement('a');
                let outDiv = document.createElement('div');
                let inFirstDiv = document.createElement('div');
                let inSecondDiv = document.createElement('div');

                outATag.setAttribute('href', '/board/'+data[i].board_id);
                outDiv.classList.add('mypage-boardbox');
                inFirstDiv.classList.add('mypage-bord-title');
                inFirstDiv.innerHTML = boardTitlePlus;
                inSecondDiv.classList.add('mypage-bord-detailbox');
                inSecondDiv.innerHTML = boardContentPlus;

                outDiv.appendChild(inFirstDiv);
                outDiv.appendChild(inSecondDiv);
                outATag.appendChild(outDiv);
                mypageContent.appendChild(outATag);

            }
            let boardValueSet = document.getElementById('mypageBoardPlusBtn');
            boardValueSet.value = '';
            boardValueSet.value = data[data.length-1].board_id;
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });
}

// 댓글 더보기
function plusMypageComment() {

    let mypageCommentPlus = document.getElementById('mypageCommentPlus');
    let commentId = document.getElementById('mypageCommentPlustBtn').value;

    let formData = new FormData();
    formData.append('lastboardid', commentId);

    fetch('/mypagecommentplus', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {

        let mypageCommentPlustBtn = document.getElementById('mypageCommentPlustBtn');
        
        for(let i = 0; i < data.length; i++) {

            let boardTitlePlus = data[i].board_title;
            let comment = data[i].comment_content;
            
            // 글자 자르기
            if (data[i].board_title.length > 30) {
                return boardTitlePlus.substring(0, 30) + '...';
            }
            if (data[i].comment_content.length > 75) {
                return comment.substring(0, 75) + '...';
            }
            
            let aTag = document.createElement('a');
            let outDiv = document.createElement('div');
            let createDate = document.createElement('span');
            let boardTitle = document.createElement('div');
            let commentIn = document.createElement('div');
            
            aTag.setAttribute('href', '/board/'+data[i].board_id);
            outDiv.classList.add('mypage-boardbox');
            createDate.classList.add('mypage-boardbox-date');
            createDate.innerHTML = data[i].created_at;
            boardTitle.innerHTML = boardTitlePlus;
            boardTitle.classList.add('mypage-bord-title');
            commentIn.innerHTML = comment;
            commentIn.classList.add('mypage-bord-detailbox');

            outDiv.appendChild(createDate);
            outDiv.appendChild(boardTitle);
            outDiv.appendChild(commentIn);
            aTag.appendChild(outDiv);
            mypageCommentPlus.appendChild(aTag);

            mypageCommentPlustBtn.value = '';
            mypageCommentPlustBtn.value = data[i].board_id;
        }
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });
}


// 게시글 모달 더보기

function plusMypageBoardModal() {
    let mypageContent = document.getElementById('mypageModalBoard');
    let lastSpanSelect = document.querySelectorAll('#mypageModalBoard .mypage-date-today-modal');
    let lastSpanDate = lastSpanSelect[lastSpanSelect.length - 1].innerHTML;
    let boardId = document.getElementById('mypageModalBoardBtn').value;

    let formData = new FormData();
    formData.append('lastboardid', boardId);

    fetch('/mypageboardplus', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
            for (let i = 0; i < data.length; i++) {
                let boardTitlePlus = data[i].board_title;
                let boardContentPlus = data[i].board_content;
                
                // 글자 자르기
                if (data[i].board_title.length > 30) {
                    boardTitlePlus.substring(0, 30) + '...';
                }
                if (data[i].board_content.length > 75) {
                    boardContentPlus.substring(0, 75) + '...';
                }

                if(data[0].created_at !== lastSpanDate && i == 0) {
                    let createdAt = data[0].created_at;
                    let mypageDateToday = document.createElement('div');
                    mypageDateToday.classList.add('mypage-date-today-modal');
                    let mypageBoardDate = document.createElement('span');
                    mypageBoardDate.classList.add('mypage-board-date-modal');
                    mypageBoardDate.innerHTML = createdAt;

                    mypageDateToday.appendChild(mypageBoardDate);
                    mypageContent.appendChild(mypageDateToday);
                } 
                if(i > 0) {
                    if(data[i-1].created_at !== data[i].created_at) {
                        let mypageDateToday = document.createElement('div');
                        mypageDateToday.classList.add('mypage-date-today-modal');
                        let mypageBoardDate = document.createElement('span');
                        mypageBoardDate.classList.add('mypage-board-date-modal');
                        mypageBoardDate.innerHTML = data[i].created_at;

                        mypageDateToday.appendChild(mypageBoardDate);
                        mypageContent.appendChild(mypageDateToday);
                    } 
                }

                // 게시글
                let outATag = document.createElement('a');
                let outDiv = document.createElement('div');
                let inFirstDiv = document.createElement('div');
                let inSecondDiv = document.createElement('div');

                outATag.setAttribute('href', '/board/'+data[i].board_id);
                outDiv.classList.add('mypage-boardbox-modal');
                inFirstDiv.classList.add('mypage-bord-title');
                inFirstDiv.innerHTML = boardTitlePlus;
                inSecondDiv.classList.add('mypage-bord-detailbox');
                inSecondDiv.innerHTML = boardContentPlus;

                outDiv.appendChild(inFirstDiv);
                outDiv.appendChild(inSecondDiv);
                outATag.appendChild(outDiv);
                mypageContent.appendChild(outATag);

            }
            let boardValueSet = document.getElementById('mypageModalBoardBtn');
            boardValueSet.value = '';
            boardValueSet.value = data[data.length-1].board_id;
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });
}

// 댓글 모달 더보기
function plusMypageCommentModal() {
    let mypageCommentPlus = document.getElementById('mypageCommentModalPlus');
    let commentId = document.getElementById('mypageModalCommentBtn').value;

    let formData = new FormData();
    formData.append('lastboardid', commentId);

    fetch('/mypagecommentplus', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {

        let mypageCommentPlustBtn = document.getElementById('mypageModalCommentBtn');
        
        for(let i = 0; i < data.length; i++) {

            let boardTitlePlus = data[i].board_title;
            let comment = data[i].comment_content;
            
            // 글자 자르기
            if (data[i].board_title.length > 30) {
                return boardTitlePlus.substring(0, 30) + '...';
            }
            if (data[i].comment_content.length > 75) {
                return comment.substring(0, 75) + '...';
            }
            
            let aTag = document.createElement('a');
            let outDiv = document.createElement('div');
            let createDate = document.createElement('span');
            let boardTitle = document.createElement('div');
            let commentIn = document.createElement('div');
            
            aTag.setAttribute('href', '/board/'+data[i].board_id);
            outDiv.classList.add('mypage-boardbox-modal');
            createDate.classList.add('mypage-boardbox-date');
            createDate.innerHTML = data[i].created_at;
            boardTitle.innerHTML = boardTitlePlus;
            boardTitle.classList.add('mypage-bord-title');
            commentIn.innerHTML = comment;
            commentIn.classList.add('mypage-bord-detailbox');

            outDiv.appendChild(createDate);
            outDiv.appendChild(boardTitle);
            outDiv.appendChild(commentIn);
            aTag.appendChild(outDiv);
            mypageCommentPlus.appendChild(aTag);

            mypageCommentPlustBtn.value = '';
            mypageCommentPlustBtn.value = data[i].board_id;
        }
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });
}

// 마이페이지 모든 항목 display none 함수
function deleteMypageBtnAll() {
    let mypageProfile = document.getElementById('mypageProfile');
    let mypageMyInfo = document.querySelectorAll('.mypage-main-btn');
    let mypageGap = document.getElementById('mypageGap');
    let mypageLogout = document.getElementById('mypageLogoutBtn');
    let mypageMainBtn = document.getElementById('mypageMainBtn');
    mypageMyInfo.forEach(function (element) {
        element.classList.add('mypage-display-none');
    });

    mypageProfile.classList.add('mypage-display-none');
    mypageMainBtn.classList.add('mypage-display-none');
    mypageGap.classList.add('mypage-display-none');
    mypageLogout.classList.add('mypage-display-none');
}

// 나의 해시태그 목록 불러오기
function canDeleteHashLoad() {
    deleteMypageBtnAll();
    let mypageHashtagAll = document.getElementById('mypageHashtagAll');
    mypageHashtagAll.classList.remove('mypage-display-none');
}


function hashtagNoneDisplay() {
    // 나의 해시태그 출력
let showMyHashtagAll = document.getElementById('showMyHashtagAll');
let showMyHashtagAllFlg = showMyHashtagAll.value;
    let mypageHashtag = document.getElementById('mypageHashtag'); 
    if(showMyHashtagAllFlg == 0) { 
        mypageHashtag.style = '';
        showMyHashtagAll.value = 1;
    } else if (showMyHashtagAllFlg == 1) {
        mypageHashtag.style.display = 'none';
        showMyHashtagAll.value = 0;
    }
}

// 나의 게시물 불러오기
function goToMyBoard() {
    deleteMypageBtnAll();
    let mypageMyInfoThird = document.getElementById('mypageMyInfoThird');
    mypageMyInfoThird.classList.remove('mypage-display-none');
}

// 스크롤바   
window.addEventListener("scroll", function() {
        let topBar = document.getElementById("topBar");
        let scrollPosition = window.scrollY;

        // 특정 스크롤 좌표 이후에 fixed 스타일 적용
        if (scrollPosition > 200) {
            topBar.classList.add("tab-list-fixed");
        } else {
            topBar.classList.remove("tab-list-fixed");
        }
    });

// 정보수정창으로 이동
function setNewInfo() {
    deleteMypageBtnAll();
    let mypagemyInfoMain = document.getElementById('mypagemyInfoMain');
    let UserAccountDelete = document.getElementById('UserAccountDelete');
    let mypageGap2 = document.getElementById('mypageGap2');
    mypagemyInfoMain.classList.remove('mypage-display-none');
    UserAccountDelete.classList.remove('mypage-display-none');
    mypageGap2.classList.remove('mypage-display-none');
}

// 프로필 변경창
function myprofileChange() {
    deleteMypageBtnAll();
    let mypageProfileChange = document.getElementById('mypageProfileChange');
    let mypageGap3 = document.getElementById('mypageGap3');
    let mypageMyInfoThird = document.getElementById('mypageMyInfoThird');
    if (!mypageMyInfoThird.classList.contains('mypage-display-none')) {
        mypageMyInfoThird.classList.add('mypage-display-none');
    }
    mypageProfileChange.classList.remove('mypage-display-none');
    mypageGap3.classList.remove('mypage-display-none');
}

// 비밀번호 변경창 열기
// function setNewPassword() {
//     deleteMypageBtnAll();
//     let passwordChangeFirstChk = document.getElementById('passwordChangeFirstChk');
//     passwordChangeFirstChk.classList.remove('mypage-display-none');
// }

// function passwordChangeChk() {

// }

// 회원탈퇴 창으로 이동
function goToDeleteIdZone() {
    let goToDeleteIdZoneDiv = document.getElementById('goToDeleteIdZone');
    let mypagemyInfoMain = document.getElementById('mypagemyInfoMain');
    let UserAccountDelete = document.getElementById('UserAccountDelete');
    let mypageGap2 = document.getElementById('mypageGap2');
    let passwordFirstChk = document.getElementById('passwordFirstChk');
    mypagemyInfoMain.classList.add('mypage-display-none');
    UserAccountDelete.classList.add('mypage-display-none');
    mypageGap2.classList.add('mypage-display-none');
    goToDeleteIdZoneDiv.classList.add('mypage-display-none');
    passwordFirstChk.classList.remove('mypage-display-none');
}

// 해시태그 검색 폼 submit
// 엔터키로 작동
let submitSearchHashBtn = document.getElementById("submitSearchHashBtn");
submitSearchHashBtn.addEventListener("keyup", function(event) {
    if (event.key === "Enter" || event.keyCode == 13) {
        submitSearchHash();
    }
});


function hashtagFirstCheck(data) {

    let hashId = data;
    // let formData = new FormData();
    // formData.append('hashsearch', data);

    let hashtagId = document.getElementById('allHashtagId' + data);
    hashtagId.remove();
    addhashtag(hashId);
    // fetch('/hashtagcheck', {
    //     method: 'POST',
    //     body: formData
    // })
    // .then(response => response.json())
    // .then(data => { 
    //     if (data == '1') {
    //         alert('이미 추가된 해시태그 입니다.')
    //         return false;
    //     } else if ( data == '2') {

    //     }
    // })
    // .catch(error => {
    //     console.error('Error:', error);
    // });
}

function submitSearchHash() {
    let searchHashResult = document.getElementById('searchHashResult');

    while (searchHashResult.firstChild) {
        searchHashResult.removeChild(searchHashResult.firstChild);
    }
    let formData = new FormData(document.getElementById('mypageHastagSearchForm'));
    let hashsearch = document.getElementById('hashsearch').value;
    formData.append('hashsearch', hashsearch);

    fetch('/hashtagsearch', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if(data == 'nodata') {
            let creatediv = document.createElement('div');
            creatediv.innerHTML = '검색결과가 없습니다.'
            creatediv.id = 'noSearchData';
            creatediv.style.gridColumnStart = '1';
            creatediv.style.gridColumnEnd = '4';
            creatediv.style.backgroundColor = '#e0eaff';
            creatediv.style.width = '100%';
            creatediv.style.justifyContent = 'center';
            creatediv.style.alignItems = 'center';

            searchHashResult.appendChild(creatediv);
        } else {
            for (let i = 0; i < data.length; i++) {
                let hashtagdiv = document.createElement('div');
                let hashspan = document.createElement('span');
                hashtagdiv.id = 'allHashtagId'+data[i].hashtag_id;
                // hashplusbtn.setAttribute("value", data[i].hashtag_id);
                hashspan.setAttribute('onclick', `hashtagFirstCheck(${data[i].hashtag_id})`);
                hashspan.id = 'allHashtagtext'+ data[i].hashtag_id;
                hashspan.setAttribute('value', data[i].hashtag_id);
                hashspan.innerHTML = data[i].hashtag_name;
                hashtagdiv.appendChild(hashspan);
                searchHashResult.appendChild(hashtagdiv);
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    

}
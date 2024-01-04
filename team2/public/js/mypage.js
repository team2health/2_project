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
    mypagemodalclosebtn(); //모달창 닫기
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
let mypageTagTitle = document.getElementById('mypageTagTitle2');

function userboardshow() {
        userinfomodify.style.display = 'none';
        mypagecontent.style.display = 'block';

    if ( window.innerWidth <= 700 ) {
        userboardmodal.classList.toggle('UserboardModal');
        mypageContentModal.classList.toggle('mypage-content-modal-block');
        }
}

// 모달창 닫는 버튼
function mypagemodalclosebtn() {
    let userboardmodal = document.getElementById('UserboardModal');
    userboardmodal.classList.toggle('UserboardModal');
    mypageContentModal.classList.toggle('mypage-content-modal-block');
}

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
        let deletefavoritespan2 = document.createElement('span');
        
        deletedfavoritehashtag.id = 'allHashtagtext' + data;
        deletefavoritespan.id = 'favoritehashtext'+data;
        deletefavoritespan.setAttribute('value', data );
        deletefavoritespan2.setAttribute('onclick', `addhashtag(${data})`);
        deletefavoritespan.innerHTML = favoritehashtextget;
        deletefavoritespan2.innerHTML = 'x';
        deletedfavoritehashtag.appendChild(deletefavoritespan);
        deletedfavoritehashtag.appendChild(deletefavoritespan2);
        
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

let addallfavoritetagevent = document.getElementById('addallfavoritetag');
let favoriteFlg = 0;
let addallfavoritetagtext = document.getElementById('addallfavoritetag');
addallfavoritetagtext.innerHTML = '';
addallfavoritetagtext.innerHTML = '관심태그 추가하기';

// 관심 해시태그 추가 창 열기
addallfavoritetagevent.addEventListener('click', function(){
    if( favoriteFlg == 0) {
        addallfavoritetag();
        addallfavoritetagevent.removeEventListener('click', addallfavoritetag);
        favoriteFlg = '1';
    }
    if ( favoriteFlg == 1 ) {
        addallfavoritetagevent.addEventListener('click', closeoption);
        addallfavoritetagtext.innerHTML = '';
        addallfavoritetagtext.innerHTML = '닫기 ';
    }
});

// 해시태그 테스트
let targetArray = [];
function setArrayHash(data){
    let TargetValueHash = document.getElementById('favoritehashtext'+data).value;
    targetArray = TargetValueHash;
}
// 관심 해시태그 추가 창 닫기
function closeoption(){
    if(
        document.getElementById('creaTagMainDiv')
    ) {
        let createtagmaindiv = document.getElementById('creaTagMainDiv');
        addallfavoritetagtext.innerHTML = '';
        addallfavoritetagtext.innerHTML = '관심태그 추가하기 ';
        createtagmaindiv.remove();
        favoriteFlg = '0';
    }
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
            let hashplusbtn = document.createElement('span');
            hashtagdiv.id = 'allHashtagId'+data[i].hashtag_id;
            // hashplusbtn.setAttribute("value", data[i].hashtag_id);
            hashplusbtn.innerHTML = '+';
            hashplusbtn.setAttribute('onclick', `addhashtag(${data[i].hashtag_id})`);
            hashspan.id = 'allHashtagtext'+ data[i].hashtag_id;
            hashspan.setAttribute('value', data[i].hashtag_id);
            hashspan.innerHTML = data[i].hashtag_name;
            hashtagdiv.appendChild(hashspan);
            hashtagdiv.appendChild(hashplusbtn);
            createplustag.appendChild(hashtagdiv);

        }
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
    let allHashtagId = document.getElementById('allHashtagId'+data);
    allHashtagId.remove();
    // let deletefavoritehashtext = document.getElementById('allHashtagtext'+data).value;
    let mypageHashtag = document.getElementById('mypageHashtag');
    let deletedfavoritehashtag = document.createElement('div')
    let makefavoritespan = document.createElement('span');
    let makefavoritespan2 = document.createElement('span');

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
        makefavoritespan2.setAttribute('onclick', `favoritehashdelete(${data[0].hashtag_id})`);
        makefavoritespan.innerHTML = data[0].hashtag_name;
        makefavoritespan2.innerHTML = 'x';
    })
    .catch(error => {
        console.error('오류 발생:', error);
    });

    deletedfavoritehashtag.appendChild(makefavoritespan);
    deletedfavoritehashtag.appendChild(makefavoritespan2);
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
const tabListItem = document.querySelectorAll(".mypage-board-show-btn");
const firstTab = tabListItem[0];
const secondTab = tabListItem[1];
const tabContent1 = document.querySelectorAll(".tab-contents");
const tabContent2 = document.querySelectorAll(".tab-contents2");
const data1 = document.querySelectorAll('[data-order="1"]');
const data2 = document.querySelectorAll('[data-order="2"]');

let tabflg = 1;

firstTab.addEventListener('click', function () {
    if(tabflg === 2) {
            data1.forEach(element => {
                element.style.display = 'block';
            });
            data2.forEach(element => {
                element.style.display = 'none';
            });
        firstTab.classList.add('active');
        secondTab.classList.remove('active');
        tabflg = 1;
    } 
})

secondTab.addEventListener('click', function () {
    if (tabflg === 1) {
            data2.forEach(element => {
                element.style.display = 'block';
            });
            data1.forEach(element => {
                element.style.display = 'none';
            });
        firstTab.classList.remove('active');
        secondTab.classList.add('active');
        tabflg = 2;
    }
})


// 모달 탭

const tabModal = document.querySelector(".tab-modal");
const tabListItemModal = document.querySelectorAll(".mypage-board-modal-btn");
const modalfirstTab = tabListItemModal[0];
const modalsecondTab = tabListItemModal[1];
const modaltabContent1 = document.querySelectorAll(".tab-contents-modal");
const modaltabContent2 = document.querySelectorAll(".tab-contents-modal2");
const modaldata1 = document.querySelectorAll('[data-order="3"]');
const modaldata2 = document.querySelectorAll('[data-order="4"]');

let modaltabflg = 3;

modalfirstTab.addEventListener('click', function () {
    if(modaltabflg === 4) {
            modaldata1.forEach(element => {
                element.style.display = 'block';
            });
            modaldata2.forEach(element => {
                element.style.display = 'none';
            });
            modalfirstTab.classList.add('tab-active');
            modalsecondTab.classList.remove('tab-active');
        modaltabflg = 3;
    } 
})

modalsecondTab.addEventListener('click', function () {
    if (modaltabflg === 3) {
            modaldata2.forEach(element => {
                element.style.display = 'block';
            });
            modaldata1.forEach(element => {
                element.style.display = 'none';
            });
            modalfirstTab.classList.remove('tab-active');
            modalsecondTab.classList.add('tab-active');
        modaltabflg = 4;
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

// 마이페이지 모든 버튼 삭제하는 함수
function deleteMypageBtnAll() {
    let mypageProfile = document.getElementById('mypageProfile');
    let mypageMyInfo = document.querySelectorAll('.mypage-main-btn');
    let mypageGap = document.getElementById('mypageGap');
    let mypageLogout = document.getElementById('mypageLogout');
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
// 해시태그 검색

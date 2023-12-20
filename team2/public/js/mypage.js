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
let mypageTagTitle = document.getElementById('mypageTagTitle');

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

// 관심태그 삭제 버튼
function favoritehashdelete(data) {

    if ( confirm("삭제하시겠습니까?") ) { 
        alert("삭제되었습니다.");
        let favoritetag = document.getElementById('favoriteHashtagId'+data);
        favoritetag.style.display = 'none';

        let formData = new FormData();
        formData.append('favorite_id', data);
        // 즉시 추가
        let deletefavoritehashtext = document.getElementById('favoritehashtext'+data).value;
        let mypageHashtag = document.getElementById('mypageHashtagOpen');
        let deletedfavoritehashtag = document.createElement('div')
        let deletefavoritespan = document.createElement('span');
        let deletefavoritespan2 = document.createElement('span');
    
        deletedfavoritehashtag.id = 'allHashtagtext' + data;
        deletefavoritespan.id = 'favoritehashtext'+data;
        deletefavoritespan.setAttribute('value', deletefavoritehashtext );
        deletefavoritespan2.setAttribute('onclick', `addhashtag(${data})`);
        deletefavoritespan.innerHTML = `${deletefavoritehashtext}`;
        deletefavoritespan2.innerHTML = 'x';
        deletedfavoritehashtag.appendChild(deletefavoritespan);
        deletedfavoritehashtag.appendChild(deletefavoritespan2);
        mypageHashtag.appendChild(deletedfavoritehashtag);
        
        fetch('/myhashdelete', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)})
        .catch(error => console.log(error));

    } else {
        // 취소 클릭시 false 가 리턴 되어 실행​    
    } 
}

let addallfavoritetagevent = document.getElementById('addallfavoritetag');


addallfavoritetagevent.addEventListener('click', function(){
    addallfavoritetag();
    addallfavoritetagevent.removeEventListener('click', addallfavoritetag);
    let createtagmaindiv = document.getElementById('creaTagMainDiv');
    createtagmaindiv.style.display = 'block';
});

// 관심 해시태그 목록 불러오기
function addallfavoritetag() {
    let createtagmaindiv = document.createElement('div');
    let createplustag = document.createElement('div');
    createplustag.classList.add('mypage-hashtag');
    createplustag.id = 'mypageHashtagOpen'
    let addtagbtndiv = document.createElement('mypage-btn-line');
    let hashplusokbtn = document.createElement('span');
    let hashplusclosebtn = document.createElement('span');
    addtagbtndiv.classList.add('mypage-btn-line');
    createtagmaindiv.id = 'creaTagMainDiv';
    hashplusokbtn.innerHTML = '저장';
    hashplusclosebtn.innerHTML = '취소';
    hashplusokbtn.classList.add('mypage-btn');
    hashplusclosebtn.classList.add('mypage-btn');

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
                hashspan.setAttribute('value', data[i].hashtag_name);
                hashspan.innerHTML = data[i].hashtag_name;
                hashtagdiv.appendChild(hashspan);
                hashtagdiv.appendChild(hashplusbtn);
                createplustag.appendChild(hashtagdiv);

        }
        mypageTagTitle.appendChild(createtagmaindiv);
        createtagmaindiv.appendChild(createplustag);
        addtagbtndiv.appendChild(hashplusokbtn);
        addtagbtndiv.appendChild(hashplusclosebtn);
        createtagmaindiv.appendChild(addtagbtndiv);
    })
    .catch(error => console.error(error));
    
    hashplusclosebtn.addEventListener('click', closeoption);

}


// 관심 해시태그 추가 창 닫기
function closeoption(){
    let createtagmaindiv = document.getElementById('creaTagMainDiv');
    createtagmaindiv.style.display = 'none';
}

// 관심 해시태그 추가
function addhashtag(data) {
    let formData = new FormData();
    formData.append('tag_id', data);
    
    let deletefavoritehashtext = document.getElementById('allHashtagtext'+data).value;
    let allHashtagId = document.getElementById('allHashtagId'+data);
    allHashtagId.remove();
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
        console.log(data[0]);
        // console.log(data.hash_id);
        // console.log(data.hash_name);
        // 즉시 추가
        deletedfavoritehashtag.id = 'favoriteHashtagId' + data[0].hashtag_id;
        makefavoritespan.id = 'favoritehashtext'+data[0].hashtag_id;
        makefavoritespan.setAttribute('value', deletefavoritehashtext );
        makefavoritespan2.setAttribute('onclick', `favoritehashdelete(${data[0].hashtag_id})`);
        makefavoritespan.innerHTML = data[0].hashtag_name;
        makefavoritespan2.innerHTML = 'x';
    })
    .catch(error => console.log(error));

    deletedfavoritehashtag.appendChild(makefavoritespan);
    deletedfavoritehashtag.appendChild(makefavoritespan2);
    mypageHashtag.appendChild(deletedfavoritehashtag);
    
}

// 저장 버튼이 구현가능하도록 추가와 db저장을 따로 분리함
// value값 변경해야함

let regex = /^[가-힣a-zA-Z0-9]{2,}$/;
let imgFlg = 0;

function nameChange() {
	let nameChk = document.getElementById('usermodifyname').value;

	if(nameChk === '') {
		alert('닉네임을 입력해주세요');
		return false;
	} else if(!regex.test(nameChk)) {
        alert('닉네임을 다시 확인해주세요.');
        return false;
    }

	const formData = new FormData();
	formData.append('user_name', nameChk);
	// console.log(nameChk);
	// console.log(formData.get('username'));
	fetch('/namechange', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		if(data['namechange'] === '0') {
			alert('사용가능한 닉네임 입니다.');
		} else if(data['namechange'] === '1') {
			alert('이미 존재하는 닉네임 입니다.');
		}
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
}

let fileInput = document.getElementById('profilephoto');

fileInput.addEventListener('change', function() {
    let userImgUrl = document.getElementById('user-img-url');
    userImgUrl.innerHTML = fileInput.files[0].name;
    // console.log(fileInput.files[0].name);
    if (fileInput.files.length > 0) {
        imgFlg = 1;
    }
});

function userimgremove() {
    imgFlg = 2;
}

function userinfoupdate() {
    let USERADRESSFVALUE = document.getElementById('sample4_roadAddress').value;
	let USERADRESSSVALUE = document.getElementById('sample4_detailAddress').value;
    let IMGFLG = document.getElementById('imgflg');
    IMGFLG.setAttribute('value', imgFlg);

    let ADRESS = document.getElementById('adress-fullname');
	ADRESS.setAttribute('value', USERADRESSFVALUE+' '+USERADRESSSVALUE);

	document.getElementById('userinfo_form').submit();
}

// let userImgSelect = document.getElementById('profilephoto').files[0];
// let userImgName = document.getElementById('user_img_name');
// console.log(userImgSelect);

// userImgName.innerHTML = userImgSelect;
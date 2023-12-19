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
addallfavoritetagevent.addEventListener('click', addallfavoritetag);

addallfavoritetagevent.addEventListener('click', function(){
    addallfavoritetagevent.removeEventListener('click', addallfavoritetag);
    let createtagmaindiv = document.getElementById('creaTagMainDiv');
    createtagmaindiv.style.display = 'block';
});

function addallfavoritetag() {

    let createtagmaindiv = document.createElement('div');
    let createplustag = document.createElement('div');
    createplustag.classList.add('mypage-hashtag');
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
        console.log(data);

        for(let i = 0; i < data.length; i++) {
                let hashtagdiv = document.createElement('div');
                let hashspan = document.createElement('span');
                let hashplusbtn = document.createElement('span');
                hashtagdiv.id = 'allHashtagId'+data[i].hashtag_id;
                // hashplusbtn.setAttribute("value", data[i].hashtag_id);
                hashplusbtn.innerHTML = '+';
                hashplusbtn.setAttribute('onclick', `addhashtag(${data[i].hashtag_id})`);
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



function closeoption(){
    let createtagmaindiv = document.getElementById('creaTagMainDiv');
    createtagmaindiv.style.display = 'none';
}

function addhashtag(data) {
    console.log(data);
    let formData = new FormData();
    formData.append('tag_id', data);
    
    let deletefavoritehashtext = document.getElementById('favoritehashtext'+data).value;
    let allHashtagId = document.getElementById('allHashtagId'+data);
    allHashtagId.remove();

    fetch('/addfavoritehashtag', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        console.log(response);
        response.json();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => console.log(error));

    // 즉시 추가
    let mypageHashtag = document.getElementById('mypageHashtag');
    let deletedfavoritehashtag = document.createElement('div')
    let makefavoritespan = document.createElement('span');
    let makefavoritespan2 = document.createElement('span');

    deletedfavoritehashtag.id = 'favoriteHashtagId' + data;
    makefavoritespan.id = 'favoritehashtext'+data;
    makefavoritespan.innerhtml = deletefavoritehashtext;
    makefavoritespan.setAttribute('value', deletefavoritehashtext );
    makefavoritespan2.setAttribute('onclick', `favoritehashdelete(${data})`);
    makefavoritespan2.innerHTML = 'x';
    deletedfavoritehashtag.appendChild(makefavoritespan);
    deletedfavoritehashtag.appendChild(makefavoritespan2);
    mypageHashtag.appendChild(deletedfavoritehashtag);
}

// 1. 저장/취소 버튼 구현
// 관심태그 추가하기 여러번 반복 되도록
// insert구문 create로 변경
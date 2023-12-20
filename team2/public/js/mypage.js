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
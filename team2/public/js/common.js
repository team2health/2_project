function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
	document.getElementById("headerCategory").style.color = '#FF9900'
}
window.addEventListener('load', function() {
    setPageName(); //일주일을 불러오는 함수
});
// 푸터 아이콘 opacity
let footericondiv = document.querySelectorAll('.footer-icon-div');

// function toggleDropdown2() {
//     document.getElementById("myDropdown2").classList.toggle("show");
// }

// 페이지 이름 세팅
function setPageName () {
    // footericondiv.forEach(element => {
    //     element.classList.add('footer-icon-div-opacity');
    // });
    let headerPageName = document.getElementById('headerPageName');
    let currentPath = window.location.pathname + window.location.search;
    let boardNum = /^\/board\/[\w\d]+$/;
    let boardcategory1 = /^\/boardcategory\/1\/[\w\d]+$/;
    let boardcategory2 = /^\/boardcategory\/2\/[\w\d]+$/;
    let boardcategory3 = /^\/boardcategory\/3\/[\w\d]+$/;
    let boardcategory4 = /^\/boardcategory\/4\/[\w\d]+$/;
    if(currentPath == '/mypage') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='마이페이지';
        footericondiv[3].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/login') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='로그인';
        footericondiv[3].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/regist') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='회원가입';
        footericondiv[3].classList.remove('footer-icon-div-opacity');
    }else if(boardcategory1.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='자유게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(boardcategory2.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='친목게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(boardcategory3.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='정보게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(boardcategory4.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='질문게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath === '/boardcategory/1') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='자유게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath === '/boardcategory/2') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='친목게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath === '/boardcategory/3') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='정보게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath === '/boardcategory/1') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='질문게시판';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    }else if(currentPath == '/favoriteboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='관심태그 게시글';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(boardNum.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='상세내용';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/lastboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='게시글 내용';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/categoryboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='카테고리';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/timeline') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='타임라인';
        footericondiv[2].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/hotboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='핫게시글';
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/') {
        footericondiv[0].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/board') {
        footericondiv[1].classList.remove('footer-icon-div-opacity');
    } else if(currentPath == '/firstchkpassword') {
        footericondiv[3].classList.remove('footer-icon-div-opacity');
        headerPageName.innerHTML='';
        headerPageName.innerHTML='비밀번호 변경';
    }
}
// 창 외부 클릭 시 드랍다운 닫기
window.onclick = function (event) {
    if (!event.target.matches('.cate_btn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// let categoryFlg = 0;

// Ajax를 사용하여 해당 카테고리의 게시글을 불러오는 코드
// 여기에서는 가상의 URL 및 데이터로 예시를 보여줍니다.
function showBoard(categoryId) {
    let FORMACTION = document.getElementById('category_id_form');
    FORMACTION.setAttribute('action', '/boardcategory/'+categoryId);
    FORMACTION.submit();

    // 드랍다운 닫기
    document.getElementById("myDropdown").classList.remove("show");
}


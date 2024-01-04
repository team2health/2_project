function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}
window.addEventListener('load', function() {
    setPageName(); //일주일을 불러오는 함수
});


// function toggleDropdown2() {
//     document.getElementById("myDropdown2").classList.toggle("show");
// }

// 페이지 이름 세팅
function setPageName () {
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
    } else if(currentPath == '/login') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='로그인';
    } else if(boardcategory1.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='자유게시판';
    } else if(boardcategory2.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='친목게시판';
    } else if(boardcategory3.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='정보게시판';
    } else if(boardcategory4.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='질문게시판';
    } else if(currentPath === '/boardcategory/1') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='자유게시판';
    } else if(currentPath === '/boardcategory/2') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='친목게시판';
    } else if(currentPath === '/boardcategory/3') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='정보게시판';
    } else if(currentPath === '/boardcategory/1') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='질문게시판';
    }else if(currentPath == '/favoriteboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='관심태그 게시글';
    } else if(boardNum.test(currentPath)) {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='상세내용';
    } else if(currentPath == '/lastboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='게시글 내용';
    } else if(currentPath == '/categoryboard') {
        headerPageName.innerHTML='';
        headerPageName.innerHTML='카테고리';
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
let COMMUNITYNAV = document.getElementById("myDropdown");
let communityNav = 0;

function toggleDropdown() {
	if(communityNav === 0) {
		COMMUNITYNAV.style.display = 'block'
		communityNav = 1;
	} else if(communityNav === 1) {
		COMMUNITYNAV.style.display = 'none'
		communityNav = 0;
	}
}

// function toggleDropdown2() {
//     document.getElementById("myDropdown2").classList.toggle("show");
// }

// 창 외부 클릭 시 드랍다운 닫기
// window.onclick = function (event) {
//     if (!event.target.matches('.cate_btn')) {
//         var dropdowns = document.getElementsByClassName("dropdown-content");
//         for (var i = 0; i < dropdowns.length; i++) {
//             var openDropdown = dropdowns[i];
//             if (openDropdown.classList.contains('show')) {
//                 openDropdown.classList.remove('show');
//             }
//         }
//     }
// }

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
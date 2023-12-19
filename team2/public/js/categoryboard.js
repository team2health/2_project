function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
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

    // Ajax를 사용하여 해당 카테고리의 게시글을 불러오는 코드
    // 여기에서는 가상의 URL 및 데이터로 예시를 보여줍니다.
    function showBoard(categoryId) {
        var url = '/getBoardByCategory/' + categoryId;
    
        fetch(url)
            .then(response => response.json())
            .then(data => {
                updatePageWithData(data);
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    
        // 드랍다운 닫기
        document.getElementById("myDropdown").classList.remove("show");
    }


// 페이지를 업데이트하는 함수
function updatePageWithData(data) {
    var postContainer = document.getElementById('post-container');

    // 기존의 게시글 삭제
    while (postContainer.firstChild) {
        postContainer.removeChild(postContainer.firstChild);
    }

    // 받아온 데이터를 이용하여 새로운 게시글 추가
    data.forEach(function(post) {
        var postElement = document.createElement('div');
        postElement.textContent = post.board_title;
        postContainer.appendChild(postElement);
    });
}
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
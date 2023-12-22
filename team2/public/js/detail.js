const token = "{{ csrf_token() }}";


document.addEventListener('DOMContentLoaded', function () {
    // 댓글 개수 업데이트
    function updateCommentCount() {
       // 여기에서 board_id를 올바르게 추출하는 부분을 확인
        const commentContentInput = commentForm.querySelector('textarea[name="comment_content"]');
        const commentContent = commentContentInput ? commentContentInput.value : '';
        const boardId = commentForm.querySelector('input[name="board_id"]').value;
        // FormData 생성
        const formData = new FormData(commentForm);
        formData.append('board_id', boardId);
        formData.append('comment_content', commentContent);

        // 여기에 댓글을 서버로 보내는 코드를 추가
        fetch('/comments', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log('서버 응답:', data);
            updateCommentCount(); // 댓글 개수 업데이트
            // 댓글 추가 후 폼 초기화
            commentForm.reset();
        })
        .catch(error => console.error('에러 발생:', error));
    }

    // 댓글 폼 제출 이벤트
    const commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // 댓글 내용 가져오기
            const commentContentInput = commentForm.querySelector('textarea[name="comment_content"]');
            const commentContent = commentContentInput ? commentContentInput.value : '';

            // 여기에서 board_id를 올바르게 추출하는 부분을 확인
            const boardIdElement = document.getElementById('boardId');
            const boardId = boardIdElement ? boardIdElement.value : '';

            // FormData 생성
            const formData = new FormData(commentForm);
            formData.append('board_id', boardId);
            formData.append('comment_content', commentContent);

            // 여기에 댓글을 서버로 보내는 코드를 추가
            fetch('/comments', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                console.log('서버 응답:', data);                
                updateCommentCount(); // 댓글 개수 업데이트
                // 댓글 추가 후 폼 초기화
                window.location.reload();
            })
            .catch(error => console.error('에러 발생:', error));
        });
    }
    
    function appendNewComment(comment) {
        const commentList = document.querySelector('.detail_comment ul');
        const newCommentItem = document.createElement('li');
        
        newCommentItem.innerHTML = `
            <div class="last_user">
                <img class="community_icon" src="../img/default_f.png" alt="" class="board_nic_img">
                <div class="board_nic_text">
                    <div>
                        <span>${comment.user_name}</span>
                    </div>
                    <div>
                        ${comment.created_at}
                    </div>
                </div>
            </div>
            <div>
                <p>${comment.comment_content}</p>
            </div>
        `;
    
        commentList.appendChild(newCommentItem);}

    
});

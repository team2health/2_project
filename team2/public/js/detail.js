const token = "{{ csrf_token() }}";
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

// 모달 닫기
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

// 모달 외부 클릭 시 닫기
window.addEventListener('click', function(event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
        closeModal();
    }
});
function openModals(commentId) {
    document.getElementById('myModalcomment' + commentId).style.display = 'block';
}

function closeModals(commentId) {
    document.getElementById('myModalcomment' + commentId).style.display = 'none';
}

function reportComment() {
    // 여기에서 서버로 데이터를 전송하고 필요한 처리를 수행
    // ...

    // 이후에 필요한 동작을 수행할 수 있습니다.
    // 예를 들어, 모달 닫기 등의 동작을 수행할 수 있습니다.

    // 여기서 false를 반환하면 form이 submit되지 않습니다.
    return true;
}


document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-comment-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            const confirmDelete = confirm('정말로 삭제하시겠습니까?');

            if (confirmDelete) {
                // 확인이 눌렸을 때의 처리
                const form = button.closest('form');
                form.submit(); // 폼 제출
            } else {
                // 취소가 눌렸을 때의 처리
                event.preventDefault(); // 기본 동작(폼 제출) 방지
            }     
                   
        });
    });
    
// document.addEventListener('DOMContentLoaded', function () {
//     const deleteButtons = document.querySelectorAll('.delete-comment-btn');
//     const reportButtons = document.querySelectorAll('.detail_comment-report-btn');

//     deleteButtons.forEach(button => {
//         button.addEventListener('click', function (event) {
//             const confirmDelete = confirm('정말로 삭제하시겠습니까?');

//             if (confirmDelete) {
//                 // 확인이 눌렸을 때의 처리
//                 const form = button.closest('form');
//                 form.submit(); // 폼 제출
//             } else {
//                 // 취소가 눌렸을 때의 처리
//                 event.preventDefault(); // 기본 동작(폼 제출) 방지
//             }
//         });


//     // 댓글 신고 버튼에 대한 이벤트 추가
//     reportButtons.forEach(button => {
//         button.addEventListener('click', function () {
//             openModals(); // 모달 열기 로직 추가
//         });
//     });

//     // 모달 외부 클릭 시 닫기
//     window.addEventListener('click', function(event) {
//         var modal = document.getElementById('myModalcomment');
//         if (event.target === modal) {
//             closeModals();
//         }
//     });
// });

    
    
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
                <img class="community_icon" src="/img/default_f.png" alt="" class="board_nic_img">
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

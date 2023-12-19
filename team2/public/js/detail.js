const token = "{{ csrf_token() }}";

document.addEventListener('DOMContentLoaded', function () {
    // 모달 열기
    document.getElementById('openModal').addEventListener('click', function () {
        document.getElementById('confirmModal').style.display = 'block';
        centerModal(); // 모달을 화면 중앙에 위치시키는 함수 호출
    });

    // 모달 닫기
    document.getElementById('cancelDelete').addEventListener('click', function () {
        document.getElementById('confirmModal').style.display = 'none';
    });

    // 창 크기 변경 시 모달 중앙 정렬
    window.addEventListener('resize', function () {
        centerModal();
    });

    // 확인 버튼 클릭 시 폼 제출 (Soft Delete)
    document.getElementById('confirmDelete').addEventListener('click', function () {
        document.getElementById('deleteForm').submit();
    });
});

// 모달을 화면 중앙에 위치시키는 함수
function centerModal() {
    var modal = document.getElementById('confirmModal');
    modal.style.top = Math.max(0, (window.innerHeight - modal.offsetHeight) / 2) + 'px';
    modal.style.left = Math.max(0, (window.innerWidth - modal.offsetWidth) / 2) + 'px';
}
document.addEventListener('DOMContentLoaded', function () {
    // 댓글 개수 업데이트
    function updateCommentCount() {
        // ... (이전 코드와 동일)

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
document.querySelectorAll('.commentDeleteBtn').forEach(function (button) {
    button.addEventListener('click', function () {
        var commentId = button.getAttribute('data-comment-id');
        var commentIdToDeleteInput = document.getElementById('commentIdToDelete');
        
        if (commentIdToDeleteInput) {
            commentIdToDeleteInput.value = commentId;
            
            // 모달 열기
            document.getElementById('confirmCommentDeleteModal').style.display = 'block';

            // 모달 위치 조정
            centerModal();
        } else {
            console.error('Element with ID "commentIdToDelete" not found.');
        }
    });
});

// 추가: 취소 버튼 클릭 시 댓글 삭제 확인 모달 닫기
document.getElementById('cancelCommentDelete').addEventListener('click', function () {
    // 모달 닫기
    document.getElementById('confirmCommentDeleteModal').style.display = 'none';
});

// 추가: 확인 버튼 클릭 시 댓글 삭제 수행
document.getElementById('confirmCommentDelete').addEventListener('click', function () {
    var commentId = document.getElementById('commentIdToDelete').value;

    // AJAX 요청을 통해 댓글 삭제
    axios({
        method: 'delete',
        url: '/comments/' + commentId,
        headers: {
            'X-CSRF-TOKEN': token,
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(function (response) {
        // 성공적으로 삭제되었을 때 수행할 동작
        console.log('Comment deleted successfully.');

        // 모달 닫기
        document.getElementById('confirmCommentDeleteModal').style.display = 'none';

        // 댓글 삭제 후 화면 갱신
        window.location.reload();
    })
    .catch(function (error) {
        // 삭제 실패 시 수행할 동작
        console.error('Error deleting comment:', error);

        // 모달 닫기
        document.getElementById('confirmCommentDeleteModal').style.display = 'none';
    });
});

// const token = "{{ csrf_token() }}";

// document.addEventListener('DOMContentLoaded', function () {
//     // 모달 열기
//     document.getElementById('openModal').addEventListener('click', function () {
//         document.getElementById('confirmModal').style.display = 'block';
//         centerModal(); // 모달을 화면 중앙에 위치시키는 함수 호출
//     });

//     // 모달 닫기
//     document.getElementById('cancelDelete').addEventListener('click', function () {
//         document.getElementById('confirmModal').style.display = 'none';
//     });

//     // 창 크기 변경 시 모달 중앙 정렬
//     window.addEventListener('resize', function () {
//         centerModal();
//     });

//     // 확인 버튼 클릭 시 폼 제출 (Soft Delete)
//     document.getElementById('confirmDelete').addEventListener('click', function () {
//         document.getElementById('deleteForm').submit();
//     });

//     // 모달을 화면 중앙에 위치시키는 함수
//     function centerModal() {
//         var modal = document.getElementById('confirmModal');
//         modal.style.top = Math.max(0, (window.innerHeight - modal.offsetHeight) / 2) + 'px';
//         modal.style.left = Math.max(0, (window.innerWidth - modal.offsetWidth) / 2) + 'px';
//     }

//     // 댓글 개수 업데이트
//     function updateCommentCount() {
//         // ... (이전 코드와 동일)

//         // 여기에서 board_id를 올바르게 추출하는 부분을 확인
//         const commentContentInput = commentForm.querySelector('textarea[name="comment_content"]');
//         const commentContent = commentContentInput ? commentContentInput.value : '';
//         const boardId = commentForm.querySelector('input[name="board_id"]').value;
//         // FormData 생성
//         const formData = new FormData(commentForm);
//         formData.append('board_id', boardId);
//         formData.append('comment_content', commentContent);

//         // 여기에 댓글을 서버로 보내는 코드를 추가
//         fetch('/comments', {
//             method: 'POST',
//             headers: {
//                 'X-CSRF-TOKEN': token,
//                 'X-Requested-With': 'XMLHttpRequest',
//             },
//             body: formData,
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log('서버 응답:', data);
//             updateCommentCount(); // 댓글 개수 업데이트
//             // 댓글 추가 후 폼 초기화
//             commentForm.reset();
//         })
//         .catch(error => console.error('에러 발생:', error));
//     }

//     // 댓글 폼 제출 이벤트
//     const commentForm = document.getElementById('commentForm');
//     if (commentForm) {
//         commentForm.addEventListener('submit', function (event) {
//             event.preventDefault();

//             // 댓글 내용 가져오기
//             const commentContentInput = commentForm.querySelector('textarea[name="comment_content"]');
//             const commentContent = commentContentInput ? commentContentInput.value : '';

//             // 여기에서 board_id를 올바르게 추출하는 부분을 확인
//             const boardIdElement = document.getElementById('boardId');
//             const boardId = boardIdElement ? boardIdElement.value : '';

//             // FormData 생성
//             const formData = new FormData(commentForm);
//             formData.append('board_id', boardId);
//             formData.append('comment_content', commentContent);

//             // 여기에 댓글을 서버로 보내는 코드를 추가
//             fetch('/comments', {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': token,
//                     'X-Requested-With': 'XMLHttpRequest',
//                 },
//                 body: formData,
//             })
//             .then(response => response.json())
//             .then(data => {
//                 console.log('서버 응답:', data);
//                 updateCommentCount(); // 댓글 개수 업데이트
//                 // 댓글 추가 후 폼 초기화
//                 window.location.reload();
//             })
//             .catch(error => console.error('에러 발생:', error));
//         });
//     }
    
//     function appendNewComment(comment) {
//         const commentList = document.querySelector('.detail_comment ul');
//         const newCommentItem = document.createElement('li');
        
//         newCommentItem.innerHTML = `
//             <div class="last_user">
//                 <img class="community_icon" src="../img/default_f.png" alt="" class="board_nic_img">
//                 <div class="board_nic_text">
//                     <div>
//                         <span>${comment.user_name}</span>
//                     </div>
//                     <div>
//                         ${comment.created_at}
//                     </div>
//                 </div>
//             </div>
//             <div>
//                 <p>${comment.comment_content}</p>
//             </div>
//         `;
    
//         commentList.appendChild(newCommentItem);
//     }

//     document.querySelectorAll('.commentDeleteBtn').forEach(function (button) {
//         button.addEventListener('click', function () {
//             var commentId = button.getAttribute('data-comment-id');
//             var commentIdToDeleteInput = document.getElementById('commentIdToDelete');
            
//             if (commentIdToDeleteInput) {
//                 commentIdToDeleteInput.value = commentId;
                
//                 // 모달 열기
//                 document.getElementById('confirmCommentDeleteModal').style.display = 'block';

//                 // 모달 위치 조정
//                 centerModal();
//             } else {
//                 console.error('Element with ID "commentIdToDelete" not found.');
//             }
//         });
//     });

//     // 추가: 취소 버튼 클릭 시 댓글 삭제 확인 모달 닫기
//     document.getElementById('cancelCommentDelete').addEventListener('click', function () {
//         // 모달 닫기
//         document.getElementById('confirmCommentDeleteModal').style.display = 'none';
//     });

//     // 추가: 확인 버튼 클릭 시 댓글 삭제 수행
//     document.getElementById('confirmCommentDelete').addEventListener('click', function () {
//         var commentId = document.getElementById('commentIdToDelete').value;

//         // AJAX 요청을 통해 댓글 삭제
//         axios({
//             method: 'delete',
//             url: '/comments/' + commentId,
//             headers: {
//                 'X-CSRF-TOKEN': token,
//                 'X-Requested-With': 'XMLHttpRequest'
//             }
//         })
//         .then(function (response) {
//             // 성공적으로 삭제되었을 때 수행할 동작
//             console.log('Comment deleted successfully.');

//             // 모달 닫기
//             document.getElementById('confirmCommentDeleteModal').style.display = 'none';

//             // 댓글 삭제 후 화면 갱신
//             window.location.reload();
//         })
//         .catch(function (error) {
//             // 삭제 실패 시 수행할 동작
//             console.error('Error deleting comment:', error);

//             // 모달 닫기
//             document.getElementById('confirmCommentDeleteModal').style.display = 'none';
//         });
//     });
// });
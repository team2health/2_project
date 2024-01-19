// function confirmDelete() {
//     var selectedItems = document.querySelectorAll('input[name="id[]"]:checked');

//     if (selectedItems === 0) {
//         alert('선택된 항목이 없습니다.');
//         return false; // 선택된 항목이 없으면 삭제를 막음
//     }

//     // 선택된 항목이 있으면 삭제 실행
//     return true;
// }

// function deleteConfirmed() {
//     // 여기에 실제 삭제 작업을 수행하는 로직 추가
//     document.getElementById('deleteForm').submit();
// }
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-comment-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            var selectedItems = document.querySelectorAll('input[name="id[]"]:checked');

            if (selectedItems.length === 0) {
                alert('선택된 항목이 없습니다.');
                event.preventDefault(); // 선택된 항목이 없으면 기본 동작(폼 제출) 방지
                return false;
            }

            if (!confirmDelete) {
                event.preventDefault(); // 취소가 눌렸을 때의 처리: 기본 동작(폼 제출) 방지
            }
        });
    });
    window.confirmDelete = function () {
        const selectedItems = document.querySelectorAll('input[name="id[]"]:checked');

        if (selectedItems.length > 0) {
            const confirmDelete = confirm('정말로 삭제하시겠습니까?');

            if (confirmDelete) {
                document.getElementById('deleteForm').submit();
            }
        }
    };
});


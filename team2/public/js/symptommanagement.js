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

            const confirmDelete = confirm('정말로 삭제하시겠습니까?');

            if (!confirmDelete) {
                event.preventDefault(); // 취소가 눌렸을 때의 처리: 기본 동작(폼 제출) 방지
            }
        });
    });
    window.confirmDelete = function () {
        document.getElementById('deleteForm').submit();
    };
});
function checkAndAddSymptom() {
    const selectedPartId = document.getElementById('part_id').value;
    const newSymptomName = document.getElementById('symptom_name').value;

    // 여기에서 이미 있는 증상인지 체크하는 API 호출 또는 필요한 로직 수행
    // 아래는 임시로 alert를 통해 표시하는 예시입니다.
    if (isExistingSymptom(selectedPartId, newSymptomName)) {
        alert('이미 있는 증상입니다.');
    } else {
        // 이미 있는 증상이 아니라면 폼 제출 또는 다른 로직 수행
        document.getElementById('adminaddsymptomForm').submit();
    }
}

function isExistingSymptom(partId, symptomName) {
    // 여기에서 서버 또는 로컬에서 이미 있는 증상인지 체크하는 로직을 수행
    // 임시로 항상 이미 있는 증상으로 가정하고 true를 반환하는 예시
    return false;
}
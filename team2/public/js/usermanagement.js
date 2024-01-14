function toggleCheckboxes() {
    var checkboxes = document.querySelectorAll('.delete-checkbox');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = document.getElementById('allselectcheck').checked;
    });
}

function deleteSelected() {
    // 여기에서 폼을 서브밋하거나, Ajax를 사용하여 서버에 삭제 요청을 보낼 수 있습니다.
    document.getElementById('deleteForm').submit();
}
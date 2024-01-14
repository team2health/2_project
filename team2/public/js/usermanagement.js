
// function toggleCheckboxes() {
//     var checkboxes = document.querySelectorAll('.delete-checkbox');
//     console.log(checkboxes);
//     checkboxes.forEach(function (checkbox) {
//         checkbox.checked = document.getElementById('allselectcheck').checked;
//         console.log(checkboxes);
//     });
// }

// function deleteSelected() {
//     console.log('deleteSelected');
//     // 여기에서 폼을 서브밋하거나, Ajax를 사용하여 서버에 삭제 요청을 보낼 수 있습니다.
//     var form = document.getElementById('deleteForm');
//     console.log(form);
//     var checkboxes = form.querySelectorAll('.delete-checkbox:checked');
//     console.log(checkboxes);
//     if (checkboxes.length > 0) {
//         // 폼을 서브밋합니다.
//         console.log(form);
//         form.submit();
//         console.log(form);
//     } else {
//         alert('선택된 항목이 없습니다.');
//     }
// }
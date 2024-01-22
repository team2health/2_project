function admindelete() {
    let checkboxes = document.querySelectorAll('input[name="admin[]"]');
    let chkflg = false;

    checkboxes.forEach(function(checkbox) {
        if(checkbox.checked === true) {
            chkflg = true;
        }
    });
    if(chkflg === false) {
        alert('선택된 관리자가 없습니다.');
        return false;
    }
    document.getElementById('admindeleteform').submit();
}
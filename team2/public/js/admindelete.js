function admindelete() {
    let checkboxes = document.querySelectorAll('input[name="admin[]"]');
    let chkflg = false;

    checkboxes.forEach(function(checkbox) {
        if(checkbox.checked === true) {
            chkflg = true;
        }
    });
    if(chkflg === false) {
        alert('관리자를 선택하여주십시오.');
        return false;
    }
    document.getElementById('admindeleteform').submit();
}
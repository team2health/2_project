let allselectcheck = document.getElementById('allselectcheck');
let contents = document.getElementsByClassName('contens-checkbox');
allselectcheck.addEventListener('change', function() {
    for(let i = 0; i < 10; i++) {
        let isChecked = this.checked;
        contents[i].checked = isChecked;
    }
})

let form = document.getElementById('setDeclationFlg');
function setDeclarationflg() {
    form.setAttribute('action', '/admin/temporarilydelete');
    form.submit();
}

function deleteDeclaration() {
    form.setAttribute('action', '/admin/deletedeclarationboard');
    form.submit();
}

let commentform = document.getElementById('CommentSetDeclationFlg');
function deleteDeclarationComment() {
    commentform.setAttribute('action', '/admin/admindeletecomment');
    commentform.submit();
}

function SetCommentFlg() {
    commentform.setAttribute('action', '/admin/setcommentflg');
    commentform.submit();
}

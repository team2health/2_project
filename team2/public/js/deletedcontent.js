let allselectcheck = document.getElementById('allselectcheck');
let contents = document.getElementsByClassName('contens-checkbox');
allselectcheck.addEventListener('change', function() {
    for(let i = 0; i < 10; i++) {
        let isChecked = this.checked;
        contents[i].checked = isChecked;
    }
})


let SearchAlignFlg = 0;

let contentsmanagementSearchAlign = document.getElementById('contentsmanagementSearchAlign');
let contentclass = document.getElementById('contentsmanagementSearchAlignDiv');
let contentsmanagementSearchAlignValue = document.getElementById('contentsmanagementSearchAlignValue');
contentsmanagementSearchAlign.addEventListener('click', function() {
    if(SearchAlignFlg === 0){
        contentclass.classList.toggle('admin-display-none');
        SearchAlignFlg = 1;
    } else if(SearchAlignFlg === 1) {
        contentclass.classList.toggle('admin-display-none');
        SearchAlignFlg = 0;
    }
})

// 정렬
let sortValue = document.getElementById('sortValue');
let alignValueSet3 = document.getElementById('alignValueSet3');
alignValueSet3.addEventListener('click', function(){
    let deletedcontentsort = document.getElementById('deletedcontentsort');
    sortValue.setAttribute('value','0');
    contentclass.classList.add('admin-display-none');
    deletedcontentsort.submit();
})
let alignValueSet4 = document.getElementById('alignValueSet4');
alignValueSet4.addEventListener('click', function(){
    sortValue.setAttribute('value','1');
    let deletedcontentsort = document.getElementById('deletedcontentsort');
    contentclass.classList.add('admin-display-none');
    deletedcontentsort.submit();
})

let form = document.getElementById('deletedContentMainForm');
function deletecontent() {
    let selectedItems = document.querySelectorAll('input[name="board_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 게시글이 없습니다.');
        return false;
    } else {
        form.setAttribute('action', '/admin/boardsoftdelete');
        form.submit();
    }
}

function restoreBoardSet() {
    let selectedItems = document.querySelectorAll('input[name="board_id[]"]:checked');
    if(selectedItems.length < 1) {
        alert('선택된 게시글이 없습니다.');
        return false;
    } else {
        form.setAttribute('action', '/admin/boardsetshow');
        form.submit();
    }
}
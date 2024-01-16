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
let alignValueSet = document.getElementById('alignValueSet');
alignValueSet.addEventListener('click', function(){
    contentsmanagementSearchAlignValue.setAttribute('value','0');
    let AlignValueForm = document.getElementById('AlignValueForm');
    contentclass.classList.add('admin-display-none');
    AlignValueForm.submit();
})
let alignValueSet2 = document.getElementById('alignValueSet2');
alignValueSet2.addEventListener('click', function(){
    contentsmanagementSearchAlignValue.setAttribute('value','1');
    let AlignValueForm = document.getElementById('AlignValueForm');
    contentclass.classList.add('admin-display-none');
    AlignValueForm.submit();
})

let form = document.getElementById('deletedContentMainForm');
function deletecontent() {
    form.setAttribute('action', '/admin/boardsoftdelete');
    form.submit();
}

function restoreBoardSet() {
    form.setAttribute('action', '/admin/boardsetshow');
    form.submit();
}
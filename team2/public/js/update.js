function openFile(fileInputId) {
    document.getElementById(fileInputId).click();
}

// function previewImage(inputId, previewId) {
//     var input = document.getElementById(inputId);
//     var preview = document.getElementById(previewId);

//     var reader = new FileReader();
//     reader.onload = function (e) {
//         preview.src = e.target.result;
//     };

//     if (input.files && input.files[0]) {
//         reader.readAsDataURL(input.files[0]);
//     }
// }
function previewImage(inputId, previewId) {
    var input = document.getElementById(inputId);
    var preview = document.getElementById(previewId);
    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('img/plus.png') }}";
    }
}
    
var selectedHashtags = [];

function toggleHashtags() {
    var hiddenHashtags = document.getElementById('hiddenHashtags');

    // 히든 해시태그 요소의 내용을 토글
    if (hiddenHashtags.style.display === 'none') {
        hiddenHashtags.style.display = 'block';
    } else {
        hiddenHashtags.style.display = 'none';
    }
}

function handleTagClick(tag) {
    var clickedTagName = tag.getAttribute('data-tag');
    var hashtagContainer = document.getElementById('hashtagContainer');

    if (selectedHashtags.includes(clickedTagName)) {
        selectedHashtags = selectedHashtags.filter(function (tag) {
            return tag !== clickedTagName;
        });
    } else {
        selectedHashtags.push(clickedTagName);
    }

    updateSelectedTags();
}

function updateSelectedTags() {
    var outputDiv = document.getElementById('hashtagContainer');
    outputDiv.innerHTML = '';

    var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
    selectedHashtagsInput.value = '';

    // 추가된 태그를 span 태그로 감싸고 삭제 버튼 추가
    selectedHashtags.forEach(function (tag) {
        var tagSpan = document.createElement('span');
        tagSpan.className = 'selected-tag';
        tagSpan.setAttribute('data-selected-tag', tag);
        tagSpan.innerHTML = tag + ' ';

        var removeButton = document.createElement('button');
        removeButton.textContent = 'x';
        removeButton.type = 'button';
        removeButton.addEventListener('click', function () {
            removeSelectedTag(tag);
        });

        tagSpan.appendChild(removeButton);
        outputDiv.appendChild(tagSpan);
    });

    // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
    selectedHashtagsInput.value = selectedHashtags.join(',');
}

function removeSelectedTag(tag) {
    // 선택된 해시태그 배열에서 삭제
    selectedHashtags = selectedHashtags.filter(function (t) {
        return t !== tag;
    });

    updateSelectedTags();
}

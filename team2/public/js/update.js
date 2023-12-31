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
// function previewImage(inputId, previewId) {
//     var input = document.getElementById(inputId);
//     var preview = document.getElementById(previewId);
//     var file = input.files[0];
//     var reader = new FileReader();

//     reader.onloadend = function () {
//         preview.src = reader.result;
//     };

//     if (file) {
//         reader.readAsDataURL(file);
//     } else {
//         preview.src = "{{ asset('img/plus.png') }}";
//     }
// }
var selectedImages = [];

function openFile(fileInputId) {
    document.getElementById(fileInputId).click();
}

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

function removeImage(imageKey) {
    // 이미지를 삭제하는 로직 추가

    // 선택된 이미지 배열에서 삭제
    selectedImages = selectedImages.filter(function (key) {
        return key !== imageKey;
    });

    // 이미지 미리보기, 업로드한 이미지 input, 이미지 삭제 버튼 삭제
    var imageContainer = document.getElementById('imageContainer' + imageKey);
    if (imageContainer) {
        imageContainer.parentNode.removeChild(imageContainer);
    }

    // 배열에 있는 모든 이미지를 숨겨진 인풋 필드에 설정
    var selectedImagesInput = document.getElementById('selectedImages');
    selectedImagesInput.value = selectedImages.join(',');
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
    var outputDiv = document.getElementById('hashtagContainer');

    outputDiv.addEventListener('click', function (event) {
        var target = event.target;
        if (target.tagName === 'BUTTON') {
            var tagToRemove = target.parentElement.getAttribute('data-selected-tag');
            removeSelectedTag(tagToRemove);
        }
    });
    // updateSelectedTags 함수 호출을 여기로 이동
    updateSelectedTags();
}
function updateSelectedTags() {
    var outputDiv = document.getElementById('hashtagContainer');

    // 기존 해시태그 유지
    var existingTags = outputDiv.querySelectorAll('.selected-tag');
    existingTags.forEach(function (existingTag) {
        var existingTagName = existingTag.getAttribute('data-selected-tag');
        selectedHashtags.push(existingTagName);
    });

    // 중복된 해시태그 제거
    selectedHashtags = [...new Set(selectedHashtags)];

    // 새로운 태그만 추가하기 위해 기존 태그를 비움
    outputDiv.innerHTML = '';

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

    // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 추가
    var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
    selectedHashtagsInput.value = selectedHashtags.join(',');
}
function removeSelectedTag(tag) {
    var outputDiv = document.getElementById('hashtagContainer');
    var tags = outputDiv.querySelectorAll('.selected-tag');

    tags.forEach(function (tagElement) {
        var tagValue = tagElement.getAttribute('data-selected-tag');
        if (tagValue === tag) {
            tagElement.remove();
            // 선택된 해시태그 배열에서 삭제
            selectedHashtags = selectedHashtags.filter(function (t) {
                return t !== tag;
            });
        }
    });

    // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 추가
    var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
    selectedHashtagsInput.value = selectedHashtags.join(',');
}

// function removeSelectedTag(tag) {
//     // 선택된 해시태그 배열에서 삭제
//     selectedHashtags = selectedHashtags.filter(function (t) {
//         return t !== tag;
//     });

//     updateSelectedTags();
// }

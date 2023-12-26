function openFile() {
    document.getElementById('file0').click();
}

function previewImage(inputId, previewId) {
    var input = document.getElementById(inputId);
    var preview = document.getElementById(previewId);

    var reader = new FileReader();
    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
    var selectedHashtags = [];

function toggleHashtags() {
    var hiddenHashtags = document.getElementById('hiddenHashtags');

    if (hiddenHashtags.style.display === 'none') {
        hiddenHashtags.style.display = 'block';
    } else {
        hiddenHashtags.style.display = 'none';
    }

    // 이전에 등록된 이벤트 리스너 삭제
    hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
        tag.removeEventListener('click', handleTagClick);
    });

    // 각 태그를 클릭할 때 실행되는 함수
    hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
        tag.addEventListener('click', function () {
            handleTagClick(tag);
        });
        
    });
}

function handleTagClick(tag) {
    var clickedTagName = tag.getAttribute('data-tag');

    // 이미 선택된 태그인지 확인
    if (!selectedHashtags.includes(clickedTagName)) {
        // 클릭한 태그의 이름을 배열에 추가
        selectedHashtags.push(clickedTagName);

        // 출력할 div 선택
        var outputDiv = document.getElementById('hashtagContainer');

        // 추가된 태그를 span 태그로 감싸고 삭제 버튼 추가
        var tagSpan = document.createElement('span');
        tagSpan.className = 'selected-tag';
        tagSpan.setAttribute('data-selected-tag', clickedTagName);
        tagSpan.innerHTML = clickedTagName + ' <button type="button" onclick="removeSelectedTag(this)">x</button>';

        // span 태그를 출력 div에 추가
        outputDiv.appendChild(tagSpan);

        // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
        var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
        selectedHashtagsInput.value = selectedHashtags.join(',');
    }
    
    // 기존 태그 목록에 존재하지 않는 경우에만 추가
    
}

function removeSelectedTag(button) {
    // 삭제 버튼이 속한 span 태그를 찾아 삭제
    var tagSpan = button.parentNode;
    var clickedTagName = tagSpan.getAttribute('data-selected-tag');

    // 선택된 해시태그 배열에서 삭제
    selectedHashtags = selectedHashtags.filter(function (tag) {
        return tag !== clickedTagName;
    });

    // 출력할 div에서 삭제된 span 태그를 제거
    tagSpan.parentNode.removeChild(tagSpan);

    // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
    var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
    selectedHashtagsInput.value = selectedHashtags.join(',');
}

}
// var selectedHashtags = [];

// document.addEventListener('DOMContentLoaded', function () {
//     // 페이지 로딩 시 기존에 선택된 해시태그 목록 초기화
//     var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
//     if (selectedHashtagsInput.value) {
//         selectedHashtags = selectedHashtagsInput.value.split(',').map(function (tag) {
//             return tag.trim();
//         });

//         // 초기 선택된 해시태그를 화면에 표시
//         var outputDiv = document.getElementById('hashtagContainer');
//         selectedHashtags.forEach(function (tag) {
//             var tagSpan = createTagSpan(tag);
//             outputDiv.appendChild(tagSpan);
//         });
//     }

//     var hiddenHashtags = document.getElementById('hiddenHashtags');

//     // 페이지 로딩 시 이전에 등록된 이벤트 리스너 삭제
//     hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
//         tag.removeEventListener('click', handleTagClick);
//     });

//     // 페이지 로딩 시 각 태그를 클릭할 때 실행되는 함수 등록
//     hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
//         tag.addEventListener('click', function () {
//             handleTagClick(tag);
//         });
//     });
// });

// function toggleHashtags() {
//     var hiddenHashtags = document.getElementById('hiddenHashtags');

//     if (hiddenHashtags.style.display === 'none') {
//         hiddenHashtags.style.display = 'block';
//     } else {
//         hiddenHashtags.style.display = 'none';
//     }
// }

// function handleTagClick(tag) {
//     var clickedTagName = tag.getAttribute('data-tag');

//     // 이미 선택된 태그인지 확인
//     if (!selectedHashtags.includes(clickedTagName)) {
//         // 클릭한 태그의 이름을 배열에 추가
//         selectedHashtags.push(clickedTagName);

//         // 출력할 div 선택
//         var outputDiv = document.getElementById('hashtagContainer');

//         // 추가된 태그를 span 태그로 감싸고 삭제 버튼 추가
//         var tagSpan = createTagSpan(clickedTagName);

//         // span 태그를 출력 div에 추가
//         outputDiv.appendChild(tagSpan);

//         // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
//         updateSelectedHashtagsInput();
//     }
// }

// function removeSelectedTag(button) {
//     // 삭제 버튼이 속한 span 태그를 찾아 삭제
//     var tagSpan = button.parentNode;
//     var clickedTagName = tagSpan.getAttribute('data-selected-tag');

//     // 선택된 해시태그 배열에서 삭제
//     selectedHashtags = selectedHashtags.filter(function (tag) {
//         return tag !== clickedTagName;
//     });

//     // 출력할 div에서 삭제된 span 태그를 제거
//     tagSpan.parentNode.removeChild(tagSpan);

//     // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
//     updateSelectedHashtagsInput();
// }

// function createTagSpan(tagName) {
//     var tagSpan = document.createElement('span');
//     tagSpan.className = 'selected-tag';
//     tagSpan.setAttribute('data-selected-tag', tagName);
//     tagSpan.innerHTML = tagName + ' <button type="button" onclick="removeSelectedTag(this)">x</button>';
//     return tagSpan;
// }

// function updateSelectedHashtagsInput() {
//     // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
//     var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
//     selectedHashtagsInput.value = selectedHashtags.join(',');
// }
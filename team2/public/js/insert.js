
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

// 이미지를 미리보기하고 파일 인풋의 내용을 변경하는 함수
// function previewAndAddImage(inputId, containerId) {
//     var input = document.getElementById(inputId);
//     var container = document.getElementById(containerId);

//     var reader;
//     for (var i = 0; i < input.files.length; i++) {
//         reader = new FileReader();
//         var file = input.files[i];

//         reader.onload = function (e) {
//             // 미리보기 이미지 엘리먼트 생성
//             var previewImage = document.createElement("img");
//             previewImage.src = e.target.result;

//             // 삭제 버튼 엘리먼트 생성
//             var deleteButton = document.createElement("button");
//             deleteButton.type = "button";
//             deleteButton.innerText = "x";
//             deleteButton.onclick = function () {
//                 container.removeChild(previewImage);
//                 input.value = ''; // 파일 인풋 초기화
//             };

//             // 미리보기 이미지와 삭제 버튼을 컨테이너에 추가
//             container.appendChild(previewImage);
//             container.appendChild(deleteButton);
//         };

//         reader.readAsDataURL(file);
//     }
// }

// // 파일 인풋이 변경되었을 때 호출되는 함수
// function handleFileInputChange(event) {
//     var input = event.target;
//     var container = document.getElementById("imageContainer");

//     previewAndAddImage(input.id, "imageContainer");

//     // 새로운 파일 인풋 엘리먼트 생성
//     var newInput = document.createElement("input");
//     newInput.type = "file";
//     newInput.name = "board_img[]";
//     newInput.style = "display:none;";
//     newInput.accept = "image/*";
//     newInput.id = "fileInput" + container.children.length; // ID를 동적으로 생성
//     newInput.addEventListener("change", handleFileInputChange);

//     // 파일 인풋을 컨테이너에 추가
//     container.appendChild(newInput);

//     // 새로운 파일 인풋에 포커스 설정 (다음 이미지를 추가할 때 새로운 파일 인풋이 선택되도록)
//     newInput.focus();
// }

// // 초기 파일 인풋에 이벤트 리스너 등록
// document.getElementById("fileInput").addEventListener("change", handleFileInputChange);
// function openFileInput() {
//     document.getElementById('fileInput').click();
// }

// document.getElementById('fileInput').addEventListener('change', handleFileSelect);

// function handleFileSelect(event) {
//     const files = event.target.files;
//     const container = document.getElementById('imageContainer');

//     for (const file of files) {
//         const imageContainer = document.createElement('div');
//         imageContainer.className = 'detail_board_content';

//         const img = document.createElement('img');
//         img.src = URL.createObjectURL(file);

//         const deleteButton = document.createElement('button');
//         deleteButton.type = 'button';
//         deleteButton.textContent = '삭제';
//         deleteButton.addEventListener('click', function() {
//             // 이미지 및 해당 버튼 제거
//             imageContainer.remove();
//         });

//         imageContainer.appendChild(img);
//         imageContainer.appendChild(deleteButton);

//         container.appendChild(imageContainer);
//     }
// }






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


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
function toggleHashtags() {
    var hiddenHashtags = document.getElementById('hiddenHashtags');
    var hashtagInput = document.getElementById('hashtag');

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
            handleTagClick(tag, hashtagInput);
        });
    });
}

function handleTagClick(tag, hashtagInput) {   
    var clickedTagName = tag.getAttribute('data-tag');    
    console.log("Clicked tag Name:", clickedTagName);
    var existingTags = hashtagInput.value.split(',').map(function (tag) {
        return tag.trim();
    });

    // 중복 체크
    if (!existingTags.includes(clickedTagName)) {
        // 클릭한 태그의 이름을 가져와서 입력 폼에 추가
        hashtagInput.value += (hashtagInput.value ? ', ' : '') + clickedTagName;
    }
}

// function handleTagClick(tag, hashtagInput) {
//     // 클릭한 태그의 이름을 콘솔에 출력
//     var clickedTag = tag.getAttribute('data-tag');
//     //var clickedTag = this.getAttribute('data-tag');
//     console.log("Clicked tag:", clickedTag);
// // 태그들을 id가 아닌 hashtag_name으로 가져오기
//     // 현재 입력 폼에 있는 태그들을 배열로 가져오기
//     var existingTags = hashtagInput.value.split(',').map(function (tag) {
//         return tag.trim();
//     });

//     // 중복 체크
//     if (!existingTags.includes(clickedTag)) {
//         // 클릭한 태그의 이름을 가져와서 입력 폼에 추가
//         hashtagInput.value += (hashtagInput.value ? ', ' : '') + clickedTag;
//     }
// }
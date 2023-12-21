
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

    // 각 태그를 클릭할 때 실행되는 함수
//     hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
//         tag.addEventListener('click', function () {
//             // 클릭한 태그의 이름을 가져와서 입력 폼에 추가
//             var clickedTag = this.getAttribute('data-tag');
//             hashtagInput.value += (hashtagInput.value ? ', ' : '') + clickedTag;
//         });
//     });
hiddenHashtags.querySelectorAll('.tag').forEach(function (tag) {
    tag.addEventListener('click', function () {
        // 클릭한 태그의 이름을 콘솔에 출력
        var clickedTag = this.getAttribute('data-tag');
        console.log("Clicked tag:", clickedTag);

        // 클릭한 태그의 이름을 가져와서 입력 폼에 추가
        hashtagInput.value += (hashtagInput.value ? ', ' : '') + clickedTag;
    });
});
 }
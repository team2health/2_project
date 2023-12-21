
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
document.getElementById('hashtag').addEventListener('input', function() {
    var input = this.value.toLowerCase();
    var dropdown = document.getElementById('hashtags-list');

    // 서버에서 해시태그 목록을 가져오는 AJAX 요청
    fetch('/hashtags')
        .then(response => response.json())
        .then(hashtags => {
            // 입력한 내용과 일치하는 해시태그를 필터링
            var filteredHashtags = hashtags.filter(function(tag) {
                return tag.toLowerCase().includes(input);
            });

            // 드랍다운 목록을 업데이트
            dropdown.innerHTML = '';
            filteredHashtags.forEach(function(tag) {
                var tagElement = document.createElement('a');
                tagElement.textContent = tag;
                tagElement.addEventListener('click', function() {
                    // 선택한 해시태그를 입력란에 추가
                    document.getElementById('hashtag').value = tag;
                    // 드랍다운을 숨김
                    dropdown.style.display = 'none';
                });
                dropdown.appendChild(tagElement);
            });

            // 입력란에 값이 있고, 필터된 목록이 있을 때 드랍다운을 보여줌
            if (input.length > 0 && filteredHashtags.length > 0) {
                dropdown.style.display = 'block';
            } else {
                dropdown.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error fetching hashtags:', error);
        });
});

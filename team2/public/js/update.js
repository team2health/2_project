function openFile(fileInputId) {
    document.getElementById(fileInputId).click();
}

// 
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
// 이미지를 저장하는 배열
// var selectedImages = [];


// function openFile(fileInputId) {
//     //파일 선택 다이얼로그 열기
//     document.getElementById(fileInputId).click();
// }

// function previewImage(inputId, previewId) {
//     //전달받은 inputId를 사용하여 HTML 문서에서 해당 ID를 가진 
//     //파일 입력(input) 엘리먼트를 찾아 변수 input에 할당
//     var input = document.getElementById(inputId);
    
//     // 전달받은 previewId를 사용하여 HTML 문서에서 해당 ID를 가진 
//     // 이미지 미리보기 엘리먼트를 찾아 변수 preview에 할당합니다.
//     var preview = document.getElementById(previewId);
    
//     //파일 입력(input) 엘리먼트에서 선택된 파일의 
//     //첫 번째 파일을 가져와 변수 file에 할당합니다.
//     var file = input.files[0];
    
//     //FileReader 객체를 생성하여 변수 reader에 할당합니다. 
//     //이 객체는 파일을 비동기적으로 읽을 수 있게 해줍니다.
//     var reader = new FileReader();
    
//     //reader 객체의 onloadend 이벤트 핸들러를 설정합니다. 파일 읽기가 완료되면 
//     //해당 함수가 실행되어 미리보기 이미지의 소스(src)를 읽은 파일의 결과로 설정합니다.
//     reader.onloadend = function () {
//         preview.src = reader.result;
//     };
//     //만약 선택된 파일이 있다면, FileReader를 사용하여 파일을 데이터 URL로 읽어와
//     //미리보기 이미지의 소스로 설정합니다. 선택된 파일이 없으면 
//     //기본적으로 설정된 이미지 파일('img/plus.png')을 미리보기 이미지의 소스로 설정합니다.
//     if (file) {
//         reader.readAsDataURL(file);
//     } else {
//         preview.src = "{{ asset('img/plus.png') }}";
//     }
// }

// function removeImage(imageKey) {    

//     // 선택된 이미지 배열에서 삭제
//     selectedImages = selectedImages.filter(function (key) {
//         return key !== imageKey;
//     });

//     // 이미지 미리보기, 업로드한 이미지 input, 이미지 삭제 버튼 삭제
//     var imageContainer = document.getElementById('imageContainer' + imageKey);
//     if (imageContainer) {
//         imageContainer.parentNode.removeChild(imageContainer);
//     }

//     // 배열에 있는 모든 이미지를 숨겨진 인풋 필드에 설정
//     var selectedImagesInput = document.getElementById('selectedImages');
//     selectedImagesInput.value = selectedImages.join(',');
// }
    
var selectedHashtags = [];

function toggleHashtags() {
    var hiddenHashtags = document.getElementById('hiddenHashtags');

    // 히든 해시태그 요소의 내용을 토글
    //클릭시 none으로 되어있으면
    if (hiddenHashtags.style.display === 'none') {
        //요소를 block으로 변경
        hiddenHashtags.style.display = 'block';
    } else {
        //none이 아니면 none으로 변경
        hiddenHashtags.style.display = 'none';
    }
}

function handleTagClick(tag) {
    var clickedTagName = tag.getAttribute('data-tag');
    
        //클릭된 태그의 이름(clickedTagName)을 
        //selectedHashtags 배열에 추가하는 역할
        selectedHashtags.push(clickedTagName);
    
    //ID가 'hashtagContainer'인 엘리먼트를 찾아 outputDiv에 저장합니다.
    var outputDiv = document.getElementById('hashtagContainer');

    outputDiv.addEventListener('click', function (event) {
        //클릭된 이벤트의 대상 엘리먼트를 target에 저장하고, 
        //해당 엘리먼트가 'BUTTON' 태그인지 확인합니다.
        var target = event.target;
        if (target.tagName === 'BUTTON') {
            //클릭된 버튼의 부모 엘리먼트에서 'data-selected-tag' 속성 값을 가져와 tagToRemove에 저장하고, 
            //removeSelectedTag 함수를 호출하여 해당 해시태그를 제거합니다.
            var tagToRemove = target.parentElement.getAttribute('data-selected-tag');
            removeSelectedTag(tagToRemove);
        }
    });
    // updateSelectedTags 함수 호출을 이동시켜, 
    //해시태그가 업데이트된 후에 해당 함수를 호출합니다.
    updateSelectedTags();
}
function updateSelectedTags() {
    //ID가 'hashtagContainer'인 엘리먼트를 찾아 outputDiv에 저장합니다.
    var outputDiv = document.getElementById('hashtagContainer');

    // 기존 해시태그 유지
    //outputDiv에서 클래스가 'selected-tag'인 
    //모든 엘리먼트를 선택하여 existingTags에 저장합니다
    var existingTags = outputDiv.querySelectorAll('.selected-tag');
    //forEach 메서드를 사용하여 existingTags에 대해 반복문을 수행
    existingTags.forEach(function (existingTag) {
        //getAttribute 메서드를 사용하여 해당 태그의 'data-selected-tag' 
        //속성 값을 읽어와 existingTagName 변수에 저장
        var existingTagName = existingTag.getAttribute('data-selected-tag');
        //selectedHashtags 배열에 추가하는 역할
        selectedHashtags.push(existingTagName);
    });

    // 중복된 해시태그 제거
    //selectedHashtags 배열에서 중복된 항목을 제거합니다. 
    //이를 위해 Set 객체를 사용하고 다시 배열로 변환하여 중복을 없앱니다
    selectedHashtags = [...new Set(selectedHashtags)];

    //기존의 해시태그를 유지하기 위해 outputDiv의 내용을 모두 비웁니다.
    outputDiv.innerHTML = '';

    // 추가된 태그를 span 태그로 감싸고 삭제 버튼 추가
    selectedHashtags.forEach(function (tag) {
        // 새로운 span 엘리먼트를 생성합니다. 
        //이 엘리먼트는 나중에 해시태그를 감싸기 위한 용도
        //해시태그를 span으로 감싸는 것은 주로 
        //스타일링과 DOM 조작을 용이하게 하기 위한 목적
        var tagSpan = document.createElement('span');
        tagSpan.className = 'selected-tag';
        // tagSpan 엘리먼트에 'data-selected-tag' 속성을 추가하고, 이 속성의 값으로 현재 반복에서 가져온 tag 값을 설정합니다. 
        //이렇게 함으로써 나중에 삭제 버튼을 눌렀을 때 어떤 해시태그를 제거해야 하는지를 알 수 있습니다.
        tagSpan.setAttribute('data-selected-tag', tag);
        tagSpan.innerHTML = tag + ' ';
        //새로운 button 엘리먼트를 생성하고, 해당 버튼의 텍스트 내용을 'x'로 설정합니다.
        // 버튼의 type 속성은 'button'으로 설정됩니다.
        var removeButton = document.createElement('button');
        removeButton.textContent = 'x';
        removeButton.type = 'button';
        //removeButton에 클릭 이벤트 리스너를 추가합니다. 버튼이 클릭되면 
        //removeSelectedTag 함수가 호출되어 해당 해시태그를 제거하게 됩니다.
        removeButton.addEventListener('click', function () {
            removeSelectedTag(tag);
        });
        //removeButton을 자식 엘리먼트로 추가합니다. 
        //이로써 각 해시태그 옆에 삭제 버튼이 나타납니다.
        tagSpan.appendChild(removeButton);
        //tagSpan을 자식 엘리먼트로 추가합니다. 
        //이로써 각 해시태그와 삭제 버튼이 outputDiv에 표시됩니다.
        outputDiv.appendChild(tagSpan);
    });
    //selectedHashtags 배열의 내용을 문자열로 변환하여 숨겨진 
    //인풋 필드(selectedHashtagsInput)의 value 속성에 저장하는 역할
    var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
    selectedHashtagsInput.value = selectedHashtags.join(',');
}
function removeSelectedTag(tag) {
    var outputDiv = document.getElementById('hashtagContainer');
    var tags = outputDiv.querySelectorAll('.selected-tag');

    tags.forEach(function (tagElement) {
        //data-selected-tag' 속성 값을 가져와서 tagValue 변수에 저장
        var tagValue = tagElement.getAttribute('data-selected-tag');
        // 현재 해시태그의 값이 함수에 전달된 tag 값과 일치하는지 확인합니다.
        if (tagValue === tag) {
            //일치하는 경우, 해당 엘리먼트를 DOM에서 제거합니다.
            tagElement.remove();
            
            // 선택된 해시태그 배열에서 현재 삭제된 해시태그(tag)를 필터링하여 
            //해당 태그를 제외한 나머지 태그들만으로 새로운 배열을 생성합니다. 
            //이를 통해 선택된 해시태그 목록을 업데이트합니다
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

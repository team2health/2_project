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
document.addEventListener('DOMContentLoaded', function() {
    // 기존 이미지 미리보기 및 삭제 기능 추가
    for (let i = 0; i < 10; i++) {
        var fileInput = document.getElementById('file' + i);
        if (fileInput) {
            fileInput.addEventListener('change', function(event) {
                handleFileSelect(event);
            });
        }
    }
});

function handleFileSelect(event) {
    
    const files = event.target.files;
    
    const container = document.getElementById('imageContainer');

    for (const file of files) {
        const imageContainer = document.createElement('div');
        imageContainer.className = 'insert_img';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);

        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = '삭제';
        deleteButton.addEventListener('click', function() {
            // 이미지 및 해당 버튼 제거
            imageContainer.remove();
        });

        imageContainer.appendChild(img);
        imageContainer.appendChild(deleteButton);

        container.appendChild(imageContainer);     
    }
 }

    
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
        removeButton.textContent = 'X';
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

    let i = 0;
    tags.forEach(function (tagElement) {
        //data-selected-tag' 속성 값을 가져와서 tagValue 변수에 저장
        var tagValue = tagElement.getAttribute('data-selected-tag');
        if(tagValue) {
            selectedHashtags[i] = tagValue;
            i++;
        }
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

function openModal() {
    document.getElementById('myModal').style.display = 'block';
    selectedCategories = [];
}

// 모달 닫기
// function closeModal() {
//     document.getElementById('myModal').style.display = 'none';
// }

// 모달 외부 클릭 시 닫기
window.onclick = function(event) {
    console.log(event.target);
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        closeModal();
    }
}
function validateForm() {
    var selectedCategory = document.querySelector('.category-item.selected');
    
    if (!selectedCategory) {
        alert('게시판을 선택해주세요.');
        return false;
    }

    return true;
}

var selectedCategories = [];

        function toggleCategorySelection(categoryElement) {
            var categoryId = categoryElement.getAttribute('data-category-id');

            var index = selectedCategories.indexOf(categoryId);
            if (index === -1) {
                selectedCategories.push(categoryId);
                categoryElement.classList.add('selected');
            } else {
                selectedCategories.splice(index, 1);
                categoryElement.classList.remove('selected');
            }
            

            updateSelectedCategories();
        }

        function updateSelectedCategories() {
            var selectedCategoriesContainer = document.getElementById('selectedCategoriesContainer');
            selectedCategoriesContainer.innerHTML = ""; // 기존에 선택한 카테고리를 모두 지웁니다.

            selectedCategories.forEach(function (categoryId) {
                var categoryElement = document.createElement('p');
                categoryElement.innerText =categoryId;
                selectedCategoriesContainer.appendChild(categoryElement);
            });

            // 모달을 닫습니다.
            closeModal();
            var selectedCategoriesInput = document.getElementById('selectedCategoriesInput');
            selectedCategoriesInput.value = selectedCategories.join(',');

        }

        // function getCategoryNameById(categoryId) {
        //     // categoryId에 해당하는 카테고리 이름을 반환하는 함수를 구현해야 합니다.
        //     // 해당 함수는 서버 측에서 미리 로드한 카테고리 정보를 활용하여 categoryId에 해당하는 카테고리 이름을 반환해야 합니다.
        //     // 이 예제에서는 더미 함수로 대체하였습니다.
        //     return  categoryId;
        // }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
            
        }
// function selectCategory(categoryName) {
//     document.getElementById('selectedCategoriesContainer').innerText = categoryName;
//     document.getElementById('selectedCategoriesInput').value = categoryName;
//     closeModal();
// }

// function closeModal() {
//     document.getElementById('myModal').style.display = 'none';
// }

// function openModal() {
//     document.getElementById('myModal').style.display = 'block';
// }

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
//         preview.src = "{{ asset('img/camera2.png') }}";
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
//         preview.src = "{{ asset('img/camera2.png') }}";
//     }
// }


// document.addEventListener('DOMContentLoaded', function() {
//     // 기존 이미지 미리보기 및 삭제 기능 추가
//     for (let i = 0; i < 10; i++) {
//         var fileInput = document.getElementById('file' + i);
//         if (fileInput) {
//             fileInput.addEventListener('change', function(event) {
//                 handleFileSelect(event);
//             });
//         }
//     }
// });
// let test = null; // 파일 저장용 전역변수

// function handleFileSelect(event) {
//     if(!test) {
//         // 1번째 파일일 경우 초기 데이터 셋팅
//         test = event.target.files;
//     } else {
//         // 2번째 이후 파일일 경우 추가처리
//         const dataTranster = new DataTransfer();
//         // 기존 데이터 추가
//         for (let i = 0; i < test.length; i++) {
//             dataTranster.items.add(test[i]);
//         }
//         // 새로운 파일 추가
//         dataTranster.items.add(event.target.files[0]);
//         // 전역변수에 저장
//         test = dataTranster.files;
//     //     const fileInput = document.getElementById('fileInput1');
//     // fileInput.files = test;
//     }
// }
    // const files = event.target.files;
    
    // const container = document.getElementById('imageContainer');

    // for (const file of files) {

    //     const imageContainer = document.createElement('div');
    //     imageContainer.className = 'insert_img';

    //     const img = document.createElement('img');
    //     img.src = URL.createObjectURL(file);

    //     const deleteButton = document.createElement('button');
    //     deleteButton.type = 'button';
    //     deleteButton.textContent = '삭제';
    //     deleteButton.addEventListener('click', function() {
    //         // 이미지 및 해당 버튼 제거
    //         imageContainer.remove();
    //     });

    //     imageContainer.appendChild(img);
    //     imageContainer.appendChild(deleteButton);

    //     container.appendChild(imageContainer);     
    // }
    
//  }
let test = []; // 전역 변수로 선언

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    if (fileInput) {
        fileInput.addEventListener('change', function(event) {
            handleFileSelect(event);
        });
    }
});

function handleFileSelect(event) {
    const files = event.target.files;
    const container = document.getElementById('imageContainer');

    // CSRF 토큰을 가져옵니다.
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    for (const file of files) {
        const imageContainer = document.createElement('div');
        imageContainer.className = 'insert_img';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        const formData = new FormData();

        // CSRF 토큰을 FormData에 추가
        formData.append('_token', csrfToken);

        // test 배열에 있는 이미지들을 FormData에 추가
        for (const file of test) {
            formData.append('images[]', file);
        }
        
        // 서버로 이미지 전송
        fetch('/board', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error('Error:', error));
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = '삭제';
        deleteButton.addEventListener('click', function() {
            // 이미지 및 해당 버튼 제거
            imageContainer.remove();
            // 저장된 파일 목록에서도 삭제
            const fileIndex = test.findIndex(item => item.file === file);
            if (fileIndex !== -1) {
                test.splice(fileIndex, 1);
            }
        });

        imageContainer.appendChild(img);
        imageContainer.appendChild(deleteButton);

        container.appendChild(imageContainer);

        // 파일 정보와 함께 test 배열에 저장
        test.push({ file, imageContainer });
    }

    // test 배열에 저장된 정보를 활용하여 다양한 작업 수행 가능
    console.log(test);
}

// document.addEventListener('DOMContentLoaded', function() {
//     // 기존 이미지 미리보기 및 삭제 기능 추가
//     for (var i = 0; i < 10; i++) {
//         var fileInput = document.getElementById('file' + i);
//         if (fileInput) {
//             fileInput.addEventListener('change', function(event) {
//                 handleFileSelect(event);
//             });
//         }
//     }
// });
// function handleFileSelect(event) {
//     const files = event.target.files;
//     const container = document.getElementById('imageContainer');
    
//     for (const file of files) {
//         const imageContainer = document.createElement('div');
//         imageContainer.className = 'insert_img';
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
document.addEventListener('DOMContentLoaded', function() {
    openModal();  // 페이지 로드 시 모달 창을 열도록 호출     
});


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
        tagSpan.innerHTML = clickedTagName + ' <button type="button" onclick="removeSelectedTag(this)">X</button>';

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
function openModal() {
    document.getElementById('myModal').style.display = 'block';
    selectedCategories = [];
}

// 모달 닫기
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

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
                categoryElement.innerText = getCategoryNameById(categoryId);
                selectedCategoriesContainer.appendChild(categoryElement);
            });

            // 모달을 닫습니다.
            closeModal();
            var selectedCategoriesInput = document.getElementById('selectedCategoriesInput');
            selectedCategoriesInput.value = selectedCategories.join(',');

        }

        function getCategoryNameById(categoryId) {
            // categoryId에 해당하는 카테고리 이름을 반환하는 함수를 구현해야 합니다.
            // 해당 함수는 서버 측에서 미리 로드한 카테고리 정보를 활용하여 categoryId에 해당하는 카테고리 이름을 반환해야 합니다.
            // 이 예제에서는 더미 함수로 대체하였습니다.
            return  categoryId;
        }

        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
            
        }
        // function getSelectedCategoryIds() {
        //     return selectedCategories;
        // }
        
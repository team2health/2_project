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
    } 
}

// function removeImage(key) {
//     // 삭제하려는 이미지의 부모 요소를 찾아서 삭제
//     var imageContainer = document.getElementById(`preview${board_img_id}`);
//     console.log(imageContainer);
    
//     if (imageContainer) {
//         // 이미지를 감싸는 부모 요소를 찾기
//         var parentContainer = imageContainer.parentNode;
        
//         // 부모 요소에서 이미지 삭제
//         parentContainer.parentNode.removeChild(parentContainer);
//     }
// }

let IMGDELETE = [];
let cnt = 0;

function removeImage(imageId) {
    // 삭제하려는 이미지의 부모 요소를 찾아서 삭제
    var imageContainer = document.getElementById(`preview${imageId}`);
    
    if (imageContainer) {
        // 이미지를 감싸는 부모 요소를 찾기
        var parentContainer = imageContainer.parentNode;
        
        // 부모 요소에서 이미지 삭제
        parentContainer.parentNode.removeChild(parentContainer);

        // 배열에서 해당 이미지 ID를 사용하여 제거하는 로직 추가
        // 예: 이미지 배열(images)에서 imageId에 해당하는 이미지를 찾아 제거
        // images = images.filter(image => image.id !== imageId);
        
        IMGDELETE[cnt] = imageId;
        cnt++;
        document.getElementById('inputHiddenImgUrl').value = IMGDELETE;
    }
    // updateImagesOnServer();
}
// function updateImagesOnServer() {
//     // images 배열에서 이미지 ID만 추출하여 서버로 전송할 데이터 생성
//     var imageIdsToDelete = images.map(image => image.id);
//     var csrfToken = document.querySelector('meta[name="csrf-token"]').content;   

//     // 서버로 전송할 JSON 데이터
//     var jsonData = {
//         imagesToDelete: imageIdsToDelete
//     };

//     // Fetch API를 사용하여 서버로 JSON 데이터 전송
//     fetch('/board/board_id', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': csrfToken,
//         },
//         body: JSON.stringify(jsonData),
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log('Server response:', data);
//     })
//     .catch(error => {
//         console.error('Error during fetch:', error);
//     });
// }

 imageView = function imageView(vid, fid) {
    var imageZone = document.getElementById(vid);
    var selectFile = document.getElementById(fid);
    var sel_files = [];

    selectFile.onchange = function(e){
        var files = e.target.files;
        var fileArr = Array.prototype.slice.call(files) // begin부터 end-1 인덱스 까지 요소를 얕은 복사하여 새로운 배열 객체로 반환
        for(f of fileArr) {
            imageLoader(f);
        }
    }; 

    // 탐색기에서 드래그앤 드롭 사용
    
    // 드롭 대상 위로 지나갈 때
    imageZone.addEventListener('dragenter', function(e) {
        e.preventDefault();
        e.stopPropagation();
    }, false);
    
    // 드롭 대상위로 지나갈때
    imageZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.stopPropagation();
    }, false);
      
    // 드래그 할때
    imageZone.addEventListener('drop', function(e) {
        var files = {};
        e.preventDefault();
        e.stopPropagation();
        var dt = e.dataTransfer;
        files = dt.files;
        for(f of files) {
            imageLoader(f);
        }
    }, false);

    // 첨부된 이미지를 배열에 넣고 미리보기
    var imageLoader = function(file){
        sel_files.push(file);
        var reader = new FileReader();
        reader.onload = function(e) {
            let img = document.createElement('img')
            img.classList.add("image"); // class 추가
            img.src = e.target.result;
            imageZone.appendChild(makeDiv(img, file));
        };
      
        var dt = new DataTransfer();
        for(f in sel_files) {
            var file = sel_files[f];
            dt.items.add(file);
        }
        selectFile.files = dt.files;
        
        reader.readAsDataURL(file);
    };

    // 첨부된 파일이 있는 경우 button과 함께 imageZone에 추가할 div를 만들어 반환
    var makeDiv = function(img, file) {
        var div = document.createElement('div');
        div.classList.add("image-box");
  
        var btn = document.createElement('input');
        btn.setAttribute('type', 'button');
        btn.setAttribute('value', 'x');
        btn.setAttribute('delFile', file.name);
        btn.classList.add("image-btn");
        btn.onclick = function(ev){
            var ele = ev.srcElement;
            var delFile = ele.getAttribute('delFile');
            for(var i=0 ;i<sel_files.length; i++){
                if(delFile === sel_files[i].name){
                    sel_files.splice(i, 1);      
                }
            }
    
            var dt = new DataTransfer();
            for(f in sel_files) {
                var file = sel_files[f];
                dt.items.add(file);
            }
            selectFile.files = dt.files;
            
            var p = ele.parentNode;
            imageZone.removeChild(p);
        };
        div.appendChild(img);
        div.appendChild(btn);
        return div;
    };
}
('image_zone', 'selectFile');
// function openFile(fileInputId) {
//     document.getElementById(fileInputId).click();
// }

// // 
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
//  }
// function openFile(fileInputId) {
//     document.getElementById(fileInputId).click();
// }
// function removeImage(key) {
//     console.log('removeImage function called for key:', key); // 확인용 출력
//     var imageContainer = document.querySelector('.detail_board_content:nth-child(' + (key + 1) + ')');
//     console.log('Image container:', imageContainer); // 확인용 출력
//     if (imageContainer) {
//         imageContainer.remove();
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
//     } 
// }
// function removeImage(key) {
//     var imageContainer = document.querySelector('preview',key );
//     console.log(imageContainer)
//     imageContainer.remove();
// }  

 
//  imageView = function imageView(vid, fid) {
//     var imageZone = document.getElementById(vid);
//     var selectFile = document.getElementById(fid);
//     var sel_files = [];

//     selectFile.onchange = function(e){
//         var files = e.target.files;
//         var fileArr = Array.prototype.slice.call(files) // begin부터 end-1 인덱스 까지 요소를 얕은 복사하여 새로운 배열 객체로 반환
//         for(f of fileArr) {
//             imageLoader(f);
//         }
//     }; 

//     // 탐색기에서 드래그앤 드롭 사용
    
//     // 드롭 대상 위로 지나갈 때
//     imageZone.addEventListener('dragenter', function(e) {
//         e.preventDefault();
//         e.stopPropagation();
//     }, false);
    
//     // 드롭 대상위로 지나갈때
//     imageZone.addEventListener('dragover', function(e) {
//         e.preventDefault();
//         e.stopPropagation();
//     }, false);
      
//     // 드래그 할때
//     imageZone.addEventListener('drop', function(e) {
//         var files = {};
//         e.preventDefault();
//         e.stopPropagation();
//         var dt = e.dataTransfer;
//         files = dt.files;
//         for(f of files) {
//             imageLoader(f);
//         }
//     }, false);

//     // 첨부된 이미지를 배열에 넣고 미리보기
//     var imageLoader = function(file){
//         sel_files.push(file);
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             let img = document.createElement('img')
//             img.classList.add("image"); // class 추가
//             img.src = e.target.result;
//             imageZone.appendChild(makeDiv(img, file));
//         };
      
//         var dt = new DataTransfer();
//         for(f in sel_files) {
//             var file = sel_files[f];
//             dt.items.add(file);
//         }
//         selectFile.files = dt.files;
        
//         reader.readAsDataURL(file);
//     };
    

//     // 첨부된 파일이 있는 경우 button과 함께 imageZone에 추가할 div를 만들어 반환
//     var makeDiv = function(img, file) {
//         var div = document.createElement('div');
//         div.classList.add("image-box");
  
//         var btn = document.createElement('input');
//         btn.setAttribute('type', 'button');
//         btn.setAttribute('value', 'x');
//         btn.setAttribute('delFile', file.name);
//         btn.classList.add("image-btn");
//         btn.onclick = function(ev){
//             var ele = ev.srcElement;
//             var delFile = ele.getAttribute('delFile');
//             for(var i=0 ;i<sel_files.length; i++){
//                 if(delFile === sel_files[i].name){
//                     sel_files.splice(i, 1);      
//                 }
//             }
    
//             var dt = new DataTransfer();
//             for(f in sel_files) {
//                 var file = sel_files[f];
//                 dt.items.add(file);
//             }
//             selectFile.files = dt.files;
            
//             var p = ele.parentNode;
//             imageZone.removeChild(p);
//         };
//         div.appendChild(img);
//         div.appendChild(btn);
//         return div;
//     };
// }
// ('image_zone', 'selectFile');

 
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



// 모달 외부 클릭 시 닫기
window.addEventListener('click', function(event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
        closeModal();
    }
});
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
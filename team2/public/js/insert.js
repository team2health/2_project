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
			btn.setAttribute('value', 'X');
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
    
// //  }
// let test = []; // 전역 변수로 선언   최신

// document.addEventListener('DOMContentLoaded', function() {
//     const fileInput = document.getElementById('fileInput');
//     if (fileInput) {
//         fileInput.addEventListener('change', function(event) {
//             handleFileSelect(event);
//         });
//     }
// });

// function handleFileSelect(event) {
//     const files = event.target.files;
//     const container = document.getElementById('imageContainer');

//     // CSRF 토큰을 가져옵니다.
//     const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

//     for (const file of files) {
//         const imageContainer = document.createElement('div');
//         imageContainer.className = 'insert_img';

//         const img = document.createElement('img');
//         img.src = URL.createObjectURL(file);
//         const formData = new FormData();

//         // CSRF 토큰을 FormData에 추가
//         formData.append('_token', csrfToken);

//         // test 배열에 있는 이미지들을 FormData에 추가
//         for (const file of test) {
//             formData.append('images[]', file);
//         }
        
//         // 서버로 이미지 전송
//         fetch('/board', {
//             method: 'POST',
//             body: formData,
//         })
//         .then(response => response.json())
//         .then(data => console.log(data))
//         .catch(error => console.error('Error:', error));
//         const deleteButton = document.createElement('button');
//         deleteButton.type = 'button';
//         deleteButton.textContent = '삭제';
//         deleteButton.addEventListener('click', function() {
//             // 이미지 및 해당 버튼 제거
//             imageContainer.remove();
//             // 저장된 파일 목록에서도 삭제
//             const fileIndex = test.findIndex(item => item.file === file);
//             if (fileIndex !== -1) {
//                 test.splice(fileIndex, 1);
//             }
//         });

//         imageContainer.appendChild(img);
//         imageContainer.appendChild(deleteButton);

//         container.appendChild(imageContainer);

//         // 파일 정보와 함께 test 배열에 저장
//         test.push({ file, imageContainer });
//     }

//     // test 배열에 저장된 정보를 활용하여 다양한 작업 수행 가능
//     console.log(test);
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


// function handleTagClick(tag) {
//     var clickedTagName = tag.getAttribute('data-tag');

//     // 이미 선택된 태그인지 확인
//     if (!selectedHashtags.includes(clickedTagName)) {
//         // 클릭한 태그의 이름을 배열에 추가
//         selectedHashtags.push(clickedTagName);

//         // 출력할 div 선택
//         var outputDiv = document.getElementById('hashtagContainer');

//         // 추가된 태그를 span 태그로 감싸고 삭제 버튼 추가
//         var tagSpan = document.createElement('span');
//         tagSpan.className = 'selected-tag';
//         tagSpan.setAttribute('data-selected-tag', clickedTagName);
//         tagSpan.innerHTML = clickedTagName + ' <button type="button" onclick="removeSelectedTag(this)">X</button>';

//         // span 태그를 출력 div에 추가
//         outputDiv.appendChild(tagSpan);

//         // 배열에 있는 모든 해시태그를 숨겨진 인풋 필드에 설정
//         var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
//         selectedHashtagsInput.value = selectedHashtags.join(',');
//     }
    
//     // 기존 태그 목록에 존재하지 않는 경우에만 추가
    
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
//     var selectedHashtagsInput = document.getElementById('selectedHashtagsInput');
//     selectedHashtagsInput.value = selectedHashtags.join(',');
// }
function handleTagClick(tag) {
    var clickedTagName = tag.getAttribute('data-tag');

    // 클릭한 태그의 이름을 배열에 추가
    selectedHashtags.push(clickedTagName);

        // 출력할 div 선택
        var outputDiv = document.getElementById('hashtagContainer');

        // let tagButton = document.createElement('button');

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

    // 클릭한 태그에 이벤트 리스너 추가하여 클릭시 삭제 함수 호출
    tagSpan.addEventListener('click', function() {
        removeSelectedTag(tagSpan);
    });
}

function removeSelectedTag(element) {
    // 삭제 버튼이 속한 span 태그를 찾아 삭제
    var tagSpan = element;
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
window.addEventListener('click', function(event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
        closeModal();
    }
});
function validateForm() {
    var selectedCategory = document.querySelector('.category-item.selected');
    var input= document.getElementById('selectFile');
    var maxFileSize = 5 * 1024 * 1024; // 5MB
    if (!selectedCategory) {
        alert('게시판을 선택해주세요.');
        return false;
    }
    

    for (var i = 0; i < input.files.length; i++) {
        var fileSize = input.files[i].size;

        if (fileSize > maxFileSize) {
            alert('이미지 파일은 5MB를 초과할 수 없습니다.');
            return false; // 업로드를 중지합니다.
        }
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
        
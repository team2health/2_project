
// // 게시글 탭
// const tab = document.querySelector(".tab");
// // const tabListItem = document.querySelectorAll(".mypage-board-show-btn");
// const firstTab = document.getElementById('contentsTaBoard');
// const secondTab = document.getElementById('contentsTaComments');
// const tabContent1 = document.querySelectorAll(".tab-contents");
// const tabContent2 = document.querySelectorAll(".tab-contents2");
// const data1 = document.querySelectorAll('[data-order="1"]');
// const data2 = document.querySelectorAll('[data-order="2"]');

// let tabflg = 1;
// firstTab.addEventListener('click', function () {
//     if(tabflg === 2) {
//             data1.forEach(element => {
//                 // element.style.display = 'block';
//                 element.classList.add('tab-show');
//             });
//             data2.forEach(element => {
//                 // element.style.display = 'none';
//                 element.classList.remove('tab-show');

//             });
//         firstTab.classList.add('active');
//         secondTab.classList.remove('active');
//         tabflg = 1;
//     } 
// })

// secondTab.addEventListener('click', function () {
//     if (tabflg === 1) {
//             data2.forEach(element => {
//                 // element.style.display = 'block';
//                 element.classList.add('tab-show');
//             });
//             data1.forEach(element => {
//                 // element.style.display = 'none';
//                 element.classList.remove('tab-show');
//             });
//         firstTab.classList.remove('active');
//         secondTab.classList.add('active');
//         tabflg = 2;
//     }
// })

let SearchAlignFlg = 0;

let contentsmanagementSearchAlign = document.getElementById('contentsmanagementSearchAlign');
let contentclass = document.getElementById('contentsmanagementSearchAlignDiv');
let contentsmanagementSearchAlignValue = document.getElementById('contentsmanagementSearchAlignValue');
contentsmanagementSearchAlign.addEventListener('click', function() {
    if(SearchAlignFlg === 0){
        contentclass.classList.toggle('admin-display-none');
        SearchAlignFlg = 1;
    } else if(SearchAlignFlg === 1) {
        contentclass.classList.toggle('admin-display-none');
        SearchAlignFlg = 0;
    }
})

// 정렬
let alignValueSet = document.getElementById('alignValueSet');
alignValueSet.addEventListener('click', function(){
    contentsmanagementSearchAlignValue.setAttribute('value','0');
    let AlignValueForm = document.getElementById('AlignValueForm');
    contentclass.classList.add('admin-display-none');
    AlignValueForm.submit();
})
let alignValueSet2 = document.getElementById('alignValueSet');
alignValueSet2.addEventListener('click', function(){
    contentsmanagementSearchAlignValue.setAttribute('value','1');
    let AlignValueForm = document.getElementById('AlignValueForm');
    contentclass.classList.add('admin-display-none');
    AlignValueForm.submit();
})



let searchDate = new Date();
let thisYear = searchDate.getFullYear();


const birthYearEl = document.querySelectorAll('#start-year');
// NodeList를 배열로 변환
const birthYearArray = Array.from(birthYearEl);
// 각 요소에 대해 이벤트 리스너 추가
birthYearArray.forEach(element => {
    element.addEventListener('focus', function () {
        // option 목록을 생성할 컨테이너 역할을 하는 DocumentFragment 생성
        for(var i = 2020; i <= thisYear; i++) {
        // option element 생성
            const YearOption = document.createElement('option');
            YearOption.setAttribute('value', i);
            YearOption.innerText = i;
        // birthYearEl의 자식 요소로 추가
            this.appendChild(YearOption);
        }
    });
});

// '검색 달' 셀렉트 박스 option 목록 동적 생성
const birthMonthEl = document.querySelectorAll('#start-month');
const birthMonthArray = Array.from(birthMonthEl);
// option 목록 생성 여부 확인
birthMonthArray.forEach(element => {

    element.addEventListener('focus', function () {
		let day;
		for(var i = 1; i <= 12; i++) {
		// option element 생성
			const MonthOption = document.createElement('option');
			if(i<10) {
				day = "0" + i;
			} else {
				day = i;
			}
			MonthOption.setAttribute('value', day);
			MonthOption.innerText = i;
		// birthMonthEl의 자식 요소로 추가
			this.appendChild(MonthOption);
        }
    });
});

// '검색 날짜' 셀렉트 박스 option 목록 동적 생성
const birthDateEl = document.querySelectorAll('#start-day');
const birthDayArray = Array.from(birthDateEl);
// option 목록 생성 여부 확인
birthDayArray.forEach(element => {
    element.addEventListener('focus', function () {
		let date;
		for(var i = 1; i <= 31; i++) {
		// option element 생성
			if(i<10) {
				date = "0" + i;
			} else {
				date = i;
			}
			const DayOption = document.createElement('option');
			DayOption.setAttribute('value', date);
			DayOption.innerText = i
		// birthMonthEl의 자식 요소로 추가
			this.appendChild(DayOption);
		}
    });
});
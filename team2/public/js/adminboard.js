

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
let alignValueSet2 = document.getElementById('alignValueSet2');
alignValueSet2.addEventListener('click', function(){
    contentsmanagementSearchAlignValue.setAttribute('value','1');
    let AlignValueForm = document.getElementById('AlignValueForm');
    contentclass.classList.add('admin-display-none');
    AlignValueForm.submit();
})



// let searchDate = new Date();
// let thisYear = searchDate.getFullYear();


// const birthYearEl = document.querySelectorAll('#start-year');
// // NodeList를 배열로 변환
// const birthYearArray = Array.from(birthYearEl);
// // 각 요소에 대해 이벤트 리스너 추가
// birthYearArray.forEach(element => {
//     element.addEventListener('focus', function () {
//         // option 목록을 생성할 컨테이너 역할을 하는 DocumentFragment 생성
//         for(var i = 2020; i <= thisYear; i++) {
//         // option element 생성
//             const YearOption = document.createElement('option');
//             YearOption.setAttribute('value', i);
//             YearOption.innerText = i;
//         // birthYearEl의 자식 요소로 추가
//             this.appendChild(YearOption);
//         }
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });

// '검색 달' 셀렉트 박스 option 목록 동적 생성
// const birthMonthEl = document.querySelectorAll('#start-month');
// const birthMonthArray = Array.from(birthMonthEl);
// // option 목록 생성 여부 확인
// birthMonthArray.forEach(element => {

//     element.addEventListener('focus', function () {
// 		let day;
// 		for(var i = 1; i <= 12; i++) {
// 		// option element 생성
// 			const MonthOption = document.createElement('option');
// 			if(i<10) {
// 				day = "0" + i;
// 			} else {
// 				day = i;
// 			}
// 			MonthOption.setAttribute('value', day);
// 			MonthOption.innerText = i;
// 		// birthMonthEl의 자식 요소로 추가
// 			this.appendChild(MonthOption);
//         }
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });

// '검색 날짜' 셀렉트 박스 option 목록 동적 생성
// const birthDateEl = document.querySelectorAll('#start-day');
// const birthDayArray = Array.from(birthDateEl);
// // option 목록 생성 여부 확인
// birthDayArray.forEach(element => {
//     element.addEventListener('focus', function () {
// 		let date;
// 		for(var i = 1; i <= 31; i++) {
// 		// option element 생성
// 			if(i<10) {
// 				date = "0" + i;
// 			} else {
// 				date = i;
// 			}
// 			const DayOption = document.createElement('option');
// 			DayOption.setAttribute('value', date);
// 			DayOption.innerText = i
// 		// birthMonthEl의 자식 요소로 추가
// 			this.appendChild(DayOption);
// 		}
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });

// const birthYearEl2 = document.querySelectorAll('#end-year');
// // NodeList를 배열로 변환
// const birthYearArray2 = Array.from(birthYearEl2);
// // 각 요소에 대해 이벤트 리스너 추가
// birthYearArray2.forEach(element => {
//     element.addEventListener('focus', function () {
//         // option 목록을 생성할 컨테이너 역할을 하는 DocumentFragment 생성
//         for(var i = 2020; i <= thisYear; i++) {
//         // option element 생성
//             const YearOption = document.createElement('option');
//             YearOption.setAttribute('value', i);
//             YearOption.innerText = i;
//         // birthYearEl의 자식 요소로 추가
//             this.appendChild(YearOption);
//         }
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });

// // '검색 달' 셀렉트 박스 option 목록 동적 생성
// const birthMonthEl2 = document.querySelectorAll('#end-month');
// const birthMonthArray2 = Array.from(birthMonthEl2);
// // option 목록 생성 여부 확인
// birthMonthArray2.forEach(element => {

//     element.addEventListener('focus', function () {
// 		let day;
// 		for(var i = 1; i <= 12; i++) {
// 		// option element 생성
// 			const MonthOption = document.createElement('option');
// 			if(i<10) {
// 				day = "0" + i;
// 			} else {
// 				day = i;
// 			}
// 			MonthOption.setAttribute('value', day);
// 			MonthOption.innerText = i;
// 		// birthMonthEl의 자식 요소로 추가
// 			this.appendChild(MonthOption);
//         }
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });

// // '검색 날짜' 셀렉트 박스 option 목록 동적 생성
// const birthDateEl2 = document.querySelectorAll('#end-day');
// const birthDayArray2 = Array.from(birthDateEl2);
// // option 목록 생성 여부 확인
// birthDayArray2.forEach(element => {
//     element.addEventListener('focus', function () {
// 		let date;
// 		for(var i = 1; i <= 31; i++) {
// 		// option element 생성
// 			if(i<10) {
// 				date = "0" + i;
// 			} else {
// 				date = i;
// 			}
// 			const DayOption = document.createElement('option');
// 			DayOption.setAttribute('value', date);
// 			DayOption.innerText = i
// 		// birthMonthEl의 자식 요소로 추가
// 			this.appendChild(DayOption);
// 		}
//         element.removeEventListener('focus', handler);
//     },{ once: true });
// });


function categoryChange(data) {
    let form = document.getElementById('deleteAdminContent'+data);
    form.submit();
}

let allselectcheck = document.getElementById('allselectcheck');
let contents = document.getElementsByClassName('contens-checkbox');

allselectcheck.addEventListener('change', function() {
    for(let i = 0; i < 10; i++) {
        let isChecked = this.checked;
        contents[i].checked = isChecked;
    }
})

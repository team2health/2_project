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
    },{ once: true });
    
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
    },{ once: true });
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
    },{ once: true });
});

const endYear = document.querySelectorAll('#end-year');
// NodeList를 배열로 변환
const endYearArray = Array.from(endYear);
// 각 요소에 대해 이벤트 리스너 추가
endYearArray.forEach(element => {
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
    },{ once: true });
    
});

// '검색 달' 셀렉트 박스 option 목록 동적 생성
const endMonth = document.querySelectorAll('#end-month');
const endMonthArray = Array.from(endMonth);
// option 목록 생성 여부 확인
endMonthArray.forEach(element => {

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
    },{ once: true });
});

// '검색 날짜' 셀렉트 박스 option 목록 동적 생성
const endDay = document.querySelectorAll('#end-day');
const endDayArray = Array.from(endDay);
// option 목록 생성 여부 확인
endDayArray.forEach(element => {
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
    },{ once: true });
});



function allSelectCheckBox () {
    let allselectcheck = document.getElementById('allselectcheck');
    allselectcheck.addEventListener('click', function () {
        for (let i = 0; i < 10; i++) {
            let commentChkBox = document.getElementById('commentChkBox' + i);
            commentChkBox.setAttribute('checked');
        }
    })
}

function searchCommentDate() {
    let form = document.getElementById('searchCommentDateForm');
    let startYearvalue = document.getElementById('start-year').value;
    let startMonthvalue = document.getElementById('start-month').value;
    let startDayvalue = document.getElementById('start-day').value;
    let endYearvalue = document.getElementById('end-year').value;
    let endMonthvalue = document.getElementById('end-month').value;
    let endDayvalue = document.getElementById('end-day').value;
    console.log(startYearvalue);
    console.log(startMonthvalue);
    console.log(startDayvalue);
    console.log(endYearvalue);
    console.log(endMonthvalue);
    console.log(endDayvalue);
    if(startYearvalue === '연도') {
        return false;
    } else if (startMonthvalue === '월') {
        return false;
    } else if (startDayvalue === '일') {
        return false;
    } else if (endYearvalue === '연도') {
        return false;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
    } else if (endMonthvalue === '월') {
        return false;
    } else if (endDayvalue === '일') {
        return false;
    }
    form.submit();
}

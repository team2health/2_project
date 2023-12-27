// window.addEventListener('load', function() {
//     buildCalendar();  //달력 불러오는 함수를 페이지를 로딩하자마자 실행
// });.
// const mediaQuery = window.matchMedia('(min-width: 800px)');

// if (mediaQuery.matches) {
//     dateScrollbar();
//     console.log('노노노')
// } else {
//     console.log('애애앵')
// }


window.addEventListener('load', function() {
    weekendShow(); //일주일을 불러오는 함수
});
window.addEventListener('load', function() {
    yearShowDiv(); //달력 날짜를 표시하는 함수
});
window.addEventListener('load', function() {
    dateScrollbar(); //일주일 스크롤을 설정하는 함수
});

window.addEventListener('load', function() {
    showRecordToday();
});

let nowMonth = new Date();  // 현재 달을 페이지를 로드한 날의 달로 초기화
let today = new Date();     // 페이지를 로드한 날짜를 저장
today.setHours(0, 0, 0, 0);    // 비교 편의를 위해 today의 시간을 초기화

function yearShowDiv() {
    let showyear = today.getFullYear();
    let showmonth = today.getMonth()+1;

    let weekendindiv = document.getElementById('calendarBtn');
    weekendindiv.innerHTML = showyear + '년 ' + showmonth + '월';

}

//캘린더 보여주는 버튼
function calendarshow() {
    let calendarView = document.getElementById('calendarOpen');
    calendarView.classList.toggle('calendarNone');
    buildCalendar();
}

// 달력 블록 생성
function weekendShow() {
    let lastDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, 0);  // 이번달 마지막날

    let thismonth = today.getFullYear(); // 올해 날짜 가져옴
    let thismonthday = today.getMonth()+1; // 이번달
    let thismonthtoday = today.getDate();
    let iddate = thismonth + '-' + thismonthday + '-';

    let monthlast = new Date(thismonth, thismonthday+1, 0); //월의 마지막 날짜 가져오기
    let monthfirstday = new Date(thismonth, thismonthday, 1); //월의 마지막 날짜 가져오기
    let totalmonthdate = monthlast.getDate(); //변수에 담기
    let monthday = monthfirstday.getDay();


    for (let date = 1; date <= totalmonthdate; date++) {
        // 마지막 날짜만큼 for문 돌려서 1일부터 출력
        let monthdaytext;

        if(monthday == 0) {
            monthdaytext = '일';
        } else if (monthday == 1) {
            monthdaytext = '월';
        } else if (monthday == 2) {
            monthdaytext = '화';
        } else if (monthday == 3) {
            monthdaytext = '수';
        } else if (monthday == 4) {
            monthdaytext = '목';
        } else if (monthday == 5) {
            monthdaytext = '금';
        } else {
            monthdaytext = '토';
        };

        let weekendindiv = document.createElement('div');
        weekendindiv.classList.add('datebar');
        weekendindiv.id = 'weekend'+date;
        weekendindiv.onclick = function () {
            selectDate(iddate + date, date);
        }
        let weekendinspan = document.createElement('span');
        let weekendinspan2 = document.createElement('span')
        // let weekendinsdot = document.createElement('span')

        let mypagediv = document.getElementById('mypageSecondMargin');
        mypagediv.appendChild(weekendindiv);

        weekendinspan.innerHTML = date+'일';
        weekendinspan2.innerHTML =  monthdaytext;
        // weekendinsdot.innerHTML = '.';

        weekendindiv.appendChild(weekendinspan2);
        weekendindiv.appendChild(weekendinspan);
        // weekendindiv.appendChild(weekendinsdot);
        monthday++;
        
        if(monthday > 6) {
            monthday = 0;
        }

        if( date == thismonthtoday) {
            weekendindiv.classList.add('datebartoday');
        }
    }
}
// 날짜에 따른 검색기록 초기 화면 
function showRecordToday () {
    let noticeNoData = document.getElementById('noticeNoData');
    let recordTurn = document.getElementById('recordTurn').value;

    if(recordTurn == 0) {
        noticeNoData.classList.remove('notice-no-data');
    }

}
//날짜에 따른 검색기록 조회
function selectDate(data, data2) {
    console.log('data:   ' + data);
    console.log('data2:   ' + data2);

    // 선택한 날을 제외한 다른 hover 삭제
    let parentElement = document.getElementById('mypageSecond');
    let childElements = parentElement.getElementsByClassName('datebardayselect');
    for (let i = 0; i < childElements.length; i++) {
        childElements[i].classList.remove('datebardayselect');
    }
    
    let weekendinthediv = document.getElementById('weekend'+data2);
    weekendinthediv.classList.add('datebardayselect');

    selectDateScrollbar(data2);

    let recordTurnVal = document.getElementById('recordTurn').value;
    let recordTurn = document.getElementById('recordTurn');
    let recordDeleteTest = document.getElementById('recordDeleteTest');
    let recordCircleImg = document.querySelectorAll('.record-circle-img');
    let userRecord = document.getElementById('userRecord');
    let userRecordClass = document.querySelectorAll('.user-record');
    let noticeNoData = document.getElementById('noticeNoData');


    // if( recordTurnVal > 0) {
        for (let i = 0; i < recordTurnVal; i++){
            recordCircleImg.forEach(function (recordCircleImg) {
                recordCircleImg.remove();
            });
    
            userRecordClass.forEach(function (userRecord) {
                userRecord.remove();
            });
        }
    // }

    let formData = new FormData();
    formData.append('date', data);

    fetch('/daytimeline', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log('검색기록결과' + data);
        if( data.length > 0) {
            noticeNoData.classList.add('notice-no-data');
            recordTurn.value = '';
            recordTurn.value = data.length;

            for (let i = 0; i < data.length; i++) {
                let inputHiddenDate = document.createElement('input');
                let inputHiddenRecordId = document.createElement('input');
                let img = document.createElement('img');
                let recordDiv = document.createElement('div');
                let timespan = document.createElement('span');
                let recordDeleteDiv = document.createElement('div');
                let br = document.createElement('br');
                let textspan = document.createElement('span');
                inputHiddenDate.setAttribute('value', data[i].created_at);
                inputHiddenRecordId.setAttribute('value', data[i].record_id);
                let inputHiddenRecordValue = inputHiddenRecordId.value;
                img.classList.add('record-circle-img');
                img.id = 'recordCircleImg'+data[i].record_id;
                img.src = '/img/circle.png';
                recordDiv.id = 'userRecord'+data[i].record_id;
                recordDiv.classList.add('user-record');
                timespan.classList.add('record-time');
                timespan.innerHTML = data[i].created_at;
                recordDeleteDiv.classList.add('record-delete-btn');
                recordDeleteDiv.innerHTML = 'X';
                recordDeleteDiv.id = data[i].record_id;
                recordDeleteDiv.onclick = function (e) {recorddeletemodalopen(e.target.id);}
                textspan.classList.add('recordtext');
                textspan.innerHTML = data[i].symptom_name;
                console.log('record_id');
                console.log(data[i].record_id);
                console.log('onclick아이디');
                console.log(inputHiddenRecordValue);

                recordDiv.appendChild(timespan);
                recordDiv.appendChild(recordDeleteDiv);
                recordDiv.appendChild(br);
                recordDiv.appendChild(textspan);
                inputHiddenDate.appendChild(img);
                inputHiddenRecordId.appendChild(img);
                recordDeleteTest.appendChild(img);
                recordDeleteTest.appendChild(recordDiv);
            }
        } else {
            recordTurn.value = '';
            recordTurn.value = data.length;
            noticeNoData.classList.remove('notice-no-data');
        }
    })
    .catch(error => console.log(error));
}

// 스크롤 이동
function dateScrollbar() {
    let todaydiv = today.getDate();
    let scrollbar = document.getElementById('weekend' + todaydiv);
    // 특정 element를 기준으로 스크롤을 이동
    scrollbar.scrollIntoView({behavior: "auto", block: "center", inline: "center"});
}
// 선택 날짜를 중심으로 스크롤 이동
function selectDateScrollbar(data) {
    let scrollbar = document.getElementById('weekend' + data);
    scrollbar.scrollIntoView({behavior: 'smooth', block: "center", inline: "center"});
}


// 달력 생성 : 해당 달에 맞춰 테이블을 만들고, 날짜를 채워 넣는다.
function buildCalendar() {

    let firstDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth(), 1);     // 이번달 1일
    let lastDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, 0);  // 이번달 마지막날

    // 각 날짜에 id값 세팅
    let getFullYear = nowMonth.getFullYear();
    let getFullYearIn = String(getFullYear);
    let getMonth = nowMonth.getMonth()+1;
    let inputDateId = '';
    let getMonthIn = '';
    if(getMonth < 10) {
        getMonthIn = "0" + getMonth;
    } else {
        getMonthIn = String(getMonth);
    }
    let testsearchDateZero ='';
    inputDateId = getFullYearIn + getMonthIn;

    let tbody_Calendar = document.querySelector(".Calendar > tbody");
    document.getElementById("calYear").innerText = nowMonth.getFullYear();             // 연도 숫자 갱신
    document.getElementById("calMonth").innerText = leftPad(nowMonth.getMonth() + 1);  // 월 숫자 갱신

    while (tbody_Calendar.rows.length > 0) {      // 이전 출력결과가 남아있는 경우 초기화
        tbody_Calendar.deleteRow(tbody_Calendar.rows.length - 1);
    }

    let nowRow = tbody_Calendar.insertRow();  // 첫번째 행 추가           

    for (let j = 0; j < firstDate.getDay(); j++) {  // 이번달 1일의 요일만큼
        let nowColumn = nowRow.insertCell();        // 열 추가
    }

    let searchDate = 1;
    for (let nowDay = firstDate; nowDay <= lastDate; nowDay.setDate(nowDay.getDate() + 1)) {   // day는 날짜를 저장하는 변수, 이번달 마지막날까지 증가시키며 반복  
        
        let nowColumn = nowRow.insertCell();        // 새 열을 추가하고
        let newDIV = document.createElement("p");
        var searchDateZero = '';

        // 각 날짜에 value값 부여
        if(searchDate < 10) {
            searchDateZero = "0" + searchDate;
            newDIV.id = inputDateId + searchDateZero;
            testsearchDateZero = inputDateId + searchDateZero;
            // console.log(testsearchDateZero);
        } else {
            searchDateZero = searchDate;
            newDIV.id = inputDateId + searchDateZero;
            testsearchDateZero = inputDateId + searchDateZero;
        }
        newDIV.innerHTML = leftPad(nowDay.getDate());        // 추가한 열에 날짜 입력
        // let newDivId = newDIV.id;
        // ptagCal.onclick = function () { console.log('test') }; //각 날짜마다 onclick 처리        
        // console.log(testsearchDateZero);
        
        nowColumn.appendChild(newDIV);

        if (nowDay.getDay() == 6) {                 // 토요일인 경우
            nowRow = tbody_Calendar.insertRow();    // 새로운 행 추가
        }
        
        if (nowDay > today) {
            newDIV.className = "pastDay";
        }
        else if (nowDay.getFullYear() == today.getFullYear() && nowDay.getMonth() == today.getMonth() && nowDay.getDate() == today.getDate()) { // 오늘인 경우           
            newDIV.className = "today";
            // newDIV.onclick = function () { choiceDate(this); }
        }
        else {
            newDIV.className = "futureDay";
            // newDIV.onclick = function () { choiceDate(this); }
        }
        
        let ptagCal = document.getElementById(testsearchDateZero);
        ptagCal.onclick = function (e) {
            console.log("Event listener executed with ptagCal1:", ptagCal);
            console.log(e.target.id);
            newCalendarReloard(e.target.id);
            // choiceDate(this);
        }; //각 날짜마다 onclick 처리
        searchDate++;
    }
}

// 달력 날짜 선택하면 실행되는 함수
function newCalendarReloard(data) {

    // 기존 달의 데이터바 삭제
    let mypageSecond = document.getElementById('mypageSecond');
    let mypageSecondMargin = document.getElementById('mypageSecondMargin');
    mypageSecondMargin.innerHTML = '';
    // nextCalendar();
    let newCalendarYear = parseInt(data.substring(0, 4), 10);
    let newCalendarMonth = parseInt(data.substring(4, 6), 10) - 1; // 월은 0부터 시작하므로 1을 뺍니다.
    let newCalendarDay = parseInt(data.substring(6, 8), 10);
    
    // Date 객체를 생성합니다.
    let setNewCalendar = new Date(newCalendarYear, newCalendarMonth, newCalendarDay);


    let thisyear = setNewCalendar.getFullYear(); // 불러온 년도
    let thismonthday = setNewCalendar.getMonth()+1; // 불러온 달
    let thismonthtoday = setNewCalendar.getDate(); // 불러온 날짜
    console.log('불러온 날짜' + thismonthtoday);
    let iddate = thisyear + '-' + thismonthday + '-'; // 날짜마다id 세팅
    let monthlast = new Date(thisyear, thismonthday, 0); //월의 마지막 날짜 가져오기
    let monthfirstday = new Date(thisyear, thismonthday-1, 1); //월의 첫번째 날짜 가져오기
    let totalmonthdate = monthlast.getDate(); //변수에 담기
    let monthday = monthfirstday.getDay();
    let iddate2 = thisyear + '-' + thismonthday + '-' + thismonthtoday; // ���� ��다

    for (let a = 1; a <= totalmonthdate; a++) {
        // 마지막 날짜만큼 for문 돌려서 1일부터 출력
        let monthdaytext;

        if(monthday == 0) {
            monthdaytext = '일';
        } else if (monthday == 1) {
            monthdaytext = '월';
        } else if (monthday == 2) {
            monthdaytext = '화';
        } else if (monthday == 3) {
            monthdaytext = '수';
        } else if (monthday == 4) {
            monthdaytext = '목';
        } else if (monthday == 5) {
            monthdaytext = '금';
        } else {
            monthdaytext = '토';
        };

        let weekendindiv = document.createElement('div');
        weekendindiv.classList.add('datebar');
        weekendindiv.id = 'weekend'+a;
        weekendindiv.onclick = function () {
            selectDate(iddate + a, a);
        }
        let weekendinspan = document.createElement('span');
        let weekendinspan2 = document.createElement('span')
        
        weekendinspan.innerHTML = a +'일';
        weekendinspan2.innerHTML =  monthdaytext;
        
        weekendindiv.appendChild(weekendinspan2);
        weekendindiv.appendChild(weekendinspan);
        mypageSecondMargin.appendChild(weekendindiv);
        mypageSecond.appendChild(mypageSecondMargin);
        monthday++;
        
        if(monthday > 6) {
            monthday = 0;
        }

    }
    // let data2 = thismonthtoday;

    calendarshow(); //캘린더 닫기
    let weekendindiv = document.getElementById('calendarBtn');
    weekendindiv.innerHTML = thisyear + '년 ' + thismonthday + '월';
    selectDate(iddate2 , thismonthtoday);
}

// 날짜 선택
function choiceDate(ptagCal) {
    console.log("choiceDate", ptagCal);
    if (document.getElementsByClassName("choiceDay")[0]) {                              // 기존에 선택한 날짜가 있으면
        document.getElementsByClassName("choiceDay")[0].classList.remove("choiceDay");  // 해당 날짜의 "choiceDay" class 제거
    }
    ptagCal.classList.add("choiceDay");           // 선택된 날짜에 "choiceDay" class 추가
}

// 이전달 버튼 클릭
function prevCalendar() {
    nowMonth = new Date(nowMonth.getFullYear(), nowMonth.getMonth() - 1, nowMonth.getDate());   // 현재 달을 1 감소
    buildCalendar();    // 달력 다시 생성
}
// 다음달 버튼 클릭
function nextCalendar() {
    console.log('달력 다음달 버튼 클릭시:'+ nowMonth.getMonth())
    if(nowMonth.getMonth() + 1 > 11) {
        let Year =  nowMonth.getFullYear() + 1;
        let Month = 0;
        let newDate = nowMonth.getDate();
        
        nowMonth = new Date(Year, Month, newDate);
        console.log('달력 리뉴얼'+nowMonth);
    } else {
        nowMonth = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, nowMonth.getDate());   // 현재 달을 1 증가
        console.log('달력 유지'+nowMonth);
    }
    buildCalendar();    // 달력 다시 생성
}

// input값이 한자리 숫자인 경우 앞에 '0' 붙혀주는 함수
function leftPad(value) {
    if (value < 10) {
        value = "0" + value;
        return value;
    }
    return value;
}

//  검색기록 삭제
function recorddeletemodalopen(data) {

    if(confirm("삭제하시겠습니까?")){
        // 삭제
        let deleteImg = document.getElementById('recordCircleImg'+data);
        let deleteDiv = document.getElementById('userRecord'+data);
        deleteDiv.remove();
        deleteImg.remove();
    
        let formData = new FormData();
        formData.append('record_id', data);
    
        fetch('/recorddelete', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)})
        .catch(error => console.log(error));

	}else{
        // 처리 없음
	}

}


window.addEventListener('load', function() {
    buildCalendar();  //달력 불러오는 함수를 페이지를 로딩하자마자 실행
});

window.addEventListener('load', function() {
    weekendshow(); //일주일을 불러오는 함수
});
window.addEventListener('load', function() {
    yearshowdiv(); //일주일을 불러오는 함수
});
window.addEventListener('load', function() {
    datescrollbar(); //일주일을 불러오는 함수
});


let nowMonth = new Date();  // 현재 달을 페이지를 로드한 날의 달로 초기화
let today = new Date();     // 페이지를 로드한 날짜를 저장
today.setHours(0, 0, 0, 0);    // 비교 편의를 위해 today의 시간을 초기화

function yearshowdiv() {
    let showyear = today.getFullYear();
    let showmonth = today.getMonth()+1;

    let weekendindiv = document.getElementById('calendarBtn');
    weekendindiv.innerHTML = showyear + '년 ' + showmonth + '월';

}

function calendarshow() {
    let calendarView = document.getElementById('calendarOpen');
    calendarView.classList.toggle('calendarNone');
} //캘린더 보여주는 버튼

function weekendshow() {

    let lastDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, 0);  // 이번달 마지막날

    let thismonth = today.getFullYear(); // 올해 날짜 가져옴
    let thismonthday = today.getMonth(); // 이번달
    let thismonthtoday = today.getDate();

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
        let weekendinspan = document.createElement('span');
        let weekendinspan2 = document.createElement('span')
        let weekendinsdot = document.createElement('span')

        let mypagediv = document.getElementById('mypageSecond');
        mypagediv.appendChild(weekendindiv);

        weekendinspan.innerHTML = date+'일';
        weekendinspan2.innerHTML =  monthdaytext;
        weekendinsdot.innerHTML = '.';

        weekendindiv.appendChild(weekendinspan2);
        weekendindiv.appendChild(weekendinspan);
        weekendindiv.appendChild(weekendinsdot);
        monthday++;
        
        if(monthday > 6) {
            monthday = 0;
        }

        if( date == thismonthtoday) {
            weekendindiv.classList.add('datebartoday');
        }

        weekendindiv.onclick = function() {
            alert('클릭되었을 경우 처리');
        };
    }
}
// 스크롤 이동 javascript
function datescrollbar() {
    let todaydiv = today.getDate();
    let scrollbar = document.getElementById('weekend' + todaydiv);
    // 특정 element를 기준으로 스크롤을 이동
    scrollbar.scrollIntoView({behavior: "auto", block: "center", inline: "center"});
    // scrollbar.scrollTo({left:1070, top:100})
}



// 달력 생성 : 해당 달에 맞춰 테이블을 만들고, 날짜를 채워 넣는다.
function buildCalendar() {

    let firstDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth(), 1);     // 이번달 1일
    let lastDate = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, 0);  // 이번달 마지막날

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

    for (let nowDay = firstDate; nowDay <= lastDate; nowDay.setDate(nowDay.getDate() + 1)) {   // day는 날짜를 저장하는 변수, 이번달 마지막날까지 증가시키며 반복  

        let nowColumn = nowRow.insertCell();        // 새 열을 추가하고


        let newDIV = document.createElement("p");
        newDIV.innerHTML = leftPad(nowDay.getDate());        // 추가한 열에 날짜 입력
        nowColumn.appendChild(newDIV);

        if (nowDay.getDay() == 6) {                 // 토요일인 경우
            nowRow = tbody_Calendar.insertRow();    // 새로운 행 추가
        }

        if (nowDay > today) {                       // 지난날인 경우
            newDIV.className = "pastDay";
        }
        else if (nowDay.getFullYear() == today.getFullYear() && nowDay.getMonth() == today.getMonth() && nowDay.getDate() == today.getDate()) { // 오늘인 경우           
            newDIV.className = "today";
            newDIV.onclick = function () { choiceDate(this); }
        }
        else {                                      // 미래인 경우
            newDIV.className = "futureDay";
            newDIV.onclick = function () { choiceDate(this); }
        }
    }
}

// 날짜 선택
function choiceDate(newDIV) {
    if (document.getElementsByClassName("choiceDay")[0]) {                              // 기존에 선택한 날짜가 있으면
        document.getElementsByClassName("choiceDay")[0].classList.remove("choiceDay");  // 해당 날짜의 "choiceDay" class 제거
    }
    newDIV.classList.add("choiceDay");           // 선택된 날짜에 "choiceDay" class 추가
}

// 이전달 버튼 클릭
function prevCalendar() {
    nowMonth = new Date(nowMonth.getFullYear(), nowMonth.getMonth() - 1, nowMonth.getDate());   // 현재 달을 1 감소
    buildCalendar();    // 달력 다시 생성
}
// 다음달 버튼 클릭
function nextCalendar() {
    nowMonth = new Date(nowMonth.getFullYear(), nowMonth.getMonth() + 1, nowMonth.getDate());   // 현재 달을 1 증가
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

// 삭제 모달
function recorddeletemodalopen() {
    let modalopen = document.getElementById('mypageFourth');
    modalopen.style.display = 'block';
}

// 삭제 모달 닫기
function deletemodalclose() {
    let modalclose = document.getElementById('mypageFourth');
    modalclose.style.display = 'none';
}

// 삭제 모달 확인 버튼 
function recorddeletebtn() {
    let recorddelete = document.getElementById('recordDeleteTest');
    recorddelete.style.display = 'none';
    deletemodalclose();
}

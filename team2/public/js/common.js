let now = new Date();
now.getFullYear();
let year = now.getFullYear();
now.getMonth() + 1;
let month = now.getMonth() + 1;
console.log(year);
now.getDate();
let date = now.getDate();
now.getDay();
let day = now.getDay();
w_day = '';

switch(day) {
	case 1:
		w_day = ' 월요일';
		break;
	case 2:
		w_day = ' 화요일';
		break;
	case 3:
		w_day = ' 수요일';
		break;
	case 4:
		w_day = ' 목요일';
		break;
	case 5:
		w_day = ' 금요일';
		break;
	case 6:
		w_day = ' 토요일';
		break;
	default:
		w_day = ' 일요일';
		break;
}
let timeYear = document.getElementById('time-year');
let timeDay = document.getElementById('time-day');
timeYear.innerHTML = year+'.'+month+'.'+date;
timeDay.innerHTML = w_day;
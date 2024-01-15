let myChart = echarts.init(document.getElementById('chart'));
let MAINDATA = JSON.parse(document.getElementById('statistics').getAttribute('data-results'));
let GENDERMAIN = document.getElementById('main-gender');

let data = MAINDATA[0];
let genderdata = MAINDATA[1];
let boarddata = MAINDATA[2];
let commentdata = MAINDATA[3];

genderdata.forEach(element => {
	let SPAN = document.createElement('div');
	if(element.user_gender === '1') {
		SPAN.innerHTML = '남성:'+element.gender_count;
	} else if(element.user_gender === '2') {
		SPAN.innerHTML = '여성:'+element.gender_count;
	}
	SPAN.classList = 'genderList';
	GENDERMAIN.appendChild(SPAN);
});

let week = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
let boardcnt = [];
let bcount = 0;

week.forEach(week => {
	bcount = 0;

	boarddata.forEach(element => {
    if(element.week === week) {
    	bcount = element.cnt;
    }
});
	boardcnt.push(bcount);
});

let commentcnt = [];
let ccount = 0;

week.forEach(week => {
	ccount = 0;

	commentdata.forEach(element => {
    if(element.week === week) {
    	ccount = element.cnt;
    }
});
	commentcnt.push(ccount);
});

option = {
	tooltip: {
    trigger: 'item'
	},
legend: {
    top: '5%',
    left: 'center'
	},
series: [
    {
		name: '연령대',
		type: 'pie',
		radius: ['40%', '70%'],
		avoidLabelOverlap: false,
		itemStyle: {
        borderRadius: 10,
        borderColor: '#fff',
        borderWidth: 2
	},
	label: {
        show: false,
        position: 'center'
		},
		emphasis: {
        label: {
			show: true,
			fontSize: 40,
			fontWeight: 'bold'
        }
	},
	labelLine: {
        show: false
	},
	data
    }
]
};

myChart.setOption(option);


let myChart1 = echarts.init(document.getElementById('chart1'));

option1 = {
	tooltip: {
    trigger: 'axis'
},
legend: {
    data: ['board', 'comment']
},
grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
},
toolbox: {
    feature: {
		saveAsImage: {}
    }
},
xAxis: {
    type: 'category',
    boundaryGap: false,
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
},
yAxis: {
    type: 'value'
},
series: [
    {
		name: 'board',
		type: 'line',
		data: boardcnt
    },
    {
		name: 'comment',
		type: 'line',
		data: commentcnt
    }
]
};

myChart1.setOption(option1);

function insertpandemic() {
	let PANDEMICNAME = document.getElementById('pandemic_name_insert').value;
	let PANDEMICSYMPTOM = document.getElementById('pandemic_symptom_insert').value;

	let formData = new FormData();
	formData.append('pandemic_name', PANDEMICNAME);
	formData.append('pandemic_symptom', PANDEMICSYMPTOM);
	
	fetch('/pandemicinsert', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
		console.log(data);

		let PANDEMICDELETEBOX = document.getElementById('pandemicdeletebox');
		let PANDEMICHEADER = document.createElement('div');
		let DIV = document.createElement('div');
		let PANDEMICSPAN = createElement('span');
		let PANDEMICINPUT = createElement('input');
		let PANDEMICNAME = createElement('span');
		let PANDEMICSYMPTOM = createElement('span');
		let PANDEMICCREATE = createElement('span');


		// <div class="card-header">
		// 		<div class="admin-index-ps">
		// 			<span><input type="checkbox" name="pandemic_id[]" value="{{$item->pandemic_id}}"></span>
		// 			<span class="pandemic-name1">{{$item->pandemic_name}}</span>
		// 			<span class="pandemic-symptom1">{{$item->pandemic_symptoms}}</span>
		// 			<span>{{$item->created_at}}</span>
		// 		</div>
		// </div>

		// let DATE = new Date(data.created_at);
		// var formattedDate = DATE.getFullYear() + '-' +
        // ('0' + (DATE.getMonth() + 1)).slice(-2) + '-' +
        // ('0' + DATE.getDate()).slice(-2) + ' ' +
        // ('0' + DATE.getHours()).slice(-2) + ':' +
        // ('0' + DATE.getMinutes()).slice(-2) + ':' +
        // ('0' + DATE.getSeconds()).slice(-2);
	})
	.catch(error => {
		console.error(error.stack);
	})
}
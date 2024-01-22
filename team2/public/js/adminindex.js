let MAINDATA = JSON.parse(document.getElementById('statistics').getAttribute('data-results'));
let GENDERMAIN = document.getElementById('main-gender');
let PSMODAL1 = document.getElementById('psModal1');
let PSMODAL2 = document.getElementById('psModal2');
let PSMODAL3 = document.getElementById('psModal3');
let PSMODAL4 = document.getElementById('psModal4');

let data = MAINDATA[0];
let genderdata = MAINDATA[1];
let boarddata = MAINDATA[2];
let commentdata = MAINDATA[3];
let psrankdata = MAINDATA[4];
let psrankdata2 = MAINDATA[6];

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

function psModal(index) {
	if(index === 1) {
		PSMODAL1.classList = 'psmodaldisplaynone';
		PSMODAL2.removeAttribute('class');
	} else if(index === 2) {
		PSMODAL2.classList = 'psmodaldisplaynone';
		PSMODAL1.removeAttribute('class');
	} else if(index === 3) {
		PSMODAL3.classList = 'psmodaldisplaynone';
		PSMODAL4.removeAttribute('class');
	} else if(index === 4) {
		PSMODAL4.classList = 'psmodaldisplaynone';
		PSMODAL3.removeAttribute('class');
	}
}

let week = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
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

let myChart = echarts.init(document.getElementById('chart'));

option = {
	tooltip: {
    trigger: 'item'
	},
legend: {
    top: 0,
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
    data: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
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

let pscnt = [];
let pslastyearcnt = [];
let psname = [];

psrankdata.forEach(element => {
	pscnt.push(element.cnt);
	pslastyearcnt.push(element.last_year_cnt);
	psname.push(element.part_name[0].part_name+' - '+element.symptom_name[0].symptom_name);
});

let myChart2 = echarts.init(document.getElementById('chart2'));

option2 = {
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    }
  },
  legend: {
	top: 10,
  },
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: {
    type: 'value',
    boundaryGap: [0, 0.01]
  },
  yAxis: {
    type: 'category',
    data: psname.reverse()
  },
  series: [
    {
      name: '2023',
      type: 'bar',
      data: pslastyearcnt.reverse()
    },
    {
      name: '2024',
      type: 'bar',
      data: pscnt.reverse()
    }
  ]
};

myChart2.setOption(option2);

let pscnt2 = [];
let pslastyearcnt2 = [];
let psage2 = [];
let psname2 = [];

psrankdata2.forEach(element => {
	pscnt2.push(element.cnt);
	pslastyearcnt2.push(element.last_year_cnt);
	psage2.push(element.age_range);
	psname2.push(element.part_name[0].part_name+' - '+element.symptom_name[0].symptom_name);
});

let psname3 = psname2.reverse();

let myChart3 = echarts.init(document.getElementById('chart3'));

option3 = {
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'shadow'
    },
    textStyle: {
      fontSize: 14,
    },
	formatter: function(params) {
		var dataIndex = params[0].dataIndex;

		var customTooltip = psname3[dataIndex] + '<br>' + params[0].marker + params[0].seriesName + ' ' + params[0].value + '<br>' + params[1].marker + params[1].seriesName + '  ' + params[1].value;
		return customTooltip;
	  }
  },
  legend: {
	top: 10,
  },
  grid: {
    left: '3%',
    right: '4%',
    bottom: '3%',
    containLabel: true
  },
  xAxis: {
    type: 'value',
    boundaryGap: [0, 0.01]
  },
  yAxis: {
    type: 'category',
    data: psage2.reverse()
  },
  series: [
    {
      name: '2023',
      type: 'bar',
      data: pslastyearcnt2.reverse()
    },
    {
      name: '2024',
      type: 'bar',
      data: pscnt2.reverse()
    }
  ]
};

myChart3.setOption(option3);


function insertpandemic() {
	let PANDEMICNAME = document.getElementById('pandemic_name_insert').value;
	let PANDEMICSYMPTOM = document.getElementById('pandemic_symptom_insert').value;

	let formData = new FormData();
	formData.append('pandemic_name', PANDEMICNAME);
	formData.append('pandemic_symptom', PANDEMICSYMPTOM);
	
	fetch('/admin/pandemicinsert', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {

		let PANDEMICDELETEBOX = document.getElementById('pandemicdeletebox');
		let PANDEMICHEADER = document.createElement('div');
		let DIV = document.createElement('div');
		let PANDEMICSPAN = document.createElement('span');
		let PANDEMICINPUT = document.createElement('input');
		let PANDEMICNAME = document.createElement('span');
		let PANDEMICSYMPTOM = document.createElement('span');
		let PANDEMICCREATE = document.createElement('span');

		PANDEMICHEADER.classList = 'card-header';
		DIV.classList='admin-index-ps';
		PANDEMICINPUT.type = 'checkbox';
		PANDEMICINPUT.name = 'pandemic_id[]';
		PANDEMICINPUT.value = data.pandemic_id;
		PANDEMICNAME.classList = 'pandemic-name1';
		PANDEMICNAME.innerHTML = data.pandemic_name;
		PANDEMICSYMPTOM.classList = 'pandemic-symptom1';
		PANDEMICSYMPTOM.innerHTML = data.pandemic_symptoms;
		
		let DATE = new Date(data.created_at);
		var formattedDate = DATE.getFullYear() + '-' +
        ('0' + (DATE.getMonth() + 1)).slice(-2) + '-' +
        ('0' + DATE.getDate()).slice(-2) + ' ' +
        ('0' + DATE.getHours()).slice(-2) + ':' +
        ('0' + DATE.getMinutes()).slice(-2) + ':' +
        ('0' + DATE.getSeconds()).slice(-2);

		PANDEMICCREATE.innerHTML = formattedDate;

		PANDEMICDELETEBOX.prepend(PANDEMICHEADER);
		PANDEMICHEADER.appendChild(DIV);
		DIV.appendChild(PANDEMICSPAN);
		PANDEMICSPAN.appendChild(PANDEMICINPUT);
		DIV.appendChild(PANDEMICNAME);
		DIV.appendChild(PANDEMICSYMPTOM);
		DIV.appendChild(PANDEMICCREATE);

		document.getElementById('pandemic_name_insert').value = "";
		document.getElementById('pandemic_symptom_insert').value = "";
	})
	.catch(error => {
		console.error(error.stack);
	})
}

function pandemicdelete() {
    let checkboxes = document.querySelectorAll('input[name="pandemic_id[]"]');
    let chkflg = false;

    checkboxes.forEach(function(checkbox) {
        if(checkbox.checked === true) {
            chkflg = true;
        }
    });
    if(chkflg === false) {
        alert('선택된 유행하는 질병이 없습니다.');
        return false;
    }
    document.getElementById('pandemicdeletebox').submit();
}
let sidebarItemHover = document.querySelectorAll('.sidebar-item');
let currentPath = window.location.pathname + window.location.search;
if(currentPath === '/admin/main') {
    console.log('작동해');
    console.log(sidebarItemHover[0]);
    sidebarItemHover[0].style. setProperty('background-color', '#b8d8ff', 'important');
    // sidebarItemHover[0].style.backgroundColor = '#b8d8ff';
    // sidebarItemHover[0].style.color = 'rgb(53, 44, 57)';
}

var myChart = echarts.init(document.getElementById('chart'));

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
      name: 'Access From',
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
      data: [
        { value: 1048, name: 'Search Engine' },
        { value: 735, name: 'Direct' },
        { value: 580, name: 'Email' },
        { value: 484, name: 'Union Ads' },
        { value: 300, name: 'Video Ads' }
      ]
    }
  ]
};

myChart.setOption(option);
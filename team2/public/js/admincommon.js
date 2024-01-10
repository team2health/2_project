let sidebarItemHover = document.querySelectorAll('.sidebar-item');
let currentPath = window.location.pathname + window.location.search;
if(currentPath === '/admin/main') {
    console.log('작동해');
    console.log(sidebarItemHover[0]);
    sidebarItemHover[0].style. setProperty('background-color', '#b8d8ff', 'important');
    // sidebarItemHover[0].style.backgroundColor = '#b8d8ff';
    // sidebarItemHover[0].style.color = 'rgb(53, 44, 57)';
}
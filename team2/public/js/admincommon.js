let sidebarItemHover = document.querySelectorAll('.sidebar-item');
let currentPath = window.location.pathname + window.location.search;
if(currentPath === '/admin/main') {
    sidebarItemHover[0].style. setProperty('background-color', '#b8d8ff', 'important');
    // sidebarItemHover[0].style.backgroundColor = '#b8d8ff';
    // sidebarItemHover[0].style.color = 'rgb(53, 44, 57)';
}

let ADMINMODAL = document.getElementById('admin_modal');

function adminmodalon() {
    ADMINMODAL.style.display = 'block';
}

function adminmodaloff() {
    ADMINMODAL.style.display = 'none';
}
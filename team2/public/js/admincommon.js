

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

function adminRegist() {
    let ADMINID = document.getElementById('admin_regist_id').value;
    let ADMINNAME = document.getElementById('admin_regist_name').value;
    let ADMINPW = document.getElementById('admin_regist_pw').value;

    let formData = new FormData();
	formData.append('admin_id', ADMINID);
	formData.append('admin_name', ADMINNAME);
	formData.append('admin_password', ADMINPW);

	fetch('/admin/adminregist', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
        ADMINMODAL.style.display = 'none';
        document.getElementById('admin_regist_id').value = "";
        document.getElementById('admin_regist_name').value = "";
        document.getElementById('admin_regist_pw').value = "";
	})
	.catch(error => {
		console.error(error.stack);
	})
}


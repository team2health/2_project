let now = new Date();
now.getFullYear();
let year = now.getFullYear();
now.getMonth() + 1;
let month = now.getMonth() + 1;
// console.log(year);
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


function toggleDropdown() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// function toggleDropdown2() {
//     document.getElementById("myDropdown2").classList.toggle("show");
// }

// 창 외부 클릭 시 드랍다운 닫기
window.onclick = function (event) {
    if (!event.target.matches('.cate_btn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// let categoryFlg = 0;

    // Ajax를 사용하여 해당 카테고리의 게시글을 불러오는 코드
    // 여기에서는 가상의 URL 및 데이터로 예시를 보여줍니다.
    function showBoard(categoryId) {
        let FORMACTION = document.getElementById('category_id_form');
        FORMACTION.setAttribute('action', '/boardcategory/'+categoryId);
        // let CATEGORYBOARD = document.getElementById('category-board');
        // let CATEGORYBOARDMODAL = document.getElementById('category-board-modal');
        // CATEGORYBOARD.style.display = 'none';
        // CATEGORYBOARDMODAL.removeAttribute('style');
        // CATEGORYBOARDMODAL.style.display = 'block';

        // console.log(categoryId);
        // $url = '/boardcategory'+'/'+categoryId;

        // fetch($url)
        // .then(response => response.json())
        // .then(data => {
            // console.log(data);
            // let CBMODAL = document.getElementById('category-board-modal');
            // let CATEGORYDIV = document.createAttribute('div');
            // let LASTUSERDIV = document.createAttribute('div');
            // CBMODAL.appendChild(CATEGORYDIV);
            // CATEGORYDIV.innerHTML = 'adfasdfasdfasdfsadf';
            // CATEGORYDIV.setAttribute('class', 'last_container');
            // CATEGORYDIV.appendChild(LASTUSERDIV);
            // LASTUSERDIV.setAttribute('class', 'last_user');

            // let MODALBOARDIMG = document.createAttribute('img');
            // LASTUSERDIV.appendChild(MODALBOARDIMG);
            // MODALBOARDIMG.setAttribute('class', 'community_icon');

            // let NAMECREATED = document.createAttribute('div');
            // LASTUSERDIV.appendChild(NAMECREATED);

            // let CATEGORYNAME = document.createAttribute('div');
            // NAMECREATED.appendChild(CATEGORYNAME);
            // CATEGORYNAME.innerHTML = 'aaaaaa';

            // let CATEGORYCREATE = document.createAttribute('div');
            // NAMECREATED.appendChild(CATEGORYCREATE);
            // CATEGORYCREATE.innerHTML = 'bbbb';

            // if(categoryFlg === 0) {
            //     let DIVCREATE = [];
                
            //     for(let i = 0; i < data[1].length; i++) {
            //         let MYDROPDOWM = document.getElementById('myDropdown2');
            //         DIVCREATE[i] = document.createElement('div');
    
            //         MYDROPDOWM.appendChild(DIVCREATE[i]);
            //         DIVCREATE[i].innerHTML = data[1][i].category_name;
            //         DIVCREATE[i].setAttribute('id', 'category_select');
            //         DIVCREATE[i].setAttribute('onclick', `showBoard(${data[1][i].category_id})`)
            //     }
            //     categoryFlg = 1;
            // }

            
        // })
        // .catch(error => {
        //     console.error('오류 발생:', error);
        // })  
        FORMACTION.submit();
    
        // 드랍다운 닫기
        document.getElementById("myDropdown").classList.remove("show");
    }
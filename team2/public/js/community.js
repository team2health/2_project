document.addEventListener('DOMContentLoaded', function () {
    let startSlide = 0;
    let endSlide = 10; // 5개씩 보여주기 위해 endSlide 설정
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide() {
        for (let i = 0; i < totalSlides; i++) {
            if (i >= startSlide && i <= endSlide) {
                slides[i].style.display = 'block';
            } else {
                slides[i].style.display = 'none';
            }
        }
    }

    function nextSlide() {
        if (endSlide < totalSlides - 1) {
            startSlide++;
            endSlide++;
            showSlide();
        }
    }

    function prevSlide() {
        if (startSlide > 0) {
            startSlide--;
            endSlide--;
            showSlide();
        }
    }

    // 초기 슬라이드 보여주기
    showSlide();

    // 자동 슬라이딩 설정 (5초마다 변경)
    setInterval(nextSlide, 5000);
});


function lastBoard() {
    let LASTNUM = document.getElementById('last_num').value;

    // console.log(LASTNUM);

    let formData = new FormData();
	formData.append('last_num', LASTNUM);

	fetch('/nextboard', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
        if(data && data.length > 0) {
            console.log(data);
            
            let LASTBOARDBOX = document.getElementById('lastboardbox');
            let LASTBOARDURL = [];
            let LASTBOARDDIV = [];
            let LASTBOARDDIV2 = [];
            let LASTBOARDDIV3 = [];
            
            for(let i = 0; i < data.length; i++) {
                LASTBOARDURL[i] = document.createElement('a');
                LASTBOARDDIV[i] = document.createElement('div');
                LASTBOARDDIV2[i] = document.createElement('div');
                LASTBOARDDIV3[i] = document.createElement('div');
    
                LASTBOARDBOX.appendChild(LASTBOARDURL[i]);
                LASTBOARDURL[i].appendChild(LASTBOARDDIV[i]);
                LASTBOARDDIV[i].appendChild(LASTBOARDDIV2[i]);
                LASTBOARDDIV[i].appendChild(LASTBOARDDIV3[i]);
    
                LASTBOARDDIV2[i].style = 'margin-bottom: 30px';
                LASTBOARDDIV2[i].innerHTML = data[i].board_title;
                LASTBOARDDIV3[i].innerHTML = data[i].board_content;
            }
    
            let lastNumber = data[data.length - 1]; // 마지막 게시글 번호 가져오기
            console.log(lastNumber.board_id);
            document.getElementById('last_num').setAttribute('value', lastNumber.board_id);
        } else {
            document.getElementById('lastboardbtn').style.display = 'none';
        }
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
}

function favoriteBoard() {
    let FAVORITENUM = document.getElementById('favorite_num').value;

    // console.log(LASTNUM);

    let formData = new FormData();
	formData.append('favorite_num', FAVORITENUM);

	fetch('/favoritenextboard', {
		method: 'POST',
		body: formData,
	})
	.then(response => response.json())
	.then(data => {
        if(data && data.length > 0) {
            console.log(data);
            
            let FAVORITEBOARDBOX = document.getElementById('favoriteboard');
            let FAVORITEBOARDURL = [];
            let FAVORITEBOARDDIV = [];
            let FAVORITEBOARDDIV2 = [];
            let FAVORITEBOARDDIV3 = [];
            
            for(let i = 0; i < data.length; i++) {
                FAVORITEBOARDURL[i] = document.createElement('a');
                FAVORITEBOARDDIV[i] = document.createElement('div');
                FAVORITEBOARDDIV2[i] = document.createElement('div');
                FAVORITEBOARDDIV3[i] = document.createElement('div');
    
                FAVORITEBOARDBOX.appendChild(FAVORITEBOARDURL[i]);
                FAVORITEBOARDURL[i].appendChild(FAVORITEBOARDDIV[i]);
                FAVORITEBOARDDIV[i].appendChild(FAVORITEBOARDDIV2[i]);
                FAVORITEBOARDDIV[i].appendChild(FAVORITEBOARDDIV3[i]);
    
                FAVORITEBOARDDIV2[i].style = 'margin-bottom: 30px';
                FAVORITEBOARDDIV2[i].innerHTML = data[i].board_title;
                FAVORITEBOARDDIV3[i].innerHTML = data[i].board_content;
            }
    
            let favoriteNumber = data[data.length - 1]; // 마지막 게시글 번호 가져오기
            console.log(favoriteNumber.board_id);
            document.getElementById('favorite_num').setAttribute('value', favoriteNumber.board_id);
        } else {
            document.getElementById('favoritebtn').style.display = 'none';
        }
	})
	.catch(error => {
		console.error('오류 발생:', error);
	})
}
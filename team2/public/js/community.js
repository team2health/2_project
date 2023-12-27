document.addEventListener('DOMContentLoaded', function () {
    let startSlide = 0;
    let endSlide = 10; // 5개씩 보여주기 위해 endSlide 설정
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide() {
        for (let i = 0; i < totalSlides; i++) {
            if (i >= startSlide && i <= endSlide) {
                slides[i].style.display = 'grid';
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
    
                LASTBOARDURL[i].href = 'http://127.0.0.1:8000/board/'+data[i].board_id;
                LASTBOARDDIV2[i].classList.add('community-home-title');
                LASTBOARDDIV2[i].innerHTML = data[i].board_title;
                LASTBOARDDIV3[i].innerHTML = data[i].board_content;
                LASTBOARDDIV3[i].classList.add('community-home-content');
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
            let FAVORITEBOARDDIV4 = [];
            let FAVORITEBOARDTAG = [];
            
            for(let i = 0; i < data.length; i++) {
                // console.log(data[i].board_tag);
                FAVORITEBOARDURL[i] = document.createElement('a');
                FAVORITEBOARDDIV[i] = document.createElement('div');
                FAVORITEBOARDDIV2[i] = document.createElement('div');
                FAVORITEBOARDDIV3[i] = document.createElement('div');
                FAVORITEBOARDDIV4[i] = document.createElement('div');
                FAVORITEBOARDDIV4[i].classList.add('community-fav-board-tag');
    
                FAVORITEBOARDBOX.appendChild(FAVORITEBOARDURL[i]);
                FAVORITEBOARDURL[i].appendChild(FAVORITEBOARDDIV[i]);
                FAVORITEBOARDDIV[i].appendChild(FAVORITEBOARDDIV2[i]);
                FAVORITEBOARDDIV[i].appendChild(FAVORITEBOARDDIV3[i]);
                FAVORITEBOARDURL[i].appendChild(FAVORITEBOARDDIV4[i]);
    
                FAVORITEBOARDURL[i].href = 'http://127.0.0.1:8000/board/'+data[i].board_id;
                FAVORITEBOARDDIV2[i].classList.add('community-home-title');
                FAVORITEBOARDDIV2[i].innerHTML = data[i].board_title;
                FAVORITEBOARDDIV3[i].innerHTML = data[i].board_content;
                FAVORITEBOARDDIV3[i].classList.add('community-home-content');

                for(let j = 0; j < data[i].board_tag.length; j++) {
                    FAVORITEBOARDTAG[i] = document.createElement('span');
                    FAVORITEBOARDDIV4[i].appendChild(FAVORITEBOARDTAG[i]);
                    // FAVORITEBOARDURL[i].appendChild(FAVORITEBOARDURL[i])
                    FAVORITEBOARDTAG[i].innerHTML = data[i].board_tag[j].hashtag_name;
                }
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
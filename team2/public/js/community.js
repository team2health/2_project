// const communitySlider = document.querySelector('.slider');
//     let isCommunityTransitioning = false;

//     function nextCommunitySlide() {
//         if (!isCommunityTransitioning) {
//             isCommunityTransitioning = true;
//             communitySlider.style.transform = 'translateX(0)';
//             setTimeout(() => {
//                 communitySlider.appendChild(communitySlider.firstElementChild);
//                 communitySlider.style.transform = 'translateX(0)';
//                 isCommunityTransitioning = false;
//             }, 5000);
//         }
//     }

//     setInterval(nextCommunitySlide, 3000);




document.addEventListener('DOMContentLoaded', function () {
    let startSlide = 0;
    let endSlide = 4; // 5개씩 보여주기 위해 endSlide 설정
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

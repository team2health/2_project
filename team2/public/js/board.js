function openFile() {
    document.getElementById('fileInput').click();
}


const slider = document.querySelector('.slider');
    let isTransitioning = false;

    function nextSlide() {
        if (!isTransitioning) {
            isTransitioning = true;
            slider.style.transform = 'translateX(0)'; // 한 개의 슬라이드가 이동하는 거리 조절
            setTimeout(() => {
                slider.appendChild(slider.firstElementChild);
                slider.style.transform = 'translateX(0)';
                isTransitioning = false;
            }, 5000); // 0.5초 뒤에 실행 (transition duration과 일치해야 함)
        }
    }

    setInterval(nextSlide, 3000);
// const slider = document.querySelector('.slider');
//     let isTransitioning = false;

//     function nextSlide() {
//         if (!isTransitioning) {
//             isTransitioning = true;
//             slider.style.transform = 'translateX(-20%)'; // 한 개의 슬라이드가 이동하는 거리 조절
//             setTimeout(() => {
//                 slider.appendChild(slider.firstElementChild);
//                 slider.style.transform = 'translateX(0)';
//                 isTransitioning = false;
//             }, 500); // 0.5초 뒤에 실행 (transition duration과 일치해야 함)
//         }
//     }

//     function prevSlide() {
//         if (!isTransitioning) {
//             isTransitioning = true;
//             slider.insertBefore(slider.lastElementChild, slider.firstElementChild);
//             slider.style.transform = 'translateX(-20%)';
//             setTimeout(() => {
//                 slider.style.transform = 'translateX(0)';
//                 isTransitioning = false;
//             }, 50); // 0.05초 뒤에 실행 (transition duration과 일치해야 함)
//         }
//     }

//     // 스크롤바로 이동
//     slider.addEventListener('wheel', (event) => {
//         if (event.deltaY > 0) {
//             nextSlide();
//         } else {
//             prevSlide();
//         }
//     });
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
    const favoriteSlider = document.querySelector('.favorite_slider');
    let isFavoriteTransitioning = false;
    
    function nextFavoriteSlide() {
        if (!isFavoriteTransitioning) {
            isFavoriteTransitioning = true;
            favoriteSlider.style.transform = 'translateX(0)'; // 한 개의 슬라이드가 이동하는 거리 조절
            setTimeout(() => {
                favoriteSlider.appendChild(favoriteSlider.firstElementChild);
                favoriteSlider.style.transform = 'translateX(0)';
                isFavoriteTransitioning = false;
            }, 5000); // 0.5초 뒤에 실행 (transition duration과 일치해야 함)
        }
    }
    
    setInterval(nextFavoriteSlide, 3000);
    
    function previewImage(inputId, previewId) {
        var input = document.getElementById(inputId);
        var preview = document.getElementById(previewId);

        input.addEventListener('change', function () {
            var file = input.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        });
    }
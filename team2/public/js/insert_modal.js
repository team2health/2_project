function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

// 모달 닫기
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

// 모달 외부 클릭 시 닫기
window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
        closeModal();
    }
}
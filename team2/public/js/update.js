function openFile() {
    document.getElementById('file0').click();
}

function previewImage(inputId, previewId) {
    var input = document.getElementById(inputId);
    var preview = document.getElementById(previewId);

    var reader = new FileReader();
    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}
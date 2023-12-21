
function previewImage(inputId, previewId) {
    var input = document.getElementById(inputId);
    var preview = document.getElementById(previewId);
    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "{{ asset('img/plus.png') }}";
    }
}
// function previewImage(inputId, previewId) {
//     var input = document.getElementById(inputId);
//     var preview = document.getElementById(previewId);
    
//     // Clear previous previews
//     preview.innerHTML = "";

//     for (var i = 0; i < input.files.length; i++) {
//         var reader = new FileReader();
//         var imgElement = document.createElement("img");
//         imgElement.className = "preview-image";

//         reader.onloadend = (function (img) {
//             return function (e) {
//                 img.src = e.target.result;
//             };
//         })(imgElement);

//         if (input.files[i]) {
//             reader.readAsDataURL(input.files[i]);
//             preview.appendChild(imgElement);
//         } else {
//             imgElement.src = "{{ asset('img/plus.png') }}";
//             preview.appendChild(imgElement);
//         }
//     }
// }

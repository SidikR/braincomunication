let inputId;

document.addEventListener("DOMContentLoaded", function () {
    var uploadButtons = document.querySelectorAll(".upload-button");
    uploadButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            var inputId = button.getAttribute("data-input-id");
            window.open(
                "/file-manager/fm-button",
                "fm",
                "width=1400,height=800"
            );
            setInputId(inputId);
        });
    });
});

function setInputId(id) {
    inputId = id;
}

function fmSetLink(url) {
    if (inputId) {
        var partialUrl = url.substring(url.indexOf("storage/"));
        var idDisplayImage = `${inputId}-display`;
        document.getElementById(inputId).value = partialUrl;

        // Menggunakan path relatif langsung untuk gambar
        document.getElementById(idDisplayImage).src = "/" + partialUrl;
    } else {
        console.error("Input id is not set.");
    }
}

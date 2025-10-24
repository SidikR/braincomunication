<div class="welcome-section d-flex justify-content-center align-items-center">
    <div class="fw-bold " id="welcome-text"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var welcomeText =
            "Selamat Datang di {{ getInfo()->title }}";
        var speed = 40; // Kecepatan ketik (ms)
        var delay = 500; // Jeda sebelum memulai lagi (ms)
        var cursor = true; // Apakah kursor harus ditampilkan

        var element = document.getElementById("welcome-text");
        var index = 0;
        var direction = 1; // Arah penulisan: 1 untuk maju, -1 untuk mundur

        function type() {
            if (index < welcomeText.length && direction === 1) {
                element.innerHTML += welcomeText.charAt(index);
                index++;
                setTimeout(type, speed);
            } else if (index > 0 && direction === -1) {
                index--;
                element.innerHTML = welcomeText.substring(0, index);
                setTimeout(type, 5);
            } else {
                // Hapus fungsi type dan blinkCursor setelah selesai
                delete window.type;
                delete window.blinkCursor;
            }
        }

        // Mulai animasi typing
        type();

        // Tampilkan kursor jika disetel
        if (cursor) {
            var cursorElement = document.createElement("span");
            cursorElement.className = "cursor";
            cursorElement.innerHTML = "|";
            element.appendChild(cursorElement);

            function blinkCursor() {
                cursorElement.style.display = (cursorElement.style.display == "none" ? "inline" : "none");
                setTimeout(blinkCursor, 500); // Waktu kedipan kursor (ms)
            }

            blinkCursor();

            // Hapus fungsi blinkCursor setelah selesai
            delete window.blinkCursor;
        }
    });
</script>

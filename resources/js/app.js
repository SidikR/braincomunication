// Import JavaScript files
import AOS from "aos"; // import AOS module
import Swiper from "swiper/bundle";
import GLightbox from "glightbox/dist/js/glightbox.min";
import Isotope from "isotope-layout";
import "bootstrap/dist/js/bootstrap.bundle.min.js";
import "../js/main";
import $ from "jquery";
// import './echo';
// import Swal from "sweetalert2";

$(document).ready(function () {
    // Mendapatkan URL saat ini
    var currentUrl = window.location.href;

    // Loop melalui setiap tautan pada navigasi
    $("ul li a").each(function () {
        // Memeriksa apakah URL tautan ini cocok dengan URL saat ini
        if ($(this).attr("href") === currentUrl) {
            // Menambahkan kelas "active" jika cocok
            $(this).addClass("active");

            // Menemukan elemen induk (parent) yang sesuai
            var parentDropdown = $(this).closest("li.has-dropdown");

            // Menambahkan kelas "active" ke elemen a di dalamnya jika ditemukan
            parentDropdown.find("a:first").addClass("active");
        } else if (
            // Menandai tautan jika URL saat ini mengandung kata kunci tertentu
            currentUrl.includes("berita") &&
            $(this).attr("href").includes("berita")
        ) {
            // Menambahkan kelas "active" ke tautan yang sesuai
            $(this).addClass("active");

            // Menambahkan kelas "active" ke elemen induk (parent) jika ditemukan
            var parentDropdown = $(this).closest("li.has-dropdown");
            if (parentDropdown.length > 0) {
                parentDropdown.find("a:first").addClass("active");
            }
        } else if (
            // Menandai tautan "Home" sebagai aktif jika URL saat ini adalah halaman beranda
            currentUrl.endsWith("/") &&
            $(this).attr("href") === "{{ route('homepage') }}"
        ) {
            // Menambahkan kelas "active" ke tautan "Home"
            $(this).addClass("active");
        }
    });
});

// Initialize GLightbox
const glightbox = GLightbox({
    selector: ".glightbox",
});

// Initialize Swiper sliders
function initSwiper() {
    document.querySelectorAll(".swiper").forEach(initSwiperInstance);
}

function initSwiperInstance(swiper) {
    const config = JSON.parse(
        swiper.querySelector(".swiper-config").innerHTML.trim()
    );
    new Swiper(swiper, config);
}

initSwiper();

// window.addEventListener("load", initSwiper);

// Initialize AOS (Animate On Scroll)
function initAOS() {
    AOS.init({
        duration: 400,
        easing: "ease-in-out",
        once: true,
        mirror: false,
    });
}
initAOS();
// window.addEventListener("load", initAOS);

// Initialize Isotope layout and filters
function initIsotopeLayout() {
    document.querySelectorAll(".isotope-layout").forEach(initIsotopeInstance);
}

function initIsotopeInstance(isotopeItem) {
    const layout = isotopeItem.getAttribute("data-layout") || "masonry";
    const filter = isotopeItem.getAttribute("data-default-filter") || "*";
    const sort = isotopeItem.getAttribute("data-sort") || "original-order";

    const initIsotope = new Isotope(
        isotopeItem.querySelector(".isotope-container"),
        {
            itemSelector: ".isotope-item",
            layoutMode: layout,
            filter: filter,
            sortBy: sort,
        }
    );

    isotopeItem
        .querySelectorAll(".isotope-filters li")
        .forEach(function (filter) {
            filter.addEventListener("click", function () {
                handleFilterClick(filter, initIsotope);
            });
        });
}

function handleFilterClick(filter, isotope) {
    const activeFilter = filter.parentElement.querySelector(".filter-active");
    if (activeFilter) {
        activeFilter.classList.remove("filter-active");
    }
    filter.classList.add("filter-active");

    isotope.arrange({
        filter: filter.getAttribute("data-filter"),
    });

    if (typeof initAOS === "function") {
        initAOS();
    }
}

window.addEventListener("load", initIsotopeLayout);

function animateLoader() {
    var width = 0; // Mulai dari 0%
    var loaderBar = document.querySelector(".loader-bar"); // Ambil elemen loader
    var interval = setInterval(function () {
        width += 1; // Tambah 1% setiap interval
        loaderBar.style.width = width + "%"; // Atur lebar baru
        if (width >= 90) {
            // Saat mencapai 90%, hentikan animasi
            clearInterval(interval);
        }
    }, 30); // Setiap 30 milidetik

    window.onload = function () {
        loaderBar.style.width = "100%"; // Mengatur posisi awal ke 100%
        setTimeout(function () {
            document.querySelector(".loader-container").style.display = "none";
        }, 300); // Opsional: Menunda penyembunyian loader untuk kelancaran
    };
}
animateLoader();

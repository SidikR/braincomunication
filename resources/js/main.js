/**
 * Template Name: Append
 * Updated: Sep 18 2023 with Bootstrap v5.3.2
 * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */
document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    /**purecounter
     * Scroll top button
     */
    let scrollTop = document.querySelector(".scroll-top");

    function toggleScrollTop() {
        if (scrollTop) {
            window.scrollY > 100
                ? scrollTop.classList.add("active")
                : scrollTop.classList.remove("active");
        }
    }
    scrollTop.addEventListener("click", (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });

    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);

    /**
     * Preloader
     */
    const preloader = document.querySelector("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    const selectBody = document.querySelector("body");
    const selectHeader = document.querySelector("#header");

    function toggleScrolled() {
        if (
            !selectHeader.classList.contains("scroll-up-sticky") &&
            !selectHeader.classList.contains("sticky-top") &&
            !selectHeader.classList.contains("fixed-top")
        )
            return;
        window.scrollY > 100
            ? selectBody.classList.add("scrolled")
            : selectBody.classList.remove("scrolled");
    }

    document.addEventListener("scroll", toggleScrolled);
    window.addEventListener("load", toggleScrolled);

    /**
     * Scroll up sticky header to headers with .scroll-up-sticky class
     */
    let lastScrollTop = 0;
    window.addEventListener("scroll", function () {
        if (!selectHeader.classList.contains("scroll-up-sticky")) return;

        let scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

        if (
            scrollTop > lastScrollTop &&
            scrollTop > selectHeader.offsetHeight
        ) {
            selectHeader.style.setProperty("position", "sticky", "important");
            selectHeader.style.top = `-${header.offsetHeight + 50}px`;
        } else if (scrollTop > selectHeader.offsetHeight) {
            selectHeader.style.setProperty("position", "sticky", "important");
            selectHeader.style.top = "0";
        } else {
            selectHeader.style.removeProperty("top");
            selectHeader.style.removeProperty("position");
        }
        lastScrollTop = scrollTop;
    });

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector(".mobile-nav-toggle");

    function mobileNavToogle() {
        document.querySelector("body").classList.toggle("mobile-nav-active");
        mobileNavToggleBtn.classList.toggle("bi-list");
        mobileNavToggleBtn.classList.toggle("bi-x");
    }
    mobileNavToggleBtn.addEventListener("click", mobileNavToogle);

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll("#navmenu a").forEach((navmenu) => {
        navmenu.addEventListener("click", () => {
            if (document.querySelector(".mobile-nav-active")) {
                mobileNavToogle();
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document.querySelectorAll(".navmenu .has-dropdown i").forEach((navmenu) => {
        navmenu.addEventListener("click", function (e) {
            if (document.querySelector(".mobile-nav-active")) {
                e.preventDefault();
                this.parentNode.classList.toggle("active");
                this.parentNode.nextElementSibling.classList.toggle(
                    "dropdown-active"
                );
                e.stopImmediatePropagation();
            }
        });
    });

    /**
     * Correct scrolling position upon page load for URLs containing hash links.
     */
    window.addEventListener("load", function (e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop =
                        getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: "smooth",
                    });
                }, 100);
            }
        }
    });

    /**
     * Initiate Pure Counter
     */
    // new PureCounter();

    /**
     * Frequently Asked Questions Toggle
     */
    document
        .querySelectorAll(".faq-item h3, .faq-item .faq-toggle")
        .forEach((faqItem) => {
            faqItem.addEventListener("click", () => {
                faqItem.parentNode.classList.toggle("faq-active");
            });
        });

    // var copyLinkBtn = document.querySelector(".btn-copy-link");

    // copyLinkBtn.addEventListener("click", function () {
    //     // Mendapatkan URL berita
    //     var newsUrl = window.location.href;

    //     // Membuat elemen textarea sementara untuk menyalin URL ke clipboard
    //     var textarea = document.createElement("textarea");
    //     textarea.value = newsUrl;
    //     textarea.setAttribute("readonly", "");
    //     textarea.style.position = "absolute";
    //     textarea.style.left = "-9999px";
    //     document.body.appendChild(textarea);

    //     // Menyalin URL ke clipboard
    //     textarea.select();
    //     document.execCommand("copy");

    //     // Menghapus elemen textarea sementara
    //     document.body.removeChild(textarea);

    //     // Memberikan umpan balik kepada pengguna
    //     alert("Link berhasil disalin!");
    // });

    // var shareBtn = document.querySelector(".btn-share");

    // shareBtn.addEventListener("click", function () {
    //     // Mendapatkan URL berita
    //     var newsUrl = window.location.href;

    //     // Mengecek apakah perangkat pengguna mobile atau desktop
    //     if (/Mobi|Android/i.test(navigator.userAgent)) {
    //         // Jika pengguna menggunakan perangkat mobile, buka menu berbagi perangkat
    //         if (navigator.share) {
    //             navigator
    //                 .share({
    //                     title: document.title,
    //                     text: "Baca berita ini",
    //                     url: newsUrl,
    //                 })
    //                 .then(() => console.log("Berita dibagikan."))
    //                 .catch(console.error);
    //         } else {
    //             alert("Maaf, browser Anda tidak mendukung fitur berbagi.");
    //         }
    //     } else {
    //         // Jika pengguna menggunakan desktop, berikan instruksi untuk berbagi secara manual
    //         alert(
    //             "Untuk berbagi, silakan gunakan menu berbagi di browser Anda."
    //         );
    //     }
    // });
});

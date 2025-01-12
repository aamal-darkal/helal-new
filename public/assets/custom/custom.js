/**
 * Back to top button
 */
let backtotop = document.querySelector(".back-to-top");

const toggleBacktotop = () => {
    if (window.scrollY > 100) backtotop.classList.add("active");
    else backtotop.classList.remove("active");
};

window.addEventListener("scroll", toggleBacktotop);

/** =====================================
    Sticky
  ======================================= */
const navbar = document.querySelector(".navbar");
const makeNavSticky = () => {
    if (window.scrollY > 10) navbar.classList.add("sticky");
    else navbar.classList.remove("sticky");
};
window.addEventListener("scroll", makeNavSticky);

/** =====================================
    Animation depending on AOS pkg
  ======================================= */
window.addEventListener("load", () =>
    AOS.init({
        duration: 600,
        easing: "ease-in-out",
        once: true,
        mirror: false,
    })
);

/** =====================================
    Defining swipers (slider) depending on Swiper pkg
  ======================================= */
var swiper = new Swiper(".martyer-swiper", {
    loop: true,
    speed: 600,
    autoplay: {
        delay: 5000,
    },
    slidesPerView: 1,
    pagination: {
        el: ".swiper-pagination",
        type: "bullets",
        clickable: true,
    },
    breakpoints: {
        // 768: {
        //     slidesPerView: 2,
        //     spaceBetween: 5,
        // },
        992: {
            slidesPerView: 3,
            spaceBetween: 5,
        },
    },
});

var swiper = new Swiper(".news-swipper", {
    slidesPerView: 1,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 5,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

var swiper = new Swiper(".stories-swiper", {
    slidesPerView: 1,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

/** =====================================
   Search modal
  ======================================= */
var modal = document.getElementById("search-modal");
var openModalBtn = document.querySelector(".open-modal");
var closeModalBtn = document.querySelector(".close-modal");
var contentDivider = document.querySelector(".content-divider");

openModalBtn.onclick = function () {
    modal.classList.toggle("hidden");
    document.querySelector(".navbar").classList.toggle("with-modal");

    if (contentDivider) contentDivider.style.marginTop = "130px";
};

closeModalBtn.onclick = function () {
    modal.classList.add("hidden");
    document.querySelector(".navbar").classList.remove("with-modal");

    if (contentDivider) contentDivider.style.marginTop = "60px";
};

modal.onclick = function (event) {
    if (event.target == modal) {
        modal.classList.add("hidden");

        document.querySelector(".navbar").classList.remove("with-modal");

        if (contentDivider) contentDivider.style.marginTop = "60px";
    }
};

/** =====================================
   view summery of section
  ======================================= */
const contentElements = document.querySelectorAll(".summary");
for (let contentElement of contentElements) {
    const length = contentElement.getAttribute("data-length");
    let summary = contentElement.previousElementSibling.innerText
        .trim()
        .substring(0, length);

    /** truncate part of word */
    contentElement.innerHTML =
        summary.substring(0, summary.lastIndexOf(" ")) + "...";
}

/** =====================================
   search filter
  ======================================= */
function getUrl(filter) {
    let preUrl = location.href;
    let pos = preUrl.lastIndexOf("type=");
    /** strip type if exists */
    let url = pos == -1 ? preUrl : preUrl.substring(0, pos - 1);
    /** add operator eithor ? or & */
    let operator = url.lastIndexOf("=") == -1 ? "?" : "&";
    /** add type filter */
    location = url + operator + "type=" + filter;
}

/** =====================================
   navbar
  ======================================= */
let navs = document.querySelectorAll(
    ".navbar-nav > .dropdown > .dropdown-toggle"
);
navs.forEach((currNav) => {
    currNav.addEventListener("click", () => {
        navs.forEach((nav) => {
            if (nav == currNav){
                nav.classList.toggle("active");
                nav.nextElementSibling.classList.toggle("dropdown-hidden");
            }
            else nav.nextElementSibling.classList.add("dropdown-hidden");
        });
    });
});

let subNavs = document.querySelectorAll(".dropdown .dropdown .dropdown-toggle");
subNavs.forEach((currNav) => {
    currNav.addEventListener("click", function (event) {
        subNavs.forEach((nav) => {
            if (nav == currNav){
                nav.classList.toggle("active");
                nav.nextElementSibling.classList.toggle("dropdown-hidden");
            }
            else nav.nextElementSibling.classList.add("dropdown-hidden");
        });
    });
});

document.documentElement.addEventListener("click", function (event) {
    // get the event path
    const path = event.composedPath();
    // console.log(path)
    // check if it has the menu element
    if (path.some((elem) => elem.id === "navbar-area")) {
        // terminate this function if it does
        return;        
    }
    
    document.querySelectorAll(".dropdown-menu").forEach((el) => el.classList.add("dropdown-hidden"));

});

import $ from "jquery";
import Swiper from "/node_modules/swiper/swiper-bundle.js";
class CrouselSliderScript {
    constructor() {
        this.SliderSelector = document.querySelectorAll(".content-slider");
        this.fullslider = document.querySelectorAll(".full-slider");
        this.autoSliderLeftArrow =
            document.querySelectorAll(".swiper-button-prev");
        this.autoSliderRighttArrow =
            document.querySelectorAll(".swiper-button-next");
        this.i = 0;
        this.CrouselSliderAction();
        // this.fullsliderSliderAction();
    }
    CrouselSliderAction() {
        for (this.i = 0; this.i < this.SliderSelector.length; this.i++) {
            this.SliderSelector[this.i].classList.add("content-slider-" + this.i);
            const SliderSwiper = new Swiper(".content-slider-" + this.i, {
                slidesPerView: 1,
                spaceBetween: 5,
                autoHeight: true,
                loop: true,
                allowTouchMove: true,
                speed: 1000,
                navigation: {
                    // slidesPerView: 1,
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                },
                breakpoints: {
                    768: {
                        slidesPerGroup: 1,
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                        loop: true,
                        allowTouchMove: true,
                    },
                    1680: {
                        spaceBetween: 80,
                    },
                },
            });
        }
    }
    fullsliderSliderAction() {
        for (this.i = 0; this.i < this.fullslider.length; this.i++) {
            this.fullslider[this.i].classList.add("full-slider-" + this.i);

            this.autoSliderLeftArrow[this.i].classList.add(
                "slider-button-next-" + this.i
            );
            this.autoSliderRighttArrow[this.i].classList.add(
                "slider-button-prev-" + this.i
            );
            const SliderSwiper = new Swiper(".full-slider-" + this.i, {
                slidesPerView: 1,
                spaceBetween: 0,
                autoHeight: true,
                loop: false,
                allowTouchMove: true,
                speed: 1000,
                coverflowEffect: {
                    rotate: 30,
                    slideShadows: false,
                },
                // autoplay: {
                //     delay: 2500,
                //     disableOnInteraction: false,
                // },
                navigation: {
                    slidesPerView: 1,
                    prevEl: ".slider-button-next-" + this.i,
                    nextEl: ".slider-button-prev-" + this.i,
                },
                pagination: {
                    el: ".swiper-pagination",
                    // dynamicBullets: true,
                    clickable: true
                },
            });
        }
    }
}
export default CrouselSliderScript;
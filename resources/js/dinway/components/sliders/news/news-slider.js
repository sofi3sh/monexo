import {Swiper, Navigation, Lazy} from "swiper";
Swiper.use([Navigation, Lazy]);

export default new Swiper(".news-slider .swiper-container", {
    slidesPerView: 1.3,
    spaceBetween: 43,
    preloadImages: false,
    lazy: {
        loadPrevNext: true,
    }, 
    navigation: {
        nextEl: ".news-slider__next",
        prevEl: ".news-slider__prev"
    },
    breakpoints: {
        470: {
            slidesPerView: 1.7
        },
        576: {
            slidesPerView: 2
        },
        800: {
            slidesPerView: 3
        },
        1000: {
            slidesPerView: 3,
            spaceBetween: 30
        }
    }
});

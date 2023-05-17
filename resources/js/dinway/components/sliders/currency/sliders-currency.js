import {Swiper, Autoplay} from 'swiper';
Swiper.use(Autoplay);

export default new Swiper('.currency-slider .swiper-container', {
        slidesPerView: 2,
        spaceBetween: 20,
        loop: true,
        speed: 3000,
        allowTouchMove: false,
        autoplay: {
            delay: 3000,
        },
        breakpoints: {
            520: {
                slidesPerView: 3,
            },
            705: {
                slidesPerView: 4,
            },
            890: {
                slidesPerView: 5,
            },
            1045: {
                slidesPerView: 6,
            },
            1220: {
                slidesPerView: 7,
            },
            1395: {
                slidesPerView: 8,
            },
            1570: {
                slidesPerView: 9,
            },
        }
});

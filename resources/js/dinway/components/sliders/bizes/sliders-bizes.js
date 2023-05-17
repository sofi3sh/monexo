import {Swiper, Navigation} from 'swiper';
Swiper.use(Navigation);

export default new Swiper('.bizes-slider .swiper-container', {
    slidesPerView: 'auto',
    direction: 'vertical',
    spaceBetween: 20,
    allowTouchMove: false,
    navigation: {
        prevEl: '.bizes-slider__slider-prev',
        nextEl: '.bizes-slider__slider-next'
    },
    breakpoints: {
        768: {
            loop: true,
            slidesPerView: 2,
            direction: 'horizontal',
            allowTouchMove: true,
        },
        1440: {
            loop: true,
            slidesPerView: 4,
            direction: 'horizontal',
            allowTouchMove: true,
        },
        1100: {
            loop: true,
            slidesPerView: 3,
            direction: 'horizontal',
            allowTouchMove: true,
        }             
    }
});
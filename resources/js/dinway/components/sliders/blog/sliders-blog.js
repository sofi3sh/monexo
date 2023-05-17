import {Swiper, Scrollbar} from 'swiper';
Swiper.use(Scrollbar);

export default sliderThumbs = new Swiper('.blog-slider .swiper-container', {
    direction: 'vertical',
    slidesPerView: 'auto',
    freeMode: true,
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    mousewheel: true,
});
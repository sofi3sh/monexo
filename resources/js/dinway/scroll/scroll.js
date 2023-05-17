import SmoothScroll from 'smooth-scroll';

window.addEventListener('DOMContentLoaded', function() {
    
    const header = document.querySelector('.header');

    const scroll = new SmoothScroll('a[href*="#"]', {
        offset: () =>  {
            const height =  header.clientHeight;
            const fixed = header.classList.contains('header_fixed');
            return fixed ? height : height * 2
        },
        easing: 'easeInOutQuint',
        emitEvents: true
    });

});
    

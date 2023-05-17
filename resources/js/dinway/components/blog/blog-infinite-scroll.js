import InfiniteScroll from 'infinite-scroll';

const blogCards = document.querySelector('.blog-cards');

if(blogCards) {

    let infScroll = new InfiniteScroll(blogCards, {
        path: '.pagination__next',
        append: '.blog-card',
        history: false
    });

}

import { shuffle } from "../helpers/functions";
import cards from "../store/cards";

export function getSmallCards(category) {
    let newCards = [];

    if (category === "all") {
        let categoryCards = Object.values(cards);

        for (let key in categoryCards) {
            newCards.push(...categoryCards[key]);
        }

        newCards = shuffle(newCards);
    } else {
        newCards = cards[category];
    }

    return newCards;
}

export function createSmallCard(category, img, title, text, id) {
    if (text.length > 50) {
        text = text.slice(0, 50) + "...";
    }
    if (title.length > 20) {
        title = title.slice(0, 20) + "...";
    }

    return `
    <div class="blog-secondary-card" data-category="${category}" data-index="${id}">
      <div class="blog-secondary-card__image">
          <img src="${img.trim()}" alt="">
      </div>
      <div class="blog-secondary-card__right">
          <h4 class="blog-secondary-card__title">
              ${title.trim()}
          </h4>
          <p class="blog-secondary-card__text">${text.trim()}</p>
      </div>
    </div>
    `;
}

export function createMainCard(settings) {
    let { img, title, text, author, date, time, views } = settings;
    return `<div class="blog-main-card">
        <div class="blog-main-card__image">
            <img src="${img}" alt="" >
        </div>
        <article class="blog-main-card-article">
            <img class="blog-main-card-article__decor" src="/img/frontsite/blog-slider/blog-slider-branch.svg" alt>
            <div class="blog-main-card-article__header">
                <div class="blog-main-card-article__header-left">
                    <div class="blog-main-card-article__info">
                        <time datetime="">
                            <span class="blog-main-card-article__time">${time}</span>
                            <span class="blog-main-card-article__date">${date}</span>
                        </time>
                        <span class="blog-main-card-article__author">${author}</span>
                    </div>
                </div>
                <div class="blog-main-card-article__header-right">
                    <span class="blog-main-card-article__views">${views}</span>
                    <svg width="20" height="18">
                        <use xlink:href="/img/frontsite/svg/sprite.svg#view_icon"></use>
                    </svg>
                </div>
            </div>
            <div class="blog-main-card-article__content">
                <h3 class="blog-main-card-article__title">${title}</h3>
                <div class="blog-main-card-article__text-wrap">
                  <p class="blog-main-card-article__text">${text}</p>
                </div>
            </div>
        </article>
      </div>`;
}

export function generateCards(cardsContainer, category = "all") {
    const cards = getSmallCards(category);
    const cardsHTML = cards.map(card =>
        createSmallCard(card.category, card.img, card.title, card.text, card.id)
    );
    cardsContainer.innerHTML = cardsHTML.join("");
}

export function generateMainCard(settings) {
    const mainCard = createMainCard(settings);
    const mainCardContainer = document.querySelector(".blog-slider__maincard");
    mainCardContainer.innerHTML = mainCard;
}

export function getCard(category, id) {
    let cards = getSmallCards(category);
    return cards.find(card => card.id == id);
}

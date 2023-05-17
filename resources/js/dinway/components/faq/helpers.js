function createQuestionsListItem(category, current = false) {
    let className = current ? 'faq-questions-list__item faq-questions-list__item--current' 
                            : 'faq-questions-list__item';

    return `<li class="${className}">
        <button class="faq-questions-list__link" data-question="${category}">${category}</button>
    </li>`;
}

export function generateQuestionsList(categories, wrapper) {
    const QuestionsListItems = categories.map((category, index) => {
        return createQuestionsListItem(category, !index);
    });

    wrapper.insertAdjacentHTML('afterbegin', QuestionsListItems.join(''));
}

import {findQuestions} from '../../helpers/questions';
import {getQuestionsItems} from '../../store/questions-items';

window.addEventListener('DOMContentLoaded', function() {
    // search 
    const faqQuestionsSection = document.querySelector('.faq-page');
    
    if(faqQuestionsSection) {

        const search = faqQuestionsSection.querySelector('.search__input');
        const contentContainer = faqQuestionsSection.querySelector('.faq-questions__content');
        const faqSearchResult = faqQuestionsSection.querySelector('.faq-search-result');

        search.addEventListener('input', function() {
            const text = this.value.trim().toLowerCase();
            
            if(text !== '') {
                (async () => {
                    const questionsItems = await getQuestionsItems();
                    const questions = findQuestions(questionsItems, text);
                    const questionsHTML = questions.join('') || trans('dinway.faq-search.not-found');
                    contentContainer.classList.add('active');
                    faqSearchResult.classList.add('active');
                    faqSearchResult.innerHTML =  `<div class="questions__items">${questionsHTML}<button class="faq-search-result__btn btn-blue">${trans('dinway.faq-search.btn-cancel')}</button></div>`;
                })();
            }
            else {
                faqSearchResult.innerHTML =  '';
                contentContainer.classList.remove('active');
                faqSearchResult.classList.remove('active');
            }
        });

        faqQuestionsSection.addEventListener('click', e => {
            if(e.target.closest('.faq-search-result__btn')) {
                search.value = '';
                faqSearchResult.innerHTML =  '';
                contentContainer.classList.remove('active');
                faqSearchResult.classList.remove('active');
            }
        });
    }
});
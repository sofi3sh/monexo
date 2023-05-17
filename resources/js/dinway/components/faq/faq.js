import { getQuestionsItems, getCategories } from "../../store/questions-items";
import { generateQuestions, questionOnClick } from "../../helpers/questions";

!(function() {
    const faq = document.querySelector(".faq");

    if (faq) {
        
        (async () => {
            const questionsItems = await getQuestionsItems();
            const categories = await getCategories();
            let categoryIndex = 0;
            
            if(window.faqQuestionCategory) {
                const categoryArray = window.faqQuestionCategory.split(',');
                let category = '';

                categoryArray.forEach(name => {
                    if(categories.indexOf(name) > -1) {
                        category = name;
                    }
                });

                categoryIndex = categories.indexOf(category);
                categoryIndex == -1 ? categoryIndex = 0 : 1;
            }

            const wrapper = document.querySelector(".questions");
            const questionsSettings = {
                wrapper: wrapper,
                questionsItems: questionsItems[categories[categoryIndex]],
                countOnPhone: 7,
                countOnDesktop: 7
            };

            generateQuestions(questionsSettings);

            window.addEventListener(
                "resize",
                generateQuestions(questionsSettings)
            );

            questionOnClick(wrapper);
        })();
    }
})();

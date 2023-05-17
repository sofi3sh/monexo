import { getCategories } from "../../store/questions-items";
import { generateQuestionsList } from "./helpers";

const wrapper = document.querySelector("#faq-questions-list");

if (wrapper) {
    (async () => {
        let categories = await getCategories();
        generateQuestionsList(categories, wrapper);
    })();
}

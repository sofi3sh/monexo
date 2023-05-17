import {getResponceJson} from '../../helpers/data';


export async function getQuestionsItems() {
    return await getResponceJson('/faq/data');
}

export async function getCategories() {
    const questionsItems = await getQuestionsItems();
    return Object.keys(questionsItems);
}





!!function() {
    const btns = document.querySelectorAll('#btn-homework');
    const modal = document.querySelector('#modalHomeWork');
    
    async function getQuestions(moduleId) {
        const response = await fetch(`/home/profi-universe/fetch-exam/${moduleId}`);
        
        if (response.ok) {
            let json = await response.json();
            return json;
        } else {
            console.log("Ошибка HTTP: " + response.status);
        }
    }


    async function btnOnClick() {
        const modalFormContent = modal.querySelector('.modal-form-content');
        const modalTitle = modal.querySelector('.modal-title');
        const moduleNumber = this.dataset.module;
        let newContent = `<input type="hidden" name="module_id" value="${moduleNumber}">`;
        const questions = await getQuestions(moduleNumber);
        
        for(let i = 0; i < questions.length; i++) {
            const question = await questions[i].question;
            const id = await questions[i].id;
            const textarea = `<textarea required name="answer_${i + 1}" style="resize: none" rows="5" class="form-control"></textarea>`;
            const input =`<input name="question_${i + 1}" value="${id}" type="hidden">`
            newContent += `
            <label class="d-block">
                <span class="d-block mb-2">${question}</span> 
                ${textarea}
                ${input}
            </label>`;
        }

        newContent += `<button class="btn btn-dark" type="submit">${trans('base.dash.btns.submit')}</button>`;

        modalTitle.innerHTML = trans(`base.dash.profi-universe.mlm_up_2_dot_0.modal.module-${moduleNumber}.title`);
        modalFormContent.innerHTML = newContent;
    }

    btns.forEach(btn => btn.addEventListener('click', btnOnClick));
    
}();

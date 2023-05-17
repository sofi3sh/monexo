const errorsFunctions = {
    'email': value => emailValidation(value)
}

const emailValidation = value => {
    let isValid = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}/igm.test(value);
    return isValid ? -1 : trans('validation.js-lang.emailValidation.email');
}

const printError = (errorBox, input, message) => {
    
    if(!input.classList.contains('error')) {
        input.classList.add('error');
        errorBox.textContent = message;
    }

}

const removeError = (errorBox, input) => {
    
    if(input.classList.contains('error')) {
        input.classList.remove('error');
        errorBox.textContent = '';
    }

}

const getData = (type, form)  => {
    const target = form.querySelector(`[data-validation="${type}"]`);
    
    if(!target) return {'target': false};

    const value = target.type === 'checkbox' ? 
                        target.checked : 
                        target.value;
    const error = errorsFunctions[type](value);
    const errorBox = form.querySelector(`[data-error="${type}"`);

    return {target, error, errorBox};
}

const checkErrors = form => {
    const errors = [];
    
    for(let type in errorsFunctions) {
        
        const {target, error, errorBox} = getData(type, form);

        error !== -1 ? errors.push(er) : removeError(errorBox, target);
    }

    return !errors.length;
}

const showErrors = form => {
        
    for(let type in errorsFunctions) {
        
        const {target, error, errorBox} = getData(type, form);
        
        if(target) {
            error !== -1 ? printError(errorBox, target, error) : removeError(errorBox, target);
        }
    }
}

const initValidation = form => {
    
    form.addEventListener('input', e => {
        const type = e.target.dataset.validation;

        if(type) {
            const {target, error, errorBox} = getData(type, form);
            
            if(target) {
                error !== -1 ? 1 : removeError(errorBox, target);
            }
        }

    });


    form.addEventListener('change', e => {
        
        const type = e.target.dataset.validation;
        const {target, error, errorBox} = getData(type, form);
        
        if(target) {
            error !== -1 ? printError(errorBox, target, error) : removeError(errorBox, target);
        }

    });


};

const forms = document.querySelectorAll('[data-form-validation]');

forms.forEach(form => initValidation(form));
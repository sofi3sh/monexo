!function() {
    const promotion = document.querySelector('#promotion');
    const modalOrder = document.querySelector('#modal_order');
    const audit = document.querySelector('#audit');
    const pack = document.querySelector('#pack');
    const escort = document.querySelector('#escort');
    const hiddenInputsContainer = document.querySelector('#hidden-inputs');
    const courses = document.querySelectorAll('#course');
    const servicesArray = [escort, audit, pack];
    courses.forEach(course => {
        servicesArray.push(course);
    });

    function getPriceFromRadio(container) {
        return parseFloat(container.querySelector('#radio-btns input:checked').value);
    }

    function getNameEnFromRadio(container) {
        return container.querySelector('#radio-btns input:checked').dataset.name_en;
    }

    function createNewHiddenInput(value, name) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.value = value;
        input.name = name;
        return input;
    }

    function clearHiddenInputsContainer() {
        hiddenInputsContainer.innerHTML = '';
    }

    function addHiddenInputInModal(value, name) {
        const input = createNewHiddenInput(value, name);
        hiddenInputsContainer.appendChild(input);
    }

    function getNameFromTitle(container) {
        return container.querySelector('#title').textContent;
    }

    function addServicesInModal(names = '') {
        const servicesNamesContainer = modalOrder.querySelector('#services-names')
        servicesNamesContainer.innerHTML = `${names}`;
    }

    function addPriceInModal(total) {
        const totalEl = modalOrder.querySelector('#total')
        totalEl.textContent = '$' + total;
    }

    function getPriceFromElement(container) {
        return container.querySelector('#price').textContent;
    }

    function getNameEnFromElement(container) {
        return container.querySelector('#single').textContent;
    }

    function getTotal(checkboxesArray) {
        return checkboxesArray.reduce((total, checkbox) => {
            return total + parseFloat(checkbox.value.replace(',', '.'));
        }, 0);
    }

    function generateNewInputsArray(checkboxesArray) {
        return checkboxesArray.map(checkbox => createNewHiddenInput(checkbox.value, checkbox.name));
    }

    function checkboxesToModalForm(checkboxesArray) {
        clearHiddenInputsContainer();
        const newCheckboxes = generateNewInputsArray(checkboxesArray);
        newCheckboxes.forEach(el => hiddenInputsContainer.appendChild(el));
    }

    function addInputTotalInArray(checkboxesArray, total) {
        const inputTotal = createNewHiddenInput(total, 'total');
        checkboxesArray.push(inputTotal);
        console.log(checkboxesArray)
    }

    function getServicesNames(labelsArray) {
        return labelsArray.map(label => `<li>${label.innerHTML}</li>`.trim()).join('');
    }

    function getArrayElements(container, selector) {
        return Array.from(container.querySelectorAll(selector));
    }

    if(modalOrder) {
        const formBtnSubmit = modalOrder.querySelector('#form_submit');
        
        modalOrder.addEventListener('input', e => {
            const valueIsEntered = e.target.value.length !== '';
            const btnHasDisabled = formBtnSubmit.hasAttribute('disabled');

            if(valueIsEntered) {
                btnHasDisabled ? formBtnSubmit.removeAttribute('disabled') : 1;
            }
            else {
                formBtnSubmit.setAttribute('disabled', 'disabled');
            }
        });

    }

    servicesArray.forEach(container => {
        if(container) {
            const btn = container.querySelector('#main_btn');

            function btnOnClick() {
                let name =  getNameFromTitle(container);
                let price = null;
                let nameEn = null;

                clearHiddenInputsContainer();
                
                const priceAndNames = {
                    200: `(${trans('base.dash.services.periods.one')})`,
                    1000: `(${trans('base.dash.services.periods.six')})`,
                    1800: `(${trans('base.dash.services.periods.twelve')})`,
                }

                if(container === escort) {
                    price = Math.trunc(getPriceFromRadio(container));
                    name += ' ' +  priceAndNames[price];
                    nameEn = getNameEnFromRadio(container);
                }
                else {
                    nameEn = getNameEnFromElement(container);
                    price = getPriceFromElement(container);
                }
                name = `<li>${name}</li>`
                addServicesInModal(name);

                addPriceInModal(price);
                addHiddenInputInModal(price, nameEn);
            }

            btn.addEventListener('click', btnOnClick);
        }
    });

    if(promotion) {
        const totalContainer = promotion.querySelector('[data-sum]');
        const formPromotionBtn = promotion.querySelector('button');

        function formPromotionOnChange() {
            const checkboxesArray = Array.from(promotion.querySelectorAll('input:checked'));
            const sum = getTotal(checkboxesArray);
            const btnHasDisabled = formPromotionBtn.hasAttribute('disabled');

            if(checkboxesArray.length > 0) {
                if(btnHasDisabled) {
                    formPromotionBtn.removeAttribute('disabled');
                }
            }
            else {
                if(!btnHasDisabled) {
                    formPromotionBtn.setAttribute('disabled', 'disabled');
                }
            }

            totalContainer.textContent = '$' + sum;
        }

        function formPromotionBtnOnClick() {
            const checkboxesArray = getArrayElements(promotion, 'input:checked');
            const labelsArray = getArrayElements(promotion, 'input:checked + label');
            const newCheckboxesArray = generateNewInputsArray(checkboxesArray);
            const total = getTotal(checkboxesArray);
            const names = getServicesNames(labelsArray);
            addInputTotalInArray(newCheckboxesArray, total);
            addServicesInModal(names);
            checkboxesToModalForm(newCheckboxesArray);
            addPriceInModal(total);
        }
        promotion.addEventListener('change', formPromotionOnChange);
        formPromotionBtn.addEventListener('click', formPromotionBtnOnClick);
    }
}();

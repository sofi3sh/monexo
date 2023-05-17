const RegionalRepresentativeRequestForm = {
    configs: {
        prices: {
            telegram: document.querySelector('#regional-representative-available-modal input[type=hidden][data-telegram-price]').value,
            instagram: document.querySelector('#regional-representative-available-modal input[type=hidden][data-instagram-price]').value
        }
    },
    elements: {
        priceInput: document.querySelector('#regional-representative-available-modal #price'),
        regionInput: document.querySelector('#regional-representative-available-modal input[type=text][name=region]'),
        socialNetworkCheckboxes: document.querySelectorAll('#regional-representative-available-modal input[type=checkbox]'),
        requestFormSubmit: document.querySelector('#regional-representative-available-modal button[type=submit]')
    },
    updateSubmit() {
        this.elements.requestFormSubmit.disabled = !this.elements.regionInput.value.trim()
            || [...this.elements.socialNetworkCheckboxes].findIndex(el => el.checked) === -1;
    },
    mounted() {
        this.elements.regionInput.addEventListener('input', () => this.updateSubmit());

        this.elements.socialNetworkCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                let price = 0;

                this.elements.socialNetworkCheckboxes.forEach(_checkbox => {
                    if (_checkbox.checked) {
                        price += Number(this.configs.prices[_checkbox.id]);
                    }
                })

                this.elements.priceInput.value = price + ' USD';
            });
        });

        // Если значения будут заполнены изначально
        this.updateSubmit();
    }
};

document.addEventListener('DOMContentLoaded', () => {
    RegionalRepresentativeRequestForm.mounted();
});

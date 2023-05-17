import 'micromodal';

window.addEventListener('DOMContentLoaded', function() {
    MicroModal.init({
        disableScroll: true
    });

    
});

window.addEventListener('load', () => {
    const microModals = document.querySelectorAll('[data-micromodal-show]');
    microModals.forEach(modal => MicroModal.show(modal.id));
});

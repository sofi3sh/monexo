import {sendData} from '../../helpers/get-post'
    

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('.subscribe-form')

    if(form) {
        const url =  '/news/subscribe'

        form.addEventListener('submit', e => {
            e.preventDefault()
            const formData = new FormData(e.target)
            
            sendData(url , formData).then(response => {
                const modal = document.querySelector('#modal-info');
                const title = modal.querySelector('#title');
                const content = modal.querySelector('#content');
                
                title.innerHTML = response.title;
                
                if(response.status === 'success') {
                    content.innerHTML = response.content;
                }
                else if (response.status === 'error') {
                    content.innerHTML = Object.values(response.content).join('</br>');
                }
                
                MicroModal.show('modal-info');
            })
        })
    }
    
})



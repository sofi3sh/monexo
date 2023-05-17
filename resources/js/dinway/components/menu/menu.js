window.addEventListener('DOMContentLoaded', function() {
    const body = document.querySelector('body');
    const page = document.querySelector('html');
    const header = document.querySelector('.header');
    const menu = document.querySelector('.burger');
    const overlay = document.querySelector('.overlay');
    
    const changeBodyOverflow = str => body.style.overflow = str;
    
    const forEachMenuElems = func => [menu, header, overlay].forEach(el => func(el));
    
    const closeMenu = () => {
        forEachMenuElems(el => el.classList.remove('active'));
        changeBodyOverflow('');
    }

    const menuIsActive = () => {
        let active = false;

        forEachMenuElems(el =>  {
            
            if(el.classList.contains('active')) {
                active = true;
            }
            
        });

        return active;
    }
    
    const openMenu = () => {
        forEachMenuElems(el => el.classList.add('active'));
        changeBodyOverflow('hidden');
    }

    const headerIsActive = () => header.classList.contains('active') ? true : false;

    window.addEventListener('scroll', () => {
        const activeClass = 'header_fixed';

        page.scrollTop > 300 ? 
        header.classList.add(activeClass) : 
        header.classList.remove(activeClass);
        
        menuIsActive() ? closeMenu() : 1;

    });

    menu.addEventListener('click', () => headerIsActive() ? closeMenu() :  openMenu());

    overlay.addEventListener('click', () => closeMenu());
});



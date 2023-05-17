window.addEventListener('DOMContentLoaded', function() {
    const blogSlider = document.querySelector(".blog-slider");

    if (blogSlider) {
        const menu = blogSlider.querySelector(".blog-slider-menu");

        if(menu) {
            menu.addEventListener("click", e => {
                const item = e.target.closest("[data-item]");

                if (item) {
                    menu.querySelectorAll("[data-item]").forEach(el => {
                        el.classList.remove("active");
                    });
                    item.classList.add("active");
                }
            });
        }
    }
});
    

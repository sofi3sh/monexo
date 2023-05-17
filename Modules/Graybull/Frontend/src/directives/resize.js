/**
 * @param el: HTMLElement
 * @param binding: ResizeVNodeDirective
 */
function inserted(el, binding) {
    const callback = binding.value,
        options = binding.options || {passive: true};

    window.addEventListener('resize', callback, options);

    el._onResize = {
        callback,
        options
    };

    if (!binding.modifiers || !binding.modifiers.quiet) {
        callback();
    }
}

/**
 * @param el: HTMLElement
 */
function unbind(el) {
    if (!el._onResize) return;

    const {callback, options} = el._onResize;

    window.removeEventListener('resize', callback, options);

    delete el._onResize;
}

export const Resize = {
    inserted,
    unbind
};

export default Resize;

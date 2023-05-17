<script>
    window.translations = {!! Cache::get(\Dok5\LangSwitcher\LocaleMiddleware::getTranslationsKey()) !!};
    window.trans = function (key, replace = {}) {
        let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);
        for (var placeholder in replace) {
            translation = translation.replace(`:${placeholder}`, replace[placeholder]);
        }
        return translation;
    }
</script>
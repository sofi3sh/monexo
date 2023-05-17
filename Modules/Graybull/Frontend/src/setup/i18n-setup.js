import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

const DEFAULT_LANGUAGE = 'ru'
const FALLBACK_LANGUAGE = 'en'

function loadLocaleMessages() {
    const locales = require.context('@/lang', true, /[A-Za-z0-9-_,\s]+\.json$/i),
        messages = {};

    locales.keys().forEach(key => {
        let matched = key.match(/([A-Za-z0-9-_]+)\./i);

        if (matched && matched.length > 1) {
            let locale = matched[1];

            messages[locale] = locales(key);
        }
    });

    return messages;
}

export const i18n = new VueI18n({
    locale: DEFAULT_LANGUAGE,
    fallbackLocale: FALLBACK_LANGUAGE,
    preserveDirectiveContent: true,
    messages: loadLocaleMessages()
})

export function setI18nLanguage(lang) {
    i18n.locale = lang
    document.querySelector('html').setAttribute('lang', lang)
    return lang
}

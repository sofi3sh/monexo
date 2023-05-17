import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';
import LocalStorage from './prototypes/localStorage';
import Cipher from './classes/Cipher';
import {i18n, setI18nLanguage} from './setup/i18n-setup';

Vue.config.productionTip = false;

Vue.prototype.$bus = new Vue;
Vue.prototype.$localStorage = LocalStorage;
Vue.prototype.$encrypt = Cipher.encrypt;
Vue.prototype.$decrypt = Cipher.decrypt;
Vue.prototype.$getLanguage = () => i18n.locale;
Vue.prototype.$setLanguage = setI18nLanguage;

new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#graybull');

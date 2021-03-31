import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store/store'
import apiService from './services/BlogApiService'

import BootstrapVue from 'bootstrap-vue';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import i18n from './plugins/i18n';
import Vuelidate from 'vuelidate'

Vue.use(BootstrapVue);
Vue.use(Vuelidate)

Vue.apiService = new apiService();

new Vue({
    i18n,
    components: { App },
    template: "<App/>",
    router,
    store
}).$mount("#app");
import Vue from 'vue'
import vuetify from './plugins/vuetify'
import App from './App.vue'
import router from './router'
import apiService from "./services/BlogApiService";
import store from "./store/store";

Vue.apiService = new apiService();

new Vue({
    vuetify,
    router,
    store,
    render: h => h(App),
}).$mount('#app')
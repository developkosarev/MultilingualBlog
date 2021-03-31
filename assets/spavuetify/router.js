import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Home from './pages/Home.vue'
import ProductList from './pages/ProductList.vue'
import NotFound from './components/NotFound.vue'

const routes = [
    { path: '/', name: 'root', component: Home },
    { path: '/product', name: 'product', component: ProductList, meta: { requiresAuth: true, role: "Users" }},

    { path: '*', name: 'notFound', component: NotFound}
]

//mode: 'history',
const router = new Router({
    base: '/en/adminvuetify',
    routes
});

export default router
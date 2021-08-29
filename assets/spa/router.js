import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Home from './pages/Home.vue'
import Chart from "./pages/Chart.vue";
import NotFound from './components/NotFound.vue'
import LoginForm from './components/auth/LoginForm.vue'
import PostList from './components/PostList.vue'
import PostShow from './components/PostShow.vue'
import PostEditList from './components/dashboard/PostEditList.vue'
import PostEditForm from './components/dashboard/PostEditForm.vue'

const routes = [
    { path: '/', name: 'root', component: Home },
    { path: '/login', name: 'login', component: LoginForm},

    { path: '/chart', name: 'chart', component: Chart },

    { path: '/blog', name: 'blog', component: PostList, meta: { requiresAuth: true, role: "Users" }},
    { path: '/blog/:slug', name: 'post', component: PostShow, meta: { requiresAuth: true, role: "Users" }},

    { path: '/dashboard', name: 'dashboard', component: PostEditList, meta: { requiresAuth: true, role: "Admin" } },
    { path: '/dashboard/:op(create|edit)/:id(\\d+)?', name: 'dashboardPostEditForm', component: PostEditForm, meta: { requiresAuth: true, role: "Admin" } },

    { path: '*', name: 'notFound', component: NotFound}
]

//mode: 'history',
const router = new Router({
    base: '/en/admin',
    routes
});

export default router
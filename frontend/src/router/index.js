import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../views/HomeView.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('../views/auth/LoginView.vue')
    },
    ,
    {
        path: '/register',
        name: 'register',
        component: () => import('../views/auth/RegisterView.vue')
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router

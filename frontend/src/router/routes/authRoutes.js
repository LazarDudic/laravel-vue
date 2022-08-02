import notAuthMiddleware from '@/middleware/notAuthMiddleware'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import('@/views/auth/LoginView.vue'),
        meta: {
            middleware: notAuthMiddleware,
        },
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/views/auth/RegisterView.vue'),
        meta: {
            middleware: notAuthMiddleware,
        },
    }
]

export default routes
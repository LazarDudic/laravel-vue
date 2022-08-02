import { createRouter, createWebHistory } from 'vue-router'
import authRoutes from '@/router/routes/authRoutes'
import pageRoutes from '@/router/routes/pageRoutes'

var routes = []
routes = routes.concat(authRoutes, pageRoutes)

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({ ...context, next: nextMiddleware });
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {from, next, router, to};
        const nextMiddleware = nextFactory(context, middleware, 1);
        return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
});

export default router

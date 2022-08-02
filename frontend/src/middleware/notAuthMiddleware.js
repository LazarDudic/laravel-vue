export default function notAuthMiddleware({ next, router }) {
    if (localStorage.getItem('auth_token')) {
      return router.push({ name: 'home' });
    }
    return next();
}
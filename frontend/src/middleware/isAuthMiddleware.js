export default function isAuthMiddleware({ next, router }) {
  if (!localStorage.getItem('auth_token')) {
    return router.push({ name: 'login' })
  }
  return next()
}

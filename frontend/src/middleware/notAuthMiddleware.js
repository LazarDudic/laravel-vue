export default function notAuthMiddleware({ next, router }) {
  if (localStorage.getItem('auth_token')) {
    return router.push({ name: 'admin-dashboard' })
  }
  return next()
}

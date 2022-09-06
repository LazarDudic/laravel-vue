import { useUserStore } from '@/stores'


export default function isAdminMiddleware({ next, router }) {
    const userStore = useUserStore()
    const authUser = userStore.authUser
    if(!authUser) {
        return router.push({ name: 'login' })
    }

    if(!authUser.is_admin) {
        return router.push({ name: 'home' })
    }
    return next()
}

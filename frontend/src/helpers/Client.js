import axios from 'axios'
import { useAlertsStore, useLoadingStore } from '@/stores'

const baseURL = process.env.VUE_APP_API_URL
const Client = axios.create({ baseURL })

Client.interceptors.response.use(
  (response) => {
    if(response.data?.success) {
        const alertStore = useAlertsStore()
        alertStore.setSuccessMessage(response.data?.success)
    }
    const loadingStore = useLoadingStore()
    loadingStore.setLoading(false)
    NProgress.done()
    return response
  },
  (error) => {
    const alertStore = useAlertsStore()
    alertStore.handleErrors(error.response)
    const loadingStore = useLoadingStore()
    loadingStore.setLoading(false)
    NProgress.done()
  },
  (config) => {
    NProgress.start()
    return config
  }
)

Client.interceptors.request.use((config) => {
  config.headers.common = {
    Authorization: `${localStorage.getItem('auth_token')}`,
    'Content-Type': 'application/json',
    Accept: 'application/json'
  }
  const loadingStore = useLoadingStore()
  loadingStore.setLoading(true)
  return config
})

export default Client

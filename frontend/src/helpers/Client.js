import axios from 'axios'
import { useAlertsStore, useLoadingStore, useLanguageStore } from '@/stores'
import { storeToRefs } from 'pinia'

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
    return response
  },
  (error) => {
    const alertStore = useAlertsStore()
    alertStore.handleErrors(error.response)
    const loadingStore = useLoadingStore()
    loadingStore.setLoading(false)
  },
  (config) => {
    NProgress.start()
    return config
  }
)

Client.interceptors.request.use((config) => {
  const loadingStore = useLoadingStore()
  loadingStore.setLoading(true)
  const { selectedLanguage } = storeToRefs(useLanguageStore())
  const langID = selectedLanguage.value ? selectedLanguage.value.id : '';
  config.headers.common = {
    Authorization: `${localStorage.getItem('auth_token')}`,
    'Content-Type': 'application/json',
    Accept: 'application/json',
    LanguageId: langID
  }
  // config.params = {...config.params, my_variable: 'value'}
  return config
})

export default Client

import { ref, watch } from 'vue'
import { defineStore } from 'pinia'
import router from '@/router/index.js'
import { useUserStore } from '@/stores'

export const useAlertsStore = defineStore('alerts', () => {
  const errors = ref([])
  const success = ref(null)
  const userStore = useUserStore()

  function handleErrors(error) {
    console.log(error)
    if (error.status === 400) {
      // Client Error
      errors.value = { global: error.data.message }
    } else if (error.status === 422) {
      // validation errors
      errors.value = error.data.errors
    } else if (error.status === 401) {
      // Unauthorized
      userStore.logout()
    } else if (error.status === 403) {
      // Unauthorized
      router.push({ name: 'home' })
    } else if (error.status === 404) {
      // not found
      // router.push({ name: '404' })

      errors.value = { global: '404. Data not found!' }
    } else {
      // global deal with other errors
      errors.value = {
        global:
          'Something went wrong. Please try again or contact administrator.'
      }
    }
    // throw error
    Promise.resolve(error)
  }

  function setSuccessMessage(successMsg) {
    success.value = successMsg
  }

  function setErrorMessage(errorMsg) {
    errors.value = { global: errorMsg }
  }

  function resetState(successMsg) {
    success.value = null
    errors.value = []
  }

  var timeoutId = null
  watch([success], () => {
    clearTimeout(timeoutId)
    if (success.value) {
      timeoutId = setTimeout(() => {
        success.value = null
      }, 5000)
    }
  })

  return {
    errors,
    success,
    handleErrors,
    setSuccessMessage,
    resetState,
    setErrorMessage
  }
})

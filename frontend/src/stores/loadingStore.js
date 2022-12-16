import { ref } from 'vue'
import { defineStore } from 'pinia'


export const useLoadingStore = defineStore('loading', () => {
  const isLoading = ref(false)
  const requestLoading = ref(0) 

  function setLoading(bool) {
    bool ? requestLoading.value++ : requestLoading.value--;

    // (setLoading(true) 3 times  will stop when setLoading(false) 3 times) === 0
    if(requestLoading.value < 0 || requestLoading.value === 0) {
      requestLoading.value = 0
      isLoading.value = false
    } else {
      isLoading.value = true
    }
  }

  return {isLoading, setLoading}
})

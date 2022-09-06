import { ref } from 'vue'
import { defineStore } from 'pinia'


export const useLoadingStore = defineStore('loading', () => {
  const isLoading = ref(false)

  function setLoading(bool) {
    isLoading.value = bool
  }

  return {isLoading, setLoading}
})

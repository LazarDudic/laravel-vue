import { ref } from 'vue'
import { defineStore } from 'pinia'
import LanguageRepository from '@/repositories/languageRepository'

export const useLanguageStore = defineStore('language', () => {
  const selectedLanguage = ref(null)

  if (localStorage.getItem('language') !== null) {
    selectedLanguage.value = JSON.parse(localStorage.getItem('language'))
  }

  const languages = ref([])
  async function getLanguages(refresh = false) {
    if (!Object.keys(languages.value).length || refresh) {
      languages.value = await LanguageRepository.all()
    }
    return languages.value
  }

  getLanguages()

  function selectLanguage(language) {
    selectedLanguage.value = language
    
    if (language) {
      localStorage.setItem('language', JSON.stringify(language))
    } else {
      localStorage.removeItem('language')
    }
  }

  return { languages, getLanguages, selectedLanguage, selectLanguage }
})

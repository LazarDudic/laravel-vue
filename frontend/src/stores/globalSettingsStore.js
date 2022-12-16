import { ref } from 'vue'
import { defineStore } from 'pinia'
import GlobalSettingsRepository from '@/repositories/globalSettingsRepository'

export const useGlobalSettingsStore = defineStore('globalSettings', () => {
  const globalSettings = ref([])

    async function getSettings(refresh = false) {
        if(!Object.keys(globalSettings.value).length || refresh) {
            globalSettings.value = await GlobalSettingsRepository.findById(1)
        }
        return globalSettings.value
    }

    async function setSettings(id) {
        globalSettings.value = await GlobalSettingsRepository.findById(id)
        return globalSettings.value
    }

    getSettings()

  return { globalSettings, getSettings }
})

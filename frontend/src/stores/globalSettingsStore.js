import { ref } from 'vue'
import { defineStore } from 'pinia'
import GlobalSettingsRepository from '@/repositories/globalSettingsRepository'

export const useGlobalSettingsStore = defineStore('globalSettings', () => {
  const globalSettings = ref([])

    async function getSettings(refresh = false) {
        if(!Object.keys(globalSettings.value).length || refresh) {
            globalSettings.value = await GlobalSettingsRepository.get()
        }
        return globalSettings.value
    }

    getSettings()

    async function update (input) {
        globalSettings.value = await GlobalSettingsRepository.update(input).then((r) => r.data.data)
    }

  return { globalSettings, getSettings, update }
})

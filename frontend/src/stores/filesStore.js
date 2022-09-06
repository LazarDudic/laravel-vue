import { reactive, ref } from 'vue'
import { defineStore } from 'pinia'
import FileRepository from '@/repositories/fileRepository'

export const useFilesStore = defineStore('files', () => {
    const files = reactive({ data: [] })
    let currentPage = ref(1)
    let lastPage = ref(null)

  const filter = reactive({
    page: 1,
    sort: 'asc',
    search: ''
  })

  async function getFiles(refresh = false) {
    filter.page = currentPage.value
    if (!Object.keys(files.data).length || refresh) {
      const newFiles = await FileRepository.get(filter)
      files.data = newFiles.data
      currentPage.value = newFiles.meta.current_page
      lastPage.value = newFiles.meta.last_page
    }
    return files.data
  }

  async function goToPage(page) {
    currentPage.value = page
    getFiles(true)
  }

  return { files, getFiles, filter, currentPage, lastPage, goToPage }
})

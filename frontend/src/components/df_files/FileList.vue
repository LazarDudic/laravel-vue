<template>
  <FileFilters
    @filtersUpdated="filtersUpdated"
    :key="render"
    :filter="filter"
  />

  <div class="d-flex flex-wrap">
    <div v-for="file in files.data" class="mb-3 me-2" @click="toggleFile(file)">
      <img
        :class="selectedFile.data?.id === file.id ? selectedFileCss : ''"
        :src="file.thumb_path"
        width="200"
      />
      <div>
        {{ file.name }}
      </div>
    </div>
  </div>

  <FilePagination
    :key="render"
    v-if="files.data.length"
    :pages="pages"
    @goToPage="goToPage"
  />
</template>

<script setup>
import { ref, reactive, onBeforeMount } from 'vue'
import FileRepository from '@/repositories/fileRepository'
import FilePagination from '@/components/df_files/FilePagination'
import FileFilters from '@/components/df_files/FileFilters'

const emit = defineEmits()
const props = defineProps(['selectedFile'])
const selectedFile = reactive({ data: props.selectedFile })
const files = reactive({ data: [] })
const render = ref(1)
const selectedFileCss = 'opacity-50 border border-primary border-5'

const pages = reactive({
  currentPage: 1,
  lastPage: null
})

const filter = reactive({
  search: '',
  order: 'new',
  page: 1,
  paginate: 12
})

onBeforeMount(async () => {
  setCurrentPage(1)
  getAllFiles()
})

const getAllFiles = async () => {
  var data = await FileRepository.get(filter)
  setCurrentPage(data.meta.current_page)
  pages.lastPage = data.meta.last_page
  files.data = data.data
  render.value++
}

const setCurrentPage = (page) => {
  pages.currentPage = page
  filter.page = page
}

const toggleFile = (file) => {
  if (selectedFile.data?.id === file.id) {
    selectedFile.data = null
    emit('toggleFile')
  } else {
    selectedFile.data = file
    emit('toggleFile', file)
  }
}

const filtersUpdated = (data) => {
  filter.search = data.search
  filter.order = data.order
  setCurrentPage(1)
  getAllFiles()
}

const goToPage = (page) => {
  setCurrentPage(page)
  getAllFiles()
}
</script>

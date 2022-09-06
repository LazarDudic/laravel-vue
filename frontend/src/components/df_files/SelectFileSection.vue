<template>
  <div>
    <div class="d-flex align-items-center justify-content-between m-2">
      <form @submit.prevent="filterFiles" class="d-flex align-items-center ml-3">
        <input
         v-model="filter.search"
          class="form-control mr-2"
          placeholder="Search..."
        />
        <button class="btn btn-secondary btn-sm mb-0">Search</button>
      </form>
      <select
        @change="filterFiles"
        v-model="filter.order"
        class="form-control"
        style="width: 200px"
      >
        <option value="new">Newest</option>
        <option value="old">Oldest</option>
        <option value="name">Name</option>
      </select>
    </div>
    <div
      class="modal-body d-flex mt-2 pb-0"
      style="max-height: 500px; overflow: auto"
    >
      <div
        v-for="file in files.data"
        class="mb-4 me-3"
        @click="toggleFile(file)"
      >
        <img
          :class="selectedFileId === file.id ? selectedFileCss : ''"
          :src="file.thumb_path"
          width="200"
        />
        <div>
          {{ file.name }}
        </div>
      </div>

    </div>

    <FilePagination  />

    <div class="modal-footer">
      <button type="button" @click="editFile()" class="btn btn-sm btn-warning">
        Edit
      </button>
      <button type="button" @click="deleteFile()" class="btn btn-sm btn-danger">
        Delete
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import FileRepository from '@/repositories/fileRepository'
import { useFilesStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { responseIsOK } from '@/helpers/helper.js'
import FilePagination from '@/components/df_files/FilePagination'


const selectedFileId = ref(null)
const selectedFile = ref(null)
const selectedFileCss = 'opacity-50 border border-primary border-5'
const emit = defineEmits(['editFile'])

const filesStore = useFilesStore()
const { files, filter, lastPage } = storeToRefs(filesStore)
console.log(lastPage.value)

const toggleFile = (file) => {
  if (selectedFileId.value === file.id) {
    selectedFile.value = null
    selectedFileId.value = null
  } else {
    selectedFile.value = file
    selectedFileId.value = file.id
  }
}

const editFile = () => {
  if (!selectedFileId.value) {
    return alert('Please select a file.')
  }

  emit('editFile', selectedFile)
}

const deleteFile = async () => {
  if (!selectedFileId.value) {
    return alert('Please select a file.')
  }
  const res = await FileRepository.delete(selectedFileId.value)
  if (responseIsOK(res)) {
    filesStore.getFiles(true)
  }
}

const filterFiles = () => {
    filesStore.getFiles(true)
}
</script>

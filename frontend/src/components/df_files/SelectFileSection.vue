<template>
  <div>
    <div class="modal-body mt-2 pb-0" style="max-height: 500px; overflow: auto">
      <FileList :selectedFile="selectedFile.data" @toggleFile="toggleFile" />
    </div>
    <div class="modal-footer">
      <button type="button" @click="selectFile()" class="btn btn-sm btn-info">
        Select
      </button>
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
import { reactive } from 'vue'
import FileRepository from '@/repositories/fileRepository'
import { responseIsOK } from '@/helpers/helper.js'
import FileList from '@/components/df_files/FileList'
const emit = defineEmits()
const props = defineProps(['selectedFile'])

const selectedFile = reactive({ data: props.selectedFile })

const toggleFile = (file = null) => {
  if (!file) {
    emit('fileUnselected')
  }
  selectedFile.data = file
}

const editFile = () => {
  if (!selectedFile.data?.id) {
    return alert('Please select a file.')
  }

  emit('editFile', selectedFile.data)
}

const selectFile = () => {
  if (!selectedFile.data?.id) {
    return alert('Please select a file.')
  }
  emit('fileSelected', selectedFile.data)
}

const deleteFile = async () => {
  if (!selectedFile.data?.id) {
    return alert('Please select a file.')
  }
  const res = await FileRepository.delete(selectedFile.data?.id)
  if (responseIsOK(res)) {
    emit('fileDeleted', selectedFile.data?.id)
  }
}
</script>

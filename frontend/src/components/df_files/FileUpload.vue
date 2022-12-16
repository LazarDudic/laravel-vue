<template>
    
  <div id="df-file-upload">
    <!-- Button trigger modal -->
    <FileUploadButton :modalId="modalId" />
    <div class="file-image-wrapper" v-if="selectedFile.data?.path">
        <img
            :src="selectedFile.data?.path"
            class="present-image"
        />
        <i @click="fileUnselected()" class="fas fa-trash remove-file"></i>
        <i  @click="openEditSelectedFile()" class="fas fa-edit edit-file"></i>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      :id="modalId"
      tabindex="-1"
    >
      <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header pb-2 pt-3">
            <button
              type="button"
              @click.prevent="showSection('update')"
              id="select-file-btn"
              class="btn btn-sm btn-info me-2"
            >
              Select
            </button>
            <button
              type="button"
              @click.prevent="showSection('upload')"
              id="upload-file-btn"
              class="btn btn-sm btn-warning"
            >
              Upload
            </button>
            <button
              type="button"
              class="btn-close close-modal"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <FileUploadForm
            :key="render"
            v-if="showUploadFileForm"
            @showSection="showSection"
          />
          <FileEditForm
            :key="render"
            v-if="showEditFileForm"
            @showSection="showSection"
            :selectedFileId="selectedFileId"
          />
          <SelectFileSection
            :key="render"
            v-if="showSelectFileSection"
            :selectedFile="selectedFile.data"
            @editFile="editFile"
            @fileSelected="fileSelected"
            @fileUnselected="fileUnselected"
            @fileDeleted="fileDeleted"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onBeforeMount, watch } from 'vue'
import FileUploadForm from '@/components/df_files/FileUploadForm'
import FileEditForm from '@/components/df_files/FileEditForm'
import SelectFileSection from '@/components/df_files/SelectFileSection'
import FileUploadButton from '@/components/df_files/FileUploadButton'
import FileRepository from '@/repositories/fileRepository'
import $ from 'jquery'

const props = defineProps(['fieldName', 'fileId'])
const emit = defineEmits()
const fieldName = props.fieldName
const modalId = fieldName + '_' + Math.random().toString(36).slice(2, 13)
const showSelectFileSection = ref(false)
const showUploadFileForm = ref(false)
const showEditFileForm = ref(false)
const selectedFile = reactive({ data: null })
const selectedFileId = ref(props.fileId)
const render = ref(1)
onBeforeMount(async () => {
  if (selectedFileId.value) {
    await getSelectedFile(selectedFileId.value)
  }
  showSection()
})

const showSection = async (section = 'default', refresh = false) => {
  if (section === 'upload') {
    showUploadFileForm.value = true
    showEditFileForm.value = false
    showSelectFileSection.value = false
  } else if (section === 'edit') {
    showUploadFileForm.value = false
    showEditFileForm.value = true
    showSelectFileSection.value = false
  } else {
    showUploadFileForm.value = false
    showEditFileForm.value = false
    showSelectFileSection.value = true
  }
  render.value++

  if (refresh) {
    await getSelectedFile(selectedFileId.value)
  }
}

async function getSelectedFile(id) {
  selectedFile.data = await FileRepository.findById(id)
}

const editFile = (file) => {
  selectedFileId.value = file.id
  showSection('edit')
}

const fileSelected = async (file) => {
  selectedFileId.value = file.id
  await getSelectedFile(file.id)
  closeModal()
  emit('fileSelected', {
    fileId: selectedFileId,
    fieldName: fieldName
  })
}

const fileUnselected = () => {
  selectedFileId.value = null
  selectedFile.data = null
  emit('fileUnselected', fieldName)
}

const fileDeleted = (id) => {
  showSection()
}

const closeModal = () => {
    var buttons = document.querySelectorAll(".close-modal");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].click();
    }
}

const openEditSelectedFile = () => {
    const btnId = '#'+modalId+'-button'
    $(btnId).click()
    showSection('edit')
}

</script>

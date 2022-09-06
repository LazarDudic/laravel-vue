<template>
  <!-- Button trigger modal -->
  <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal"
  >
    Upload File
  </button>

  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
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
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body alert-parent" style="display: none">
          <div class="alert alert-danger">
            <a href="#" class="close" onclick="closeAlert(event)">&times;</a>
            <span class="alert-message"></span>
          </div>
        </div>
        <FileUploadForm v-if="showUploadFileForm" @showSection="showSection" />
        <FileEditForm v-if="showEditFileForm" :selectedFile="selectedFile" @showSection="showSection"/>
        <SelectFileSection v-if="showSelectFileSection" @editFile="editFile"/>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import FileUploadForm from '@/components/df_files/FileUploadForm'
import FileEditForm from '@/components/df_files/FileEditForm'
import SelectFileSection from '@/components/df_files/SelectFileSection'

const showSelectFileSection = ref(true)
const showUploadFileForm = ref(false)
const showEditFileForm = ref(false)
const selectedFile = ref(null)

const showSection = (section) => {
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
}

const editFile = (file) => {
    selectedFile.value = file.value
    showSection('edit')
}

</script>

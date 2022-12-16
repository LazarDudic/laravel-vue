<template>
  <form @submit.prevent="updateFile()">
    <div class="modal-body" style="max-width: 500px">
      <img
        v-if="showImage"
        :src="selectedFile.data?.thumb_path"
        alt=""
        id="df_editImage"
        width="150"
        height="150"
      />
      <div class="form-group mb-3 mt-3">
        <input type="file" v-on:change="loadImage" class="form-control" />
        <div v-if="errors?.file">
          <div v-for="(error, id) in errors.file" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group mt-2">
        <label class="mb-0">Name:</label>
        <input type="text" v-model="input.name" class="form-control" />
        <div v-if="errors?.name">
          <div v-for="(error, id) in errors.name" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label class="mb-0">Alt:</label>
        <input type="text" class="form-control" v-model="input.alt" />
        <div v-if="errors?.alt">
          <div v-for="(error, id) in errors.alt" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Save</button>
    </div>
  </form>
</template>

<script setup>
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import FileRepository from '@/repositories/fileRepository'

const emit = defineEmits(['showSection'])
const props = defineProps(['selectedFileId'])
const selectedFileId = props.selectedFileId
const showImage = ref(true)
const selectedFile = reactive({ data: null })

const initialState = {
  file: '',
  name: '',
  alt: ''
}
const input = reactive({ ...initialState })
onBeforeMount(async () => {
  selectedFile.data = await FileRepository.findById(selectedFileId)
  input.name = selectedFile.data.name
  input.alt = selectedFile.data.alt
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)
const formData = new FormData()

const updateFile = async () => {
  const formData = getFormData(input)
  const res = await FileRepository.update(selectedFileId, formData)
  if (responseIsOK(res)) {
    emit('showSection', 'default', true)
  }
}

const loadImage = (e) => {
  input.file = e.target.files[0]
  showImage.value = false
}
</script>

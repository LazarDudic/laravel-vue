<template>
  <form @submit.prevent="updateFile()">
    <div class="modal-body" style="max-width: 500px">
      <img
        v-if="showImage"
        :src="selectedFile.thumb_path"
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
        <input type="text" class="form-control" v-model="selectedFile.alt" />
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
import { reactive, ref } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { responseIsOK } from '@/helpers/helper.js'
import { useFilesStore } from '@/stores'
import FileRepository from '@/repositories/fileRepository'

const emit = defineEmits(['showSection'])
const props = defineProps({
  selectedFile: {
    default: null
  }
})
const showImage = ref(true)
const initialState = {
  file: '',
  name: props.selectedFile.name,
  alt: props.selectedFile.alt
}
const input = reactive({ ...initialState })
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)
const filesStore = useFilesStore()
const formData = new FormData()

const updateFile = async () => {
  alertStore.resetState()
  Object.keys(input).forEach((el, index) => {
    formData.append(el, input[el])
  })
  const res = await FileRepository.update(props.selectedFile.id, formData)
  if (responseIsOK(res)) {
    filesStore.getFiles(true)
    emit('showSection')
  }
}

const loadImage = (e) => {
  input.file = e.target.files[0]
  showImage.value = false
}
</script>

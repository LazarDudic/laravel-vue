<template>
  <form @submit.prevent="uploadFile()">
    <div class="modal-body m-auto" style="max-width: 500px">
      <div class="form-group mb-3">
        <input type="file" v-on:change="loadImage" class="form-control" />
        <div v-if="errors?.file">
          <div v-for="(error, id) in errors.file" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group mb-3">
        <input
          type="text"
          v-model="input.name"
          class="form-control"
          placeholder="Name"
        />
        <div v-if="errors?.name">
          <div v-for="(error, id) in errors.name" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <input
          type="text"
          v-model="input.alt"
          class="form-control"
          placeholder="Alt"
        />
        <div v-if="errors?.alt">
          <div v-for="(error, id) in errors.alt" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Upload</button>
    </div>
  </form>
</template>

<script setup>
import { ref, reactive, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import FileRepository from '@/repositories/fileRepository'
import { storeToRefs } from 'pinia'
import { responseIsOK } from '@/helpers/helper.js'

const emit = defineEmits(['showSection'])
const initialState = { file: '', name: '', alt: '' }
const input = reactive({ ...initialState })
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const uploadFile = async () => {
  const formData = new FormData()
  Object.keys(input).forEach((el, index) => {
    formData.append(el, input[el])
  })
  const res = await FileRepository.store(formData)

  if (responseIsOK(res)) {
    emit('showSection')
  }
}

const loadImage = (e) => {
  input.file = e.target.files[0]
}
</script>

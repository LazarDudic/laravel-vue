<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-news-list' }">News</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Create</span>
      </a>
    </div>
    <h2 class="page-title">News Create</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">News Create</h2>
        <p class="content-description">description news create</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form">
        <Select
            v-if="languages.data.length"
            label="Language"
            name="lang_id"
            :selectValues="languages.data"
            @update:lang_id="languageUpdated"
            :required="true"
          />
          <InputError :errors="errors?.lang_id" />

          <Select
            v-if="rerenderCategories"
            label="Category"
            name="category_id"
            :selectValues="categories.data"
            @update:category_id="(newValue) => (input.category_id = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.category_id" />

          <Input
            label="Title"
            name="title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <Textarea
            label="Description"
            name="desc"
            @update:desc="(newValue) => (input.desc = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.desc" />

          <Textarea
            label="Content"
            name="content"
            @update:content="(newValue) => (input.content = newValue)"
            :required="true"
            rows="7"
          />
          <InputError :errors="errors?.content" />

          <Radio
            label="Status"
            :labels="['Draft', 'Published']"
            :values="['draft', 'published']"
            name="status"
            :value="input.status"
            @update:status="(newValue) => (input.status = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.status" />

          <div class="form-group">
            <label>Image</label>
            <FileUpload
              fieldName="image_id"
              :fileId="input.image_id"
              @fileSelected="fileSelected"
              @fileUnselected="fileUnselected"
            />
          </div>
          <InputError :errors="errors?.image_id" />

          <div class="d-flex">
            <CancelButton redirect="admin-news-list" />
            <SubmitButton @formSubmited="formSubmited" name="Create" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useAlertsStore } from '@/stores'
import {Input, Textarea, Select, InputError, SubmitButton, CancelButton, Radio} from '@/components/form'
import FileUpload from '@/components/df_files/FileUpload'
import NewsRepository from '@/repositories/newsRepository'
import LanguageRepository from '@/repositories/languageRepository'
import CategoryRepository from '@/repositories/categoryRepository'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import router from '@/router/index.js'
const emit = defineEmits()

const initialState = {
  lang_id: '',
  lang_group_id: null,
  title: '',
  desc: '',
  content: '',
  status: 'draft',
  image_id: null,
  category_id: null
}

const languages = reactive({ data: [] })
const categories = reactive({ data: [] })
const input = reactive({ ...initialState })
const rerenderCategories = ref(false)

onBeforeMount(async () => {
  languages.data = await LanguageRepository.all()
})

const getCategories = async () => {
  rerenderCategories.value = false
  categories.data = await CategoryRepository.getByType('news', input.lang_id)
  rerenderCategories.value = true
}

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  alertStore.resetState()
  const formData = getFormData(input)
  const res = await NewsRepository.store(formData)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-news-list' })
  }
}

const languageUpdated = async (newValue) => {
    input.lang_id = newValue
    getCategories()
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}
</script>

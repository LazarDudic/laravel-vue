<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-categories-list' }"
        >Categories</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Create</span>
      </a>
    </div>
    <h2 class="page-title">Category Create</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Category Create</h2>
        <p class="content-description">description category create</p>
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
          <Radio
            label="Type"
            :labels="['Blog', 'News']"
            :values="['blog', 'news']"
            name="type"
            @update:type="typeUpdated"
            :required="true"
          />
          <InputError :errors="errors?.type" />
          <Select
            v-if="categories.data.length"
            label="Parent Category"
            name="parent_id"
            :selectValues="categories.data"
            @update:parent_id="(newValue) => (input.parent_id = newValue)"
          />
          <InputError :errors="errors?.parent_id" />

          <Input
            label="Title"
            name="title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

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
            <CancelButton redirect="admin-categories-list" />
            <SubmitButton @formSubmited="formSubmited" name="Create" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import CategoryRepository from '@/repositories/categoryRepository'
import LanguageRepository from '@/repositories/languageRepository'
import router from '@/router/index.js'
import FileUpload from '@/components/df_files/FileUpload'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import { Input, Select, InputError, SubmitButton, Radio, CancelButton} from '@/components/form'
const emit = defineEmits()
const initialState = {
  title: '',
  lang_id: '',
  lang_group_id: '',
  image_id: null,
  parent_id: null
}

const languages = reactive({ data: [] })
const categories = reactive({ data: [] })
const input = reactive({ ...initialState })
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

onBeforeMount(async () => {
  languages.data = await LanguageRepository.all()
})

const formSubmited = async () => {
  const formData = getFormData(input)
  const res = await CategoryRepository.store(formData)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-categories-list' })
  }
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}

const languageUpdated = async (newValue) => {
    input.lang_id = newValue
    getParentCategories()
}

const typeUpdated =  (newValue) => {
    input.type = newValue
    getParentCategories()
}

const getParentCategories = async (newValue) => {
    input.parent_id = null
    categories.data = []
    if (input.type && input.lang_id) {
        categories.data = await CategoryRepository.allByLanguageIdAndType(input.lang_id, input.type)
    } 
}

</script>

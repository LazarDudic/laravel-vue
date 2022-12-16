<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-users-list' }">Users</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Edit</span>
      </a>
    </div>
    <h2 class="page-title">News Edit</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">News Edit</h2>
        <p class="content-description">description News edit</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form v-if="Object.entries(input).length" id="df-form">
          <Select
            v-if="languages.data.length"
            label="Language"
            name="lang_id"
            :value="input.lang_id"
            :selectValues="languages.data"
            :disabled="true"
          />
          <InputError :errors="errors?.lang_id" />

          <Select
            v-if="categories.data.length"
            label="Category"
            name="category_id"
            :selectValues="categories.data"
            :value="input.category_id"
            @update:category_id="(newValue) => (input.category_id = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.category_id" />

          <Input
            label="Title"
            name="title"
            :value="input.title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <Textarea
            label="Description"
            name="desc"
            :value="input.desc"
            @update:desc="(newValue) => (input.desc = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.desc" />

          <Textarea
            label="Content"
            name="content"
            :value="input.content"
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
            <SubmitButton @formSubmited="formSubmited" name="Update" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import {Input,Select,Textarea,InputError,SubmitButton,CancelButton} from '@/components/form'
import NewsRepository from '@/repositories/newsRepository'
import CategoryRepository from '@/repositories/categoryRepository'
import LanguageRepository from '@/repositories/languageRepository'
import FileUpload from '@/components/df_files/FileUpload'
import router from '@/router/index.js'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
const emit = defineEmits()

const route = useRoute()
const languages = reactive({ data: [] })
const categories = reactive({ data: [] })
const input = reactive({})
const newsId = route.params.id

onBeforeMount(async () => {
  const news = await NewsRepository.findById(newsId)
  Object.assign(input, news)
  languages.data = await LanguageRepository.all()
  if(news) {
    categories.data = await CategoryRepository.getByType('news', input.lang_id)
  }
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  alertStore.resetState()
  const formData = getFormData(input)
  const res = await NewsRepository.update(formData, newsId)
}

</script>

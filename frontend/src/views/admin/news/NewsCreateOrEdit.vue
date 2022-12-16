<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-news-list' }"
        >News</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>{{ newsExsist ? 'Edit': 'Create' }}</span>
      </a>
    </div>
    <h2 class="page-title">News {{ newsExsist ? 'Edit': 'Create' }}</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">News {{ newsExsist ? 'Edit': 'Create' }}</h2>
        <p class="content-description">description News {{ newsExsist ? 'Edit': 'Create' }}</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form" v-if="Object.entries(input).length">
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
              :key="input.image_id"
              fieldName="image_id"
              :fileId="input.image_id"
              @fileSelected="fileSelected"
              @fileUnselected="fileUnselected"
            />
          </div>
          <InputError :errors="errors?.image_id" />

          <div class="d-flex">
            <CancelButton redirect="admin-news-list" />
            <SubmitButton @formSubmited="formSubmited" name="Save" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { useRoute } from 'vue-router'
import { storeToRefs } from 'pinia'
import NewsRepository from '@/repositories/newsRepository'
import CategoryRepository from '@/repositories/categoryRepository'
import LanguageRepository from '@/repositories/languageRepository'
import router from '@/router/index.js'
import FileUpload from '@/components/df_files/FileUpload'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import {Input,Textarea,Select,InputError,SubmitButton,Radio,CancelButton} from '@/components/form'
const emit = defineEmits()
const route = useRoute()
const groupId = route.params.groupId
const langId = route.params.langId
const input = reactive({
  lang_id: langId,
  lang_group_id: groupId,
  status: 'draft',
  title: '',
  desc: '',
  content: '',
  image_id: null,
  category_id: null,
  id: null
})
const languages = reactive({ data: [] })
const newsExsist = ref(false)
const categories = reactive({ data: [] })

onBeforeMount(async () => {
  const news = await NewsRepository.findByGroupIdAndLanguageId(groupId,langId)
  languages.data = await LanguageRepository.all()
  if (news) {
    newsExsist.value = true
    Object.assign(input, news)
  }
  categories.data = await CategoryRepository.getByType('news', input.lang_id)
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  var res;
  if (newsExsist.value) {
    res = await NewsRepository.update(formData, input.id)
  } else {
    res = await NewsRepository.store(formData)
  }
  if (responseIsOK(res)) {
    router.push({ name: 'admin-news-list' })
  }
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}

</script>

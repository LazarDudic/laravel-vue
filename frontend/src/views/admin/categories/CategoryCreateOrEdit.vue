<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-categories-list' }"
        >Categories</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>{{ categoryExist ? 'Edit': 'Create' }}</span>
      </a>
    </div>
    <h2 class="page-title">Category {{ categoryExist ? 'Edit': 'Create' }}</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Category {{ categoryExist ? 'Edit': 'Create' }}</h2>
        <p class="content-description">description category {{ categoryExist ? 'Edit': 'Create' }}</p>
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
          <Radio
            label="Type"
            :labels="['Blog', 'News']"
            :values="['blog', 'news']"
            name="type"
            :value="input.type"
            :required="true"
            :disabled="true"
          />
          <Select
            v-if="categories.data.length"
            label="Parent Category"
            name="parent_id"
            :value="input.parent_id"
            :selectValues="categories.data"
            @update:parent_id="(newValue) => (input.parent_id = newValue)"
          />
          <InputError :errors="errors?.parent_id" />

          <Input
            label="Title"
            name="title"
            :value="input.title"
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
import CategoryRepository from '@/repositories/categoryRepository'
import LanguageRepository from '@/repositories/languageRepository'
import router from '@/router/index.js'
import FileUpload from '@/components/df_files/FileUpload'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import {Input,Select,InputError,SubmitButton,Radio,CancelButton} from '@/components/form'

const route = useRoute()
const groupId = route.params.groupId
const langId = route.params.langId
const type = route.params.type
const input = reactive({
  lang_id: langId,
  lang_group_id: groupId,
  type: type,
  title: null,
  parent_id: null,
  image_id: null,
  id: null
})
const languages = reactive({ data: [] })
const categoryExist = ref(false)
const categories = reactive({ data: [] })

onBeforeMount(async () => {
  const category = await CategoryRepository.findByGroupIdAndLanguageId(groupId,langId)
  languages.data = await LanguageRepository.all()
  if (category) {
    categoryExist.value = true
    Object.assign(input, category)
  }
  getParentCategories()
})

const getParentCategories = async () => {
    categories.data = await CategoryRepository.allByLanguageIdAndType(
      input.lang_id,
      input.type,
      input.id
    )
}

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  var res;
  if (input.id) {
    res = await CategoryRepository.update(formData, input.id)
  } else {
    res = await CategoryRepository.store(formData)
  }
  if (responseIsOK(res)) {
    router.push({ name: 'admin-categories-list' })
  }
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}

</script>

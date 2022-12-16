<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-pages-list' }">Pages</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Edit</span>
      </a>
    </div>
    <h2 class="page-title">Page Edit</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Page Edit</h2>
        <p class="content-description">description page edit</p>
        <i
          @click="emit('toggleBody')"
          class="close-content-body fas fa-chevron-down"
        ></i>
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

          <Input
            label="Title"
            name="title"
            :value="input.title"
            @update:title="titleUpdated"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <Input
            label="Route"
            name="route"
            :value="input.route"
            @update:route="routeUpdated"
            :required="true"
          />
          <InputError :errors="errors?.route" />

          <Input
            label="Menu Title"
            name="menuTitle"
            :value="input.menuTitle"
            @update:menuTitle="(newValue) => (input.menuTitle = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.menuTitle" />

          <Input
            label="Meta Title"
            name="metaTitle"
            :value="input.metaTitle"
            @update:metaTitle="(newValue) => (input.metaTitle = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.metaTitle" />

          <Textarea
            label="Meta Description"
            name="metaDesc"
            :value="input.metaDesc"
            @update:metaDesc="(newValue) => (input.metaDesc = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.metaDesc" />

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
            label="Show in Main Menu"
            :labels="['Yes', 'No']"
            :values="['yes', 'no']"
            name="main_menu_show"
            :value="input.main_menu_show"
            @update:main_menu_show="
              (newValue) => (input.main_menu_show = newValue)
            "
            :required="true"
          />
          <InputError :errors="errors?.main_menu_show" />

          <Radio
            label="Show in Footer"
            :labels="['Yes', 'No']"
            :values="['yes', 'no']"
            name="footer_menu_show"
            :value="input.footer_menu_show"
            @update:footer_menu_show="
              (newValue) => (input.footer_menu_show = newValue)
            "
            :required="true"
          />
          <InputError :errors="errors?.footer_menu_show" />

          <Radio
            label="Can Delete"
            :labels="['Yes', 'No']"
            :values="['yes', 'no']"
            name="can_delete"
            :value="input.can_delete"
            @update:can_delete="(newValue) => (input.can_delete = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.can_delete" />
          <div class="form-group">
            <label>Social Image</label>
            <FileUpload
              fieldName="socialImageID"
              :fileId="input.socialImageID"
              @fileSelected="fileSelected"
              @fileUnselected="fileUnselected"
            />
          </div>
          <InputError :errors="errors?.socialImageID" />

          <SummernoteEditor
            v-model="input.content"
            @update:modelValue="summernoteChange($event)"
            @summernoteImageLinkInsert="summernoteImageLinkInsert"
          />
          <div class="d-flex">
            <CancelButton redirect="admin-pages-list" />
            <SubmitButton @formSubmited="formSubmited" name="Update" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, onBeforeMount } from 'vue'
import { useRoute } from 'vue-router'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import {
  Input,
  Select,
  Textarea,
  InputError,
  SubmitButton,
  CancelButton,
  Radio
} from '@/components/form'
import SummernoteEditor from 'vue3-summernote-editor'
import PageRepository from '@/repositories/pageRepository'
import LanguageRepository from '@/repositories/languageRepository'
import FileUpload from '@/components/df_files/FileUpload'
import { getFormData } from '@/helpers/helper.js'
const emit = defineEmits()
const route = useRoute()
const languages = reactive({ data: [] })
const categories = reactive({ data: [] })
const input = reactive({})
const pageId = route.params.id

onBeforeMount(async () => {
  const page = await PageRepository.findById(pageId)
  Object.assign(input, page)
  languages.data = await LanguageRepository.all()
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  alertStore.resetState()
  const formData = getFormData(input)
  const res = await PageRepository.update(formData, pageId)
}

const titleUpdated = async (newValue) => {
  input.title = newValue
  input.route = '/' + newValue.toLowerCase().replace(/[^\w-]+/g, '-')
}

function summernoteChange(newValue) {
  console.log('summernoteChange', newValue)
}
function summernoteImageLinkInsert(...args) {
  console.log('summernoteImageLinkInsert()', args)
}

const routeUpdated = async (newValue) => {
  var slug = newValue
    .toLowerCase()
    .replace('/', '')
    .replaceAll(/[^\w-]+/g, '-')
  input.route = '/' + slug
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}
</script>

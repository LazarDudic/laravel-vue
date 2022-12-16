<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-pages-list' }"
        >News</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>{{ pageExsist ? 'Edit': 'Create' }}</span>
      </a>
    </div>
    <h2 class="page-title">News {{ pageExsist ? 'Edit': 'Create' }}</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">News {{ pageExsist ? 'Edit': 'Create' }}</h2>
        <p class="content-description">description News {{ pageExsist ? 'Edit': 'Create' }}</p>
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
            @update:main_menu_show="(newValue) => (input.main_menu_show = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.main_menu_show" />

          <Radio
            label="Show in Footer"
            :labels="['Yes', 'No']"
            :values="['yes', 'no']"
            name="footer_menu_show"
            :value="input.footer_menu_show"
            @update:footer_menu_show="(newValue) => (input.footer_menu_show = newValue)"
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
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { useRoute } from 'vue-router'
import { storeToRefs } from 'pinia'
import PageRepository from '@/repositories/pageRepository'
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
  title: '',
  route: '/',
  menuTitle: '',
  metaTitle: '',
  metaDesc: '',
  content: '',
  can_delete: 'yes',
  main_menu_show: 'yes',
  footer_menu_show: 'yes',
  socialImageID: null,
})
const languages = reactive({ data: [] })
const pageExsist = ref(false)

onBeforeMount(async () => {
  const page = await PageRepository.findByGroupIdAndLanguageId(groupId,langId)
  languages.data = await LanguageRepository.all()
  if (page) {
    pageExsist.value = true
    Object.assign(input, page)
  }
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  var res;
  if (pageExsist.value) {
    res = await PageRepository.update(formData, input.id)
  } else {
    res = await PageRepository.store(formData)
  }
  if (responseIsOK(res)) {
    router.push({ name: 'admin-pages-list' })
  }
}


const titleUpdated = async (newValue) => {
    input.title = newValue
    input.route = '/'+ newValue.toLowerCase().replace(/[^\w-]+/g, '-');
}

const routeUpdated = async (newValue) => {
    var slug = newValue.toLowerCase()
                    .replace('/', '')
                    .replaceAll(/[^\w-]+/g, '-');
    input.route = '/'+slug
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}

</script>

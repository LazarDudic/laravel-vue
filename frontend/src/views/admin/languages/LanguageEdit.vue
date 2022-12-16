<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-languages-list' }">Languages</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Edit</span>
      </a>
    </div>
    <h2 class="page-title">Language Edit</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Language Edit</h2>
        <p class="content-description">description language edit</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form" v-if="Object.entries(input).length">
          <Input
            label="Title"
            name="title"
            :value="input.title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <Input
            label="Lang Code"
            name="lang_code"
                        :value="input.lang_code"
            @update:lang_code="(newValue) => (input.lang_code = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.lang_code" />

          <Input
            label="Url Prefix"
            name="url_prefix"
            :value="input.url_prefix"
            @update:url_prefix="(newValue) => (input.url_prefix = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.url_prefix" />

          <Input
            label="Html Lang"
            name="html_lang"
            :value="input.html_lang"
            @update:html_lang="(newValue) => (input.html_lang = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.html_lang" />

          <Radio
            label="Status"
            :labels="['Preparing', 'Active']"
            :values="['preparing', 'active']"
            name="status"
            :value="input.status"
            @update:status="(newValue) => (input.status = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.status" />

          <div class="d-flex">
            <CancelButton redirect="admin-languages-list" />
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
import LanguageRepository from '@/repositories/languageRepository'
import router from '@/router/index.js'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import {
  Input,
  InputError,
  SubmitButton,
  Radio, 
  CancelButton
} from '@/components/form'
const emit = defineEmits()
const route = useRoute()
const input = reactive({})
const languageId = route.params.id

onBeforeMount(async () => {
  const language = await LanguageRepository.findById(languageId)
  Object.assign(input, language)
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  const res = await LanguageRepository.update(formData, languageId)
}

const deleteLanguage = async () => {
  if (confirm('Are you sure?')) {
    const res = await LanguageRepository.delete(languageId)
    if (responseIsOK(res)) {
      router.push({ name: 'admin-languages-list' })
    }
  }
}
</script>

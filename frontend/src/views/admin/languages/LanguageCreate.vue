<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-languages-list' }">Languages</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Create</span>
      </a>
    </div>
    <h2 class="page-title">Language Create</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Language Create</h2>
        <p class="content-description">description language create</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form">
          <Input
            label="Title"
            name="title"
            @update:title="(newValue) => (input.title = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.title" />

          <Input
            label="Lang Code"
            name="lang_code"
            @update:lang_code="(newValue) => (input.lang_code = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.lang_code" />

          <Input
            label="Url Prefix"
            name="url_prefix"
            @update:url_prefix="(newValue) => (input.url_prefix = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.url_prefix" />

          <Input
            label="Html Lang"
            name="html_lang"
            @update:html_lang="(newValue) => (input.html_lang = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.html_lang" />

          <Radio
            label="Status"
            :labels="['Preparing', 'Active']"
            :values="['preparing', 'active']"
            name="status"
            @update:status="(newValue) => (input.status = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.status" />

          <div class="d-flex">
            <CancelButton redirect="admin-languages-list" />
            <SubmitButton @formSubmited="formSubmited" name="Create" />
          </div>        
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import LanguageRepository from '@/repositories/languageRepository'
import { responseIsOK } from '@/helpers/helper.js'
import router from '@/router/index.js'
import { getFormData } from '@/helpers/helper.js'
import {
  Input,
  InputError,
  SubmitButton,
  Radio, 
  CancelButton
} from '@/components/form'
const emit = defineEmits()

const initialState = {
  title: '',
  url_prefix: '',
  html_lang: '',
  lang_code: '',
  status: ''
}
const input = reactive({ ...initialState })

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  const res = await LanguageRepository.store(formData)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-languages-list' })
  }
}
</script>

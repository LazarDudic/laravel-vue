<template>
  <!-- <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">App Settings</h1>
    </div>
    <div class="register container">
      <form>
        <div class="form-group">
          <label>Version</label>
          <input type="text" v-model="input.version" class="form-control" />
          <div v-if="errors?.version">
            <div v-for="(error, id) in errors.version" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        
        <div class="form-group py-3">
         <label>Default Language</label>
          <select v-model="input.default_lang_id" class="form-control">
            <option v-for="language in languages.data" :value="language.id" :key="language.id">
                {{language.title}}
            </option>
          </select>
          <div v-if="errors?.permissions">
            <div v-for="(error, id) in errors.permissions" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <label>Url Language Prefix</label>
        <div class="form-group ">
          <label for="yes-url-prefix">
            <input
              type="radio"
              id="yes-url-prefix"
              v-model="input.url_lang_prefix"
              value="yes"
            />Yes
          </label>
          <label for="no-url-prefix">
            <input
              type="radio"
              id="no-url-prefix"
              v-model="input.url_lang_prefix"
              value="no"
            />No
          </label>
          <div v-if="errors?.url_lang_prefix">
            <div v-for="(error, id) in errors.url_lang_prefix" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>

        <button
          type="button"
          class="btn btn-primary mt-2"
		  @click="submitUpdateAppSettings"
        >
          Update
        </button>
      </form>
    </div>
  </main> -->
      <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>App Settings</span>
      </a>
    </div>
    <h2 class="page-title">App Settings</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">App Settings</h2>
        <p class="content-description">description App Settings</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form" v-if="Object.entries(input).length">
            <Select
            v-if="languages.data.length"
            label="Language"
            name="default_lang_id"
            :value="input.default_lang_id"
            :selectValues="languages.data"
            @update:default_lang_id="(newValue) => (input.default_lang_id = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.default_lang_id" />
          <Input
            label="Version"
            name="version"
            :value="input.version"
            @update:version="(newValue) => (input.version = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.version" />

          <Radio
            label="Url Language Prefix"
            :labels="['Yes', 'No']"
            :values="['yes', 'no']"
            name="url_lang_prefix"
            :value="input.url_lang_prefix"
            @update:url_lang_prefix="(newValue) => (input.url_lang_prefix = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.url_lang_prefix" />

          <div class="d-flex">
            <CancelButton :back="true" />
            <SubmitButton @formSubmited="formSubmited" name="Update" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { useAlertsStore, useLanguageStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { useRoute } from 'vue-router'
import AppSettingsRepository from '@/repositories/appSettingsRepository'
import LanguageRepository from '@/repositories/languageRepository'
import { getFormData } from '@/helpers/helper.js'
import { Input, InputError, SubmitButton, Select, Radio, CancelButton } from '@/components/form'
const emit = defineEmits()
const route = useRoute()
const input = reactive({})
const languages = reactive({data: []})

onBeforeMount(async () => {
  const appSettings = await AppSettingsRepository.get()
  languages.data = await LanguageRepository.all()
  Object.assign(input, appSettings)
})
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  await AppSettingsRepository.update(formData)
}

</script>

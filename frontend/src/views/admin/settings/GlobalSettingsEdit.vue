<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-global-settings-list' }"
        >Global Settings</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Edit</span>
      </a>
    </div>
    <h2 class="page-title">Global Settings Edit</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">Global Settings Edit</h2>
        <p class="content-description">description Global Settings edit</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form" v-if="Object.entries(input).length">
          <Input label="Language" :value="input.language" :disabled="true" />
          <Input
            label="Sitename"
            name="sitename"
            :value="input.sitename"
            @update:sitename="(newValue) => (input.sitename = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.sitename" />

          <Input
            label="Email"
            name="email"
            :value="input.email"
            @update:email="(newValue) => (input.email = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.email" />

          <Input
            label="Public Email"
            name="email_public"
            :value="input.email_public"
            @update:email_public="(newValue) => (input.email_public = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.email_public" />

          <Input
            label="Facebook"
            name="facebook"
            :value="input.facebook"
            @update:facebook="(newValue) => (input.facebook = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.facebook" />

          <Input
            label="Facebook App Id"
            name="facebook_app_id"
            :value="input.facebook_app_id"
            @update:facebook_app_id="
              (newValue) => (input.facebook_app_id = newValue)
            "
            :required="true"
          />
          <InputError :errors="errors?.facebook_app_id" />

          <Input
            label="Twitter"
            name="twitter"
            :value="input.twitter"
            @update:twitter="(newValue) => (input.twitter = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.twitter" />

          <Input
            label="Twitter Username"
            name="twitter_username"
            :value="input.twitter_username"
            @update:twitter_username="
              (newValue) => (input.twitter_username = newValue)
            "
            :required="true"
          />
          <InputError :errors="errors?.twitter_username" />

          <Input
            label="Youtube"
            name="youtube"
            :value="input.youtube"
            @update:youtube="(newValue) => (input.youtube = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.youtube" />

          <Input
            label="Pinterest"
            name="pinterest"
            :value="input.pinterest"
            @update:pinterest="(newValue) => (input.pinterest = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.pinterest" />

          <Input
            label="Instagram"
            name="instagram"
            :value="input.instagram"
            @update:instagram="(newValue) => (input.instagram = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.instagram" />

          <Input
            label="Discord"
            name="discord"
            :value="input.discord"
            @update:discord="(newValue) => (input.discord = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.discord" />

          <Input
            label="Linkedin"
            name="linkedin"
            :value="input.linkedin"
            @update:linkedin="(newValue) => (input.linkedin = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.linkedin" />

          <Input
            label="Copyright"
            name="copyright"
            :value="input.copyright"
            @update:copyright="(newValue) => (input.copyright = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.copyright" />

          <Input
            label="Address"
            name="address"
            :value="input.address"
            @update:address="(newValue) => (input.address = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.address" />

          <Input
            label="Phone"
            name="phone"
            :value="input.phone"
            @update:phone="(newValue) => (input.phone = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.phone" />

          <Input
            label="Footer Text"
            name="footer_text"
            :value="input.footer_text"
            @update:footer_text="(newValue) => (input.footer_text = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.footer_text" />

          <Input
            label="Header Scripts"
            name="header_scripts"
            :value="input.header_scripts"
            @update:header_scripts="
              (newValue) => (input.header_scripts = newValue)
            "
            :required="true"
          />
          <InputError :errors="errors?.header_scripts" />

          <div class="form-group">
            <label>Social Image</label>
            <FileUpload
              fieldName="default_social_image_id"
              :fileId="input.default_social_image_id"
              @fileSelected="fileSelected"
              @fileUnselected="fileUnselected"
            />
          </div>
          <InputError :errors="errors?.default_social_image_id" />

          <div class="d-flex">
            <CancelButton redirect="admin-global-settings-list" />
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
import FileUpload from '@/components/df_files/FileUpload'
import { useRoute } from 'vue-router'
import GlobalSettingsRepository from '@/repositories/globalSettingsRepository'
import { getFormData } from '@/helpers/helper.js'
import { Input, InputError, SubmitButton, CancelButton } from '@/components/form'

const route = useRoute()
const input = reactive({})

onBeforeMount(async () => {
  const globalSettings = await GlobalSettingsRepository.findById(route.params.id)
  Object.assign(input, globalSettings)
})
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  const formData = getFormData(input)
  await GlobalSettingsRepository.update(route.params.id, formData)
}

const fileSelected = (data) => {
  input[data.fieldName] = data.fileId
}

const fileUnselected = (fieldName) => {
  input[fieldName] = null
}
</script>

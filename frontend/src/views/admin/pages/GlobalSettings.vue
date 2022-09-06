<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Global Settings</h1>
    </div>
    <div class="register container">
      <!-- <form>
        <div class="form-group">
          <label>Name</label>
          <input type="text" v-model="input.sitename" class="form-control" />
          <div v-if="errors?.sitename">
            <div v-for="(error, id) in errors.sitename" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" v-model="input.email" class="form-control" />
          <div v-if="errors?.email">
            <div v-for="(error, id) in errors.email" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Public Email</label>
          <input
            type="email"
            v-model="input.email_public"
            class="form-control"
          />
          <div v-if="errors?.email_public">
            <div v-for="(error, id) in errors.email_public" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Facebok</label>
          <input type="text" v-model="input.facebook" class="form-control" />
          <div v-if="errors?.facebook">
            <div v-for="(error, id) in errors.facebook" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Facebook App Id</label>
          <input
            type="text"
            v-model="input.facebook_app_id"
            class="form-control"
          />
          <div v-if="errors?.facebook_app_id">
            <div v-for="(error, id) in errors.facebook_app_id" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Twitter</label>
          <input type="text" v-model="input.twitter" class="form-control" />
          <div v-if="errors?.twitter">
            <div v-for="(error, id) in errors.twitter" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Twitter Username</label>
          <input
            type="text"
            v-model="input.twitter_username"
            class="form-control"
          />
          <div v-if="errors?.twitter_username">
            <div v-for="(error, id) in errors.twitter_username" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Youtube</label>
          <input type="text" v-model="input.youtube" class="form-control" />
          <div v-if="errors?.youtube">
            <div v-for="(error, id) in errors.youtube" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Pinterest</label>
          <input type="text" v-model="input.pinterest" class="form-control" />
          <div v-if="errors?.pinterest">
            <div v-for="(error, id) in errors.pinterest" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Instagram</label>
          <input type="text" v-model="input.instagram" class="form-control" />
          <div v-if="errors?.instagram">
            <div v-for="(error, id) in errors.instagram" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Discord</label>
          <input type="text" v-model="input.discord" class="form-control" />
          <div v-if="errors?.discord">
            <div v-for="(error, id) in errors.discord" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Linkedin</label>
          <input type="text" v-model="input.linkedin" class="form-control" />
          <div v-if="errors?.linkedin">
            <div v-for="(error, id) in errors.linkedin" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Copyright</label>
          <input type="text" v-model="input.copyright" class="form-control" />
          <div v-if="errors?.copyright">
            <div v-for="(error, id) in errors.copyright" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" v-model="input.address" class="form-control" />
          <div v-if="errors?.address">
            <div v-for="(error, id) in errors.address" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="text" v-model="input.phone" class="form-control" />
          <div v-if="errors?.phone">
            <div v-for="(error, id) in errors.phone" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Footer Text</label>
          <input type="text" v-model="input.footer_text" class="form-control" />
          <div v-if="errors?.footer_text">
            <div v-for="(error, id) in errors.footer_text" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Deafult Social Image</label>
          <input
            type="file"
            v-on:change="defaultSocialImageOnChange"
            class="form-control"
          />
          <div v-if="errors?.default_social_image">
            <div v-for="(error, id) in errors.default_social_image" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label>Header Scripts</label>
          <input
            type="text"
            v-model="input.header_scripts"
            class="form-control"
          />
          <div v-if="errors?.header_scripts">
            <div v-for="(error, id) in errors.header_scripts" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <button
          type="button"
          @click="submitUpdateGlobalSettings"
          class="btn btn-primary"
        >
          Submit
        </button>
      </form> -->
<!-- Button trigger modal -->
    <FileUpload />
    </div>
  </main>
</template>

<script setup>
import { reactive, onBeforeMount } from 'vue'
import { useAlertsStore, useGlobalSettingsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import FileUpload from '@/components/df_files/FileUpload'

const input = reactive({})
const globalSettingsStore = useGlobalSettingsStore()

onBeforeMount(async () => {
  const globalSettings = await globalSettingsStore.getSettings(true)
  Object.assign(input, globalSettings)
})
const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitUpdateGlobalSettings = async () => {
  const formData = new FormData()
  Object.keys(input).forEach((el, index) => {
    formData.append(el, input[el])
  })
  alertStore.resetState()
  await globalSettingsStore.update(formData)
}

const defaultSocialImageOnChange = (e) => {
  input.default_social_image = e.target.files[0]
}
</script>

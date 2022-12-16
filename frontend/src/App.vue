<template>
  <div v-if="!userStore.isAuth()">
    <nav>
      <span>
        <router-link :to="{ name: 'login' }">Login</router-link> |
        <router-link :to="{ name: 'register' }">Register</router-link> |
        <router-link :to="{ name: 'forgot-password' }"
          >Forgot Password</router-link
        >
        |
        <router-link :to="{ name: 'reset-password' }"
          >Reset Password</router-link
        >
      </span>
    </nav>
    <router-view :key="rerenderContent" />
  </div>

  <Admin v-if="userStore.isAuth()" @rerenderContent="rerenderContent"  :key="rerenderContentKey"/>
  <Alerts />
  <Loader />
</template>

<script setup>
import { onErrorCaptured, onMounted, ref } from 'vue'
import { storeToRefs } from 'pinia'
import Admin from '@/components/common/Admin'
import Alerts from '@/components/Alerts'
import Loader from '@/components/Loader'
import {
  useUserStore,
  useAlertsStore,
  useGlobalSettingsStore,
  useCssStore
} from '@/stores'

const rerenderContentKey = ref(0)

var userStore = useUserStore()
const { authUser } = storeToRefs(userStore)
const { globalSettings } = storeToRefs(useGlobalSettingsStore())
const { sidebarCss } = storeToRefs(useCssStore())

const rerenderContent = () => {
  rerenderContentKey.value += 1
}
onErrorCaptured((e) => {
  // const alertStore = useAlertsStore()
  // alertStore.setErrorMessage(e)
  // return false;
})
</script>

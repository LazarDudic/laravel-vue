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
    <router-view />
  </div>

  <div v-if="userStore.isAuth()">
    <header
      class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow"
    >
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">{{
        globalSettings?.sitename
      }}</a>
      <button
        class="navbar-toggler position-absolute d-md-none collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu"
        aria-controls="sidebarMenu"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" href="#" @click="userStore.logout()">
            Logout</a
          >
        </div>
      </div>
    </header>
    <div class="container-fluid">
      <div class="row">
        <nav
          id="sidebarMenu"
          class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse"
        >
          <div class="position-sticky pt-3">
            <ul class="list-unstyled ps-0">
              <li class="mb-1">
                <router-link class="btn-link" :to="{ name: 'admin-dashboard' }"
                  >Dashboard</router-link
                >
              </li>

              <li class="mb-1" v-if="userStore.can('list-users')">
                <a
                  class="btn-link align-items-center collapsed"
                  href="#"
                  data-bs-toggle="collapse"
                  data-bs-target="#users-collapse"
                  aria-expanded="false"
                >
                  Users
                </a>
                <div class="collapse" id="users-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-users-list' }"
                        >List</router-link
                      >
                    </li>
                    <li v-if="userStore.can('create-users')">
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-users-create' }"
                      >
                        Create
                      </router-link>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="mb-1" v-if="userStore.can('list-roles')">
                <a
                  class="btn-link align-items-center collapsed"
                  href="#"
                  data-bs-toggle="collapse"
                  data-bs-target="#roles-collapse"
                  aria-expanded="false"
                >
                  Roles
                </a>
                <div class="collapse" id="roles-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-roles-list' }"
                        >List</router-link
                      >
                    </li>
                    <li v-if="userStore.can('create-roles')">
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-roles-create' }"
                      >
                        Create
                      </router-link>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="mb-1" v-if="userStore.can('list-permissions')">
                <a
                  class="btn-link align-items-center collapsed"
                  href="#"
                  data-bs-toggle="collapse"
                  data-bs-target="#permissions-collapse"
                  aria-expanded="false"
                >
                  Permissions
                </a>
                <div class="collapse" id="permissions-collapse">
                  <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li>
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-permissions-list' }"
                        >List</router-link
                      >
                    </li>
                    <li v-if="userStore.can('create-permissions')">
                      <router-link
                        class="btn-link"
                        :to="{ name: 'admin-permissions-create' }"
                      >
                        Create
                      </router-link>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="mb-1" v-if="userStore.can('update-global-settings')">
                <router-link class="btn-link" :to="{ name: 'admin-settings' }"
                  >Settings</router-link
                >
              </li>
            </ul>
          </div>
        </nav>
        <div v-if="isLoading" style="z-index: 9999;" class="loader-wrapper">
            <div style="z-index: 9999;" class=" loader"></div>
        </div>
        <router-view />
        <Alerts />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onErrorCaptured, onBeforeMount, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useUserStore, useAlertsStore, useGlobalSettingsStore, useLoadingStore } from '@/stores'
import Alerts from '@/components/Alerts.vue'

var userStore = useUserStore()
const { authUser } = storeToRefs(userStore)
const { globalSettings } = storeToRefs(useGlobalSettingsStore())
const { isLoading } = storeToRefs(useLoadingStore())

onErrorCaptured((e) => {
  // const alertStore = useAlertsStore()
  // alertStore.setErrorMessage(e)
  // return false;
})
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
}

nav a.router-link-exact-active {
  color: #42b983;
}


.loader-wrapper {
  background-color: rgba(255, 255, 255, 0.155);
  position: absolute;
  width: 100%;
  height: 100%;
  padding: 0;
  margin: 0;
}

.loader {
  border: 16px solid #f3f3f3;
  position: fixed;
  border-top: 16px solid #42b983;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

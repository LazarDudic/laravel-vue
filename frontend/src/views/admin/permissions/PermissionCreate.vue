<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Permission Create</h1>
    </div>
    <div class="register container">
      <form>
        <div class="form-group">
          <label>Name</label>
          <input
            type="text"
            v-model="input.name"
            class="form-control"
            placeholder="Enter Name"
          />
          <div v-if="errors?.name">
            <div v-for="(error, id) in errors.name" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>

        <button type="button" @click="submitCreatePermission" class="btn btn-primary">
          Submit
        </button>
      </form>
    </div>
  </main>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import UserRepository from '@/repositories/userRepository'
import PermissionRepository from '@/repositories/permissionRepository'
import { responseIsOK } from '@/helpers/helper.js'
import router from '@/router/index.js'

const initialState = {
  name: '',
}
const input = reactive({ ...initialState })

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitCreatePermission = async () => {
  alertStore.resetState()
  const res = await PermissionRepository.store(input)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-permissions-list' })
  }
}
</script>

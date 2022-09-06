<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Role Create</h1>
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

        <div class="form-check w-25" v-for="permission in allPermissions.data"
          :key="permission.id"
        >
          <input
            class="form-check-input"
            type="checkbox"
            id="check1"
            v-model="input.permissions"
            :value="permission.id"
          />
          <label class="form-check-label">{{ permission.name }}</label>
          <div v-if="errors?.permissions">
            <div v-for="(error, id) in errors.permissions" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>

        <button type="button" @click="submitCreateRole" class="btn btn-primary">
          Submit
        </button>
      </form>
    </div>
  </main>
</template>

<script setup>
import { reactive, ref, onBeforeMount } from 'vue'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import RoleRepository from '@/repositories/roleRepository'
import PermissionRepository from '@/repositories/permissionRepository'
import { responseIsOK } from '@/helpers/helper.js'
import router from '@/router/index.js'

const initialState = {
  name: '',
  permissions: []
}
const input = reactive({ ...initialState })

const allPermissions = reactive({data: []})

onBeforeMount(async () => {
  allPermissions.data = await PermissionRepository.all()
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitCreateRole = async () => {
  alertStore.resetState()
  console.log(input)
  const res = await RoleRepository.store(input)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-roles-list' })
  }
}
</script>

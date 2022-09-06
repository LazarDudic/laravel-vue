<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">User Edit</h1>
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
        <div
          class="form-check w-25"
          v-for="permission in allPermissions.data"
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

        <div class="mt-4">
          <button
            type="button"
            @click="submitUpdateRole"
            class="btn btn-primary me-3"
          >
            Submit
          </button>

          <button type="button" @click="deleteRole" class="btn btn-danger">
            Delete
          </button>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>
import { reactive, onBeforeMount } from 'vue'
import { useRoute } from 'vue-router'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import RoleRepository from '@/repositories/roleRepository'
import PermissionRepository from '@/repositories/permissionRepository'
import router from '@/router/index.js'
import { responseIsOK } from '@/helpers/helper.js'

const route = useRoute()
const input = reactive({})
const allPermissions = reactive({ data: [] })

onBeforeMount(async () => {
  const role = await RoleRepository.findById(route.params.id)
  role.permissions = role.permissions.map((p) => p.id)
  Object.assign(input, role)
  allPermissions.data = await PermissionRepository.all()
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitUpdateRole = async () => {
  alertStore.resetState()
  const res = await RoleRepository.update(input, route.params.id)
}

const deleteRole = async () => {
  if (confirm('Are you sure?')) {
    const res = await RoleRepository.delete(route.params.id)
    if (responseIsOK(res)) {
      router.push({ name: 'admin-roles-list' })
    }
  }
}
</script>

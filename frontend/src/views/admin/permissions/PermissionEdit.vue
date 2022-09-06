<template>
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
      <div class="chartjs-size-monitor-expand"><div class=""></div></div>
      <div class="chartjs-size-monitor-shrink"><div class=""></div></div>
    </div>
    <div
      class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
    >
      <h1 class="h2">Permission Edit</h1>
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
        <div class="mt-4">
          <button
            type="button"
            @click="submitUpdatePermission"
            class="btn btn-primary me-3"
          >
            Submit
          </button>

          <button type="button" @click="deletePermission" class="btn btn-danger">
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
import PermissionRepository from '@/repositories/permissionRepository'
import router from '@/router/index.js'
import { responseIsOK } from "@/helpers/helper.js";

const route = useRoute()
const input = reactive({})

onBeforeMount(async () => {
  const permission = await PermissionRepository.findById(route.params.id)
  Object.assign(input, permission)
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitUpdatePermission = async () => {
  alertStore.resetState()
  const res = await PermissionRepository.update(input, route.params.id)
}

const deletePermission = async () => {
  if (confirm('Are you sure?')) {
    const res = await PermissionRepository.delete(route.params.id)
    if (responseIsOK(res)) {
      router.push({ name: 'admin-permissions-list' })
    }
  }
}
</script>

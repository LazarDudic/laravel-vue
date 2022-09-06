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
          <label>Role</label>
          <select v-model="input.role_id">
            <option v-for="role in roles.value" :key="role.id" :value="role.id">
              {{ role.name }}
            </option>
          </select>
          <div v-if="errors?.role_id">
            <div v-for="(error, id) in errors.role_id" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input
            type="text"
            v-model="input.first_name"
            class="form-control"
            placeholder="Enter First Name"
          />
          <div v-if="errors?.first_name">
            <div v-for="(error, id) in errors.first_name" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input
            type="text"
            v-model="input.last_name"
            class="form-control"
            placeholder="Enter Last Nsame"
          />
          <div v-if="errors?.last_name">
            <div v-for="(error, id) in errors.last_name" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Email address</label>
          <input
            type="email"
            v-model="input.email"
            class="form-control"
            placeholder="Enter email"
          />
          <div v-if="errors?.email">
            <div v-for="(error, id) in errors.email" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input
            type="password"
            v-model="input.password"
            class="form-control"
            id="exampleInputPassword1"
            placeholder="Password"
          />
          <div v-if="errors?.password">
            <div v-for="(error, id) in errors.password" :key="id">
              <span class="text-danger">{{ error }} </span>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <button
            type="button"
            @click="submitUpdateUser"
            class="btn btn-primary me-3"
          >
            Submit
          </button>

          <button type="button" @click="deleteUser" class="btn btn-danger">
            Delete
          </button>
        </div>
      </form>
    </div>
  </main>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { useRoute } from 'vue-router'
import { useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import UserRepository from '@/repositories/userRepository'
import RoleRepository from '@/repositories/roleRepository'
import router from '@/router/index.js'
import { responseIsOK } from "@/helpers/helper.js";

const route = useRoute()
const input = reactive({})
const roles = ref([])

onBeforeMount(async () => {
  const user = await UserRepository.findById(route.params.id)
  Object.assign(input, user)
  roles.value = ref(await RoleRepository.all())
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const submitUpdateUser = async () => {
  alertStore.resetState()
  const res = await UserRepository.update(input, route.params.id)
}

const deleteUser = async () => {
  if (confirm('Are you sure?')) {
    const res = await UserRepository.delete(route.params.id)
    if (responseIsOK(res)) {
      router.push({ name: 'admin-users-list' })
    }
  }
}
</script>

<template>
  <div id="df-main">
    <div class="page-path">
      <router-link to="/">Home</router-link
      ><i class="fas fa-chevron-right"></i>
      <router-link :to="{ name: 'admin-users-list' }">Users</router-link
      ><i class="fas fa-chevron-right"></i>
      <a href="#">
        <span>Create</span>
      </a>
    </div>
    <h2 class="page-title">User Create</h2>
    <div class="page-content">
      <div class="content-header">
        <h2 class="content-title">User Create</h2>
        <p class="content-description">description user create</p>
        <i @click="emit('toggleBody')" class="close-content-body fas fa-chevron-down"></i>
      </div>
      <hr />
      <div class="content-body">
        <form id="df-form">
          <Select
            v-if="allRoles.data.length"
            label="Role"
            name="role_id"
            :selectValues="allRoles.data"
            @update:role_id="(newValue) => (input.role_id = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.role_id" />

          <Input
            label="First Name"
            name="first_name"
            @update:first_name="(newValue) => (input.first_name = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.first_name" />

          <Input
            label="Last Name"
            name="last_name"
            @update:last_name="(newValue) => (input.last_name = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.last_name" />

          <Input
            label="Country"
            name="country"
            @update:country="(newValue) => (input.country = newValue)"
          />
          <InputError :errors="errors?.country" />

          <Input
            label="City"
            name="city"
            @update:city="(newValue) => (input.city = newValue)"
          />
          <InputError :errors="errors?.city" />

          <Input
            label="Address"
            name="address"
            @update:address="(newValue) => (input.address = newValue)"
          />
          <InputError :errors="errors?.address" />

          <Input
            label="Phone"
            name="phone"
            @update:phone="(newValue) => (input.phone = newValue)"
          />
          <InputError :errors="errors?.phone" />

          <Input
            label="Email"
            name="email"
            type="email"
            @update:email="(newValue) => (input.email = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.email" />

          <Input
            label="Password"
            name="password"
            type="password"
            @update:password="(newValue) => (input.password = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.password" />

          <div class="d-flex">
            <CancelButton redirect="admin-users-list" />
            <SubmitButton @formSubmited="formSubmited" name="Create" />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, onBeforeMount, ref } from 'vue'
import { storeToRefs } from 'pinia'
import { useAlertsStore } from '@/stores'
import {Input, Select, InputError, SubmitButton, CancelButton} from '@/components/form'
import UserRepository from '@/repositories/userRepository'
import RoleRepository from '@/repositories/roleRepository'
import { responseIsOK, getFormData } from '@/helpers/helper.js'
import router from '@/router/index.js'
const emit = defineEmits()

const initialState = {
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  role_id: ''
}

const input = reactive({ ...initialState })

const allRoles = reactive({ data: [] })
onBeforeMount(async () => {
  allRoles.data = ref(await RoleRepository.all())
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = async () => {
  alertStore.resetState()
  const formData = getFormData(input)
  const res = await UserRepository.store(formData)
  if (responseIsOK(res)) {
    Object.assign(input, initialState)
    router.push({ name: 'admin-users-list' })
  }
}
</script>

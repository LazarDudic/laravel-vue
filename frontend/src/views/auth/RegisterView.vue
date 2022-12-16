<template>
  <div class="card container">
    <form id="df-form">
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
      <Input
        label="Confirm Password"
        name="password_confirmation"
        type="password"
        @update:password_confirmation="(newValue) => (input.password_confirmation = newValue)"
        :required="true"
      />
      <InputError :errors="errors?.password_confirm" />

      <SubmitButton @formSubmited="formSubmited" name="Register" />
    </form>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useUserStore, useAlertsStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { Input, InputError, SubmitButton } from '@/components/form'

const input = reactive({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
  phone: '',
  address: '',
  country: '',
  city: '',
})

const alertStore = useAlertsStore()
const { errors } = storeToRefs(alertStore)

const formSubmited = () => {
  const userStore = useUserStore()
  console.log(input);
  userStore.register(input)
}
</script>

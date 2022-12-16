<template>
  <div class="container card">
    <form id="df-form">   
        <Input
            label="Email"
            name="email"
            type="email"
            @update:email="(newValue) => (input.email = newValue)"
            :required="true"
          />
          <InputError :errors="errors?.email" />

        <SubmitButton @formSubmited="formSubmited" name="Send" />
    </form>
  </div>
</template>

<script setup>
import { reactive } from "vue"
import { useUserStore, useAlertsStore } from "@/stores"
import { storeToRefs } from "pinia"
import AuthRepository from "@/repositories/authRepository"
import { responseIsOK } from "@/helpers/helper.js";
import {Input, InputError, SubmitButton} from '@/components/form'

const initialState = { email: "" }

const input = reactive({ ...initialState })

const alertStore = useAlertsStore()
const { errors, success } = storeToRefs(alertStore);

const formSubmited = async () => {
  const userStore = useUserStore()
  const res = await AuthRepository.forgotPassword(input)

  if (responseIsOK(res)) {
    Object.assign(input, initialState)
  }
};
</script>

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

        <SubmitButton @formSubmited="formSubmited" name="Reset" />
    </form>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useUserStore, useAlertsStore } from "@/stores";
import { storeToRefs } from "pinia";
import AuthRepository from "@/repositories/authRepository";
import { useRoute } from "vue-router";
import { responseIsOK } from "@/helpers/helper.js";
import { Input, InputError, SubmitButton } from '@/components/form'

const route = useRoute();
const initialState = {
  token: route.query.token,
  password: "",
  password_confirmation: "",
  email: "",
};

const input = reactive({ ...initialState });

const alertStore = useAlertsStore();
const { errors, success } = storeToRefs(alertStore);

const formSubmited = async () => {
  const res = await AuthRepository.resetPassword(input);

  if (responseIsOK(res)) {
    Object.assign(input, initialState);
  }
};
</script>

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

        <SubmitButton @formSubmited="formSubmited" name="Login" />
    </form>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useUserStore, useAlertsStore } from "@/stores";
import { storeToRefs } from "pinia";
import {Input, InputError, SubmitButton} from '@/components/form'

const input = reactive({
  email: "",
  password: "",
});

const alertStore = useAlertsStore();
const { errors } = storeToRefs(alertStore);

const formSubmited = () => {
  const userStore = useUserStore();
  userStore.login(input);
};
</script>

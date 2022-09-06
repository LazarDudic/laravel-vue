<template>
  <div class="container">
    <div v-if="success">
      <span class="text-success">{{ success }}</span>
    </div>
    <div v-if="errors?.global">
      <span class="text-danger">{{ errors.global }} </span>
    </div>
    <form>
      <div v-if="errors?.token">
        <div v-for="(error, id) in errors.token" :key="id">
          <span class="text-danger">{{ error }} </span>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" v-model="input.email" class="form-control" />
        <div v-if="errors?.email">
          <div v-for="(error, id) in errors.email" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" v-model="input.password" class="form-control" />
        <div v-if="errors?.password">
          <div v-for="(error, id) in errors.password" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password Confirm</label>
        <input
          type="password"
          v-model="input.password_confirmation"
          class="form-control"
        />
        <div v-if="errors?.password_confirmation">
          <div v-for="(error, id) in errors.password_confirmation" :key="id">
            <span class="text-danger">{{ error }} </span>
          </div>
        </div>
      </div>
      <button
        type="button"
        @click="submitRessetPassword"
        class="btn btn-primary"
      >
        Submit
      </button>
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

const submitRessetPassword = async () => {
  alertStore.resetState();
  const userStore = useUserStore();
  const res = await AuthRepository.resetPassword(input);

  if (responseIsOK(res)) {
    Object.assign(input, initialState);
  }
};
</script>

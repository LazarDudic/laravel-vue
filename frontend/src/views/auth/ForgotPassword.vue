<template>
  <div class="container">
    <div v-if="success">
      <span class="text-success">{{ success }}</span>
    </div>
    <div v-if="errors?.global">
      <span class="text-danger">{{ errors.global }} </span>
    </div>
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input
          type="email"
          v-model="input.email"
          class="form-control"
          id="exampleInputEmail1"
          aria-describedby="emailHelp"
          placeholder="Enter email"
        />
        <div v-if="errors?.email">
          <div v-for="(error, id) in errors.email" :key="id">
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
import { reactive } from "vue"
import { useUserStore, useAlertsStore } from "@/stores"
import { storeToRefs } from "pinia"
import AuthRepository from "@/repositories/authRepository"
import { responseIsOK } from "@/helpers/helper.js";

const initialState = { email: "" }

const input = reactive({ ...initialState })

const alertStore = useAlertsStore()
const { errors, success } = storeToRefs(alertStore);

const submitRessetPassword = async () => {
  alertStore.resetState()
  const userStore = useUserStore()
  const res = await AuthRepository.forgotPassword(input)

  if (responseIsOK(res)) {
    Object.assign(input, initialState)
  }
};
</script>

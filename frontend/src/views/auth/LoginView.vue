<template>
  <div class="container">
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
      <button type="button" @click="submitLogin" class="btn btn-primary">
        Submit
      </button>
    </form>
  </div>
</template>

<script setup>
import { reactive } from "vue";
import { useUserStore, useAlertsStore } from "@/stores";
import { storeToRefs } from "pinia";

const input = reactive({
  email: "",
  password: "",
});

const alertStore = useAlertsStore();
const { errors } = storeToRefs(alertStore);

const submitLogin = () => {
  alertStore.resetState();
  const userStore = useUserStore();
  userStore.login(input);
};
</script>

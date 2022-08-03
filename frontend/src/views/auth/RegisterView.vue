<template>
  <div class="register container">
    <form>
      <div class="form-group">
        <label>Name</label>
        <input
          type="text"
          v-model="input.name"
          class="form-control"
          placeholder="Enter name"
        />
        <div v-if="errors?.name">
          <div v-for="(error, id) in errors.name" :key="id">
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

      <button type="button" @click="submitRegister" class="btn btn-primary">
        Submit
      </button>
    </form>
  </div>
</template>

<script>
import { reactive } from "vue";
import { useAuthStore, useErrorStore } from "@/stores";
import {storeToRefs} from 'pinia'


export default {
  name: "RegisterView",
  setup() {
    const input = reactive({
      name: "",
      email: "",
      password: "",
    });

    const errorStore = useErrorStore();
    const { errors } = storeToRefs(errorStore);

    function submitRegister() {
      errorStore.$reset();
      const authStore = useAuthStore();
      authStore.register(input);
    }

    return { input, submitRegister, errors };
  },
};
</script>

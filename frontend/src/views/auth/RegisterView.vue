<template>
  <div class="register container">
    <form>
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

      <button type="button" @click="submitRegister" class="btn btn-primary">
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
  first_name: "",
  last_name: "",
  email: "",
  password: "",
});

const alertStore = useAlertsStore();
const { errors } = storeToRefs(alertStore);

const submitRegister = () => {
  alertStore.resetState();
  const userStore = useUserStore();
  userStore.register(input);
};
</script>

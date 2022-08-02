<template>
    <div class="login container">
        <form>     
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" v-model="input.email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
                <div v-if="errors?.email">
                    <div v-for="(error, id) in errors.email" :key="id">
                    <span class="text-danger">{{ error}} </span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" v-model="input.password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
                <div v-if="errors?.password">
                    <div v-for="(error, id) in errors.password" :key="id">
                    <span class="text-danger">{{ error}} </span>
                    </div>
                </div>
            </div>
            <button  type="button" @click="submitLogin()" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import { ref, reactive } from 'vue'
import { useAuthStore } from '@/stores/auth.store'

export default {
    name: 'LoginView',
    setup() {
        const input = reactive({
            email: "",
            password: ""
        })

        const errors = ref([])
    
        function submitLogin() {
            errors.value = []
            const authStore = useAuthStore();
            authStore.login(input)
                .catch(error => {
                    errors.value = error.response.data.errors
                });
        }

        return { input, submitLogin, errors}
    },
}
</script>
<template>
    <div class="login container">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" v-model="input.email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" v-model="input.password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <button type="button" @click="login" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'LoginView',
    data() {
        return {
            input: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        login() {
            axios.post(process.env.VUE_APP_API_URL + "login", this.input)
                .then(response => {
                }).catch(() => {
                });
        }
    }
}


</script>
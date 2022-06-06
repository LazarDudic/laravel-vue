<template>
    <div class="register container">
        <form>
            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="input.name" class="form-control" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label>Email address</label>
                <input type="email" v-model="input.email" class="form-control" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" v-model="input.password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <button type="button" @click="register" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'RegisterView',
    data() {
        return {
            input: {
                name: '',
                email: '',
                password: ''
            }

        }
    },
    methods: {
        register() {
            axios.post(process.env.VUE_APP_API_URL + "register", this.input)
                .then(res => {
                    console.log(res.data)
                }).catch(() => {
                });
        }
    }
}


</script>
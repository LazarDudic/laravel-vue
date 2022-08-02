<template>
    <nav>
        <router-link to="/">Home</router-link> | 
        <span v-if="!authUser.name">
            <router-link  to="/login">Login</router-link> |
            <router-link  to="/register">Register</router-link> 
        </span>
        <span v-if="authUser.name">
            <a> {{ authUser.name }} |</a>
            <a href="#" @click="authStore.logout()"> Logout</a> 
        </span>
    </nav>
    <router-view />
</template>

<script>
import {storeToRefs} from 'pinia'
import { useAuthStore } from '@/stores/auth.store';

export default {
    name: 'App',
    setup() {
        var authStore = useAuthStore();
        const {authUser} = storeToRefs(authStore);
        return {authUser, authStore}
    },
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

nav {
    padding: 30px;
}

nav a {
    font-weight: bold;
    color: #2c3e50;
}

nav a.router-link-exact-active {
    color: #42b983;
}
</style>

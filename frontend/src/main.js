import { createApp } from 'vue'
import App from './App.vue'
import router from './router/index.js'
import axios from "axios"


axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response.status === 422) {
            // global deal with validation errors
            console.log(error.response.data.errors)
        } else if (error.response.status === 401) {
            localStorage.removeItem("authToken");
            router.push({ name: "Login" });
        } else {
            // global deal with other errors
        }
    }
);

axios.interceptors.request.use(function (config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem("authToken")}`,
        "Content-Type": "application/json",
        Accept: "application/json"
    };

    return config;
});
createApp(App).use(router).mount('#app')

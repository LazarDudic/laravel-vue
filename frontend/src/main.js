import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from '@/App.vue'
import router from '@/router/index.js'
import axios from "axios"

// axios.interceptors.response.use(
//     response => response,
//     error => {
//         console.log(error.response.status)

//         if (error.response.status === 422) {
//             // global deal with validation errors
//             console.log(error.response.data.errors)
//         } else if (error.response.status === 401) {
//             router.push({ name: "logut" });
//         } else {
//             // global deal with other errors
//         }
//     }
// );

createApp(App)
    .use(createPinia())
    .use(router)
    .mount('#app')

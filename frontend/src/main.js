import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from '@/App.vue'
import router from '@/router/index.js'
import "@/assets/css/override-bootstrap.min.css"
import "bootstrap"
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css'
import "@/assets/css/style.css"

createApp(App)
    .use(createPinia())
    .use(router)
    .mount('#app')



import { defineStore } from 'pinia';
import router from '@/router/index.js'

export const useErrorStore = defineStore('error', {
    state: () => ({ errors: [],}),
    actions: {
        handleErrors(error) {
            console.log(error.status)
            if (error.status === 400) { // Client Error
                
            } else if (error.status === 422) { // validation errors
                console.log(error.data)

                this.errors = error.data.errors
            } else if (error.status === 401) { // Unauthorized
                router.push({ name: "login" });
            } else if (error.status === 404) { // not found
                router.push({ name: "404" });
            }  else {
                // global deal with other errors
            }
            // throw error
            Promise.resolve(error)
        }
    }
});
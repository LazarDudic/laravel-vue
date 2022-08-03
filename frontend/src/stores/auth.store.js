import { defineStore } from 'pinia';
import router from '@/router/index.js'
import AuthRepository from '@/repository/authRepository';

export const useAuthStore = defineStore('auth', {
    state: () => ({ authUser: JSON.parse(localStorage.getItem('auth_user') || JSON.stringify([])) }),
    actions: {
        async login(inputData) {
            const res = await AuthRepository.login(inputData)
            if (res && res.status === 200) {
                this.setAuthUser(res.data)
                router.push({name: 'home'});
            }
        },
        async register(inputData) {
            const res = await AuthRepository.register(inputData)
            if (res && res.status === 200) {
                this.setAuthUser(res.data)
                router.push({name: 'home'});
            }
        },
        async logout() {
            this.authUser = [];
            var res = await AuthRepository.logout()
            localStorage.removeItem('auth_user');
            localStorage.removeItem('auth_token');
            router.push({name: 'login'});
        },
        setAuthUser(data) {
            this.authUser = data.user;
            localStorage.setItem('auth_user', JSON.stringify(data.user));
            localStorage.setItem('auth_token', data.auth_token);
        }
    }
});
import { ref } from 'vue'
import { defineStore } from 'pinia'
import router from '@/router/index.js'
import AuthRepository from '@/repositories/authRepository'
import { responseIsOK } from '@/helpers/helper.js'

export const useUserStore = defineStore('auth', () => {
  var user = [];
  if(typeof localStorage.getItem('auth_user') !== 'undefined') {
    user = JSON.parse(localStorage.getItem('auth_user'))
  } 

  const authUser = ref(user)

  async function getAuthUser() {
    authUser.value = await AuthRepository.get()
  }
  
  function isAuth() {
    return Boolean(authUser.value?.id)
  }
  async function login(inputData) {
    const res = await AuthRepository.login(inputData)
    if (responseIsOK(res)) {
      setAuthUser(res.data)
      router.push({ name: 'admin-dashboard' })
    }
  }
  async function register(inputData) {
    const res = await AuthRepository.register(inputData)
    if (responseIsOK(res)) {
      setAuthUser(res.data)
      router.push({ name: 'admin-dashboard' })
    }
  }
  async function logout() {
    authUser.value = []
    var res = await AuthRepository.logout()
    localStorage.removeItem('auth_token')
    localStorage.removeItem('auth_user')
    router.push({ name: 'login' })
  }
  function setAuthUser(data) {
    authUser.value = data.user
    localStorage.setItem('auth_token', data.auth_token)
    localStorage.setItem('auth_user', JSON.stringify(data.user))
  }

  return { authUser, isAuth, login, register, logout }
})


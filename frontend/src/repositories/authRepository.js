import Client from '@/helpers/Client.js'

export default {
  async get() {
    return await Client.get(`/auth-user`).then((r) => r.data.data)
  },
  login(payload) {
    return Client.post(`/login`, payload)
  },
  register(payload) {
    return Client.post(`/register`, payload)
  },
  logout() {
    return Client.post(`/logout`)
  },
  forgotPassword(payload) {
    return Client.post(`/forgot-password`, payload)
  },
  resetPassword(payload) {
    return Client.post(`/reset-password`, payload)
  }
}

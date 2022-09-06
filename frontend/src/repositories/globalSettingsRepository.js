import Client from '@/helpers/Client.js'

const resource = '/settings'
export default {
  async get() {
    return await Client.get(`${resource}/get`).then((r) => r.data.data)
  },
  update(payload) {
    return Client.post(`${resource}/update`, payload)
  }
}

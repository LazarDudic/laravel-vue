import Client from '@/helpers/Client.js'

const resource = '/global-settings'
export default {
  async findById(settingsId) {
    return await Client.get(`${resource}/${settingsId}`).then((r) => r.data.data)
  },
  async all() {
    return await Client.get(`${resource}/list`).then((r) => r.data.data)
  },
  update(settingsId, payload) {
    return Client.post(`${resource}/update/${settingsId}`, payload)
  }
}

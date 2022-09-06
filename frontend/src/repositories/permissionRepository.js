import Client from '@/helpers/Client.js'

const resource = '/permissions'
export default {
  async all() {
    return await Client.get(`${resource}/list`).then((r) => r.data.data)
  },
  async findById(permissionId) {
    return await Client.get(`${resource}/${permissionId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, permissionId) {
    return Client.post(`${resource}/update/${permissionId}`, payload)
  },
  delete(permissionId) {
    return Client.post(`${resource}/delete/${permissionId}`)
  }
}

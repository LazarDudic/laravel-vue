import Client from '@/helpers/Client.js'

const resource = '/roles'
export default {
  async all() {
    return await Client.get(`${resource}/list`).then((r) => r.data.data)
  },
  async findById(roleId) {
    return await Client.get(`${resource}/${roleId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, roleId) {
    return Client.post(`${resource}/update/${roleId}`, payload)
  },
  delete(roleId) {
    return Client.post(`${resource}/delete/${roleId}`)
  }
}

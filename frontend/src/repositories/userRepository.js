import Client from '@/helpers/Client.js'

const resource = '/users'
export default {
  async findById(userId) {
    return await Client.get(`${resource}/${userId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, userId) {
    return Client.post(`${resource}/update/${userId}`, payload)
  },
  delete(userId) {
    return Client.post(`${resource}/delete/${userId}`)
  }
}

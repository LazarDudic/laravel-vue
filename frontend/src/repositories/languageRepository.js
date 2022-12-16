import Client from '@/helpers/Client.js'

const resource = '/languages'
export default {
  async findById(languageId) {
    return await Client.get(`${resource}/${languageId}`).then((r) => r.data.data)
  },
  async all() {
    return await Client.get(`${resource}/list`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, languageId) {
    return Client.post(`${resource}/update/${languageId}`, payload)
  },
  delete(languageId) {
    return Client.post(`${resource}/delete/${languageId}`)
  }
}

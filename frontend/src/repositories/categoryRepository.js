import Client from '@/helpers/Client.js'

const resource = '/categories'
export default {
  async all(languageId = '') {
    return await Client.get(`${resource}/list/${languageId}`).then((r) => r.data.data)
  },
  async getByType(type, languageId = '') {
    return await Client.get(`${resource}/type/${type}/lang/${languageId}`).then((r) => r.data.data)
  },
  async allByLanguageIdAndType(languageId, type, id=null) {
    return await Client.get(`${resource}/lang/${languageId}/type/${type}/id/${id}`).then((r) => r.data.data)
  },
  async findById(categoryId) {
    return await Client.get(`${resource}/${categoryId}`).then((r) => r.data.data)
  },
  async getChildren(categoryId) {
    return await Client.get(`${resource}/getChildren/${categoryId}`).then((r) => r.data.data)
  },
  async findByGroupIdAndLanguageId(langGroupId, languageId) {
    return await Client.get(`${resource}/${langGroupId}/${languageId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, categoryId) {
    return Client.post(`${resource}/update/${categoryId}`, payload)
  },
  delete(categoryId) {
    return Client.post(`${resource}/delete/${categoryId}`)
  }
}

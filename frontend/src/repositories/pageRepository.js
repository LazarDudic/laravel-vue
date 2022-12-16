import Client from '@/helpers/Client.js'

const resource = '/pages'
export default {
  async all(languageId = '') {
    return await Client.get(`${resource}/list/${languageId}`).then((r) => r.data.data)
  },
  async findById(pageId) {
    return await Client.get(`${resource}/${pageId}`).then((r) => r.data.data)
  },
  async findByGroupIdAndLanguageId(langGroupId, languageId) {
    return await Client.get(`${resource}/${langGroupId}/${languageId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, pageId) {
    return Client.post(`${resource}/update/${pageId}`, payload)
  },
  delete(pageId) {
    return Client.post(`${resource}/delete/${pageId}`)
  }
}

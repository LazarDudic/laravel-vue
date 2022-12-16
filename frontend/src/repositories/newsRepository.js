import Client from '@/helpers/Client.js'

const resource = '/news'
export default {
  async all(languageId = '') {
    return await Client.get(`${resource}/list/${languageId}`).then((r) => r.data.data)
  },
  async findById(newsId) {
    return await Client.get(`${resource}/${newsId}`).then((r) => r.data.data)
  },
  async findByGroupIdAndLanguageId(langGroupId, languageId) {
    return await Client.get(`${resource}/${langGroupId}/${languageId}`).then((r) => r.data.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(payload, newsId) {
    return Client.post(`${resource}/update/${newsId}`, payload)
  },
  delete(newsId) {
    return Client.post(`${resource}/delete/${newsId}`)
  }
}

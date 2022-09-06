import Client from '@/helpers/Client.js'

const resource = '/files'
export default {
  async findById(fileId) {
    return await Client.get(`${resource}/${fileId}`).then((r) => r.data.data)
  },
  async get(filters) {
    const { page , order, search} = filters
    return await Client.get(`${resource}/list?page=${page}&sort=${order}&search=${search}`)
        .then((r) => r.data)
  },
  store(payload) {
    return Client.post(`${resource}/store`, payload)
  },
  update(fileId, payload) {
    return Client.post(`${resource}/update/${fileId}`, payload)
  },
  delete(fileId) {
    return Client.post(`${resource}/delete/${fileId}`)
  }
}

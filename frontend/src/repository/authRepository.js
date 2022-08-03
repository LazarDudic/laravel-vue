import Client from "@/helpers/Client.js";

export default {
  login(payload) {
    return Client.post(`/login`, payload);
  },
  register(payload) {
    return Client.post(`/register`, payload);
  },
  logout() {
    return Client.post(`/logout`);
  }
};
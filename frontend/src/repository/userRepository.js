import Client from "@/helpers/Client.js";

const resource = "/users";
export default {
  findById(userId) {
    return Client.get(`${resource}/${userId}`);
  },
  all() {
    return Client.get(`${resource}`);
  }
};
import axios from "axios";

const baseURL = process.env.VUE_APP_API_URL

axios.interceptors.request.use(function (config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    return config;
});

export default axios.create({baseURL});

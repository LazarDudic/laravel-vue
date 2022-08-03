import axios from "axios";
import {errorHandler} from '@/helpers/helper.js'
import { useErrorStore } from '@/stores'

const baseURL = process.env.VUE_APP_API_URL
const Client = axios.create({baseURL})

Client.interceptors.response.use(
    response => response,
    error => {
        const errorStore = useErrorStore()
        errorStore.handleErrors(error.response)
    }
);

Client.interceptors.request.use(function (config) {
    config.headers.common = {
        Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
        "Content-Type": "application/json",
        Accept: "application/json"
    };
    return config;
});

export default Client;

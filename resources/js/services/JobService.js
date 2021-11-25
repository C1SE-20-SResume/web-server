import axios from "axios";
import store from "../store";

export const authClient = axios.create({
    baseURL: process.env.API_URL,
    withCredentials: true, // required to handle the CSRF token
});

authClient.interceptors.request.use((request) => {
    const token = store.getters["auth/token"];
    if (token) {
        request.headers.common.Authorization = `Bearer ${token}`;
    }

    const locale = store.getters["lang/locale"];
    if (locale) {
        request.headers.common["Accept-Language"] = locale;
    }

    // request.headers['X-Socket-Id'] = Echo.socketId()
    return request;
});

authClient.interceptors.response.use(
    (response) => {
        return response;
    },
    function (error) {
        if (
            error.response &&
            [401, 419].includes(error.response.status) &&
            store.getters["auth/authUser"] &&
            !store.getters["auth/guest"]
        ) {
            store.dispatch("auth/logout");
        }
        return Promise.reject(error);
    }
);

export default {
    async getAllJob() {
        return authClient.get("/api/admin/listJob");
    },
    async getAllAppliedJob() {
        return authClient.get("/api/admin/job_applies");
    },
    async getJob(id) {
        return authClient.get(`/api/admin/job/${id}`);
    },
    async getListCompany() {
        return authClient.get("/api/admin/listCompany");
    },
    async getListQuestion() {
        return authClient.get("/api/admin/listQuestion");
    },
    async scanCV(payload) {
        return authClient.post("/api/admin/scan", payload);
    },
};

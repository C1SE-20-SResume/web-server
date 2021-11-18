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

/*
 * Add a response interceptor
 */
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
    async login(email, password) {
        const response = await authClient.post("/api/login", {
            email,
            password,
        });
        return response;
    },
    getAuthUser() {
        return authClient.get("/api/user");
    },
    async logout() {
        const response = await authClient.post("/api/logout");
        return response;
    },
};

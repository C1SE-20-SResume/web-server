import Cookies from "js-cookie";
import { AuthService } from "../../services";
import * as types from "../mutation-types";

export const namespaced = true;

// State
export const state = {
    user: null,
    token: Cookies.get("token"),
};

export const mutations = {
    [types.SAVE_TOKEN](state, { token, remember }) {
        state.token = token;
        Cookies.set("token", token, { expires: remember ? 365 : null });
    },
    [types.FETCH_USER_SUCCESS](state, { user }) {
        state.user = user;
    },

    [types.FETCH_USER_FAILURE](state) {
        state.token = null;
        Cookies.remove("token");
    },

    [types.LOGOUT](state) {
        state.user = null;
        state.token = null;

        Cookies.remove("token");
    },

    [types.UPDATE_USER](state, { user }) {
        state.user = user;
    },
};

export const actions = {
    saveToken({ commit, dispatch }, payload) {
        commit(types.SAVE_TOKEN, payload);
    },
    async getAuthUser({ commit }) {
        try {
            const response = await AuthService.getAuthUser();
            commit(types.FETCH_USER_SUCCESS, response);
            return response;
        } catch (error) {
            commit(types.FETCH_USER_FAILURE);
        }
    },
    setGuest(context, { value }) {
        window.localStorage.setItem("guest", value);
    },
    async logout({ commit }) {
        await AuthService.logout();
        commit(types.LOGOUT);
    },
};

export const getters = {
    token: (state) => state.token,
    check: (state) => state.user !== null,
    authUser: (state) => {
        return state.user;
    },
    error: (state) => {
        return state.error;
    },
    loading: (state) => {
        return state.loading;
    },
    loggedIn: (state) => {
        return !!state.user;
    },
};

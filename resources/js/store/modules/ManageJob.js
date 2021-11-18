import * as types from "../mutation-types";
import { JobService } from "../../services";

export const namespaced = true;

// State
export const state = {
    data: null,
};

export const mutations = {
    [types.DATA_ALL_JOB](state, data) {
        state.data = data;
    },
};

export const actions = {
    async getAllJob({ commit }) {
        try {
            const response = await JobService.getAllJob();
            commit(types.DATA_ALL_JOB, response);
        } catch (error) {
            console.log(error);
        }
    },
};

export const getters = {
    data: (state) => state.data,
};

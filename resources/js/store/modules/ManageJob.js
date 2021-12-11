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
            // commit(types.DATA_ALL_JOB, response.data);
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
    async getAppliedJobs({ commit }) {
        try {
            const response = await JobService.getAllAppliedJob();
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
    async getJobById({ commit }, id) {
        try {
            const response = await JobService.getJob(id);
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
    async getListCompany({ commit }) {
        try {
            const response = await JobService.getListCompany();
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
    async getListQuestion({ commit }) {
        try {
            const response = await JobService.getListQuestion();
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
    async scanCV({ commit }, payload) {
        try {
            const response = await JobService.scanCV(payload);
            return response;
        } catch (error) {
            console.log(error);
        }
    },
    async getListUser({ commit }) {
        try {
            const response = await JobService.getListUser();
            return response.data;
        } catch (error) {
            console.log(error);
        }
    },
};

export const getters = {
    data: (state) => state.data,
};

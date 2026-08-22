import axios from "axios";
const state = () => ({
    infosSportsStatus: null,
    infosSportsMessage: null,
    infosSportsData: [],

    infosCanStatus: null,
    infosCanMessage: null,
    infosCanData: [],

    infosTogoStatus: null,
    infosTogoMessage: null,
    infosTogoData: [],
});
const getters = {

    getInfosSportsStatus(state) {
        return state.infosSportsStatus;
    },

    getInfosSportsMessage(state) {
        return state.infosSportsMessage;
    },

    getInfosSportsData(state) {
        return state.infosSportsData;
    },

    getInfosTogoStatus(state) {
        return state.infosTogoStatus;
    },

    getInfosTogoMessage(state) {
        return state.infosTogoMessage;
    },

    getInfosTogoData(state) {
        return state.infosTogoData;
    },

    getInfosCanStatus(state) {
        return state.infosCanStatus;
    },

    getInfosCanMessage(state) {
        return state.infosCanMessage;
    },

    getInfosCanData(state) {
        return state.infosCanData;
    },
}

const actions = {
    async sportsDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/sports");

            commit("setInfosSportsStatus", "success");
            commit("setInfosSportsMessage", response.data.message);
            commit("setInfosSportsData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosSportsStatus", "error");
                commit("setInfosSportsMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosSportsStatus", "error");
                commit("setInfosSportsMessage", "Erreur réseau");
            }
        }
    },

    async canDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/can");

            commit("setInfosCanStatus", "success");
            commit("setInfosCanMessage", response.data.message);
            commit("setInfosCanData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosCanStatus", "error");
                commit("setInfosCanMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosCanStatus", "error");
                commit("setInfosCanMessage", "Erreur réseau");
            }
        }
    },

    async togoDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/togo");

            commit("setInfosTogoStatus", "success");
            commit("setInfosTogoMessage", response.data.message);
            commit("setInfosTogoData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosTogoStatus", "error");
                commit("setInfosTogoMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosTogoStatus", "error");
                commit("setInfosTogoMessage", "Erreur réseau");
            }
        }
    },

}

const mutations = {
    setInfosSportsStatus(state, value) {
        state.infosSportsStatus = value;
    },

    setInfosSportsMessage(state, value) {
        state.infosSportsMessage = value;
    },

    setInfosSportsData(state, value) {
        state.infosSportsData = value;
    },

    setInfosTogoStatus(state, value) {
        state.infosTogoStatus = value;
    },

    setInfosTogoMessage(state, value) {
        state.infosTogoMessage = value;
    },

    setInfosTogoData(state, value) {
        state.infosTogoData = value;
    },

    setInfosCanStatus(state, value) {
        state.infosCanStatus = value;
    },

    setInfosCanMessage(state, value) {
        state.infosCanMessage = value;
    },

    setInfosCanData(state, value) {
        state.infosCanData = value;
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

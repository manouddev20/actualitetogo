import axios from "axios";
const state = () => ({
    infosTogoactauliteStatus: null,
    infosTogoactauliteMessage: null,
    infosTogoactauliteData: [],
});
const getters = {

    getInfosTogoactauliteStatus(state) {
        return state.infosTogoactauliteStatus;
    },

    getInfosTogoactauliteMessage(state) {
        return state.infosTogoactauliteMessage;
    },

    getInfosTogoactauliteData(state) {
        return state.infosTogoactauliteData;
    },

}

const actions = {
    async togoactualiteDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/togoactualite");

            commit("setInfosTogoactauliteStatus", "success");
            commit("setInfosTogoactauliteMessage", response.data.message);
            commit("setInfosTogoactauliteData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosTogoactauliteStatus", "error");
                commit("setInfosTogoactauliteMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosTogoactauliteStatus", "error");
                commit("setInfosTogoactauliteMessage", "Erreur réseau");
            }
        }
    },

}

const mutations = {
    setInfosTogoactauliteStatus(state, value) {
        state.infosTogoactauliteStatus = value;
    },

    setInfosTogoactauliteMessage(state, value) {
        state.infosTogoactauliteMessage = value;
    },

    setInfosTogoactauliteData(state, value) {
        state.infosTogoactauliteData = value;
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

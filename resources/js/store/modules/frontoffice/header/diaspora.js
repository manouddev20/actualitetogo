import axios from "axios";
const state = () => ({
    infosDiasporaStatus: null,
    infosDiasporaMessage: null,
    infosDiasporaData: [],

    infosFenetreSurLAfriqueStatus: null,
    infosFenetreSurLAfriqueMessage: null,
    infosFenetreSurLAfriqueData: [],
});
const getters = {

    getInfosDiasporaStatus(state) {
        return state.infosDiasporaStatus;
    },

    getInfosDiasporaMessage(state) {
        return state.infosDiasporaMessage;
    },

    getInfosDiasporaData(state) {
        return state.infosDiasporaData;
    },

    getInfosFenetreSurLAfriqueStatus(state) {
        return state.infosFenetreSurLAfriqueStatus;
    },

    getInfosFenetreSurLAfriqueMessage(state) {
        return state.infosFenetreSurLAfriqueMessage;
    },

    getInfosFenetreSurLAfriqueData(state) {
        return state.infosFenetreSurLAfriqueData;
    },

}

const actions = {
    async diasporaDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/diaspora");

            commit("setInfosDiasporaStatus", "success");
            commit("setInfosDiasporaMessage", response.data.message);
            commit("setInfosDiasporaData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosDiasporaStatus", "error");
                commit("setInfosDiasporaMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosDiasporaStatus", "error");
                commit("setInfosDiasporaMessage", "Erreur réseau");
            }
        }
    },

    async fenetreSurLAfriqueDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/fenetreSurLAfrique");

            commit("setInfosFenetreSurLAfriqueStatus", "success");
            commit("setInfosFenetreSurLAfriqueMessage", response.data.message);
            commit("setInfosFenetreSurLAfriqueData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosFenetreSurLAfriqueStatus", "error");
                commit("setInfosFenetreSurLAfriqueMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosFenetreSurLAfriqueStatus", "error");
                commit("setInfosFenetreSurLAfriqueMessage", "Erreur réseau");
            }
        }
    },

}

const mutations = {
    setInfosDiasporaStatus(state, value) {
        state.infosDiasporaStatus = value;
    },

    setInfosDiasporaMessage(state, value) {
        state.infosDiasporaMessage = value;
    },

    setInfosDiasporaData(state, value) {
        state.infosDiasporaData = value;
    },

    setInfosFenetreSurLAfriqueStatus(state, value) {
        state.infosFenetreSurLAfriqueStatus = value;
    },

    setInfosFenetreSurLAfriqueMessage(state, value) {
        state.infosFenetreSurLAfriqueMessage = value;
    },

    setInfosFenetreSurLAfriqueData(state, value) {
        state.infosFenetreSurLAfriqueData = value;
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

import axios from "axios";
const state = () => ({
    infosRubriquesStatus: null,
    infosRubriquesMessage: null,
    infosRubriquesData: [],

    infosChroniquesStatus: null,
    infosChroniquesMessage: null,
    infosChroniquesData: [],

    infosDiplomatieStatus: null,
    infosDiplomatieMessage: null,
    infosDiplomatieData: [],
});
const getters = {

    getInfosRubriquesStatus(state) {
        return state.infosRubriquesStatus;
    },

    getInfosRubriquesMessage(state) {
        return state.infosRubriquesMessage;
    },

    getInfosRubriquesData(state) {
        return state.infosRubriquesData;
    },

    getInfosChroniquesStatus(state) {
        return state.infosChroniquesStatus;
    },

    getInfosChroniquesMessage(state) {
        return state.infosChroniquesMessage;
    },

    getInfosChroniquesData(state) {
        return state.infosChroniquesData;
    },

    getInfosDiplomatieStatus(state) {
        return state.infosDiplomatieStatus;
    },

    getInfosDiplomatieMessage(state) {
        return state.infosDiplomatieMessage;
    },

    getInfosDiplomatieData(state) {
        return state.infosDiplomatieData;
    },

}

const actions = {
    async rubriquesDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/rubriques");

            commit("setInfosRubriquesStatus", "success");
            commit("setInfosRubriquesMessage", response.data.message);
            commit("setInfosRubriquesData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosRubriquesStatus", "error");
                commit("setInfosRubriquesMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosRubriquesStatus", "error");
                commit("setInfosRubriquesMessage", "Erreur réseau");
            }
        }
    },

    async diplomatieDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/diplomatie");

            commit("setInfosDiplomatieStatus", "success");
            commit("setInfosDiplomatieMessage", response.data.message);
            commit("setInfosDiplomatieData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosDiplomatieStatus", "error");
                commit("setInfosDiplomatieMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosDiplomatieStatus", "error");
                commit("setInfosDiplomatieMessage", "Erreur réseau");
            }
        }
    },

    async chroniquesDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/chroniques");

            commit("setInfosChroniquesStatus", "success");
            commit("setInfosChroniquesMessage", response.data.message);
            commit("setInfosChroniquesData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosChroniquesStatus", "error");
                commit("setInfosChroniquesMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosChroniquesStatus", "error");
                commit("setInfosChroniquesMessage", "Erreur réseau");
            }
        }
    },

}

const mutations = {
    setInfosRubriquesStatus(state, value) {
        state.infosRubriquesStatus = value;
    },

    setInfosRubriquesMessage(state, value) {
        state.infosRubriquesMessage = value;
    },

    setInfosRubriquesData(state, value) {
        state.infosRubriquesData = value;
    },

    setInfosDiplomatieStatus(state, value) {
        state.infosDiplomatieStatus = value;
    },

    setInfosDiplomatieMessage(state, value) {
        state.infosDiplomatieMessage = value;
    },

    setInfosDiplomatieData(state, value) {
        state.infosDiplomatieData = value;
    },

    setInfosChroniquesStatus(state, value) {
        state.infosChroniquesStatus = value;
    },

    setInfosChroniquesMessage(state, value) {
        state.infosChroniquesMessage = value;
    },

    setInfosChroniquesData(state, value) {
        state.infosChroniquesData = value;
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

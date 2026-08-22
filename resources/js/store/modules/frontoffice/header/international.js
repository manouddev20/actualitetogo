import axios from "axios";
const state = () => ({
    infosInternationalStatus: null,
    infosInternationalMessage: null,
    infosInternationalData: [],

    infosMondeStatus: null,
    infosMondeMessage: null,
    infosMondeData: [],

    infosAfriqueStatus: null,
    infosAfriqueMessage: null,
    infosAfriqueData: [],
});
const getters = {

    getInfosInternationalStatus(state) {
        return state.infosInternationalStatus;
    },

    getInfosInternationalMessage(state) {
        return state.infosInternationalMessage;
    },

    getInfosInternationalData(state) {
        return state.infosInternationalData;
    },

    getInfosMondeStatus(state) {
        return state.infosMondeStatus;
    },

    getInfosMondeMessage(state) {
        return state.infosMondeMessage;
    },

    getInfosMondeData(state) {
        return state.infosMondeData;
    },

    getInfosAfriqueStatus(state) {
        return state.infosAfriqueStatus;
    },

    getInfosAfriqueMessage(state) {
        return state.infosAfriqueMessage;
    },

    getInfosAfriqueData(state) {
        return state.infosAfriqueData;
    },

}

const actions = {
    async internationalDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/international");

            commit("setInfosInternationalStatus", "success");
            commit("setInfosInternationalMessage", response.data.message);
            commit("setInfosInternationalData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosInternationalStatus", "error");
                commit("setInfosInternationalMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosInternationalStatus", "error");
                commit("setInfosInternationalMessage", "Erreur réseau");
            }
        }
    },

    async mondeDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/monde");

            commit("setInfosMondeStatus", "success");
            commit("setInfosMondeMessage", response.data.message);
            commit("setInfosMondeData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosMondeStatus", "error");
                commit("setInfosMondeMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosMondeStatus", "error");
                commit("setInfosMondeMessage", "Erreur réseau");
            }
        }
    },

    async afriqueDataRequest({ commit }) {
        try {
            const response = await axios.get("/api/frontoffice/header/afrique");

            commit("setInfosAfriqueStatus", "success");
            commit("setInfosAfriqueMessage", response.data.message);
            commit("setInfosAfriqueData", response.data.data);

        } catch (error) {
            if (error.response) {
                // erreur API (404, 422, 500...)
                commit("setInfosAfriqueStatus", "error");
                commit("setInfosAfriqueMessage", error.response.data.message);
            } else {
                // erreur réseau
                commit("setInfosAfriqueStatus", "error");
                commit("setInfosAfriqueMessage", "Erreur réseau");
            }
        }
    },

}

const mutations = {
    setInfosInternationalStatus(state, value) {
        state.infosInternationalStatus = value;
    },

    setInfosInternationalMessage(state, value) {
        state.infosInternationalMessage = value;
    },

    setInfosInternationalData(state, value) {
        state.infosInternationalData = value;
    },

    setInfosMondeStatus(state, value) {
        state.infosMondeStatus = value;
    },

    setInfosMondeMessage(state, value) {
        state.infosMondeMessage = value;
    },

    setInfosMondeData(state, value) {
        state.infosMondeData = value;
    },

    setInfosAfriqueStatus(state, value) {
        state.infosAfriqueStatus = value;
    },

    setInfosAfriqueMessage(state, value) {
        state.infosAfriqueMessage = value;
    },

    setInfosAfriqueData(state, value) {
        state.infosAfriqueData = value;
    },

}

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}

<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';

const store = useStore();
const loading = ref(true);
const sportsData = ref({});
const sportsMessage = ref(null);
const sportsState = ref(true);
const canState = ref(false);
const togoState = ref(false);
const empty = ref(2);

const getResults = async () => {
    await store.dispatch('sports/sportsDataRequest', {});

    const status = store.getters['sports/getInfosSportsStatus'];
    const message = store.getters['sports/getInfosSportsMessage'];
    const data = store.getters['sports/getInfosSportsData'];

    if (status === 'success') {
        sportsData.value = data;
        empty.value = 0;
    } else {
        sportsMessage.value = message;
        empty.value = status === 'empty' ? 1 : 3;
    }
    loading.value = false;
};

const sports = () => {
    canState.value = false
    togoState.value = false
    sportsState.value = true
    getResults();
}
const can = async () => {
    canState.value = true
    togoState.value = false
    sportsState.value = false
    await store.dispatch('sports/canDataRequest', {});

    const status = store.getters['sports/getInfosCanStatus'];
    const message = store.getters['sports/getInfosCanMessage'];
    const data = store.getters['sports/getInfosCanData'];

    if (status === 'success') {
        sportsData.value = data;
        empty.value = 0;
    } else {
        sportsMessage.value = message;
        empty.value = status === 'empty' ? 1 : 3;
    }
};

const togo = async () => {
    canState.value = false
    togoState.value = true
    sportsState.value = false
    await store.dispatch('sports/togoDataRequest', {});

    const status = store.getters['sports/getInfosTogoStatus'];
    const message = store.getters['sports/getInfosTogoMessage'];
    const data = store.getters['sports/getInfosTogoData'];

    if (status === 'success') {
        sportsData.value = data;
        empty.value = 0;
    } else {
        sportsMessage.value = message;
        empty.value = status === 'empty' ? 1 : 3;
    }
};

const author = (slug) => {
    window.location = `/authors/${slug}`;
};

const article = (slug) => {
    window.location = `/${slug}`;
};

const getImage = (slug) => slug;

onMounted(() => {
    getResults();
});
</script>

<template>
    <div class="container">
        <div v-if="loading">
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div v-else class="row g-4 p-3 flex-fill">
            <div v-if="empty === 1">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div style="position: relative; height: 250px;">
                            <img :src="`/assets/images/empty.png`"
                                style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                                alt="empty">
                        </div>
                        <h5 style="text-align: center; margin-top: -50px"> {{ sportsMessage }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div v-if="empty === 3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div style="position: relative; height: 250px;">
                            <img :src="`/assets/images/error.png`"
                                style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"
                                alt="empty">
                        </div>
                        <h5 style="text-align: center; margin-top: -50px"> {{ sportsMessage }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div v-else-if="empty === 0" v-for="result in sportsData" :key="result.id" class="col-sm-6 col-lg-3">
                <div class="card bg-transparent" v-if="result.cover_media_file.file_url">
                    <img class="card-img rounded img-header" :src="getImage(result.cover_media_file.file_url)"
                        :alt="result.title" />
                    <div class="card-body px-0 pt-3">
                        <h6 class="card-title mb-0">
                            <span @click="article(result.slug)" class="btn-link text-reset fw-bold"
                                style="cursor: pointer" v-html="result.title"></span>
                        </h6>
                        <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                            <li class="nav-item">
                                <span @click="author(result.author.slug)" class="text-reset btn-link"
                                    style="cursor: pointer">{{ result.author.name }}</span>
                            </li>
                            <li class="nav-item">{{ moment(result.date_publish).format('DD/MM/YYYY') }}</li>
                        </ul>
                    </div>
                </div>
                <div v-else>
                    <div class="card mb-4">
                        <div class="card-body border rounded-3">

                            <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer"
                                    class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                            <p class="card-text" v-html="truncate_content"> </p>
                            <!-- Card info -->
                            <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                <li class="nav-item">
                                    <span @click="author(result.author.slug)" style="cursor: pointer"
                                        class="text-reset btn-link">{{ result.author.name }}</span>
                                </li>
                                <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Trending tags -->
            <div class="row px-3">
                <div class="col-12">
                    <ul class="list-inline mt-3">
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="sportsState" @click="sports"
                                class="btn btn-sm btn-success">Sports</span>
                            <span style="cursor: pointer" v-else @click="sports"
                                class="btn btn-sm btn-primary-soft">Sports</span>
                        </li>
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="canState" @click="can"
                                class="btn btn-sm btn-success">CAN</span>
                            <span style="cursor: pointer" v-else @click="can"
                                class="btn btn-sm btn-primary-soft">CAN</span>
                        </li>
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="togoState" @click="togo"
                                class="btn btn-sm btn-success">Togo</span>
                            <span style="cursor: pointer" v-else @click="togo"
                                class="btn btn-sm btn-primary-soft">Togo</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';

const store = useStore();
const loading = ref(true);
const publicationsPopularsData = ref({});
const publicationsPopularsMessage = ref(null);
const empty = ref(2);

const getResults = async () => {
  loading.value = true;
  await store.dispatch('articlesPopulars/articlesPopularsDataRequest', {});

  const status = store.getters['articlesPopulars/getInfosArticlesPopularsStatus'];
  const message = store.getters['articlesPopulars/getInfosArticlesPopularsMessage'];
  const data = store.getters['articlesPopulars/getInfosArticlesPopularsData'];

  if (status === 'success') {
    publicationsPopularsData.value = data;
    empty.value = 0;
  } else {
    publicationsPopularsMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
  loading.value = false;
};

const article = (slug) => {
  window.location = `/${slug}`;
};


const category = (slug) => {
  window.location = `/${slug}`;
};

const author = (slug) => {
  window.location = `/authors/${slug}`;
};


const getImage = (slug) => slug;

onMounted(() => {
  getResults();
});
</script>
<template>
  <div class="d-flex justify-content-center" v-if="loading">
    <div class="spinner-border text-light" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div v-else class="mb-4 position-relative"  v-for="info in publicationsPopularsData" :key="info.id">
    <div>
      <div class="row g-3">
        <div class="col-4">
          <img class="rounded" style="max-width: 100%; height: 100px" :src="getImage(info.cover_media_file.file_url)" :alt="info.title">
        </div>
        <div class="col-8">
          <div><span @click="category(info.categories.slug)" style="cursor: pointer" class="badge text-bg-danger mb-2"><i
                class="fas fa-circle me-2 small fw-bold"></i> {{ info.categories.name }} </span></div>
          <span @click="article(info.slug)" style="cursor: pointer" class="btn-link text-white "
            v-html="info.title"></span>
          <ul class="nav nav-divider align-items-center small mt-2 text-muted">
            <li class="nav-item position-relative">
              <div class="nav-link">par <span @click="author(info.author.slug)" style="cursor: pointer"
                  class="stretched-link text-reset btn-link"> {{ info.author.name }} </span>
              </div>
            </li>
            <li class="nav-item">{{ moment(info.date_publish).format("DD/MM/YYYY") }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Item -->

</template>

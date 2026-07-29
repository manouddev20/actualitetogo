<script setup>
import { ref, onMounted } from 'vue';
import moment from 'moment';
import { useStore } from 'vuex';

const store = useStore();
const loading = ref(true);
const rubriquesData = ref({});
const rubriquesMessage = ref(null);
const rubriquesState = ref(true);
const diplomatieState = ref(false);
const chroniquesState = ref(false);
const empty = ref(2);

const getResults = async () => { 
  await store.dispatch('rubriques/rubriquesDataRequest', {});

  const status = store.getters['rubriques/getInfosRubriquesStatus'];
  const message = store.getters['rubriques/getInfosRubriquesMessage'];
  const data = store.getters['rubriques/getInfosRubriquesData'];

  if (status === 'success') {
    rubriquesData.value = data;
    empty.value = 0;
  } else {
    rubriquesMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
  loading.value = false;
};

const rubriques = () => {
  diplomatieState.value= false
  chroniquesState.value= false
  rubriquesState.value= true
  getResults();
}
const diplomatie = async () => {
  diplomatieState.value= true
  chroniquesState.value= false
  rubriquesState.value= false
  await store.dispatch('rubriques/diplomatieDataRequest', {});

  const status = store.getters['rubriques/getInfosDiplomatieStatus'];
  const message = store.getters['rubriques/getInfosDiplomatieMessage'];
  const data = store.getters['rubriques/getInfosDiplomatieData'];

  if (status === 'success') {
    rubriquesData.value = data;
    empty.value = 0;
  } else {
    rubriquesMessage.value = message;
    empty.value = status === 'empty' ? 1 : 3;
  }
};

const chroniques = async () => {
  diplomatieState.value= false
  chroniquesState.value= true
  rubriquesState.value= false
  await store.dispatch('rubriques/chroniquesDataRequest', {});

  const status = store.getters['rubriques/getInfosChroniquesStatus'];
  const message = store.getters['rubriques/getInfosChroniquesMessage'];
  const data = store.getters['rubriques/getInfosChroniquesData'];

  if (status === 'success') {
    rubriquesData.value = data;
    empty.value = 0;
  } else {
    rubriquesMessage.value = message;
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
            <br><br><br>
            <div class="d-flex justify-content-center mt-3">
                <div class="spinner-border text-success" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <br><br><br>
        </div>
        <div v-else class="row g-4 p-3 flex-fill">

            <div  v-if="empty === 1">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img :src="`/assets/images/empty.png`" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ rubriquesMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div  v-if="empty === 3">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                      <div style="position: relative; height: 250px;">
                          <img :src="`/assets/images/error.png`" style="width: 100px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" alt="empty">
                      </div>
                      <h5 style="text-align: center; margin-top: -50px"> {{ rubriquesMessage  }} </h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            <!-- Card item START -->
            <div class="col-sm-6 col-lg-3" v-else-if="empty === 0" v-for="result in rubriquesData" :key="result.id">
                <div class="card bg-transparent" v-if="result.image_cover_url">
                    <!-- Card img -->
                    <img class="card-img rounded" :src='getImage(result.image_cover_url)' style="height: 150px; object-fit: cover" :alt='result.title'>
                    <div class="card-body px-0 pt-3">
                        <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                        <!-- Card info -->
                        <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                            <li class="nav-item">
                                <span @click="author(result.author_slug)" style="cursor: pointer" class="text-reset btn-link">{{ result.author_name }}</span>
                            </li>
                            <li class="nav-item">{{ moment(result.date_publish).format("DD/MM/YYYY") }}</li>
                        </ul>
                    </div>
                </div>
                <div v-else>
                    <div class="card mb-4">
                        <div class="card-body border rounded-3">

                            <h6 class="card-title mb-0"><span @click="article(result.slug)" style="cursor: pointer" class="btn-link text-reset fw-bold" v-html="result.title"></span></h6>
                            <p class="card-text" v-html="truncate_content"> </p>
                            <!-- Card info -->
                            <ul class="nav nav-divider align-items-center text-uppercase small mt-2">
                                <li class="nav-item">
                                    <span @click="author(result.author_slug)" style="cursor: pointer" class="text-reset btn-link">{{ result.author_name }}</span>
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
                            <span style="cursor: pointer" v-if="rubriquesState" @click="rubriques" class="btn btn-sm btn-success">Rubriques+</span>
                            <span style="cursor: pointer" v-else @click="rubriques" class="btn btn-sm btn-primary-soft">Rubriques+</span>
                        </li>
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="chroniquesState" @click="chroniques" class="btn btn-sm btn-success">Chroniques</span>
                            <span style="cursor: pointer" v-else @click="chroniques" class="btn btn-sm btn-primary-soft">Chroniques</span>
                        </li>
                        <li class="list-inline-item">
                            <span style="cursor: pointer" v-if="diplomatieState" @click="diplomatie" class="btn btn-sm btn-success">Diplomatie</span>
                            <span style="cursor: pointer" v-else @click="diplomatie" class="btn btn-sm btn-primary-soft">Diplomatie</span>
                        </li>
                    </ul>
                </div>
            </div> <!-- Row END -->
        </div>
    </div>
</template>

import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/Home.vue';
import SavedRepositories from './components/SavedRepositories.vue';

Vue.use(VueRouter);

const router = new VueRouter({
  routes: [
    { path: '/', component: Home, name: "Home" },
    { path: '/saved', component: SavedRepositories, name: "Saved" },
  ],
  mode: 'history',
});

export default router;
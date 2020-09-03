require('./bootstrap');
import feather from 'vue-icon'
import Vue from 'vue';
import router from './router';

Vue.use(feather, 'v-icon');
import App from './components/App.vue';

const app = new Vue({
  el: '#app',
  router,
  render: h => h(App),
});

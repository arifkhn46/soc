import Vue from 'vue';
import Vuex from "vuex";
import Notifications from 'vue-notification'

import App from './App.vue';
import './assets/styles/index.scss';

// configure router
import { createRouter } from './router'
import { createStore } from './store'

//Mixin
import mixin from '@/mixin';

Vue.use(Vuex);
Vue.use(Notifications)

Vue.config.productionTip = false;

const store = createStore()
const router = createRouter(store)

new Vue({
  store,
  router,
  mixins: [mixin],
  render: h => h(App),
}).$mount('#app');

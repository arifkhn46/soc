import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';
import 'roboto-fontface/css/roboto/roboto-fontface.css'
import '@mdi/font/css/materialdesignicons.css'
import DatetimePicker from 'vuetify-datetime-picker'

import Alert from '@/components/Alert.vue'

Vue.component('app-alert', Alert)
Vue.use(DatetimePicker)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')

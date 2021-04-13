import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

import VueAxios from "vue-axios";
import axios from "axios";

Vue.use(VueAxios, axios);

new Vue({
  render: h => h(App),
}).$mount('#app')

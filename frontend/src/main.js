import 'bootstrap-css-only/css/bootstrap.min.css'
import 'mdbvue/lib/css/mdb.min.css'
import Vue from 'vue';
import VueMeta from 'vue-meta';
import VueRouter from "vue-router";
import axios from 'axios';
import VueAxios from 'vue-axios';
import Vuex from 'vuex';
import VueCookies from 'vue-cookies';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import vSelect from 'vue-select';

Vue.use(VueCookies);
Vue.$cookies.config("7d");

Vue.use(VueAxios, axios);
Vue.use(VueMeta);
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component("v-select", vSelect);
import 'vue-select/src/scss/vue-select.scss';

Vue.config.productionTip = false;

// setup router
let routes = require("./routes");
let router = new VueRouter({
  mode: 'history',
  routes,
  scrollBehavior (to, from, savedPosition) {
    if (savedPosition) return savedPosition;
    return { x: 0, y: 0};
  }
});

import VueBodyClass from 'vue-body-class';
const vueBodyClass = new VueBodyClass(routes);
router.beforeEach((to, from, next) => { vueBodyClass.guard(to, next) });
// import global css & js
import "./assets/styles/_global.css";
import "./assets/styles/include_fonts.css";
import "./assets/styles/colors.scss";

const _ = require("lodash");
const config_file = require("./config.json");
Vue.prototype.$config = _.merge(config_file.development, config_file[process.env.NODE_ENV || 'development']);
Vue.prototype.$utils = require("./assets/scripts/utils");
Vue.prototype.$auth = require("./assets/scripts/auth");

import App from './App.vue';

new Vue({
  router,
  store: new Vuex.Store(require("./store")),
  render: h => h(App),
}).$mount('#app');
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import Vuetify from 'vuetify'
import appClient from './components/pages/client/App.vue'
import appAdmin from './components/pages/admin/App.vue'

import 'vuetify/dist/vuetify.min.css' // Ensure you are using css-loader
import router from './router/Index'
import store from './store/Index'
import Toaster from 'v-toaster'
import VueTimeago from 'vue-timeago'
import VueCookies from 'vue-cookies'
import 'v-toaster/dist/v-toaster.css'


Vue.use(Toaster, {
    timeout: 5000
})

Vue.use(VueTimeago, {
    name: 'Timeago', // Component name, `Timeago` by default
    locale: 'en', // Default locale
})

Vue.use(Vuetify)
Vue.use(VueCookies)

$cookies.config('15d')  // default: expireTimes = 1d , path=/
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('Home', require('./components/Home.vue'));
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        'app-client': appClient,
        'app-admin': appAdmin
    },
    //   render: h => h(App),
    methods: {

    }
});

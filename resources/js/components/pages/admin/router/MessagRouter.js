import Vue from 'vue'
import Router from 'vue-router'
import AuthGuard from './Auth.js'
Vue.use(Router);
const router = new Router({
routes: [{
path: '/Messag',
name: 'Messag',
component: Messag
}],
 mode: 'history',
});
export default app;

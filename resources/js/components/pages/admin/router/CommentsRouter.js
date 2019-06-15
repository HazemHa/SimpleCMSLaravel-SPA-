import Vue from 'vue'
import Router from 'vue-router'
import AuthGuard from './Auth.js'
Vue.use(Router);
const router = new Router({
routes: [{
path: '/Comments',
name: 'Comments',
component: Comments
}],
 mode: 'history',
});
export default app;

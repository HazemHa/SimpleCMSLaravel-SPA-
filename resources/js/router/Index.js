import Vue from 'vue'
import Router from 'vue-router'
import AuthGuard from './Auth.js'
import Client from './client';
import Admin from './admin';

Vue.use(Router);
var routers = [];
routers = routers.concat(Client);
routers = routers.concat(Admin);
var router = new Router({
    routes: routers,
    mode: 'history',
});


export default router;

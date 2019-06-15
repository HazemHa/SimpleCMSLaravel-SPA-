import store from '../store/Index'
export default (to, from, next) => {
    // check if user Auth continu request
    // else convert to singin page. .
    // it is like middleware for specific component
    if (store.getters['users/isAuth'] && store.getters['users/getCurrentUser'].role_id == 5) {
        next()
    } else {
        next('/singin')
    }
}

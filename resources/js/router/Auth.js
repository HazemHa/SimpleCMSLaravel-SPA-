import store from '../store/Index'
export default (to, from, next) => {
    // check if user Auth continu request
    // else convert to singin page. .
    // it is like middleware for specific component
    if (store.getters.isAuth) {
        next()
    } else {
        next('/singin')
    }
}

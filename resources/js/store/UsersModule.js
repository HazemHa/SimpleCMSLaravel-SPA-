import axios from "axios";
export default {
    namespaced: true,
    state: {
        currentUser: {
            access_token: undefined,
            id: -1,
        },
        Auth: false,
    },
    getters: {
        isAuth(state) {
            return state.Auth;
        },
        getCurrentUser(state) {
            return state.currentUser;
        }
    },
    mutations: {
        setCurrentUser(state, payload) {
            $cookies.set("user", payload);
            state.currentUser = payload;
        },

        setAuth(state, payload) {
            state.Auth = payload;
        }

    },
    actions: {
        setCurrentUser({
            commit
        }, data) {
            commit("setCurrentUser", data);
        },
        singin({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/singin`, data)
                    .then(res => {
                        if (res.data.auth) {
                            axios.defaults.headers.common['Authorization'] = "Bearer " + res.data.user.access_token;
                            commit('setCurrentUser', res.data.user);
                            commit('setAuth', true);
                        }

                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        setAuthMethod({
            commit
        }, data) {
            commit('setAuth', data);
        },
        setTokenForRequest({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                let user = $cookies.get('user');
                let accessToken = null;
                if (user) {
                    accessToken = $cookies.get("user").access_token;
                }
                if (user && accessToken) {
                    commit("setCurrentUser", user);
                    axios.defaults.headers.common['Authorization'] = "Bearer " + accessToken;
                    commit('setAuth', true);
                    resolve(this.getters['users/isAuth']);
                } else {
                    commit('setAuth', false);
                    resolve(this.getters['users/isAuth'])
                }

                axios.post(this.getters.url + `api/checkToken`)
                    .then(res => {
                        console.log(res);
                        resolve(res);
                    }).catch(err => {
                        reject(err);
                    });

            });
        },
        logout({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/logout`)
                    .then(res => {
                        this.getters.isAuth = res.data.auth;
                        commit('setCurrentUser', res.data.user);
                        $cookies.remove("access_token");
                        commit('setAuth', false);
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        singup({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/singup`, data, {
                        header: {
                            Accept: "application/json",
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        if (res.data.success) {
                            commit('setCurrentUser', res.data.user);
                        }
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        updateProfile({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .post(this.getters.url + `api/profile`, data, {
                        header: {
                            Accept: "application/json",
                            "Content-Type": "multipart/form-data"
                        }
                    })
                    .then(res => {
                        resolve(res);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        getUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=query+FetchUsers{Users{id,name,email,image,email_verified_at,about,password}}`
                    )
                    .then(res => {
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        getSpecificUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=query+FetchUsers{Users(id:${
                                data.id
                            }){id,name,email,image,about,password}}`
                    )
                    .then(res => {
                        // commit('setCurrentUser', res.data.data.Users[0]);
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        createUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=mutation+Users{mutationUsers(flag:"create",name: "${
                                data.name
                            }",email: "${data.email}",image: "${
                                data.image
                            }",email_verified_at: "${
                                data.email_verified_at
                            }",about: "${data.about}",password: "${
                                data.password
                            }"){id,name,email,image,email_verified_at,about,password}}`
                    )
                    .then(res => {
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        deleteUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=mutation+Users{mutationUsers(id:${
                                data.id
                            },flag:"delete"){id}}`
                    )
                    .then(res => {
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        updateUsers({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=mutation+Users{mutationUsers(id:${
                                data.id
                            },flag:"update",name: "${data.name}",email: "${
                                data.email
                            }",image: "${data.image}",email_verified_at: "${
                                data.email_verified_at
                            }",about: "${data.about}",password: "${
                                data.password
                            }"){id,name,email,image,email_verified_at,about,password}}`
                    )
                    .then(res => {
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        }
    }
};
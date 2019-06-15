import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {
        setSetting(state, payload) {
            state.Setting = payload;
        },
    },
    actions: {
        getSettings({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchSettings{Settings{id,site_name,site_email,site_location,site_aboutUs}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getSpecificSettings({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchSettings{Settings(id:${data.id}){id,site_name,site_email,site_location,site_aboutUs}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createSettings({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Settings{mutationSettings(flag:"create",site_name: "${data.site_name}",site_email: "${data.site_email}",site_location: "${data.site_location}",site_aboutUs: "${data.site_aboutUs}"){id,site_name,site_email,site_location,site_aboutUs}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deleteSettings({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Settings{mutationSettings(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updateSettings({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Settings{mutationSettings(id:${data.id},flag:"update",site_name: "${data.site_name}",site_email: "${data.site_email}",site_location: "${data.site_location}",site_aboutUs: "${data.site_aboutUs}"){id,site_name,site_email,site_location,site_aboutUs}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

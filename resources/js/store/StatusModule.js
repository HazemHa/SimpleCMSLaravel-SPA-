import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {
        getStatusMenu({
            commit
        }, data){
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchStatus{Status{id,name}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getStatus({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchStatus{Status{id,name,description}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getSpecificStatus({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchStatus{Status(id:${data.id}){id,name,description}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createStatus({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Status{mutationStatus(flag:"create",name: "${data.name}",description: "${data.description}"){id,name,description}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deleteStatus({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Status{mutationStatus(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updateStatus({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Status{mutationStatus(id:${data.id},flag:"update",name: "${data.name}",description: "${data.description}"){id,name,description}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

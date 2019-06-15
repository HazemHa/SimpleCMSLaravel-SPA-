import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        getGallery({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchGallery{Gallery{id,name,path,status_id,status{name}}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getSpecificGallery({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchGallery{Gallery(id:${data.id}){id,name,path,status_id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createGallery({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Gallery{mutationGallery(flag:"create",name: "${data.name}",path: "${data.path}",status_id: "${data.status_id}"){id,name,path,status_id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deleteGallery({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Gallery{mutationGallery(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updateGallery({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Gallery{mutationGallery(id:${data.id},flag:"update",name: "${data.name}",path: "${data.path}",status_id: "${data.status_id}"){id,name,path,status_id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

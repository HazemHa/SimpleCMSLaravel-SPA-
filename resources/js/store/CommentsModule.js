import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

        getComments({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchComments{Comments{id,user_id,post_id,name,email,subject,message}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getSpecificComments({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchComments{Comments(id:${data.id}){id,user_id,post_id,name,email,subject,message}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createComments({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Comments{mutationComments(flag:"create",user_id: "${data.user_id}",post_id: "${data.post_id}",name: "${data.name}",email: "${data.email}",subject: "${data.subject}",message: "${data.message}"){id,user_id,post_id,name,email,subject,message}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deleteComments({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Comments{mutationComments(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updateComments({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Comments{mutationComments(id:${data.id},flag:"update",user_id: "${data.user_id}",post_id: "${data.post_id}",name: "${data.name}",email: "${data.email}",subject: "${data.subject}",message: "${data.message}"){id,user_id,post_id,name,email,subject,message}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

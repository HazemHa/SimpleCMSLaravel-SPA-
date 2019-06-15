import axios from "axios"
export default {
namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {
getPasswordResets({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=query+FetchPasswordResets{PasswordResets{id,email,token,created_at}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
getSpecificPasswordResets({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=query+FetchPasswordResets{PasswordResets(id:${data.id}){id,email,token,created_at}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
createPasswordResets({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+PasswordResets{mutationPasswordResets(flag:"create",email: "${data.email}",token: "${data.token}",created_at: "${data.created_at}"){id,email,token,created_at}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
deletePasswordResets({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+PasswordResets{mutationPasswordResets(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
updatePasswordResets({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+PasswordResets{mutationPasswordResets(id:${data.id},flag:"update",email: "${data.email}",token: "${data.token}",created_at: "${data.created_at}"){id,email,token,created_at}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
}
 }

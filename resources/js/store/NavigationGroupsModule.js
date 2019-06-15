import axios from "axios"
export default {
namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {

getNavigationGroups({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=query+FetchNavigationGroups{NavigationGroups{id,name,slug}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
getSpecificNavigationGroups({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=query+FetchNavigationGroups{NavigationGroups(id:${data.id}){id,name,slug}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
createNavigationGroups({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+NavigationGroups{mutationNavigationGroups(flag:"create",name: "${data.name}",slug: "${data.slug}"){id,name,slug}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
deleteNavigationGroups({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+NavigationGroups{mutationNavigationGroups(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
updateNavigationGroups({commit},data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url +`graphql?query=mutation+NavigationGroups{mutationNavigationGroups(id:${data.id},flag:"update",name: "${data.name}",slug: "${data.slug}"){id,name,slug}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })},
}
 }

import axios from "axios"
export default {
    namespaced: true,
    state: {},
    getters: {},
    mutations: {},
    actions: {
        getNavigations({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchNavigations{Navigations{id,link_text,url,description,group_id,click_count,groupNavigation{name}}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        getSpecificNavigations({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchNavigations{Navigations(id:${data.id}){id,link_text,url,description,group_id,click_count}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createNavigations({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Navigations{mutationNavigations(flag:"create",link_text: "${data.link_text}",url: "${data.url}",description: "${data.description}",group_id: "${data.group_id}",click_count: "${data.click_count}"){id,link_text,url,description,group_id,click_count}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deleteNavigations({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Navigations{mutationNavigations(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updateNavigations({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Navigations{mutationNavigations(id:${data.id},flag:"update",link_text: "${data.link_text}",url: "${data.url}",description: "${data.description}",group_id: "${data.group_id}",click_count: "${data.click_count}"){id,link_text,url,description,group_id,click_count}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

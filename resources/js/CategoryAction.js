import axios from "axios"
export default {

    IndexCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `api/Category`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    ShowCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `api/Category/${data.id}`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    StoreCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.post(this.getters.url + `api/Category`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    DestroyCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.delete(this.getters.url + `api/Category/${data.id}`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    UpdateCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.put(this.getters.url + `api/Category/${data.id}`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    CreateCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `api/Category/create`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    EditCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `api/Category/${data.id}/edit`)
                .then((res) => {
                    resolve(res.data.data);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    GetCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(
                    this.getters.url +
                    `graphql?query=query+FetchCategories{Category{id,name,description,updated_at,created_at,posts{id}}}`
                )
                .then(res => {
                    commit("setCategories", res.data.data.Category);
                    resolve(res.data.data);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    GetSpecificCategories({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios
                .get(
                    this.getters.url +
                    `graphql?query=query+FetchCategories{Category(id:${data.id}){id,name,description,updated_at,created_at,posts{id,title,content,image,status{name},created_at,category{id,name},user{id,name},comments{id,content,created_at,user{id,name}}}}}`
                )
                .then(res => {
                    commit("setCurrentCategory", res.data.data);
                    resolve(res);
                })
                .catch(err => {
                    reject(err);
                });
        });
    },
    createCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `graphql?query=mutation+Category{mutationCategory(flag:"create",name: "${data.name}",description: "${data.description}"){id,name,description}}`)
                .then((res) => {
                    resolve(res);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    deleteCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `graphql?query=mutation+Category{mutationCategory(id:${data.id},flag:"delete"){id}}`)
                .then((res) => {
                    resolve(res);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
    updateCategory({
        commit
    }, data) {
        return new Promise((resolve, reject) => {
            axios.get(this.getters.url + `graphql?query=mutation+Category{mutationCategory(id:${data.id},flag:"update",name: "${data.name}",description: "${data.description}"){id,name,description}}`)
                .then((res) => {
                    resolve(res);
                }).catch((err) => {
                    reject(err);
                })
        })
    },
}

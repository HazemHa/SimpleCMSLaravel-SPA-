import axios from "axios"
export default {
    namespaced: true,
    state: {
        currentCategory: {},
        Categories: [],
    },
    getters: {
        currentCategory(state) {
            return state.currentCategory;
        },
        categories(state) {
            return state.categories;
        }

    },
    mutations: {
        setCurrentCategory(state, payload) {
            state.currentCategory = payload;
        },
        setCategories(state, payload) {
            state.Categories = payload;
        },
    },
    actions: {
        getCategoryMenu({
            commit
        }, data){

            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=query+FetchCategories{Category{id,name}}`
                    )
                    .then(res => {
                        commit("setCategories", res.data.data);
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });


        },


        getCategory({
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
                        `graphql?query=query+FetchCategories{Category(id:${data.id}){id,name,description,updated_at,created_at,posts{id,title,content,image,status{name},created_at,category{id,name},user{id,name},comments{id,message,created_at,user{id,name}}}}}`
                    )
                    .then(res => {
                        commit("setCurrentCategory", res.data.data.Category[0]);
                        resolve(res.data.data);
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
                        resolve(res.data.data);
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
                        resolve(res.data.data);
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
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

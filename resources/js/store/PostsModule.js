import axios from "axios"
export default {
    namespaced: true,
    state: {
        currentPost: {},
        Posts: [],
    },
    getters: {
        currentPost(state) {
            return state.currentPost;
        },
        posts(state) {
            return state.Posts;
        }
    },
    mutations: {
        setCurrentPost(state, payload) {
            state.currentPost = payload;
        },

        setPosts(state, payload) {
            state.Posts = payload;
        },
    },
    actions: {
        getPosts({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=query+FetchPosts{Posts{id,title,content,image,status{name},created_at,category{id,name},user{id,name},comments{id,subject,message,created_at,user{id,name}}}}`
                    )
                    .then(res => {
                        commit("setPosts", res.data.data.Posts);
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        getSpecificPosts({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=query+FetchPosts{Posts(id:${data.id}){id,title,content,image,status{name},created_at,category{id,name},user{id,name},comments{id,message,created_at,user{id,name,image}}}}`)
                    .then((res) => {
                        commit("setCurrentPost", res.data.data.Posts[0]);
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        blogDetails({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios
                    .get(
                        this.getters.url +
                        `graphql?query=query+FetchPosts{Posts(id:${data.id}){id,title,content,image,status{name},created_at,category{id,name},user{id,name},comments{id,message,created_at,user{id,name,image}}}}`
                    )
                    .then(res => {
                        commit("setCurrentPost", res.data.data.Posts[0]);
                        resolve(res.data.data);
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        storePostClient({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                console.log(this.getters.url + `storePost`);
                axios.post(this.getters.url + `api/storePost`,data,{
                    header: {
                        Accept: "application/json",
                        "Content-Type": "multipart/form-data"
                    }
                })
                    .then((res) => {
                        resolve(res.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        createPosts({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Posts{mutationPosts(flag:"create",user_id: "${data.user_id}",title: "${data.title}",content: "${data.content}",category_id: "${data.category_id}",image: "${data.image}",status_id: "${data.status_id}"){id,user_id,title,content,category_id,image,status_id,click}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        deletePosts({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Posts{mutationPosts(id:${data.id},flag:"delete"){id}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
        updatePosts({
            commit
        }, data) {
            return new Promise((resolve, reject) => {
                axios.get(this.getters.url + `graphql?query=mutation+Posts{mutationPosts(id:${data.id},flag:"update",user_id: "${data.user_id}",title: "${data.title}",content: "${data.content}",category_id: "${data.category_id}",image: "${data.image}",status_id: "${data.status_id}",click: "${data.click}"){id,user_id,title,content,category_id,image,status_id,click}}`)
                    .then((res) => {
                        resolve(res.data.data);
                    }).catch((err) => {
                        reject(err);
                    })
            })
        },
    }
}

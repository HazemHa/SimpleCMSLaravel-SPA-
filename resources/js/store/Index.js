import Vue from "vue";
import Vuex from "vuex";

import NavigationGroupsModule from "./NavigationGroupsModule";

import GalleryModule from "./GalleryModule";

import StatusModule from "./StatusModule";

import PostsModule from "./PostsModule";

import CommentsModule from "./CommentsModule";

import PasswordResetsModule from "./PasswordResetsModule";

import SettingsModule from "./SettingsModule";

import SubscribesModule from "./SubscribesModule";

import NavigationsModule from "./NavigationsModule";

import MessagesModule from "./MessagesModule";

import UsersModule from "./UsersModule";

import CategoryModule from "./CategoryModule";

/*
import NavigationGroupsAction from './NavigationGroupsAction';

import GalleryAction from './GalleryAction';

import StatusAction from './StatusAction';

import PostsAction from './PostsAction';

import CommentsAction from './CommentsAction';

import PasswordResetsAction from './PasswordResetsAction';

import SettingsAction from './SettingsAction';

import SubscribesAction from './SubscribesAction';

import NavigationsAction from './NavigationsAction';

import MessagesAction from './MessagesAction';

import UsersAction from './UsersAction';

import CategoryAction from './CategoryAction';

*/

Vue.use(Vuex);
let actions = {};
/*
actions = Object.assign(actions, NavigationGroupsAction);

actions = Object.assign(actions, GalleryAction);

actions = Object.assign(actions, StatusAction);

actions = Object.assign(actions, PostsAction);

actions = Object.assign(actions, CommentsAction);

actions = Object.assign(actions, PasswordResetsAction);

actions = Object.assign(actions, SettingsAction);

actions = Object.assign(actions, SubscribesAction);

actions = Object.assign(actions, NavigationsAction);

actions = Object.assign(actions, MessagesAction);

actions = Object.assign(actions, UsersAction);

actions = Object.assign(actions, CategoryAction);
*/
/*
const store = new Vuex.Store({
    plugins: [],
    modules: {
        //       authUser: User,
    },
    state: {
        currentPost: null,
        currentCategory: null,
        Posts: [],
        Categories: [],
        currentUser: [],
        iamAdmin: false,
        Setting: []
    },
    mutations: {

        setCurrentUser(state, payload) {
            state.currentUser = payload;
        },

        whoIam(state, payload) {
            state.iamAdmin = payload;
        }
    },
    actions: actions,
    getters: {
        url(state) {
            return "http://127.0.0.1:8000/";
        },
        categories(state) {
            return state.Categories;
        },
        posts(state) {
            return state.Posts;
        },
        currentCategory(state) {
            return state.currentCategory;
        },
        currentPost(state) {
            return state.currentPost;
        },
        currentUser(state) {
            return state.currentUser;
        },
        isAdmin(state) {
            return (state.iamAdmin = false);
        }
    }
});
export default store;
*/

const store = new Vuex.Store({
    plugins: [],
    modules: {
        navigationgroups: NavigationGroupsModule,
        gallery: GalleryModule,
        status: StatusModule,
        posts: PostsModule,
        comments: CommentsModule,
        passwordresets: PasswordResetsModule,
        settings: SettingsModule,
        subscribes: SubscribesModule,
        navigations: NavigationsModule,
        messages: MessagesModule,
        users: UsersModule,
        category: CategoryModule
    },
    getters: {
        url(state) {
            return "http://127.0.0.1:8000/";
        }
    }
});
export default store;

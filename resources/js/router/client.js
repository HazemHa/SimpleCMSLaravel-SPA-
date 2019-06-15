import ClientHome from "../components/pages/client/index.vue";
import blogDetails from "../components/pages/client/blog-details.vue";
import category from "../components/pages/client/category.vue";

import categoryDetails from "../components/pages/client/category-details.vue";

import contact from "../components/pages/client/contact.vue";
import addPost from "../components/pages/client/parts/addPosts.vue";

import singin from "../components/pages/singin.vue";
import singup from "../components/pages/singup.vue";
import profile from "../components/pages/profile.vue";
export default [
    {
        path: "/",
        name: "home",
        component: ClientHome,
        children: []
    },
    {
        path: "/category",
        name: "category",
        component: category,
        children: []
    },
    {
        path: "/category-details/:id",
        name: "category-details",
        component: categoryDetails
    },
    {
        path: "/post-details/:id",
        name: "post-details",
        component: blogDetails
    },
    {
        path: "/singin",
        name: "singin",
        component: singin
    },
    {
        path: "/singup",
        name: "singup",
        component: singup
    },

    {
        path: "/profile",
        name: "profile",
        component: profile
    },
    {
        path: "/contact",
        name: "contact",
        component: contact
    },
    {
        path: "/addPost",
        name: "addPost",
        component: addPost
    }
];

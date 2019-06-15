import adminNavigationGroups from "../components/pages/admin/CURD/NavigationGroups.vue";

import adminGallery from "../components/pages/admin/CURD/Gallery.vue";

import adminStatus from "../components/pages/admin/CURD/Status.vue";

import adminPosts from "../components/pages/admin/CURD/Posts.vue";

import adminComments from "../components/pages/admin/CURD/Comments.vue";

import adminPasswordResets from "../components/pages/admin/CURD/PasswordResets.vue";

import adminSettings from "../components/pages/admin/CURD/Settings.vue";

import adminSubscribes from "../components/pages/admin/CURD/Subscribes.vue";

import adminNavigations from "../components/pages/admin/CURD/Navigations.vue";

import adminMessages from "../components/pages/admin/CURD/Messages.vue";

import adminUsers from "../components/pages/admin/CURD/Users.vue";

import adminCategory from "../components/pages/admin/CURD/Category.vue";

import adminHome from "../components/pages/admin/index.vue";
import AuthGuard from './AdminAuth.js'

export default [{

        path: "/admin/",
        name: "adminHome",
        component: adminHome,
    }, {
        path: "/admin/subs",
        name: "adminSubscribes",
        component: adminSubscribes,
        beforeEnter: AuthGuard
    },
    {
        path: "/admin/Posts",
        name: "adminPosts",
        component: adminPosts,
        beforeEnter: AuthGuard
    },
    {
        path: "/admin/Category",
        name: "adminCategory",
        component: adminCategory,
        beforeEnter: AuthGuard
    },
    {
        path: "/admin/Comments",
        name: "adminComments",
        component: adminComments,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/gallery",
        name: "adminGallery",
        component: adminGallery,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/message",
        name: "adminMessages",
        component: adminMessages,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/navigationGroups",
        name: "adminNavigationGroups",
        component: adminNavigationGroups,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/navigation",
        name: "adminNavigations",
        component: adminNavigations,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/settings",
        name: "adminSettings",
        component: adminSettings,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/users",
        name: "adminUsers",
        component: adminUsers,
        beforeEnter: AuthGuard
    }, {
        path: "/admin/status",
        name: "adminStatus",
        component: adminStatus,
        beforeEnter: AuthGuard
    }

];

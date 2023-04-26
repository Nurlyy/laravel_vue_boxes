import { h, resolveComponent } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import createStore from "../store/index.js";

import DefaultLayout from "@/layouts/DefaultLayout.vue";

import MainLayout from "@/layouts/MainLayout.vue";

const routes = [
    {
        path: '/',
        name: 'Main',
        component: MainLayout
    },
    {
        path: "/admin",
        name: "Home",
        component: DefaultLayout,
        redirect: "/admin/images",
        children: [
            {
                path: "/dashboard",
                name: "Dashboard",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/views/Dashboard.vue"
                    ),
            },
            {
                path: "/admin/images",
                name: "Images",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/Images.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/filters",
                name: "Filters",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/Filters.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/contacts",
                name: "Contacts",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/Contacts.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/user",
                name: "User",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/User.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/images/add-image",
                name: "AddImage",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/AddImage.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/images/add-filter",
                name: "AddFilter",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/AddFilter.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/images/add-page",
                name: "AddPage",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/AddPage.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/pages",
                name: "pages",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/Pages.vue"
                    ),
                meta: { requiresAuth: true },
            },
        ],
    },

    {
        path: "/admin/login",
        name: "Login",
        component: () => import("@/views/pages/Login.vue"),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior() {
        // always scroll to top
        return { top: 0 };
    },
});

router.beforeEach((to, from, next) => {
    if (
        to.path.startsWith("/admin/") &&
        to.path !== "/admin/login" &&
        to.path !== "/admin/login/" &&
        to.path !== "/admin/logout" &&
        to.matched.some((record) => record.meta.requiresAuth)
    ) {
        const accessToken = localStorage.getItem("access_token");
        // console.log("beforeEach:" + accessToken);
        if (!accessToken) {
            next({ name: "Login" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;

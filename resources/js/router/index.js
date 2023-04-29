import { h, resolveComponent } from "vue";
import { createRouter, createWebHistory } from "vue-router";
import createStore from "../store/index.js";

import DefaultLayout from "@/layouts/DefaultLayout.vue";

import MainLayout from "@/layouts/MainLayout.vue";
import Pages from "@/main/Pages.vue";

const routes = [
    {
        path: "/page/:slug", // slug is the dynamic parameter
        component: Pages,
        props: true, // allows passing slug as a prop to the component
    },
    {
        path: "/category/:id", // slug is the dynamic parameter
        component: () =>
            import(/* webpackChunkName: "dashboard" */ "@/main/Index.vue"),
        props: true, // allows passing slug as a prop to the component
    },
    {
        path: "/",
        name: "Main",
        component: MainLayout,
        redirect: "/index",
        children: [
            {
                path: "/index",
                name: "MainIndex",
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/main/Index.vue"
                    ),
            },
            // {
            //     path: '/order-request',
            //     name: 'MainOrderRequest',
            //     component: () =>
            //         import(
            //             /* webpackChunkName: "dashboard" */ '@/main/Order.vue'
            //         ),
            // },
            {
                path: "/likes",
                name: "MainLikes",
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/main/LikePage.vue"
                    ),
            },
        ],
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
                path: "/admin/main-page",
                name: "MainPage",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/MainPage.vue"
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
                name: "Pages",
                // route level code-splitting
                // this generates a separate chunk (about.[hash].js) for this route
                // which is lazy-loaded when the route is visited.
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/Pages.vue"
                    ),
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/pages/:slug", // slug is the dynamic parameter
                component: () =>
                    import(
                        /* webpackChunkName: "dashboard" */ "@/pages/AddPage.vue"
                    ),
                props: true, // allows passing slug as a prop to the component
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/images/:id", // slug is the dynamic parameter
                component: () =>
                import(
                    /* webpackChunkName: "dashboard" */ "@/pages/AddImage.vue"
                ),
                // redirect: "/admin/images",
                props: true, // allows passing slug as a prop to the component
                meta: { requiresAuth: true },
            },
            {
                path: "/admin/filters/:id", // slug is the dynamic parameter
                component: () =>
                import(
                    /* webpackChunkName: "dashboard" */ "@/pages/AddFilter.vue"
                ),
                // redirect: "/admin/images",
                props: true, // allows passing slug as a prop to the component
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

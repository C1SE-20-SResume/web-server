const routesWithPrefix = (prefix, routes) => {
    return routes.map((route) => {
        route.path = `${prefix}${route.path}`;
        return route;
    });
};

import Layout from "../layouts/Layout.vue";
import { auth, guest } from "../middleware";
import { Dashboard } from "../pages";
import { Login } from "../auth";
const routes = [
    {
        path: "/",
        name: "layout",
        meta: {
            middleware: [auth],
            guard: "auth",
        },
        component: Layout,
        children: [
            {
                path: "",
                name: "dashboard",
                component: Dashboard,
            },
        ],
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
            middleware: [guest],
            guard: "auth",
        },
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

export default routes;

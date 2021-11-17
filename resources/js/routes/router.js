const routesWithPrefix = (prefix, routes) => {
    return routes.map((route) => {
        route.path = `${prefix}${route.path}`;
        return route;
    });
};

import Layout from "../layouts/Layout.vue";
import { auth } from "../middleware";
import { Dashboard } from "../pages";
import { Login } from "../auth";
const routes = [
    {
        path: "/",
        name: "layout",
        meta: {
            middleware: [auth],
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
    },
    { path: "/:pathMatch(.*)*", redirect: "/" },
];

export default routes;

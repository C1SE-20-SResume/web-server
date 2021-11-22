const routesWithPrefix = (prefix, routes) => {
    return routes.map((route) => {
        route.path = `${prefix}${route.path}`;
        return route;
    });
};

import Layout from "../layouts/Layout.vue";
import { auth, guest } from "../middleware";
import { Dashboard, SingleJob, listCompany, listQuestion } from "../pages";
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
            {
                path: "/list-company",
                name: "list-company",
                component: listCompany,
            },
            {
                path: "/list-question",
                name: "list-question",
                component: listQuestion,
            },
            {
                path: "job/:id",
                name: "single-job",
                component: SingleJob,
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

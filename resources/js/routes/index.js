import { createRouter, createWebHistory } from "vue-router";
import routes from "./router";
import store from "../store/index";
import middlewarePipeline from "./middlewarePipeline";
const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});
router.beforeEach((to, from, next) => {
    const middleware = to.meta.middleware;
    const context = { to, from, next, store };
    if (!middleware) {
        return next();
    }
    middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1),
    });
});
export default router;

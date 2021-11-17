export default function auth({ to, next, store }) {
    const loginQuery = { path: "/login", query: { redirect: to.fullPath } };
    if (!store.getters["auth/check"]) {
        store.dispatch("auth/getAuthUser").then(() => {
            if (!store.getters["auth/check"]) next(loginQuery);
            else next();
        });
    } else {
        next();
    }
}

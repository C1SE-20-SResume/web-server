export default function guest({ to, next, store }) {
    const storageItem = window.localStorage.getItem("guest");
    if (
        storageItem === "isAdmin" &&
        !store.getters["auth/check"] &&
        to.meta.guard === "auth"
    ) {
        store.dispatch("auth/getAuthUser").then(() => {
            if (store.getters["auth/check"]) {
                next({ name: "dashboard" });
            } else {
                store.dispatch("auth/setGuest", { value: "isGuest" });
                next();
            }
        });
    } else {
        next();
    }
}

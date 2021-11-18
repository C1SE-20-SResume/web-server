import { createApp } from "vue";
import App from "./App.vue";
import router from "./routes";
import store from "./store";

const app = createApp(App);
app.directive("click-outside", {
    beforeMount(el, binding, vnode) {
        el.clickOutsideEvent = function (event) {
            if (!(el === event.target || el.contains(event.target))) {
                binding.value(event, el);
            }
        };
        document.body.addEventListener("click", el.clickOutsideEvent);
    },
    unmounted(el) {
        document.body.removeEventListener("click", el.clickOutsideEvent);
    },
});
app.use(router);
app.use(store);

app.mount("#app");

require("./bootstrap");

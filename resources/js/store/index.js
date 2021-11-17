import { createStore } from "vuex";
import * as auth from "./modules/Auth";
const store = createStore({
    state: {
        isLoading: false,
    },
    strict: true,
    modules: {
        auth,
    },
});
export default store;

import { createStore } from "vuex";
import * as auth from "./modules/Auth";
import * as job from "./modules/ManageJob";
const store = createStore({
    state: {
        isLoading: false,
    },
    strict: true,
    modules: {
        auth,
        job,
    },
});
export default store;

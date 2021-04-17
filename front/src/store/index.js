import { createStore } from "vuex";
import auth from "./auth/index";
import user from "./user/index";

const store = createStore({
	modules: {
		auth,
		user,
	},
});

export default store;

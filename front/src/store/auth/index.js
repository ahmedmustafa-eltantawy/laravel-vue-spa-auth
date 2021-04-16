import getters from "./getters";
import mutations from "./mutations";
import actions from "./actions";

export default {
	namespaced: true,
	state: {
		user: null,
		errors: {
			name: ["Please Enter Valid name"],
			email: ["Please Enter Valid Email"],
			password: ["Please Enter Valid Password"],
			password_confirmation: ["Please must match the password Field"],
		},
		errorAtts: {
			nameIsValid: true,
			emailIsValid: true,
			passwordIsValid: true,
			passwordConfirmationIsValid: true,
		},
	},
	getters,
	mutations,
	actions,
};

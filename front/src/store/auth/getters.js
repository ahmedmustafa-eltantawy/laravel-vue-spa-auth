export default {
	user(state) {
		return state.user;
	},

	errors(state) {
		return state.errors;
	},

	nameValidationStatus(state) {
		return state.errorAtts.nameIsValid;
	},

	nameErrorMsg(state) {
		return state.errors.name && state.errors.name[0];
	},

	emailValidationStatus(state) {
		return state.errorAtts.emailIsValid;
	},

	emailErrorMsg(state) {
		return state.errors.email && state.errors.email[0];
	},

	passwordValidationStatus(state) {
		return state.errorAtts.passwordIsValid;
	},

	passwordErrorMsg(state) {
		return state.errors.password && state.errors.password[0];
	},

	passwordConfirmationValidationStatus(state) {
		return state.errorAtts.passwordIsValid;
	},

	passwordConfirmationErrorMsg(state) {
		return (
			state.errors.password_confirmation &&
			state.errors.password_confirmation[0]
		);
	},
};

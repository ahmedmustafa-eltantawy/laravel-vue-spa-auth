export default {
	setUserData(state, user) {
		state.user = user;
	},

	setErrors(state, errors) {
		state.errors = errors.data.errors;
	},

	resetErrorsAtts(state) {
		for (let errorAtt in state.errorAtts) {
			state.errorAtts[errorAtt] = true;
		}
	},

	setNameValidationStatus(state) {
		if (state.errors.name && state.errors.name[0].length) {
			state.errorAtts.nameIsValid = false;
		}
	},

	nameIsNotValid(state) {
		state.errorAtts.nameIsValid = false;
	},

	setEmailValidationStatus(state) {
		if (state.errors.email && state.errors.email[0].length) {
			state.errorAtts.emailIsValid = false;
		}
	},

	setEmailIsNotValid(state) {
		state.errorAtts.emailIsValid = false;
	},

	setPasswordValidationStatus(state) {
		if (state.errors.passwrod && state.errors.passwrod[0].length) {
			state.errorAtts.passwordIsValid = false;
		}
	},

	passwordIsNotValid(state) {
		state.errorAtts.passwordIsValid = false;
	},

	passwordConfirmationIsNotValid(state) {
		state.errorAtts.passwordConfirmationIsValid = false;
	},
};

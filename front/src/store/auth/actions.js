import axios from "axios";
export default {
	sendLoginRequest(context, userCredentials) {
		return axios
			.post("http://127.0.0.1:8000/api/" + "login", userCredentials)
			.then((res) => {
				console.log(res);
				context.commit("setUserData", res.data.user);

				// Sign Token in Storage
				localStorage.setItem("authToken", res.data.resposne.token);
				// console.log(res);
				// this.$router.push({ name: res.data.redirect_to });
				return res.data.user;
			})
			.catch((err) => {
				if (err.response) {
					context.commit("setErrors", err.response);
					context.commit("setEmailValidationStatus");
					context.commit("setPasswordValidationStatus");
				}
			});
	},

	sendRegistrationRequest(context, userCredentials) {
		console.log(userCredentials);
		return axios
			.post("http://127.0.0.1:8000/api/" + "register", userCredentials)
			.then((res) => {
				context.commit("setUserData", res.data.user);
				localStorage.setItem("authToken", res.data.token);
				// this.$router.push({ name: res.data.redirect_to });
				return res.data.user;
			})
			.catch((err) => {
				console.log(err.response);
				context.commit("setErrors", err.response);
				context.commit("setNameValidationStatus");
				context.commit("setEmailValidationStatus");
				context.commit("setPasswordValidationStatus");
			});
	},

	resetErrorsAtts(context) {
		context.commit("resetErrorsAtts");
	},

	nameIsNotValid(context) {
		context.commit("nameIsNotValid");
	},

	emailIsNotValid(context) {
		context.commit("setEmailIsNotValid");
	},

	passwordIsNotValid(context) {
		context.commit("passwordIsNotValid");
	},

	passwordConfirmationIsNotValid(context) {
		context.commit("passwordConfirmationIsNotValid");
	},
};

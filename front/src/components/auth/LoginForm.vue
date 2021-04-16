<template>
	<div class="col-lg-6 mx-auto mt-5">
		<ui-card>
			<template #card-body>
				<form class="form-signin" @submit.prevent="attemptSubmitting">
					<div class="form-label-group">
						<input
							type="email"
							id="emai"
							class="form-control"
							placeholder="Email address"
							v-model="credentials.email"
							@blur="validateEmail"
							:class="{ 'is-invalid': !emailValidationStatus }"
						/>
						<span
							v-if="!emailValidationStatus"
							:class="{ 'invalid-feedback': !emailValidationStatus }"
							>{{ emailErrorMsg }}</span
						>
						<label for="emai">Email address</label>
					</div>

					<div class="form-label-group">
						<input
							type="password"
							id="password"
							class="form-control"
							placeholder="Password"
							v-model="credentials.password"
							@blur="validatePassword"
							:class="{ 'is-invalid': !passwordValidationStatus }"
						/>
						<span
							v-if="!passwordValidationStatus"
							:class="{ 'invalid-feedback': !passwordValidationStatus }"
							>{{ passwordErrorMsg }}</span
						>
						<label for="password">Password</label>
					</div>

					<div class="checkbox mb-3">
						<label>
							<input
								type="checkbox"
								value="remember-me"
								v-model="credentials.remember_me"
							/>
							Remember me
						</label>
					</div>

					<button
						@click="validateFromInputs"
						class="btn btn-lg btn-primary btn-block"
						type="submit"
						ref="submit_btn"
					>
						Sign in
						<span v-if="isLoading" class="spinner-border" role="status">
							<span class="sr-only">Loading...</span>
						</span>
					</button>
				</form>
			</template>
		</ui-card>
		<div class="row mt-3">
			<div class="col-lg-6">
				<a class="btn btn-light" href="">Forget Password</a>
			</div>

			<div class="col-lg-6">
				<a class="btn btn-success float-right" @click="redirctToRegisterPage()"
					>Create new acount</a
				>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapGetters, mapActions } from "vuex";
	import UiCard from "../ui/UiCard";
	export default {
		name: "LoginForm",
		components: {
			UiCard,
		},

		data() {
			return {
				isLoading: false,
				credentials: {
					email: null,
					password: null,
					remember_me: true,
				},
			};
		},

		computed: {
			...mapGetters("auth", [
				"user",
				"errors",
				"emailErrorMsg",
				"passwordErrorMsg",
				"emailValidationStatus",
				"passwordValidationStatus",
			]),
		},

		methods: {
			...mapActions("auth", ["sendLoginRequest"]),

			async attemptSubmitting() {
				if (!this.credentials.email || !this.credentials.password) {
					return false;
				}
				this.isLoading = true;
				await this.$store
					.dispatch("auth/sendLoginRequest", this.credentials)
					.then(() => (this.isLoading = false));
			},

			redirctToRegisterPage() {
				this.$router.push({ name: "register" });
				this.$store.dispatch("auth/resetErrorsAtts");
			},

			validateFromInputs() {
				if (!this.emailValidation() || !this.passwordValidation()) {
					return false;
				}
			},

			emailValidation() {
				if (!this.credentials.email) {
					this.$store.dispatch("auth/emailIsNotValid");
				}

				return true;
			},

			passwordValidation() {
				if (!this.credentials.password) {
					this.$store.dispatch("auth/passwordIsNotValid");
				}

				return true;
			},
		},
	};
</script>

<style scoped>
	.bd-placeholder-img {
		font-size: 1.125rem;
		text-anchor: middle;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	@media (min-width: 768px) {
		.bd-placeholder-img-lg {
			font-size: 3.5rem;
		}
	}

	html,
	body {
		height: 100%;
	}

	body {
		display: -ms-flexbox;
		display: flex;
		-ms-flex-align: center;
		align-items: center;
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #f5f5f5;
	}

	.form-signin {
		width: 100%;
		max-width: 420px;
		padding: 15px;
		margin: auto;
	}

	.form-label-group {
		position: relative;
		margin-bottom: 1rem;
	}

	.form-label-group input,
	.form-label-group label {
		height: 3.125rem;
		padding: 0.75rem;
	}

	.form-label-group label {
		position: absolute;
		top: 0;
		left: 0;
		display: block;
		width: 100%;
		margin-bottom: 0; /* Override default `<label>` margin */
		line-height: 1.5;
		color: #495057;
		pointer-events: none;
		cursor: text; /* Match the input under the label */
		border: 1px solid transparent;
		border-radius: 0.25rem;
		transition: all 0.1s ease-in-out;
	}

	.form-label-group input::-webkit-input-placeholder {
		color: transparent;
	}

	.form-label-group input::-moz-placeholder {
		color: transparent;
	}

	.form-label-group input:-ms-input-placeholder {
		color: transparent;
	}

	.form-label-group input::-ms-input-placeholder {
		color: transparent;
	}

	.form-label-group input::placeholder {
		color: transparent;
	}

	.form-label-group input:not(:-moz-placeholder-shown) {
		padding-top: 1.25rem;
		padding-bottom: 0.25rem;
	}

	.form-label-group input:not(:-ms-input-placeholder) {
		padding-top: 1.25rem;
		padding-bottom: 0.25rem;
	}

	.form-label-group input:not(:placeholder-shown) {
		padding-top: 1.25rem;
		padding-bottom: 0.25rem;
	}

	.form-label-group input:not(:-moz-placeholder-shown) ~ label {
		padding-top: 0.25rem;
		padding-bottom: 0.25rem;
		font-size: 12px;
		color: #777;
	}

	.form-label-group input:not(:-ms-input-placeholder) ~ label {
		padding-top: 0.25rem;
		padding-bottom: 0.25rem;
		font-size: 12px;
		color: #777;
	}

	.form-label-group input:not(:placeholder-shown) ~ label {
		padding-top: 0.25rem;
		padding-bottom: 0.25rem;
		font-size: 12px;
		color: #777;
	}

	.form-label-group input:-webkit-autofill ~ label {
		padding-top: 0.25rem;
		padding-bottom: 0.25rem;
		font-size: 12px;
		color: #777;
	}

	/* Fallback for Edge
-------------------------------------------------- */
	@supports (-ms-ime-align: auto) {
		.form-label-group {
			display: -ms-flexbox;
			display: flex;
			-ms-flex-direction: column-reverse;
			flex-direction: column-reverse;
		}

		.form-label-group label {
			position: static;
		}

		.form-label-group input::-ms-input-placeholder {
			color: #777;
		}
	}
</style>

<template>
	<div>
		<container classes="set-min-height">
			<template #content>
				<login-form></login-form>
			</template>
		</container>
		<the-footer></the-footer>
	</div>
</template>

<script>
	import container from "../../components/ContainerFrontPages";
	import LoginForm from "../../components/auth/LoginForm";
	import TheFooter from "../../components/auth/TheFooter";
	export default {
		name: "login",
		components: {
			container,
			LoginForm,
			TheFooter,
		},

		data() {
			return {};
		},
	};
</script>

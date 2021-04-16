<template>
	<div>
		<container classes="set-min-height">
			<template #content>
				<registration-form></registration-form>
			</template>
		</container>
		<the-footer></the-footer>
	</div>
</template>

<script>
	import container from "../../components/ContainerFrontPages";
	import RegistrationForm from "../../components/auth/RegistrationForm";
	import TheFooter from "../../components/auth/TheFooter";
	export default {
		name: "register",
		components: {
			container,
			RegistrationForm,
			TheFooter,
		},

		data() {
			return {};
		},
	};
</script>

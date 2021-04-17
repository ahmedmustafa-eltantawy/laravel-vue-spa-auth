<template>
	<container classes="mt-5">
		<template #content>
			<div class="jumbotron">
				<h1>Welcom {{ user }}</h1>
				<p class="lead">This is a SPA using Laravel & vuejs</p>
				<router-link class="btn btn-primary" :to="{ name: 'logout' }"
					>Logout</router-link
				>
			</div>
		</template>
	</container>
</template>

<script>
	import { mapGetters, mapActions } from "vuex";
	import axios from "axios";
	export default {
		computed: {
			...mapGetters("auth", ["errors", "user"]),
			...mapGetters("user", ["user"]),
		},

		methods: {
			...mapActions("user", ["setUserData"]),
		},
		beforeRouteEnter(to, from, next) {
			axios
				.get("http://127.0.0.1:8000/api/statistics", {
					headers: {
						Authorization: "Bearer " + localStorage.getItem("authToken"),
					},
				})
				.then((res) => {
					next((vm) => {
						vm.$store.dispatch("user/setUserData", res.data.resposne.user);
					});
				})
				.catch((err) => {
					if (err.response) {
						next({ name: "login" });
					}
				});
		},
	};
</script>

const routes = [
	{
		path: "/login",
		name: "login",
		component: () => import("../views/auth/login.vue"),
	},

	{
		path: "/register",
		name: "register",
		component: () => import("../views/auth/register.vue"),
	},
];

export default routes;

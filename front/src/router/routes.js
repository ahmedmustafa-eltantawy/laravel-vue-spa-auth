const guest = (to, from, next) => {
	if (!localStorage.getItem("authToken")) {
		return next();
	} else {
		return next("/");
	}
};
const auth = (to, from, next) => {
	if (localStorage.getItem("authToken")) {
		return next();
	} else {
		return next("/login");
	}
};

const routes = [
	{
		path: "/",
		name: "home",
		component: () => import("../views/home.vue"),
	},
	{
		path: "/login",
		name: "login",
		beforeEnter: guest,
		component: () => import("../views/auth/login.vue"),
	},

	{
		path: "/register",
		name: "register",
		beforeEnter: guest,
		component: () => import("../views/auth/register.vue"),
	},

	{
		path: "/logout",
		name: "logout",
		beforeEnter: auth,
		component: () => import("../views/auth/register.vue"),
	},

	{
		path: "/dashboard",
		name: "dashboard",
		beforeEnter: auth,
		component: () => import("../views/dashboard/AdminWelcome.vue"),
		children: [
			{
				path: "",
				name: "admin-welcome",
				component: () => import("../views/dashboard/AdminWelcome.vue"),
			},
		],
	},

	{
		path: "/user/profile",
		name: "user-profile",
		component: () => import("../views/dashboard/UserProfile.vue"),
	},
];

export default routes;

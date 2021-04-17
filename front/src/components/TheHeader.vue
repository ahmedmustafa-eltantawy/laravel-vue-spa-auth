<template>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		<container>
			<template #content>
				<a class="navbar-brand" href="#">Laravel SPA</a>
				<button
					class="navbar-toggler"
					type="button"
					data-toggle="collapse"
					data-target="#navbarCollapse"
					aria-controls="navbarCollapse"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<ul class="navbar-nav">
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'home' }"
								>home</router-link
							>
						</li>

						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'admin-welcome' }"
								>Dashboard</router-link
							>
						</li>
					</ul>

					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<router-link
								class="nav-link text-dark btn btn-warning ml-2"
								:to="{ name: 'logout' }"
								>Logout</router-link
							>
						</li>

						<li>
							<router-link
								class="nav-link btn btn-primary ml-2"
								:to="{ name: 'login' }"
								>Login</router-link
							>
						</li>
						<li>
							<router-link
								class="nav-link btn btn-success ml-2"
								:to="{ name: 'register' }"
								>Register</router-link
							>
						</li>
					</ul>
				</div>
			</template>
		</container>
	</nav>
</template>

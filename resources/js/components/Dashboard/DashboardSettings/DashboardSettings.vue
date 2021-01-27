<template>
	<div>
		<div class="container-fluid shadow-sm p-4">
			<div class="container">
				<h4 class="mb-0">
					Account Settings
				</h4>
			</div>
		</div>
		<div class="container-fluid">
			<div class="container">
				<div class="row pt-4">
					<div class="col-12 col-md-2 mb-2 mb-md-0">
						<nav class="nav nav-pills nav-fill flex-column">
							<router-link class="nav-link" :to="{ name: 'dashboard.settings.profile' }">
								Profile
							</router-link>
							<router-link class="nav-link" :to="{ name: 'dashboard.settings.login' }">
								Login
							</router-link>
						</nav>
					</div>
					<div class="col-12 col-md-10">
						<div class="row">
							<div class="col-lg-6 pb-4">
								<router-view />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		mounted() {
			console.log('DashboardSettings mounted');
		},
	};
</script>

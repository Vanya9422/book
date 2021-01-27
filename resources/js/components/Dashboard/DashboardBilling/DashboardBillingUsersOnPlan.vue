<template>
	<div>
		<h5 class="mb-3 pt-3">
			<strong>Users on Plan</strong>
		</h5>
		<p>
			You've got 1 user (including you) with access to one or more of your private repositories.
		</p>
		<p>
			Upgrade to a Standard plan if you want to give access to more than 5 users. See your plan details for more information.
		</p>

		<div class="row justify-content-between align-items-center pt-4 pb-2 d-none d-md-flex">
			<div class="col">
				<strong>User</strong>
			</div>
			<div v-if="false" class="col-6 col-md-4 col-lg-3 text-center">
				<strong>Access Type</strong>
			</div>
			<div class="col-12 col-md-4 col-lg-3 text-center">
				<strong>Actions</strong>
			</div>
		</div>
		<div class="row justify-content-between align-items-center pt-2">
			<div class="col">
				<div class="d-flex align-items-center">
					<strong class="mr-3 d-md-none">User:</strong>
					<div class="d-flex align-items-center">
						<span class="rounded-circle overflow-hidden" style="font-size: 0px;">
							<img src="/img/avatar.png" width="25" alt="">
						</span>
						<span class="ml-2">Team Name</span>
					</div>
				</div>
			</div>
			<div v-if="false" class="col-6 col-md-4 col-lg-3 text-center">
				<div class="d-inline-flex align-items-center">
					<strong class="mr-3 d-md-none">Access Type:</strong>
					<span>Admin</span>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 text-center p-md-0 p-2">
				<button class="btn btn-primary btn-block">
					View Access
				</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		components: {
			//
		},
		data() {
			return {
				//
			};
		},

		mounted() {
			console.log('DashboardBillingUsersOnPlan mounted!');
		},

		methods: {
			//
		},
	};
</script>

<style scoped>

</style>

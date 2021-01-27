<template>
	<div>
		<div class="col-12 mb-4 pb-3 pt-3 border-bottom">
			<div class="row justify-content-between align-items-center">
				<strong>You're on the Free plan.</strong>
				<button class="btn btn-primary" data-toggle="modal" data-target="#upgrade">
					<span class="d-flex align-items-center">
						<span style="font-size: 0;" class="mr-2">
							<img src="/img/upload.svg" width="15" alt="">
						</span>
						<span>
							Upgrade Plan
						</span>
					</span>
				</button>
			</div>
		</div>
		<h5 class="mb-3">
			<strong>Usage summary</strong>
		</h5>
		<div class="d-flex justify-content-between align-items-center">
			<div>
				<div class="mb-2">
					<strong>1 user</strong> on your plan
				</div>
				<router-link class="btn btn-light" :to="{ name: 'dashboard.billing.users_on_plan' }">
					See the Users
				</router-link>
			</div>
			<div class="h2 mb-0">
				<strong>$0</strong>
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
			console.log('DashboardBillingPlanDetails mounted!');
		},

		methods: {
			//
		},
	};
</script>

<style scoped>

</style>

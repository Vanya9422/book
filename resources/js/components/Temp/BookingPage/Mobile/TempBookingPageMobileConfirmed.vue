<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto px-3 py-5 card-body rounded-0 border-0 text-center" style="min-height: 100%; width: 100%; max-width: 360px;">
				<img class="mx-auto" src="/img/confirm_primary.svg" width="60" alt="">
				<h4 class="text-center mt-2">
					Confirmed
				</h4>
				<div class="text-secondary text-center border-bottom pb-5 mt-3">
					You are scheduled with Ruslan.
				</div>
				<div class="col-lg-12 pt-5 pb-4">
					<span>A calendar invitation has been sent to your email.</span>
					<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-4 mt-4 active">
						<div class="row align-items-center">
							<div class="col text-left d-flex align-items-center">
								<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
							</div>
							<div class="row pr-3 m-0 flex-column align-items-end">
								<span class="h5 mb-0 d-flex align-items-center">
									<strong class="mr-2">$55</strong>
									<small class="text-right">
										<span class="badge badge-light">30min</span>
									</small>
								</span>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center justify-content-center mt-2">
						<img src="/img/clock.svg" width="20" alt="" style="opacity: .5;">
						<strong class="d-block ml-2">{{ time }}, {{ date }}</strong>
					</div>
					<div class="d-flex align-items-center justify-content-center mt-2">
						<img src="/img/country-flags/DE.png" width="20" alt="">
						<span class="ml-2">Pakistan, Maldives Time</span>
					</div>
				</div>
				<router-link :to="{ name: 'dashboard.scheduled.upcoming' }" class="btn btn-primary mx-auto mt-4">
					Go to Scheduled Bookings
				</router-link>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		components: {},
		data() {
			return {
				date: 'Friday, January 10, 2020',
				time: '14:00 - 14:45',
			};
		},

		mounted() {

		},

		methods: {},
	};
</script>

<style scoped>

</style>

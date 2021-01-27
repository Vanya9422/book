<template>
	<div>
		<div class="container-fluid border-bottom p-4 admin_main">
			<div class="container">
				<div class="d-flex">
					<h2 class="mb-0">
						Billing
					</h2>
					<!--BookingPages_l -->
					<div v-if="Object.keys(bookingPages).length" class="dropdown ml-3">
						<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="d-inline-flex align-items-center mr-2">
								<span class="rounded-circle overflow-hidden" style="font-size: 0;">
									<img :src="selectedBookingPage.computedUserAvatar.url" width="15" alt="">
								</span>
								<span class="ml-2">{{ selectedBookingPage.computedTitle }}</span>
							</span>
						</button>
						<div class="dropdown-menu border-0 shadow" aria-labelledby="dropdownMenuButton">
							<a v-for="(bookingPage) in bookingPages" :key="bookingPage.id" class="dropdown-item d-flex align-items-center"
								:class="{ 'active': bookingPage === selectedBookingPage }"
								@click.prevent="onBookingPageSelected(bookingPage)">
								
								<span class="rounded-circle overflow-hidden" style="font-size: 0;">
									<img src="/img/avatar.png" width="15" alt="">
								</span>
								<span class="ml-2">{{ bookingPage.computedTitle }}</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid pt-4">
			<div class="row flex-column align-items-center mt-3">
				<div class="col-md-9 col-12">
					<ul class="nav nav-tabs asd">
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'dashboard.billing.overview' }" exact>
								Transactions
							</router-link>
						</li>
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'dashboard.billing.cards' }">
								Cards
							</router-link>
						</li>
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'dashboard.billing.payouts' }">
								Payouts
							</router-link>
						</li>
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'dashboard.billing.plan_details' }">
								Plan Details
							</router-link>
						</li>
						<li class="nav-item">
							<router-link class="nav-link" :to="{ name: 'dashboard.billing.users_on_plan' }">
								Users on Plan
							</router-link>
						</li>
					</ul>
					<div v-if="isLoaded" class="h-100 d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 65px);">
						<span><img src="/img/preloader.svg" width="40" alt=""></span>
					</div>
					<router-view v-else />
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				isLoaded: true,
				selectedBookingPage: null,
				bookingPages: {},
			};
		},

		async mounted() {
			this.getBookingPages();
		},
		
		methods: {
			async getBookingPages() {
				let response = await this.$http.get(`/users/me/booking_pages`);
				this.bookingPages = response.data.data;
				this.selectedBookingPage = this.bookingPages[0];
				await this.$store.dispatch('setBookingPageData', this.bookingPages[0]);
				this.isLoaded = false;
			},
			async onBookingPageSelected(bookingPage) {
				this.selectedBookingPage = bookingPage;
				await this.$store.dispatch('setBookingPageData', bookingPage);
			},
		},
	};
</script>

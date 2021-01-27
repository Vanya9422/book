<template>
	<div class="d-flex align-items-center">
		<div class="container py-2" style="max-height: 100%;">
			<div class="card shadow">
				<div class="card-body p-4 d-flex flex-column align-items-center">
					<div class="[ powered-by-flag ]">
						<a href="#" class="[ powered-by-flag__container ] shadow text-center bg-dark py-2 px-4">
							<small class="text-white">POWERED BY</small>
							<small>
								<strong class="text-white d-block">Bookify.ai</strong>
							</small>
						</a>
					</div>
					<div class="col-lg-12 text-center d-flex flex-column align-items-center">
						<img class="mb-3"
							:src="bookingPage.computedUserAvatar.url" style="width: 65px; height: 65px; border-radius: 50%;"
							:alt="bookingPage.computedTitle">
						<h6 class="text-secondary">{{ bookingPage.computedTitle }}</h6>
						<span class="d-block text-secondary col-lg-3 mt-2 text-center">
							<small>{{ bookingPage.welcomeMessage }}</small>
						</span>
					</div>
					<div class="col-lg-9 mt-4 p-4">
						<div class="row">
							<router-link v-for="(bookingType) in bookingPage.bookingTypes" class="col-lg-6 mb-4"
								:key="bookingType.id"
								:to="{ name: 'booking_page.booking_type', params: { locale, bookingPageSlug: bookingPage.slug, bookingTypeSlug: bookingType.slug } }"
								style="text-decoration: none;">
								<div class="card btn btn-light p-0" style="min-height: 180px;">
									<div class="card-body p-4">
										<div class="col-lg-12">
											<div class="row">
												<div class="circle rounded-circle"
													style="width: 30px; height: 30px;"
													:style="{ 'background-color': `#${bookingType.color}` }"></div>
												<div
													class="col d-flex justify-content-between align-items-center pr-0">
													<span>{{ bookingType.name }}</span>
													<strong>&#x276F;</strong>
												</div>
											</div>
										</div>
									</div>
								</div>
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {
				//
			};
		},

		computed: {
			...mapState([
				'locale',
				'bookingPage',
			]),
		},

		mounted() {
			console.log('BookingPageHome mounted');
		},

		methods: {
			//
		},
	};
</script>

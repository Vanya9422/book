<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto px-3 py-0 card-body rounded-0 border-0"
				style="min-height: 100%; width: 100%; max-width: 820px;">
				<div class="row position-relative">
					<div class="col-6 pt-2 border-right" style="padding-right: 50px; z-index: 100000;">
						<div class="sticky-top pt-3">
							<div class="d-flex align-items-center flex-column mb-2 pb-2 border-bottom">
								<div class="col-2 px-0 pb-2">
									<div class="square-box rounded overflow-hidden">
										<div class="square-box-in">
											<img src="/img/image.png" alt="">
										</div>
									</div>
								</div>
								<h3>
									Pepsi Corporation
								</h3>
							</div>
							<div class="d-flex py-3 align-items-center bg-white sticky-top">
								<div class="col-3 pl-0 rounded-circle position-relative" style="font-size: 0px;">
									<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
									<div class="p-2 rounded-circle bg-success position-absolute border border-white"
										style="border-width: 3px !important; box-sizing: border-box; top: 74%; right: 74%;"></div>
								</div>
								<div class="col-9 pr-0 pl-1 pt-2">
									<h4>
										Mark Bruk
									</h4>
									<div class="d-flex justify-content-start align-items-center mb-2">
										<img src="/img/country-flags/DE.png" alt="">
										<span class="ml-2">Montreal</span>
									</div>
									<span class="d-flex justify-content-start align-items-center"><img
										src="/img/suitcase.svg" alt="" width="24" style="opacity: .2;"><span
										class="ml-2">Super Laywer at</span> <a
										class="btn btn-link p-1 text-decoration-none ml-1"
										href="#">Pepsi Corporation</a></span>
								</div>
							</div>
							<div class="row py-3">
								<div class="col-12">
									<div v-for="(bookingType) in bookingPage.bookingTypes" :key="bookingType.id"
										class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-2" :class="{ 'active' : bookingType === selectedBookingType }" @click="onBookingTypeSelected(bookingType)">
										<div class="row align-items-center">
											<div class="col text-left">
												<strong class="d-block">{{ bookingType.name }}</strong>
											</div>
											<div class="row pr-3 m-0 flex-column align-items-end">
												<span class="h5 mb-0 d-flex align-items-center">
													<strong v-if="false" class="mr-2">${{ bookingType.rateValue }}/h</strong>
													<div class="dropdown dropleft mr-2">
														<a id="dropdownMenuLink" class="btn btn-link p-1" href="#"
															style="font-size: 0;" role="button" data-toggle="dropdown"
															aria-haspopup="true" aria-expanded="false">
															<img src="/img/info.svg" alt="" width="15" style="opacity: .2;">
														</a>
														<div class="dropdown-menu border-0 shadow p-3"
															style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
															<div
																class="d-flex justify-content-between align-items-center mb-4">
																<strong>Rate Details</strong>
																<a class="text-decoration-none text-dark h4 mb-0" href="#"
																	style="opacity: .3; line-height: 0;">×</a>
															</div>
															<div
																class="d-flex justify-content-between align-items-center py-2 border-bottom">
																<span>Base Price</span>
																<span>$50</span>
															</div>
															<div
																class="d-flex justify-content-between align-items-center py-2 border-bottom">
																<span>Transaction Fee</span>
																<span>$1</span>
															</div>
															<div
																class="d-flex justify-content-between align-items-center pt-2">
																<span>Platform Fee</span>
																<span>$1</span>
															</div>
														</div>
													</div>
													<small class="text-right">
														<span class="badge badge-light">30min</span>
													</small>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 position-relative" style="padding-left: 50px;">
						<div class="sticky-top pt-3" style="height: 100vh;">
							<div class="d-flex justify-content-end align-items-center mb-5">
								<span>Powered by <strong>Bookify</strong></span>
								<router-link class="ml-1 btn btn-link p-1"
									:to="{ name: 'main.home', params: { locale } }">
									<img src="/img/logo.svg" alt="" width="30" height="30">
								</router-link>
							</div>
							<div class="rounded overflow-hidden mb-2" style="font-size: 0px;">
								<iframe src="https://www.youtube.com/embed/-IMRGMGLuPY"
									allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
									allowfullscreen="allowfullscreen" frameborder="0" width="100%"
									height="100%"></iframe>
							</div>
							<div class="scroll-text-container" style="height: 230px;">
								<div class="row m-0 overflow-auto h-100">
									<div class="col-12 pl-0 py-3">
										<span>
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
											Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
										</span>
									</div>
								</div>
							</div>
							<h3 class="d-block">
								Rate
							</h3>
							<h4>
								$50 / 30 mins
							</h4>
							<div class="pb-3 pt-4" style="bottom: 0; right: 0; left: 0;">
								<router-link class="btn btn-block btn-primary py-3 next-step"
									:to="{ name: 'booking_page.home', params: { locale: 'en' } }">
									<span class="d-flex justify-content-center align-items-center w-100">
										<span class="h4 mb-0">Book Now</span>
									</span>
								</router-link>
							</div>
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
				selectedBookingType: this.$store.state.bookingPage.bookingTypes[0],
			};
		},
		
		computed: {
			...mapState([
				'locale',
				'bookingPage',
			]),
		},
		
		mounted() {
			$('.dropdown-toggle').dropdown();
		},
		
		methods: {
			onBookingTypeSelected(bookingType) {
				this.selectedBookingType = bookingType;
			},
		},
	};
</script>

<style scoped>

</style>

<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto px-3 py-0 card-body rounded-0 border-0" style="min-height: 100%; width: 100%; max-width: 820px;">
				<div class="row position-relative" style="height: 100vh;">
					<div class="col-6 pt-2 border-right d-flex flex-column align-items-center justify-content-center" style="padding-right: 50px;">
						<button class="btn btn-back p-0 position-absolute rounded-circle" style="left: 15px; top: 15px; font-size: 0;" @click="goBack">
							<img src="/img/left.svg" width="30" alt="">
						</button>
						<div class="sticky-top pt-3">
							<div class="d-flex align-items-center flex-column mb-2 pb-2 border-bottom position-relative">
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

							<div class="d-flex py-3 align-items-center bg-white">
								<div class="col-3 pl-0 rounded-circle position-relative" style="font-size: 0px;">
									<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
									<div class="p-2 rounded-circle bg-success position-absolute border border-white" style="border-width: 3px !important; box-sizing: border-box; top: 74%; right: 74%;"></div>
								</div>
								<div class="col-9 pr-0 pl-1 pt-2">
									<h4>
										Mark Bruk
									</h4>
									<div class="d-flex justify-content-start align-items-center mb-2">
										<img src="/img/country-flags/DE.png" alt="">
										<span class="ml-2">Montreal</span>
									</div>
									<span class="d-flex justify-content-start align-items-center"><img src="/img/suitcase.svg" width="24" alt="" style="opacity: .2;"><span class="ml-2">Super Laywer at</span> <a href="#" class="btn btn-link p-1 text-decoration-none ml-1">Pepsi Corporation</a></span>
								</div>
							</div>

							<div class="row pt-3">
								<div class="col-12 overflow-auto" style="max-height: 190px;">
									<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-2 active" style="border-left-width: 5px !important;">
										<div class="row align-items-center">
											<div class="col text-left d-flex align-items-center">
												<img src="/img/confirm_primary.svg" width="20" alt="">
												<strong class="d-block ml-2" style="line-height: 1;">Booking Type Name</strong>
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
								</div>
							</div>
							<div class="mt-3">
								<div class="mb-2 d-flex align-items-center">
									<img src="/img/event.svg" width="20" style="opacity: .2;" alt="">
									<span class="ml-2">{{ date }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 pt-3 position-relative d-flex flex-column align-items-center justify-content-center" style="padding-left: 50px;">
						<div class="d-flex justify-content-end align-items-center mb-5 position-absolute" style="top: 15px; right: 15px;">
							<span>Powered by <strong>Bookify</strong></span>
							<router-link class="ml-1 btn btn-link p-1" :to="{ name: 'main.home', params: { locale } }">
								<img src="/img/logo.svg" width="30" height="30" alt="">
							</router-link>
						</div>
						<div class="sticky-top w-100">
							<h5 class="text-center mb-4">
								Pick a Time
							</h5>

							<div v-if="showTime" class="btn-group-vertical d-block">
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
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

		components: {},
		data() {
			return {
				date: 'Please select date on previous page',
				time: '09:00',
				showTime: false,
			};
		},
		created() {
			if (this.$route.params.date) {
				this.date = this.$route.params.date;
				this.showTime = true;
			}
			console.log(this.$route.params);
		},

		mounted() {

		},

		methods: {
			goBack: function () {
				this.$router.go(-1); // i don't think it's correct
			},
			goNext: function () {
				this.$router.push({ name: 'temp.booking_page.desktop.confirm', params: { date: this.date, time: this.time } });
			},
		},
	};
</script>

<style scoped>

</style>

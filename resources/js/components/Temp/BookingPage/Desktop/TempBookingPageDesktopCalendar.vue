<template>
	<div class="d-flex flex-column flex-nowrap align-items-center">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto px-3 py-0 card-body rounded-0 border-0"
				style="min-height: 100%; width: 100%; max-width: 820px;">
				<div class="row position-relative" style="height: 100vh;">
					<div
						class="col-6 position-relative pt-2 border-right d-flex align-items-center justify-content-center flex-column"
						style="padding-right: 50px;">
						<button class="btn btn-back p-0 position-absolute rounded-circle"
							style="left: 15px; top: 15px; font-size: 0;" @click="goBack">
							<img src="/img/left.svg" alt="" width="30">
						</button>
						<div class="pt-3">
							<div
								class="w-100 d-flex align-items-center flex-column mb-2 pb-2 border-bottom position-relative">
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
							
							<div class="w-100 d-flex py-3 align-items-center bg-white">
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
										class="ml-2">Super Laywer at</span> <a class="btn btn-link p-1 text-decoration-none ml-1"
										href="#">Pepsi Corporation</a></span>
								</div>
							</div>
							
							<div class="row pt-3 w-100">
								<div class="col-12 overflow-auto p-0" style="max-height: 190px;">
									<div
										class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-2 active"
										style="border-left-width: 5px !important;">
										<div class="row align-items-center">
											<div class="col text-left d-flex align-items-center">
												<img src="/img/confirm_primary.svg" alt="" width="20">
												<strong class="d-block ml-2"
													style="line-height: 1;">Booking Type Name</strong>
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
						</div>
					</div>
					<div class="col-6 pt-3 position-relative" style="padding-left: 50px;">
						<div class="d-flex justify-content-end align-items-center mb-5 position-absolute"
							style="top: 15px; right: 15px;">
							<span>Powered by <strong>Bookify</strong></span>
							<router-link class="ml-1 btn btn-link p-1" :to="{ name: 'main.home', params: { locale } }">
								<img src="/img/logo.svg" alt="" width="30" height="30">
							</router-link>
						</div>
						<div class="sticky-top h-100 d-flex justify-content-center flex-column align-items-center"
							style="height: 100vh;">
							<h5 class="text-center mb-4">
								Pick a Day
							</h5>
							<VCalendar class="border-0" :attributes="calendarAttributes" :masks="calendarMasks"
								is-expanded is-inline @dayclick="tempFuncToGoNextPage" />
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
		components: {
			VCalendar: () => import('v-calendar/lib/components/calendar.umd'),
		},
		
		data() {
			return {
				form: null,
				timeFormat: this.$store.state.auth.user ? this.$store.state.auth.user.timeFormat : '12H',
				selectedLocalityTime: null,
				localitySelectSelectedOption: (this.$store.state.auth.user ? this.$store.state.auth.user.locality : this.$store.state.detectedLocality),
				localitySelectOptions: [],
				localitySelectCancel: null,
				localityTimeInterval: null,
				calendarCurrentDate: null,
				calendarCurrentMonthFirstDate: null,
				calendarCurrentMonthLastDate: null,
				calendarSelectedDate: null,
				availableDates: [],
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
				'detectedLocality',
				'bookingPage',
				'bookingType',
				'timeFormats',
			]),
			
			calendarMasks() {
				return { weekdays: 'WWW' };
			},
			
			calendarAttributes() {
				return [
					{
						key: 'just-force-to-update-attributes',
						
						dates: {
							weekdays: [1, 2, 3, 4, 5, 6, 7],
						},
					},
					
					...(this.calendarCurrentDate ? [{
						dot: 'red',
						dates: this.calendarCurrentDate,
					}] : []),
					
					{
						highlight: {
							color: 'blue',
							fillMode: 'light',
						},
						
						dates: this.availableDates.map((availableDate) => {
							return new Date(availableDate.value);
						}),
					},
					
					{
						highlight: {
							color: 'blue',
							fillMode: 'solid',
						},
						
						dates: this.calendarSelectedDate,
					},
				];
			},
			
			selectedAvailableDateSpots() {
				let selectedAvailableDate = this.availableDates.find((availableDate) => {
					return availableDate.value === this.$moment(this.calendarSelectedDate).format('YYYY-MM-DD');
				});
				
				if (!selectedAvailableDate) {
					return [];
				}
				
				return selectedAvailableDate.spots;
			},
		},
		
		methods: {
			goBack() {
				this.$router.go(-1); // i don't think it's correct
			},
			
			tempFuncToGoNextPage(data) {
				this.$router.push({ name: 'temp.booking_page.desktop.time', params: { date: data.ariaLabel } });
			},
		},
	};
</script>

<style scoped>

</style>

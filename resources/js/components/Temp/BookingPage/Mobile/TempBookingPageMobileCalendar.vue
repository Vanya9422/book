<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto p-3 card-body rounded-0 border-0"
				style="min-height: 100%; width: 100%; max-width: 360px;">
				<div class="d-flex flex-column align-items-center pb-3 position-relative">
					<button class="btn btn-back p-0 position-absolute rounded-circle" style="left: 0; font-size: 0;"
						@click="goBack">
						<img src="/img/left.svg" alt="" width="30">
					</button>
					<div class="col-2 p-1 bg-white rounded-circle" style="font-size: 0px;">
						<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
					</div>
					<strong>Mark Bruk</strong>
					<span class="d-block">Super Laywer Consultant</span>
				</div>
				<hr>
				<div>
					<!-- <VCalendar class="border-0" :attributes="calendarAttributes"
                               :masks="calendarMasks" is-expanded is-inline
                               @dayclick="tempFuncToGoNextPage" /> -->
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
		
		mounted() {
			//
		},
		
		methods: {
			goBack: function () {
				this.$router.go(-1); // i don't think it's correct
			},
			tempFuncToGoNextPage: function (data) {
				this.$router.push({ name: 'temp.booking_page.mobile.time', params: { date: data.ariaLabel } });
			},
		},
	};
</script>

<style scoped>

</style>

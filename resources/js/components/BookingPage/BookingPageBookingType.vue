<template>
	<div class="d-flex align-items-center">
		<div class="container p-0">
			<div class="card flex-row rounded-0">
				<div v-if="false" class="[ powered-by-flag ]">
					<a class="[ powered-by-flag__container ] shadow text-center bg-dark py-2 px-4" href="#">
						<small class="text-white">POWERED BY</small>
						<small>
							<strong class="text-white d-block">Bookify.ai</strong>
						</small>
					</a>
				</div>
				<div class="card-body px-3 py-0">
					<div class="d-flex">
						<div class="border-right pr-3 py-3" :style="{ 'width': true ? '35%' : '50%' }">
							<div class="col-lg-12 border-bottom pb-4">
								<div class="row">
									<div class="col-2 px-0">
										<div class="square-box rounded overflow-hidden">
											<div class="square-box-in">
												<img src="/img/image.png" alt="">
											</div>
										</div>
									</div>
									<div class="col-10 pr-0">
										<strong>Mark's Bookify Page</strong>
										<div class="col-12">
											<div class="row align-items-center">
												<img src="/img/country-flags/DE.png" alt="">
												<small class="ml-2">Montreal</small>
											</div>
										</div>
										<small>1 in team from $55 per hour</small>
									</div>
								</div>
							</div>
							<div class="col-lg-12 px-0 border-bottom rounded overflow-hidden"
								:style="{ 'font-size': '0' }">
								<iframe src="https://www.youtube.com/embed/-IMRGMGLuPY"
									allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
									allowfullscreen frameborder="0" width="100%"></iframe>
							</div>
							<div class="col-12 pb-4">
								<div class="row align-items-start">
									<div class="col-2 mt-n3 p-1 bg-white rounded-circle" :style="{ 'font-size': '0' }">
										<img src="/img/avatar.png" alt="" :style="{ 'border-radius': '50%' }"
											width="100%">
									</div>
									<div class="col-9 pr-0 pt-2">
										<strong>Mark Bruk</strong>
										<span class="d-block">Super Laywer Consultant</span>
									</div>
									<div class="col-1 pt-2 px-0">
										<button class="btn btn-primary btn-block btn-sm">
											+
										</button>
									</div>
								</div>
							</div>
							<div class="row pt-4 pb-4 border-top border-bottom">
								<div class="col-12 overflow-auto" :style="{ 'max-height': '100px' }">
									<span>
										Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
									</span>
								</div>
							</div>
							<div class="row pt-4">
								<div v-for="index in 3" :key="index" class="col-12 overflow-auto"
									:style="{ 'max-height': '190px' }">
									<div class="p-3 rounded btn btn-outline-primary btn-block text-decoration-none mb-2"
										href="#" :class="{ 'active' : index === 0 }">
										<div class="row">
											<div class="col text-left">
												<strong class="d-block">Booking Type Name</strong>
												<span>30min</span>
											</div>
											<div class="row pr-3 m-0 flex-column align-items-end">
												<span class="h5">
													<strong class="mr-2">$55</strong>
													<sup>
														<small>Per Hour</small>
													</sup>
												</span>
												<div class="row m-0">
													<a class="btn btn-link p-0 mr-2" href="#" style="font-size: 0;">
														<img src="/img/video.svg" alt="" width="20">
													</a>
													<a class="btn btn-link p-0 mr-2" href="#" style="font-size: 0;">
														<img src="/img/phone.svg" alt="" width="20">
													</a>
													<a class="btn btn-link p-0" href="#" style="font-size: 0;">
														<img src="/img/skype.svg" alt="" width="20">
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="p-3" :style="{ 'width': '50%' }">
							<h5 class="mb-4">
								Select a Date & Time
							</h5>
							<VCalendar v-if="isMounted" class="border-0" :attributes="calendarAttributes"
								:masks="calendarMasks" is-expanded is-inline @dayclick="onCalendarDayClicked"
								@update:to-page="onCalendarMonthChanged" />
							<div v-else>
								Calendar Loading...
							</div>
							<div class="form-group">
								<label class="d-flex justify-content-between align-items-center" for="#exampleSelect5">
									<span>Select your City/Time Zone</span>
									<span v-if="selectedLocalityTime" class="text-secondary">
										<small>Current Time: {{ selectedLocalityTime }}</small>
									</span>
								</label>
								<VSelect id="exampleSelect5" v-model="localitySelectSelectedOption"
									:options="localitySelectOptions" label="fullAddress"
									placeholder="Select localtion..." :filterable="false"
									@input="onLocalityInputChanged" @search="onLocalityInputSearchChanged">
									<template slot="selected-option" slot-scope="option">
										<div class="d-flex align-items-center">
											<img class="mr-1" :src="`/img/country-flags/${option.countryCode}.png`">
											{{ option.fullAddress }}
										</div>
									</template>
									<template slot="option" slot-scope="option">
										<div class="d-flex align-items-center">
											<img class="mr-1" :src="`/img/country-flags/${option.countryCode}.png`">
											{{ option.fullAddress }}
										</div>
									</template>
									<template slot="no-options">
										Type to search your location...
									</template>
								</VSelect>
								<div class="d-flex justify-content-end mt-2">
									<div class="custom-control custom-switch">
										<label class="mr-4 pr-3" :for="`${_uid}-time-format-checkbox`">AM/PM</label>
										<input :id="`${_uid}-time-format-checkbox`" v-model="timeFormat" type="checkbox"
											class="custom-control-input" :true-value="'24H'"
											:false-value="'12H'" @change="onTimeFormatChanged">
										<label class="custom-control-label"
											:for="`${_uid}-time-format-checkbox`">24h</label>
									</div>
								</div>
							</div>
						</div>
						<div v-if="calendarSelectedDate" class="pt-4" style="min-width: 200px;">
							<div class="pt-4 mb-4 pb-4">
								<div class="pt-3">
									{{ $moment(calendarSelectedDate).format('dddd, MMMM, D') }}
								</div>
							</div>
							<div class="btn-group-vertical d-block">
								<div v-for="(availableSpot) in selectedAvailableDateSpots" :key="availableSpot" class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											{{ $moment.tz(availableSpot, localitySelectSelectedOption.timezoneCode).format(timeFormats[timeFormat].replace(':ss', '')) }}
										</button>
										<a type="button" class="btn btn-secondary btn-block mt-0 ml-2"
											href="scheduled_booking_type_form.html">
											Confirm
										</a>
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
	import { mapState } from 'vuex';
	import { debounce } from 'lodash';
	
	export default {
		components: {
			VCalendar: () => import('v-calendar/lib/components/calendar.umd'),
		},
		
		data() {
			return {
				isMounted: false,
				form: null,
				timeFormat: this.$store.state.auth.user ? this.$store.state.auth.user.timeFormat : '12H',
				selectedLocalityTime: null,
				localitySelectSelectedOption: (this.$store.state.auth.user ? this.$store.state.auth.user.locality : this.$store.state.detectedLocality),
				localitySelectOptions: [],
				localitySelectCancel: null,
				localityTimeInterval: null,
				calendarCurrentDate: null,
				calendarCurrentMonthFirstDate: null,
				calendarNextMonthFirstDate: null,
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
		
		created() {
			console.log('CREATED!');
		},
		
		mounted() {
			this.isMounted = true;
			console.log('MOUNTED!');
			this.updateSelectedLocalityTime();
			this.updateCalendarCurrentDate();
			
			this.localityTimeInterval = setInterval(() => {
				this.updateSelectedLocalityTime();
				this.updateCalendarCurrentDate();
			}, 1000);
		},
		
		beforeDestroy() {
			clearInterval(this.localityTimeInterval);
		},
		
		methods: {
			async onLocalityInputChanged() {
				if (this.localitySelectSelectedOption) {
					let response = await this.$http.get(`/localities/${this.localitySelectSelectedOption.key}`);
					
					if (!this.auth.user) {
						this.$store.commit('setDetectedLocality', response.data.data);
						localStorage.setItem('detected_locality', JSON.stringify(response.data.data));
					}
					
					this.$set(this.localitySelectSelectedOption, 'timezoneCode', response.data.data.timezoneCode);
					this.updateSelectedLocalityTime();
					this.updateCalendarCurrentDate();
					this.availableDates = [];
					await this.updateAvailableDates();
				} else {
					this.selectedLocalityTime = null;
				}
			},
			
			onTimeFormatChanged() {
				this.updateSelectedLocalityTime();
			},
			
			onLocalityInputSearchChanged(query, loading) {
				this.localitySelectCancel && this.localitySelectCancel();
				
				if (!query) {
					return;
				}
				
				loading(true);
				this.searchLocation(query, loading);
			},
			
			searchLocation: debounce(async function (query, loading) {
				try {
					let response = await this.$http.get('/localities/autocomplete', {
						params: { query },
						
						cancelToken: new this.$http.CancelToken((cancel) => {
							this.localitySelectCancel = cancel;
						}),
					});
					
					this.localitySelectOptions = response.data.data;
					loading(false);
				} catch (error) {
					if (this.$http.isCancel(error)) {
						return;
					}
					
					loading(false);
					throw error;
				}
			}, 250),
			
			updateSelectedLocalityTime() {
				if (!this.localitySelectSelectedOption || !this.localitySelectSelectedOption.timezoneCode) {
					return;
				}
				
				this.selectedLocalityTime = this.$moment.tz(
					this.localitySelectSelectedOption.timezoneCode,
				).format(this.timeFormats[this.timeFormat]);
			},
			
			updateCalendarCurrentDate() {
				if (!this.localitySelectSelectedOption || !this.localitySelectSelectedOption.timezoneCode) {
					return;
				}
				
				let calendarCurrentDate = new Date(
					this.$moment.tz(this.localitySelectSelectedOption.timezoneCode).format().slice(0, 19),
				);
				
				if (this.$moment(calendarCurrentDate).isSame(this.calendarCurrentDate, 'day')) {
					return;
				}
				
				this.calendarCurrentDate = calendarCurrentDate;
			},
			
			async updateAvailableDates() {
				let response = await this.$http.get(`/booking_types/${this.bookingType.id}/available_dates`, {
					params: {
						dateFrom: this.$moment(this.calendarCurrentMonthFirstDate).toISOString(),
						dateTo: this.$moment(this.calendarNextMonthFirstDate).toISOString(),
						timezoneCode: this.localitySelectSelectedOption.timezoneCode,
					},
				});
				
				let monthDateString = this.$moment(this.calendarCurrentMonthFirstDate).format('YYYY-MM');
				
				this.availableDates = this.availableDates.filter((availableDate) => {
					return !availableDate.value.startsWith(monthDateString);
				}).concat(response.data.data);
			},
			
			async onCalendarMonthChanged(date) {
				this.calendarCurrentMonthFirstDate = this.$moment([date.year, date.month - 1, 1]).toDate();
				this.calendarNextMonthFirstDate = this.$moment([date.year, date.month, 1]).toDate();
				await this.updateAvailableDates();
			},
			
			onCalendarDayClicked(day) {
				this.calendarSelectedDate = day.date;
			},
		},
	};
</script>

<template>
	<div>
		<div v-if="pageIsLoading" class="h-100 d-flex align-items-center justify-content-center"
			style="min-height: calc(100vh - 65px);">
			<span><img src="/img/preloader.svg" width="40" alt=""></span>
		</div>
		<div v-else>
			<div class="container-fluid shadow-sm p-4 admin_main bg-white sticky-top">
				<div class="container">
					<div class="row justify-content-between align-items-center">
						<div class="pl-3 d-flex align-items-center">
							<router-link class="btn btn-primary d-flex align-items-center"
								:to="{ name: 'dashboard.home' }">
								<img src="/img/back.svg" alt="" width="12">
								<span class="ml-2">Back</span>
							</router-link>
							<a href="#" class="btn btn-light text-primary ml-2">
								Preview Event Page
							</a>
						</div>
						<h5 v-if="bookingType.id" class="mb-0">
							Edit Booking Type
						</h5>
						<h5 v-else class="mb-0">
							Create New Booking Type
						</h5>
						<div class="col-lg-3 d-flex align-items-center justify-content-end">
							<div class="form-group mb-0 mr-2">
								<span class="switch switch-sm">
									<input :id="`${_uid}-customSwitch1`" type="checkbox" checked="checked"
										class="switch">
									<label :for="`${_uid}-customSwitch1`" class="m-0"></label>
								</span>
							</div>
							<label class="mb-0" :for="`${_uid}-customSwitch1`">
								Your event type is
								<b>{{ bookingType.isActive ? 'ON' : 'OFF' }}</b>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid pt-4 pb-4">
				<div class="container">
					<div class="accordion pb-2">
						<DashboardBookingTypeBasic ref="basic" :booking-page="bookingPage" :booking-type="bookingType"
							@saved="onSaved" @open="onAccordionOpen('basic')" />
						<DashboardBookingTypeAvailability v-if="bookingType.id" ref="availability"
							:booking-type="bookingType" @saved="onSaved" @open="onAccordionOpen('availability')" />
					</div>
					<h6 class="mt-3">
						Additional Options
					</h6>
					<div class="accordion pb-2">
						<DashboardBookingTypeAppearance :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypeFileUpload :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypeDiscounts :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypeCoupons :booking-page="bookingPage" :booking-type="bookingType"
							@myOpenBasicWindow="openBasicWindow" />
						<DashboardBookingTypeInviteeQuestions :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypePortfolio :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypeNotificationsAndCancellationPolicy :booking-page="bookingPage"
							:booking-type="bookingType" />
						<DashboardBookingTypeConfirmationPage :booking-page="bookingPage" :booking-type="bookingType" />
						<DashboardBookingTypeCollectPayments :booking-page="bookingPage" :booking-type="bookingType" />
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import DashboardBookingTypeBasic from './DashboardBookingTypeBasic';
	import DashboardBookingTypeAvailability from './DashboardBookingTypeAvailability';
	
	export default {
		components: {
			DashboardBookingTypeBasic,
			DashboardBookingTypeAvailability,
			DashboardBookingTypeAppearance: () => import('./DashboardBookingTypeAppearance'),
			DashboardBookingTypeFileUpload: () => import('./DashboardBookingTypeFileUpload'),
			DashboardBookingTypeInviteeQuestions: () => import('./DashboardBookingTypeInviteeQuestions'),
			DashboardBookingTypePortfolio: () => import('./DashboardBookingTypePortfolio'),
			DashboardBookingTypeCollectPayments: () => import('./DashboardBookingTypeCollectPayments'),
			DashboardBookingTypeConfirmationPage: () => import('./DashboardBookingTypeConfirmationPage'),
			DashboardBookingTypeDiscounts: () => import('./DashboardBookingTypeDiscounts'),
			DashboardBookingTypeCoupons: () => import('./DashboardBookingTypeCoupons'),
			DashboardBookingTypeNotificationsAndCancellationPolicy: () => {
				return import('./DashboardBookingTypeNotificationsAndCancellationPolicy');
			},
		},
		
		data() {
			return {
				bookingPage: null,
				
				bookingType: {
					id: null,
					isActive: false,
					color: null,
				},
				
				pageIsLoading: true,
				accordions: ['basic', 'availability'],
				
			};
		},
		
		async mounted() {
			await this.getBookingPage();
			
			if (this.$router.currentRoute.params.bookingTypeId) {
				await this.getBookingType();
			}
			
			console.log('GOT BOOKING PAGE', this.bookingPage, this.bookingType);
			this.pageIsLoading = false;
		},
		
		methods: {
			async getBookingPage() {
				let response = await this.$http.get('/booking_pages/' + this.$router.currentRoute.params.bookingPageId);
				this.bookingPage = response.data.data;
			},
			
			async getBookingType() {
				let response = await this.$http.get('/booking_types/' + this.$router.currentRoute.params.bookingTypeId, {
					params: {
						with: ['locations'],
					},
				});
				
				this.bookingType = response.data.data;
			},
			
			async isActiveChanged() {
				let response = await this.$http.post(`/booking_types/${this.bookingType.id}/${this.bookingType.isActive ? 'activate' : 'deactivate'}`);
				this.bookingType.isActive = response.data.data.isActive;
			},
			
			onAccordionOpen(openAccordionType) {
				this.accordions.filter((accordionType) => accordionType !== openAccordionType).forEach((accordionType) => {
					this.$refs[accordionType].close();
				});
			},
			
			async onSaved(bookingType, wasCreated) {
				this.bookingType = { ...this.bookingType, ...bookingType };
				
				if (wasCreated) {
					await this.$router.replace({
						name: 'dashboard.booking_page.booking_type',
						
						params: {
							bookingPageId: this.bookingPage.id,
							bookingTypeId: this.bookingType.id,
						},
					});
					
					this.$refs.basic.close({ animate: false });
					this.$refs.availability.open({ animate: false });
					$(document.documentElement).scrollTop($(this.$refs.availability.$el).offset().top + 1);
				}
			},
			
			openBasicWindow() {
				this.$refs.basic.open({ animate: false });
				this.$scrollTo(this.$refs.basic, { offset: -140 });
				this.$nextTick(function () {
					this.$refs.basic.$refs.rateValue.focus();
				});
			},
		},
	};
</script>

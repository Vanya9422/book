<template>
	<div class="card">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover text-left"
							:class="{ 'disabled': !bookingType.id }">
							Coupons
							<div v-if="bookingType.id">
								<small class="text-secondary text-left d-block">
									Allow Coupon Codes with expiration dates.
								</small>
							</div>
						</button>
						
						<div class="btn-group fade" :class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
							<button type="button" class="btn btn-outline-secondary" @click.stop="cancel">
								Cancel
							</button>
							<button type="button" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
								:disabled="isLoading" @click.stop="save">
								{{ bookingType.id ? 'Save & Close' : 'Next' }}
							</button>
						</div>
					</div>
				</div>
			</h2>
		</div>
		<form v-if="form" ref="form" class="collapse border-top" :class="{ 'show': !bookingType.id }"
			:aria-labelledby="`${_uid}-header`" @submit.prevent>
			<div class="card-body">
				<div class="form">
					<div class="row align-items-center">
						<div class="col-lg-10">
							<div class="row align-items-center">
								<div class="col-lg-3">
									<strong>
										Coupon Name
									</strong>
								</div>
								<div class="col-lg-3">
									<strong>
										Coupon Code
									</strong>
								</div>
								<div class="col-lg-3">
									<strong>
										Discount
									</strong>
								</div>
								<div class="col-lg-3">
									<strong>
										Expiration Date
									</strong>
								</div>
							</div>
						</div>
						<div class="col-lg-2">
							<button class="btn btn-primary btn-block" data-toggle="modal"
								@click="addCoupon">
								Add Coupon
							</button>
						</div>
					</div>
					<hr>
					
					<div v-if="form.coupons.length > 0">
						<div v-for="(couponItem, couponItemIndex) in form.coupons" :key="couponItem.id"
							class="row align-items-center mb-3">
							<div class="col-lg-10">
								<div class="row align-items-center">
									<div class="col-lg-3 d-flex align-items-center">
										<span>
											{{ couponItem.name }}
										</span>
										<span v-if="couponItem.isEnable" class="badge badge-success ml-2">
											On
										</span>
										<span v-else class="badge badge-secondary ml-2">
											Off
										</span>
									</div>
									<div class="col-lg-3">
										<span>
											{{ couponItem.code }}
										</span>
									</div>
									<div class="col-lg-3">
										<span>
											{{ getCurrency() }} {{ couponItem.discountValue }}
										</span>
									</div>
									<div class="col-lg-3">
										<span v-if="couponItem.hasExpiration">
											{{ $moment(couponItem.expirationDate).format('DD MMMM YYYY') }}
											<strong>
												(in {{ $moment(couponItem.expirationDate).format('DD') - $moment().format('DD') }} days)
											</strong>
										</span>
									</div>
								</div>
							</div>
							<div class="col-lg-2 d-flex">
								<div class="w-50 pr-1">
									<button class="btn btn-light btn-block" data-toggle="modal"
										@click="openCouponModal(couponItemIndex)">
										<img src="/img/edit.svg" alt="" style="opacity: .5;" width="15">
									</button>
								</div>
								<div class="w-50 pl-1">
									<button class="btn btn-light btn-block" data-toggle="modal"
										data-target="#delete_coupon" @click="openDeleteModal(couponItemIndex)">
										<img src="/img/delete.svg" alt="" style="opacity: .5;" width="15">
									</button>
								</div>
							</div>
						</div>
					</div>
					<div v-else class="text-center">
						Not coupon
					</div>
				</div>
				<div class="row pt-4 pl-2 pr-2 pb-0 border-top mt-4 justify-content-end align-items-center">
					<button class="btn btn-link mr-2" @click="toggle">
						Cancel
					</button>
					<button class="btn btn-primary mr-2" @click="save">
						Save & Close
					</button>
				</div>
			</div>
		</form>
		<!-- Modal -->
		<ValidationObserver ref="validationObserver">
			<form>
				<div id="add_coupon" ref="couponModal" class="modal fade" tabindex="-1" role="dialog"
					aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 id="exampleModalLabel" class="modal-title">
									Create a Coupon
								</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="d-flex align-items-center mb-1">
									<div class="form-group mb-0 mr-2">
										<span class="switch switch-sm">
											<input id="coupon_enable_discount" v-model="coupon.isEnable" type="checkbox"
												class="switch" checked="checked">
											<label class="m-0" for="coupon_enable_discount"></label>
										</span>
									</div>
									<label class="mb-0" for="coupon_enable_discount">
										<strong>
											Enable Coupon
										</strong>
									</label>
								</div>
								<div class="d-flex flex-wrap">
									<div class="col-lg-6 col-12 pl-0 pr-0 pr-lg-3">
										<div class="form-group mb-0">
											<ValidationProvider v-slot="valiadtion" class="col-10 p-0" rules="required">
												<label for="coupon_name">
													Coupon Name
												</label>
												<input id="coupon_name" v-model="coupon.name" type="text"
													name="coupon_name" class="form-control"
													:class="{ 'is-invalid': valiadtion.failedRules.required }"
													aria-describedby="emailHelp">
												<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
													The coupon name is required
												</div>
											</ValidationProvider>
										</div>
									</div>
									<div class="col-lg-6 col-12 pr-0 pl-0 pl-lg-3">
										<div class="form-group mb-0">
											<ValidationProvider v-slot="valiadtion" class="col-10 p-0" rules="required">
												<label for="coupon_code">
													Coupon Code
												</label>
												<input id="coupon_code" v-model="coupon.code" type="text"
													name="coupon_code" class="form-control"
													:class="{ 'is-invalid': valiadtion.failedRules.required }"
													aria-describedby="emailHelp">
												<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
													The coupon code is required
												</div>
											</ValidationProvider>
										</div>
									</div>
								</div>
								<div class="d-flex mb-2 py-3">
									<span class="mr-3" @click="scrollUp">
										Current Rate:
										<strong class="h5 mb-0" style="font-weight: bold;">
											{{ getCurrency() }} {{ form.rateValue }}
										</strong>
									</span>
									<span>
										Rate with Discount:
										<strong class="h5 mb-0" style="font-weight: bold;">
											{{ getCurrency() }} {{ coupon.discountValue }}
										</strong>
									</span>
								</div>
								<div v-if="!form.rateValue">
									First, please add a rate.
									( you can click on the rate, and it will scroll up, and open the window where
									you can set the rate ).
								</div>
								<div class="col-lg-12 p-0 mb-3">
									<div class="input-group mb-0">
										<div class="input-group-append disabled-flex">
											<label class="input-group-text rounded-left border-right-0 px-2"
												for="inputGroupSelect03">
												Set Discount
											</label>
										</div>
										<ValidationProvider v-slot="valiadtion" rules="required">
											<input v-model.number="discountValue" type="number" name="discount_value"
												class="form-control text-center form-control-required"
												:class="{ 'is-invalid': valiadtion.failedRules.required }"
												placeholder="E.g.: 50" value="15" min="1"
												:disabled="!form.isPaymentRequired" @input="getDiscount">
											<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
												The set discount filed is required
											</div>
										</ValidationProvider>
										<select id="inputGroupSelect03" class="custom-select"
											:disabled="!form.isPaymentRequired">
											<option>
												{{ form.rateCurrencyCode }}
											</option>
										</select>
									</div>
								</div>
								<div class="d-flex align-items-center">
									<div class="d-flex align-items-center">
										<div class="form-group mb-0 mr-2">
											<span class="switch switch-sm">
												<input id="coupon_discount_period" v-model="coupon.hasExpiration"
													type="checkbox" class="switch">
												<label class="m-0" for="coupon_discount_period"></label>
											</span>
										</div>
										<label class="mb-0" for="coupon_discount_period">
											<strong>
												Expiration Date
											</strong>
										</label>
									</div>
									<div class="col pl-0">
										<div v-if="coupon.hasExpiration" class="input-group ml-3">
											<VDatePicker v-model="datePicker" :min-date="new Date()"
												@input="updateDay" />
										</div>
									</div>
									<strong v-if="coupon.hasExpiration" class="ml-3">(in
										{{ $moment(coupon.expirationDate).format('DD') - $moment().format('DD') }}
										days)</strong>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">
									Close
								</button>
								<button v-if="couponIndex == null" type="button" class="btn btn-primary"
									@click="saveCoupon">
									Add
								</button>
								<button v-else type="button" class="btn btn-primary" @click="saveCoupon">
									Edit
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</ValidationObserver>
		<!-- Modal -->
		<div id="delete_coupon" ref="deleteCouponModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Delete a Coupon
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Are you sure that you wish to delete this coupon?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary" @click="deleteCoupon">
							Yes
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';
	import { ValidationObserver } from 'vee-validate';
	
	export default {
		components: {
			VDatePicker: () => import('v-calendar/lib/components/date-picker.umd'),
			ValidationObserver,
		},
		
		props: {
			bookingPage: {
				type: Object,
				required: true,
			},
			
			bookingType: {
				type: Object,
				default: null,
			},
		},
		
		data() {
			return {
				isOpen: !this.bookingType.id,
				form: null,
				validationFields: {},
				isLoading: false,
				newLocationIsShown: !this.bookingType.id || this.bookingType.locations.length === 0,
				selectedLocationTypeKey: null,
				selectedLocation: null,
				selectedLocationIndex: null,
				
				locationTypes: (() => {
					let locationTypes = {
						IN_PERSON_MEETING: {
							icon: '/img/location.svg',
						},
						PHONE_CALL: {
							icon: '/img/phone.svg',
						},
						CUSTOM: {
							icon: '/img/custom.svg',
						},
						ASK_INVITEE: {
							icon: '/img/askinvitee.svg',
						},
					};
					
					locationTypes = Object.keys(locationTypes).map((locationTypeKey) => {
						return {
							value: locationTypeKey,
							...locationTypes[locationTypeKey],
							title: this.$trans(`booking_type_locations.types.${locationTypeKey}.title`),
							description: this.$trans(`booking_type_locations.types.${locationTypeKey}.placeholder`),
						};
					});
					
					for (let locationType of locationTypes) {
						locationTypes[locationType.value] = locationType;
					}
					
					return locationTypes;
				})(),
				
				colors: [
					'ee5353', 'f778b4', 'e27eff', '8989fc',
					'4a91e9', '0cc0d7', '34c76e', '67c820',
					'dfc12d', 'f49a31',
				],
				coupon: null,
				discountValue: '',
				datePicker: new Date(),
				coupons: [],
				couponIndex: null,
				
			};
		},
		
		computed: {
			...mapState(['auth']),
		},
		
		watch: {
			bookingType() {
				this.buildForm();
			},
		},
		
		created() {
			this.buildForm();
			this.coupon = {
				isEnable: false,
				name: '',
				code: '',
				inDay: 0,
				expirationDate: '',
				hasExpiration: false,
				discountValue: 0,
			};
		},
		
		mounted() {
			!this.bookingType.id && this.$nextTick(() => {
				this.$refs.bookingTypeNameInput && this.$refs.bookingTypeNameInput.focus();
			});
		},
		
		methods: {
			buildForm() {
				this.form = {
					name: this.bookingType.id ? this.bookingType.name : null,
					description: this.bookingType.id ? this.bookingType.description : null,
					slug: this.bookingType.id ? this.bookingType.slug : null,
					color: this.bookingType.id ? this.bookingType.color : this.colors[Math.floor(this.colors.length * Math.random())],
					isPaymentRequired: this.bookingType.id ? this.bookingType.isPaymentRequired : false,
					rateValue: this.bookingType.isPaymentRequired ? parseFloat(this.bookingType.rateValue) : 0,
					rateCurrencyCode: this.bookingType.isPaymentRequired ? this.bookingType.rateCurrencyCode : '',
					
					coupons: this.bookingType.id ? this.bookingType.coupons.map((bookingTypeCoupons) => {
						return {
							id: bookingTypeCoupons.id,
							isEnable: bookingTypeCoupons.isEnable,
							name: bookingTypeCoupons.name,
							code: bookingTypeCoupons.code,
							expirationDate: bookingTypeCoupons.expirationDate,
							hasExpiration: bookingTypeCoupons.hasExpiration,
							discountValue: bookingTypeCoupons.discountValue,
						};
					}) : [],
					
				};
			},
			
			// ---------------------------------------------------------------------- //
			
			open() {
				$(this.$refs.form).collapse('show');
				this.isOpen = true;
				this.$emit('open');
			},
			
			close({ animate = true } = {}) {
				if (animate) {
					$(this.$refs.form).collapse('hide');
				} else {
					$(this.$refs.form).removeClass('show');
				}
				
				this.isOpen = false;
				this.$emit('close');
			},
			
			toggle() {
				if (!this.bookingType.id) {
					return;
				}
				
				this.isOpen ? this.close() : this.open();
			},
			
			cancel() {
				if (this.bookingType.id) {
					return this.close();
				}
				
				return this.$router.push({ name: 'dashboard.home' });
			},
			
			addCoupon() {
				this.coupon = {
					isEnable: false,
					name: '',
					code: '',
					expirationDate: '',
					hasExpiration: false,
					discountValue: 0,
				};
				$(this.$refs.couponModal).modal('show');
			},
			
			async saveCoupon() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				if (this.couponIndex !== null) {
					this.form.coupons[this.couponIndex] = this.coupon;
					this.couponIndex = null;
					$(this.$refs.couponModal).modal('hide');
				} else {
					this.form.coupons.push(this.coupon);
					this.couponIndex = null;
					$(this.$refs.couponModal).modal('hide');
				}
			},
			
			async save() {
				this.isLoading = true;
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
					bookingType: this.form,
				});
				
				if (!this.bookingType.id) {
					return;
				}
				
				this.isLoading = false;
				this.close({ animate: !!this.bookingType.id });
			},
			
			async deleteCoupon() {
				this.form.coupons.splice(this.couponIndex, 1);
				this.couponIndex = null;
				$(this.$refs.deleteCouponModal).modal('hide');
			},
			
			openCouponModal(couponItemIndex) {
				this.couponIndex = couponItemIndex;
				this.coupon = this.form.coupons[this.couponIndex];
				this.datePicker = new Date(this.form.coupons[this.couponIndex].expirationDate);
				this.discountValue = this.form.rateValue - this.form.coupons[this.couponIndex].discountValue;
				$(this.$refs.couponModal).modal('show');
			},
			
			openDeleteModal(couponItemIndex) {
				this.couponIndex = couponItemIndex;
				$(this.$refs.deleteCouponModal).modal('show');
			},
			
			getCurrency() {
				let currencies = {
					'USD': '$',
					'CAD': '$',
					'EUR': '€',
					'GBP': '£',
					'BRL': 'R$',
					'MEX': '$',
					'RUB': '₽',
					'UZS': 'so\'m or сўм\t',
					'RUP': '₹',
				};
				if (this.form && this.form.isPaymentRequired) {
					for (let [key, value] of Object.entries(currencies)) {
						if (this.form.rateCurrencyCode === key) {
							return value;
						}
					}
				}
			},
			
			getDiscount() {
				if (this.discountValue < this.form.rateValue && this.discountValue !== '') {
					let discountValue = this.form.rateValue - this.discountValue;
					this.coupon.discountValue = discountValue;
				} else {
					this.discountValue = 0;
					this.discountValue = 0;
				}
			},
			
			updateDay(e) {
				this.coupon.expirationDate = this.$moment(e).format('YYYY-MM-DD');
			},
			
			scrollUp() {
				if (!this.form.rateValue) {
					$(this.$refs.couponModal).modal('hide');
					this.close();
					this.$emit('myOpenBasicWindow');
				}
			},
		},
	};
</script>

<style scoped>
	.form-control-required {
		border-radius: 0rem;
	}
	
	.disabled-flex {
		display: block;
		
	}
</style>

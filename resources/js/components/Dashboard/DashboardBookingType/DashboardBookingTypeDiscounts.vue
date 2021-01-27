<template>
	<div class="card">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover text-left"
							:class="{ 'disabled': !bookingType.id }">
							Discounts
							<div v-if="bookingType.id">
								<small class="text-secondary text-left d-block">
									Allow fixed-rateValue or percentage discounts with expiration dates.
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
			:aria-labelledby="`${_uid}-header`" @submit.prevent="save">
			<div class="card-body">
				<div class="form">
					<div>
						<div class="d-flex align-items-center mb-1">
							<div class="form-group mb-0 mr-2">
								<span class="switch switch-sm">
									<input id="enable_discount" v-model="form.isDiscountEnabled" type="checkbox"
										class="switch" checked="checked">
									<label class="m-0" for="enable_discount"></label>
								</span>
							</div>
							<label class="mb-0" for="enable_discount">
								<strong>
									Enable Discount
								</strong>
							</label>
						</div>
						<div class="d-flex mb-2 py-3">
							<span class="mr-3">
								Current Rate:
								<strong class="h5 mb-0">
									{{ getCurrency() }} {{ form.rateValue }}
								</strong>
							</span>
							<span>
								Rate with Discount:
								<strong class="h5 mb-0">{{ getCurrency() }} {{ form.discountValue }}</strong>
							</span>
						</div>
						<div class="col-lg-4 pl-0 mb-3">
							<div class="input-group mb-0">
								<div class="input-group-append">
									<label class="input-group-text rounded-left border-right-0 px-2" for="inputGroupSelect02">
										Set Discount
									</label>
								</div>
								<input v-model="rateDiscount" type="text" class="form-control text-center"
									placeholder="E.g.: 50" @input="getDiscount">
								<select id="inputGroupSelect02" v-model="form.rateCurrencyCode" class="custom-select">
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
										<input id="discount_period" v-model="form.discountHasExpiration" type="checkbox" class="switch">
										<label class="m-0" for="discount_period"></label>
									</span>
								</div>
								<label class="mb-0" for="discount_period">
									<strong>
										Expiration Date
									</strong>
								</label>
							</div>
							<div v-if="form.discountHasExpiration" class="col-lg-2 pl-0">
								<div class="input-group ml-3">
									<VDatePicker v-model="datePicker" :min-date="new Date()" @input="updateDay" />
								</div>
							</div>
							<strong v-if="form.discountHasExpiration" class="ml-3">
								(in {{ $moment(form.discountExpirationDate).format('DD') - $moment().format('DD') }} days)
							</strong>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import { mapState } from 'vuex';
	
	export default {
		components: {
			VDatePicker: () => import('v-calendar/lib/components/date-picker.umd'),
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
				requirePayment: false,
				rateValue: 0,
				currency: 'USD',
				discountValue: '',
				rateDiscount: 0,
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
				datePicker: new Date(),
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
		
		mounted() {
			this.buildForm();
			
			!this.bookingType.id && this.$nextTick(() => {
				this.$refs.bookingTypeNameInput && this.$refs.bookingTypeNameInput.focus();
			});
			
			this.datePicker = this.bookingType.discountExpirationDate &&
				this.bookingType.discountExpirationDate !== '0000-00-00' ? new Date(this.bookingType.discountExpirationDate) : new Date();
			this.rateDiscount = this.form.rateValue - this.form.discountValue;
		},
		
		methods: {
			buildForm() {
				this.form = {
					name: this.bookingType.id ? this.bookingType.name : null,
					description: this.bookingType.id ? this.bookingType.description : null,
					slug: this.bookingType.id ? this.bookingType.slug : null,
					color: this.bookingType.id ? this.bookingType.color : this.colors[Math.floor(this.colors.length * Math.random())],
					isDiscountEnabled: this.bookingType.id ? this.bookingType.isDiscountEnabled : false,
					discountValue: this.bookingType.id ? this.bookingType.discountValue : 0,
					discountHasExpiration: this.bookingType.id ? this.bookingType.discountHasExpiration : false,
					discountExpirationDate: this.bookingType.id && this.bookingType.discountExpirationDate !== '0000-00-00' ? this.bookingType.discountExpirationDate : null,
					rateValue: this.bookingType.isPaymentRequired ? parseFloat(this.bookingType.rateValue) : 0,
					rateCurrencyCode: this.bookingType.isPaymentRequired ? this.bookingType.rateCurrencyCode : '',
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
			
			async save() {
				this.isLoading = true;
				
				try {
					let response = await this.$http.post((
							this.bookingType.id
								? `/booking_types/${this.bookingType.id}/update`
								: `/booking_pages/${this.bookingPage.id}/booking_types/create`
						), {
							bookingType: this.form,
						});
					
					this.isLoading = false;
					this.validationFields = {};
					this.close({ animate: !!this.bookingType.id });
					this.$emit('saved', response.data.data, !this.bookingType.id);
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			// ---------------------------------------------------------------------- //
			
			async onEventNameChanged() {
				if (this.form.slug) {
					return;
				}
				
				let response = await this.$http.get((
						this.bookingType.id
							? `/booking_types/${this.bookingType.id}/suggest_slug`
							: `/booking_pages/${this.bookingPage.id}/booking_types/suggest_slug`
					), {
						params: { string: this.form.name },
					});
				
				if (this.form.slug) {
					return;
				}
				
				this.form.slug = response.data.data;
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
				for (let [key, value] of Object.entries(currencies)) {
					if (this.form.rateCurrencyCode === key) {
						return value;
					}
				}
			},
			
			getDiscount() {
				if (this.rateDiscount < this.form.rateValue && this.rateDiscount !== '') {
					let discountValue = this.form.rateValue - this.rateDiscount;
					this.form.discountValue = discountValue;
				} else {
					this.form.discountValue = 0;
				}
			},
			
			updateDay(e) {
				this.form.discountExpirationDate = this.$moment(e).format('YYYY-MM-DD');
			},
		},
	};
</script>

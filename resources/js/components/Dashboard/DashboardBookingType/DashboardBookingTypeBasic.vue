<template>
	<div ref="root" class="card">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover"
							:class="{ 'disabled': !bookingType.id }">
							What booking type is this?
							<div v-if="bookingType.id">
								<small class="text-secondary text-left d-block">{{ bookingType.name }}</small>
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
		<ValidationObserver ref="validationObserver">
			<form v-if="form" ref="form" class="collapse border-top" :class="{ 'show': !bookingType.id }"
				:aria-labelledby="`${_uid}-header`" @submit.prevent="save">
				<div class="card-body">
					<div class="form">
						<div class="row">
							<div class="col-lg-6">
								<div class="d-flex mb-3" style="font-size: 0px;">
									<label
										class="btn btn-outline-primary rounded-left border-right-0 checked-primary w-50"
										:class="{ 'active': tempBookingTypeType === 0 }" style="border-radius: 0;">
										<img src="/img/conference.svg" alt="" width="30">
										<strong class="d-block mt-2">Meeting</strong>
										<small>Free/Fixed Hourly Rate/Time-Counter</small>
										<input v-model="tempBookingTypeType" type="radio" class="d-none" :value="0">
									</label>
									<label
										class="btn btn-outline-primary rounded-right border-left-0 checked-primary w-50"
										:class="{ 'active': tempBookingTypeType === 1 }" style="border-radius: 0;">
										<img src="/img/conference.svg" alt="" width="30">
										<strong class="d-block mt-2">Video Webinar/Conference</strong>
										<small>Free/Tickets/Time-Counter</small>
										<input v-model="tempBookingTypeType" type="radio" class="d-none" :value="1">
									</label>
								</div>
								<div class="row mr-0 ml-0 mb-4 align-items-center justify-content-between ">
									<div class="col p-0">
										<div class="d-flex align-items-center mb-1">
											<div class="form-group mb-0 mr-2">
												<span class="switch switch-sm">
													<input id="events_switch" v-model="form.isPaymentRequired"
														type="checkbox" class="switch" checked="checked">
													<label class="m-0" for="events_switch"></label>
												</span>
											</div>
											<label class="mb-0" for="events_switch">
												<strong>Require Payment</strong>
											</label>
										</div>
										<small v-if="tempBookingTypeType === 0"
											class="d-block">People must pay to Book this Meeting</small>
										<small v-if="tempBookingTypeType === 1"
											class="d-block">Set a price for tickets.</small>
									</div>
									<div class="input-group mb-0 col-7 p-0 set-your-rate"
										:class="{ 'isVisible' : form.isPaymentRequired }">
										<div class="input-group-append disabled-flex">
											<label class="input-group-text rounded-left border-right-0 px-2"
												for="inputGroupSelect02">
												<span v-if="tempBookingTypeType === 0">
													Set your Hourly Rate
												</span>
												<span v-else-if="tempBookingTypeType === 1">
													Set your Ticket Price
												</span>
											</label>
										</div>
										<ValidationProvider v-slot="valiadtion" rules="required">
											<input ref="rateValue" v-model="form.rateValue" type="number"
												class="form-control text-center form-control-required"
												:class="{ 'is-invalid': valiadtion.failedRules.required }"
												placeholder="E.g.: 50">
											<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
												The rate filed is required
											</div>
										</ValidationProvider>
										<select id="inputGroupSelect02" v-model="form.rateCurrencyCode"
											class="custom-select">
											<option value="USD">
												USD
											</option>
											<option value="CAD">
												CAD
											</option>
											<option value="EUR">
												EUR
											</option>
											<option value="GBP">
												GBP
											</option>
											<option value="BRL">
												BRL
											</option>
											<option value="MEX">
												MEX
											</option>
											<option value="RUB">
												RUB
											</option>
											<option value="UZS">
												UZS
											</option>
											<option value="RUP">
												RUP
											</option>
										</select>
									</div>
								</div>
								<div v-if="tempBookingTypeType === 0" class="form-group">
									<label for="exampleInputName1">Booking type name *</label>
									<input id="exampleInputName1" ref="bookingTypeNameInput" v-model="form.name"
										type="text" class="form-control"
										:class="{ 'is-invalid': validationFields['booking_type.name'] }"
										aria-describedby="nameHelp">
									<div v-if="validationFields['booking_type.name']" class="invalid-feedback">
										{{ validationFields['booking_type.name'][0] }}
									</div>
								</div>
								<div v-else-if="tempBookingTypeType === 1" class="form-group">
									<label for="exampleInputName1">Webinar Name *</label>
									<input id="exampleInputName1" ref="bookingTypeNameInput" type="text"
										class="form-control">
								</div>
								<div v-if="tempBookingTypeType === 0" class="form-group">
									<label for="exampleFormControlSelect2">
										Location(s) - E.g. Skype, In-Person, Phone call, etc...
									</label>
									<div v-if="form.locations.length > 0">
										<div v-for="(location, locationIndex) in form.locations" :key="locationIndex"
											class="row pl-0 pr-2 m-0 mb-2 py-1 location-list-item">
											<div class="col pl-0 d-flex align-items-center">
												<img class="mr-2" height="20" style="opacity: .3;"
													:src="locationTypes[location.type].icon">
												{{ locationTypes[location.type].title }}
											</div>
											<a class="edit-option btn btn-link" href="#" style="font-size: 0;"
												@click.prevent="editLocation(location, locationIndex)">
												<img src="/img/edit.svg" alt="" width="15" style="opacity: .3;">
											</a>
											<a class="ml-2 remove-option btn btn-link" href="#" style="font-size: 0;"
												@click.prevent="removeLocation(locationIndex)">
												<img src="/img/delete.svg" alt="" width="15" style="opacity: .3;">
											</a>
										</div>
										<div v-if="!newLocationIsShown" class="row">
											<div class="col-12">
												Want to offer more choices to your invitee?
												<a href="#"
													@click.prevent="showNewLocation">Add another location option</a>
											</div>
										</div>
									</div>
									<VSelect v-if="form.locations.length === 0 || newLocationIsShown"
										v-model="selectedLocationTypeKey" :options="locationTypes"
										:reduce="locationType => locationType.value" :filterable="false"
										@input="locationTypeSelected">
										<template v-slot:option="locationType">
											<div class="row">
												<div class="col-1 d-flex">
													<img class="justify-content-center" width="20" style="opacity: .3;"
														:src="locationType.icon">
												</div>
												<div class="col-11">
													<div class="row">
														<div class="col-12">
															{{ locationType.title }}
														</div>
													</div>
													<div class="row">
														<div class="col-12">
															<small>{{ locationType.description }}</small>
														</div>
													</div>
												</div>
											</div>
										</template>
									</VSelect>
								</div>
								<div class="row mr-0 ml-0 mb-4 align-items-center justify-content-between ">
									<div class="col p-0">
										<div class="d-flex align-items-center mb-1">
											<div class="form-group mb-0 mr-2">
												<span class="switch switch-sm">
													<input id="password_protection" v-model="form.isPasswordProtected"
														type="checkbox" class="switch">
													<label class="m-0" for="password_protection"></label>
												</span>
											</div>
											<label class="mb-0" for="password_protection">
												<strong>Password Protection</strong>
											</label>
										</div>
										<small class="d-block">Protect this Webinar with a Password</small>
									</div>
									<div class="input-group mb-0 col-7 p-0 set-your-rate"
										:class="{ 'isVisible' : form.isPasswordProtected }">
										<div class="input-group-prepend disabled-flex">
											<label class="input-group-text rounded-left border-right-0 px-2"
												for="password_input">
												<span>
													Set Password
												</span>
											</label>
										</div>
										<div class="col p-0 position-relative">
											<input id="password_input" v-model="password" :type="passwordFieldType"
												aria-describedby="basic-addon3" class="form-control rounded-0">
											<div v-if="password" style="font-size: 0;"
												class="passwordVisibilitySwitcher"
												:class="{ 'isToHide': passwordFieldType === 'text' }"
												@click="switchPasswordVisibility">
												<img src="/img/visibility.svg" width="20" style="opacity: .3;" alt="">
											</div>
										</div>
										<!--										<input :type="passwordFieldType" v-model="password">-->
										<!--										<button type="password" @click="switchVisibility">show / hide</button>-->
										<div class="input-group-append">
											<button id="button-addon2" class="btn btn-outline-secondary" type="button">
												Update
											</button>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="formControlTextarea1">Description/Instructions</label>
									<textarea id="formControlTextarea1" v-model="form.description" class="form-control"
										:class="{ 'is-invalid': validationFields['booking_type.description'] }"
										style="width: 100%;" rows="3"></textarea>
									<div v-if="validationFields['booking_type.description']" class="invalid-feedback">
										{{ validationFields['booking_type.description'][0] }}
									</div>
								</div>
								
								<div v-if="tempBookingTypeType === 1" class="d-flex align-items-center">
									<div class="form-group w-25">
										<label for="seat_limit">Set the Seat Limit</label>
										<div class="input-group mb-3">
											<input id="seat_limit" type="number" value="10" class="form-control"
												aria-describedby="basic-addon3">
											<div class="input-group-append">
												<span id="basic-addon3" class="input-group-text">Seats</span>
											</div>
										</div>
									</div>
									<strong class="ml-2 d-block mb-1">85 Remaining Seats</strong>
								</div>
								<div class="form-group">
									<label for="basic-url">Booking type link *</label>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span id="basic-addon3"
												class="input-group-text">https://bookify.ai/{{ bookingPage.slug }}/</span>
										</div>
										<input id="basic-url" v-model="form.slug" type="text" class="form-control"
											:class="{ 'is-invalid': validationFields['booking_type.slug'] }"
											aria-describedby="basic-addon3">
										<div v-if="validationFields['booking_type.slug']" class="invalid-feedback">
											{{ validationFields['booking_type.slug'][0] }}
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 pb-4 pt-2">
								<label>Booking type color *</label>
								<div class="btn-group-toggle btn-group-sm"
									:class="{ 'is-invalid': validationFields['booking_type.color'] }">
									<label v-for="(color) in colors" :key="color" class="btn is-color mr-2"
										:class="{ 'active': color === form.color }"
										:style="{ 'background-color': `#${color}` }">
										<input v-model="form.color" type="radio" :value="color" autocomplete="off">
									</label>
								</div>
								<div v-if="validationFields['booking_type.color']" class="invalid-feedback">
									{{ validationFields['booking_type.color'][0] }}
								</div>
							</div>
							<div class="col-lg-12">
								<div class="d-flex justify-content-end align-items-center">
									<button type="button" class="btn btn-default mr-4" @click="cancel">
										Cancel
									</button>
									<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
										:disabled="isLoading">
										{{ bookingType.id ? 'Save & Close' : 'Next' }}
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</ValidationObserver>
		
		<div id="edit-location-modal" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">
							Edit Location
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div v-if="selectedLocation" class="modal-body">
						<div class="row mb-3">
							<div class="col-12">
								<VSelect v-model="selectedLocation.type" :clearable="false" :options="locationTypes"
									label="title" :reduce="o => o.value" :filterable="false"
									@input="selectedLocationTypeChanged">
									<template v-slot:selected-option="locationType">
										<img class="mr-2" width="20" style="opacity: .3;"
											:src="locationType.icon"> {{ locationType.title }}
									</template>
									<template v-slot:option="locationType">
										<div class="row">
											<div class="col-1 d-flex">
												<img class="justify-content-center" width="20" style="opacity: .3;"
													:src="locationType.icon">
											</div>
											<div class="col-11">
												<div class="row">
													<div class="col-12">
														{{ locationType.title }}
													</div>
												</div>
												<div class="row">
													<div class="col-12">
														<small>{{ locationType.description }}</small>
													</div>
												</div>
											</div>
										</div>
									</template>
								</VSelect>
							</div>
						</div>
						<div v-if="selectedLocation.type === 'IN_PERSON_MEETING'" class="row">
							<div class="col-12 mb-2">
								<input v-model="selectedLocation.basicInformation" type="text" class="form-control"
									autocorrect="off" autocomplete="off" maxlength="255" placeholder="Basic Information"
									required>
							</div>
							<div class="col-12 mb-2">
								<textarea v-model="selectedLocation.additionalInformation" class="form-control"
									autocorrect="off" autocomplete="off" maxlength="255"
									placeholder="Additional Information"></textarea>
							</div>
						</div>
						<div v-else-if="selectedLocation.type === 'PHONE_CALL'" class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-1 d-flex justify-content-center align-items-center">
										<input id="outbound-call-type" v-model="selectedLocation.callType" type="radio"
											class="form-control" autocorrect="off" autocomplete="off" value="OUTBOUND"
											required>
									</div>
									<label for="outbound-call-type">
										<div class="col-11">
											<div class="row">
												<div class="col">
													I will call my invitee
												</div>
											</div>
											<div class="row">
												<div class="col">
													<small>
														Book will require your invitee’s phone number before scheduling.
													</small>
												</div>
											</div>
										</div>
									</label>
								</div>
							</div>
							<div class="col-12">
								<div class="row">
									<div class="col-1 d-flex justify-content-center align-items-center">
										<input id="inbound-call-type" v-model="selectedLocation.callType" type="radio"
											name="locationOption" class="form-control" value="INBOUND" autocorrect="off"
											autocomplete="off" required>
									</div>
									<label for="inbound-call-type">
										<div class="col-11">
											<div class="row">
												<div class="col">
													My invitee should call me
												</div>
											</div>
											<div class="row">
												<div class="col">
													<small>
														Book will provide your number after the call has been scheduled.
													</small>
												</div>
											</div>
										</div>
									</label>
								</div>
							</div>
						</div>
						<div v-else-if="selectedLocation.type === 'CUSTOM'" class="row">
							<div class="col-12 mb-2">
								<input v-model="selectedLocation.basicInformation" type="text" name="location"
									class="form-control" autocorrect="off" autocomplete="off" maxlength="255"
									placeholder="Basic Information" required>
							</div>
							<div class="col-12 mb-4">
								<div class="row">
									<div class="col-1">
										<input id="booking-type-location-display-while-booking"
											v-model="selectedLocation.isHidden" type="radio" class="form-control"
											autocorrect="off" autocomplete="off" :value="false" required>
									</div>
									<div class="col-11 d-flex align-items-center">
										<label class="mb-0" for="booking-type-location-display-while-booking">
											Display location while booking
										</label>
									</div>
								</div>
								<div class="row">
									<div class="col-1">
										<input id="booking-type-location-display-after-confirmation"
											v-model="selectedLocation.isHidden" type="radio" class="form-control"
											autocorrect="off" autocomplete="off" :value="true" required>
									</div>
									<div class="col-11 d-flex align-items-center">
										<label class="mb-0" for="booking-type-location-display-after-confirmation">
											Display location only after confirmation
										</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" @click="cancelEditingLocation">
							Cancel
						</button>
						<button type="button" class="btn btn-primary" @click="updateLocation">
							Update
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
				isPasswordProtected: 0,
				form: null,
				validationFields: {},
				isLoading: false,
				newLocationIsShown: !this.bookingType.id || this.bookingType.locations.length === 0,
				selectedLocationTypeKey: null,
				selectedLocation: null,
				selectedLocationIndex: null,
				tempBookingTypeType: 0,
				password: '',
				passwordFieldType: 'password',
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
						SKYPE: {
							icon: '/img/skype.png',
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
			this.form.isPaymentRequired = true;
			this.form.rateCurrencyCode = 'USD';
			
			this.$nextTick(() => {
				$(this.$refs.root).find('[data-toggle="tooltip"]').tooltip();
			});
		},
		
		beforeDestroy() {
			$(this.$refs.root).find('[data-toggle="tooltip"]').tooltip('disable');
		},
		
		methods: {
			switchPasswordVisibility() {
				this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
			},
			buildForm() {
				this.form = {
					name: this.bookingType.id ? this.bookingType.name : null,
					description: this.bookingType.id ? this.bookingType.description : null,
					slug: this.bookingType.id ? this.bookingType.slug : null,
					color: this.bookingType.id ? this.bookingType.color : this.colors[Math.floor(this.colors.length * Math.random())],
					isPaymentRequired: this.bookingType.id ? this.bookingType.isPaymentRequired : false,
					rateValue: this.bookingType.isPaymentRequired ? parseFloat(this.bookingType.rateValue) : 25,
					rateCurrencyCode: this.bookingType.isPaymentRequired ? this.bookingType.rateCurrencyCode : '',
					
					locations: this.bookingType.id ? this.bookingType.locations.map((bookingTypeLocation) => {
						return {
							id: bookingTypeLocation.id,
							type: bookingTypeLocation.type,
							basicInformation: bookingTypeLocation.basicInformation,
							additionalInformation: bookingTypeLocation.additionalInformation,
							callType: bookingTypeLocation.callType,
							isHidden: bookingTypeLocation.isHidden,
						};
					}) : [],
				};
			},
			
			// ---------------------------------------------------------------------- //
			
			open({ animate = true } = {}) {
				if (animate) {
					$(this.$refs.form).collapse('show');
				} else {
					$(this.$refs.form).addClass('show');
				}
				
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
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				this.isLoading = true;
				
				try {
					let requestUrl = this.bookingType.id
						? `/booking_types/${this.bookingType.id}/update`
						: `/booking_pages/${this.bookingPage.id}/booking_types/create`;
					
					let response = await this.$http.post(requestUrl, {
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
			
			locationTypeSelected() {
				this.selectedLocationIndex = null;
				
				this.selectedLocation = {
					type: this.selectedLocationTypeKey,
					basicInformation: null,
					additionalInformation: null,
					callType: 'OUTBOUND',
					isHidden: false,
				};
				
				$('#edit-location-modal').modal('show');
				
				this.$nextTick(() => {
					this.selectedLocationTypeKey = null;
				});
			},
			
			cancelEditingLocation() {
				this.selectedLocation = null;
				$('#edit-location-modal').modal('hide');
			},
			
			updateLocation() {
				if (this.selectedLocationIndex !== null) {
					this.form.locations[this.selectedLocationIndex] = this.selectedLocation;
					this.selectedLocation = null;
				} else {
					this.form.locations.push(this.selectedLocation);
					this.selectedLocation = null;
					this.newLocationIsShown = false;
				}
				
				$('#edit-location-modal').modal('hide');
			},
			
			showNewLocation() {
				this.newLocationIsShown = true;
			},
			
			removeLocation(locationIndex) {
				this.form.locations.splice(locationIndex, 1);
			},
			
			editLocation(location, locationIndex) {
				this.selectedLocationIndex = locationIndex;
				this.selectedLocation = { ...location };
				$('#edit-location-modal').modal('show');
			},
			
			selectedLocationTypeChanged() {
				this.selectedLocation.basicInformation = null;
				this.selectedLocation.additionalInformation = null;
			},
			
		},
	};
</script>

<style lang="scss" scoped>
	.form-control-required {
		border-radius: 0rem;
		width: 80px;
	}
	
	.btn.btn-outline-primary.checked-primary {
		background-position: -40px 50%;
		transition: all .3s ease
	}
	
	.btn.btn-outline-primary.active.checked-primary {
		background-image: url('/img/confirm_primary_white.svg');
		background-position: 20px 50%;
		padding-left: 60px;
		background-size: 30px;
		background-repeat: no-repeat;
	}
	
	.invalid-feedback {
		position: absolute;
	}
	
	.set-your-rate {
		opacity: 0;
		visibility: hidden;
		transition: all .3s ease;
		
		&.isVisible {
			opacity: 1;
			visibility: visible;
		}
	}
	
	.cursor-not-allowed {
		cursor: not-allowed !important;
	}
	
	.passwordVisibilitySwitcher {
		width: 20px;
		height: 20px;
		position: absolute;
		top: calc(50% - 10px);
		right: 10px;
		z-index: 10;
		cursor: pointer;
		overflow: hidden;
		
		&:after {
			content: '';
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%) rotate(45deg);
			transform-origin: 50% 50%;
			width: 0px;
			height: 3px;
			background: #b3b3b3;
			transition: all .3s ease;
		}
		
		&.isToHide:after {
			width: 20px;
		}
		
	}
</style>

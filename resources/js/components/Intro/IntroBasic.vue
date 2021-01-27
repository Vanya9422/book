<template>
	<form @submit.prevent="saveData({ pressedButton: 'continue' })">
		<div class="container d-flex justify-content-center pt-4 pb-4">
			<div class="col-lg-7 pt-4 pb-4">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row justify-content-between align-items-end">
							<div class="col-lg-12 pt-3">
								<h5>
									Welcome to Bookify!
								</h5>
								<p class="text-secondary mt-4">
									We take the work out of connecting with others so you can accomplish more.
								</p>
							</div>
							<!--							<div class="col-lg-4">-->
							<!--								<img src="/img/megaphone.svg" alt="" style="max-width: 100%;">-->
							<!--							</div>-->
						</div>
					</div>
					<div class="card-body">
						<small class="mb-3 d-block">
							<strong>Create your Bookify URL</strong>
						</small>
						<p>
							<small>
								Choose a URL that describes you or your business in a concise way.
								Make it short and easy to remember so you can share links with ease.
							</small>
						</p>
						<div class="pb-2">
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<span id="basic-addon1" class="input-group-text">bookify.ai/</span>
								</div>
								<input v-model="bookingPage.slug" type="text" class="form-control" :class="{
									'is-invalid': validationFields['booking_page.slug'],
									'is-valid': slugIsValid === true,
								}" placeholder="your-username" aria-label="url"
									aria-describedby="basic-addon1" @input="onBookingPageSlugChanged">
								<div v-if="validationFields['booking_page.slug']" class="invalid-feedback">
									{{ validationFields['booking_page.slug'][0] }}
								</div>
							</div>
						</div>
						<hr>
						<small class="mb-2 d-flex align-items-center justify-content-between">
							<strong>Choose your City/Time Zone</strong>
							<span v-if="selectedLocalityTime" class="ml-1 text-secondary">
								Current Time: {{ selectedLocalityTime }}
							</span>
						</small>
						<VSelect v-model="localitySelectSelectedOption" :options="localitySelectOptions"
							label="fullAddress" placeholder="Select localtion..."
							:filterable="false" :class="{
								'is-invalid': validationFields['user.locality_key'],
							}" @input="onLocalityInputChanged" @search="onLocalityInputSearchChanged">
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
						<div v-if="validationFields['user.locality_key']" class="invalid-feedback">
							{{ validationFields['user.locality_key'][0] }}
						</div>
					</div>
				</div>
				<div class="row pt-4">
					<div class="col-lg-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-3">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="20"
										aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col">
								<div class="d-flex justify-content-end align-items-center">
									<button type="submit" class="btn btn-primary ml-3"
										:class="{ 'is-loading': loadingButton === 'continue' }"
										:disabled="loadingButton === 'continue'">
										Continue
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</template>

<script>
	import { debounce } from 'lodash';
	import { mapState } from 'vuex';
	
	export default {
		data() {
			return {
				bookingPage: {
					slug: this.$store.state.auth.user.bookingPages[0].slug,
				},
				
				user: {
					localityKey: this.$store.state.auth.user.locality ? this.$store.state.auth.user.locality.key : null,
				},
				
				slugIsValid: null,
				selectedLocalityTime: null,
				localitySelectSelectedOption: this.$store.state.auth.user.locality ? { ...this.$store.state.auth.user.locality } : null,
				localitySelectOptions: [],
				localitySelectCancel: null,
				localityTimeInterval: null,
				validationFields: {},
				loadingButton: null,
			};
		},
		
		computed: {
			...mapState([
				'timeFormats',
			]),
		},
		
		mounted() {
			this.updateSelectedLocalityTime();
			
			this.localityTimeInterval = setInterval(() => {
				this.updateSelectedLocalityTime();
			}, 1000);
		},
		
		beforeDestroy() {
			clearInterval(this.localityTimeInterval);
		},
		
		methods: {
			onBookingPageSlugChanged: debounce(async function () {
				let onValidated = () => {
					delete this.validationFields['booking_page.slug'];
					this.validationFields = { ...this.validationFields };
					this.slugIsValid = true;
				};
				
				try {
					await this.$http.post('/intro/basic', {
						bookingPage: {
							slug: this.bookingPage.slug,
						},
						
						justValidate: true,
					});
					
					return onValidated();
				} catch (error) {
					if (error.response && error.response.data.error === 'Validation') {
						if (error.response.data.validationFields['booking_page.slug']) {
							this.validationFields = {
								...this.validationFields,
								'booking_page.slug': error.response.data.validationFields['booking_page.slug'],
							};
							
							return;
						}
						
						return onValidated();
					}
					
					throw error;
				}
			}, 250),
			
			async onLocalityInputChanged() {
				if (this.localitySelectSelectedOption && this.localitySelectSelectedOption.key) {
					this.user.localityKey = this.localitySelectSelectedOption.key;
					let response = await this.$http.get(`/localities/${this.user.localityKey}`);
					this.localitySelectSelectedOption.timezoneCode = response.data.data.timezoneCode;
					this.updateSelectedLocalityTime();
				} else {
					this.user.localityKey = null;
					this.selectedLocalityTime = null;
				}
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
					loading(false);
					throw error;
				}
			}, 250),
			
			updateSelectedLocalityTime() {
				if (!this.localitySelectSelectedOption || !this.localitySelectSelectedOption.timezoneCode) {
					return;
				}
				
				this.selectedLocalityTime = this.$moment.tz(this.localitySelectSelectedOption.timezoneCode).format(this.timeFormats['12H']);
			},
			
			async saveData({ pressedButton }) {
				this.loadingButton = pressedButton;
				
				try {
					let response = await this.$http.post('/intro/basic', {
						bookingPage: {
							slug: this.bookingPage.slug,
						},
						
						user: {
							localityKey: this.user.localityKey,
						},
					});
					
					this.$store.commit('mergeAuthUser', response.data.data);
					await this.$router.replace({ name: this.$store.state.auth.user.entryPointRoute });
				} catch (error) {
					this.loadingButton = null;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = error.response.data.validationFields;
						return;
					}
					
					throw error;
				}
			},
		},
	};
</script>

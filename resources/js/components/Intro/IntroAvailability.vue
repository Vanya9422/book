<template>
	<form @submit.prevent="saveData({ pressedButton: 'continue' })">
		<div class="container d-flex justify-content-center pt-4 pb-4">
			<div class="col-lg-7 pt-4 pb-4">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row justify-content-between align-items-end">
							<div class="col-lg-12 pt-3">
								<h5>
									Set your availability
								</h5>
								<p class="text-secondary mt-4">
									Let Bookify know when you’re typically available to accept meetings.
								</p>
							</div>
							<div v-if="false" class="col-lg-4">
								<img src="/img/availability.svg" alt="" style="max-width: 100%;">
							</div>
						</div>
					</div>
					<div class="card-body">
						<div id="available-hours">
							<small class="mb-2 d-block">
								<strong>Available Hours</strong>
							</small>
							<div class="col-lg-12 mb-4">
								<div class="row justify-content-between">
									<div class="col-lg-5 p-0">
										<select v-model="availability.hourFrom" class="form-control"
											@change="hourFromChanged">
											<option v-for="hour in 24" :key="hour" :value="hour - 1">
												{{ $moment().hour(hour - 1).format('hh:00 A') }}
											</option>
										</select>
									</div>
									<div class="col-lg-1 p-0 text-center text-secondary">
										____
									</div>
									<div class="col-lg-5 p-0">
										<select v-model="availability.hourTo" class="form-control"
											@change="hourToChanged">
											<option v-for="hour in 24" :key="hour" :value="hour - 1">
												{{ $moment().hour(hour - 1).format('hh:00 A') }}
											</option>
										</select>
									</div>
								</div>
							</div>
							<small class="mb-2 d-block">
								<strong>Available Days</strong>
							</small>
							<div class="col-lg-12">
								<div class="row">
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline1" v-model="availability.sunday" type="checkbox"
												class="custom-control-input" value="1">
											<label class="custom-control-label" for="customControlInline1"></label>
										</div>
										<span><small class="text-secondary">Sundays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline2" v-model="availability.monday" type="checkbox" class="custom-control-input"
												value="1" checked>
											<label class="custom-control-label" for="customControlInline2"></label>
										</div>
										<span><small class="text-secondary">Mondays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline3" v-model="availability.tuesday" type="checkbox" class="custom-control-input"
												value="1" checked>
											<label class="custom-control-label" for="customControlInline3"></label>
										</div>
										<span><small class="text-secondary">Tuesdays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline4" v-model="availability.wednesday" type="checkbox" class="custom-control-input"
												value="1" checked>
											<label class="custom-control-label" for="customControlInline4"></label>
										</div>
										<span><small class="text-secondary">Wednesdays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline5" v-model="availability.thursday" type="checkbox" class="custom-control-input"
												value="1" checked>
											<label class="custom-control-label" for="customControlInline5"></label>
										</div>
										<span><small class="text-secondary">Thursdays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border border-right-0 p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline6" v-model="availability.friday" type="checkbox"
												class="custom-control-input" checked>
											<label class="custom-control-label" for="customControlInline6"></label>
										</div>
										<span><small class="text-secondary">Fridays</small></span>
									</div>
									<div class="col d-flex flex-column align-items-center border p-2">
										<div class="custom-control custom-checkbox my-1">
											<input id="customControlInline7" v-model="availability.saturday"
												type="checkbox" class="custom-control-input">
											<label class="custom-control-label" for="customControlInline7"></label>
										</div>
										<span><small class="text-secondary">Saturdays</small></span>
									</div>
								</div>
							</div>
							<div class="text-center text-secondary mt-4">
								<small>Don’t worry! You’ll be able to further customize your availability later on.</small>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-4">
					<div class="col-lg-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-3">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="70"
										aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col">
								<div class="d-flex justify-content-end align-items-center">
									<button type="button" class="btn"
										:class="{ 'is-loading': loadingButton === 'set_up_later' }"
										:disabled="loadingButton === 'set_up_later'"
										@click="saveData({ pressedButton: 'set_up_later' })">
										Set up later
									</button>
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
	export default {
		data() {
			return {
				availability: {
					hourFrom: this.$store.state.auth.user.availability.hourFrom,
					hourTo: this.$store.state.auth.user.availability.hourTo,
					monday: this.$store.state.auth.user.availability.monday,
					tuesday: this.$store.state.auth.user.availability.tuesday,
					wednesday: this.$store.state.auth.user.availability.wednesday,
					thursday: this.$store.state.auth.user.availability.thursday,
					friday: this.$store.state.auth.user.availability.friday,
					saturday: this.$store.state.auth.user.availability.saturday,
					sunday: this.$store.state.auth.user.availability.sunday,
				},

				loadingButton: null,
			};
		},

		created() {
			//
		},

		mounted() {
			//
		},

		methods: {
			hourFromChanged() {
				if (this.availability.hourFrom >= this.availability.hourTo) {
					if (this.availability.hourFrom === 23) {
						this.availability.hourTo = 0;
					} else {
						this.availability.hourTo = (this.availability.hourFrom + 1);
					}
				}
			},

			hourToChanged() {
				if (this.availability.hourTo <= this.availability.hourFrom) {
					if (this.availability.hourTo === 0) {
						this.availability.hourFrom = 23;
					} else {
						this.availability.hourFrom = (this.availability.hourTo - 1);
					}
				}
			},

			async saveData({ pressedButton }) {
				this.loadingButton = pressedButton;

				try {
					let response = await this.$http.post('/intro/availability', {
						userAvailability: this.availability,
						skip: (['set_up_later'].indexOf(pressedButton) > -1 ? true : null),
					});

					this.$store.commit('mergeAuthUser', response.data.data);
					await this.$router.replace({ name: this.$store.state.auth.user.entryPointRoute });
				} catch (error) {
					this.loadingButton = null;
					throw error;
				}
			},
		},
	};
</script>

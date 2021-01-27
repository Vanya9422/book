<template>
	<div class="card dashboard-booking-type-collect-payments">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover collapsed text-left">
							Collect Payments
							<div>
								<small class="text-secondary text-left d-block">
									Bookify confirmation page, no active links
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
		<form ref="form" class="border-top collapse" onsubmit="return false">
			<div class="card-body">
				<div class="col-lg-6">
					<div class="alert alert-danger mb-4" role="alert">
						To collect payments, visit your
						<a href="#">
							Integrations page
						</a>
						and choose your preferred provider.
					</div>
					<div>
						1
						<div class="custom-control custom-radio">
							<input id="customRadio1" type="radio" name="customRadio" class="custom-control-input">
							<label class="custom-control-label" for="customRadio1">
								Do not collect payments for this event
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="customRadio2" type="radio" name="customRadio" class="custom-control-input">
							<label class="custom-control-label" for="customRadio2">
								Accept payments with Stripe
							</label>
						</div>
						<div class="custom-control custom-radio">
							<input id="customRadio3" type="radio" name="customRadio" class="custom-control-input">
							<label class="custom-control-label" for="customRadio3">
								Accept payments with PayPal
							</label>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="d-flex justify-content-end align-items-center"
						:class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
						<button type="button" class="btn btn-default mr-4" @click="cancel">
							Cancel
						</button>
						<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
							:disabled="isLoading" @click="save">
							{{ bookingType.id ? 'Save & Close' : 'Next' }}
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
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
			};
		},
		
		methods: {
			
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
			},
			
			save() {
				this.isLoading = true;
				this.isLoading = false;
				this.close({ animate: !!this.bookingType.id });
			},
		},
	};
</script>

<template>
	<div>
		<div v-if="auth.user" class="col-lg-8 p-0" :class="{ 'text-center': dashboardButtonCentered }">
			<router-link class="btn btn-primary next-step py-3 btn-block" type="button" :to="{ name: auth.user.entryPointRoute }">
				<span class="h4 mb-0">Go to Dashboard</span>
			</router-link>
		</div>
		<form v-else onsubmit="event.preventDefault();" @submit="checkEmailAndContinue">
			<div class="input-group mb-3">
				<input
					ref="email"
					v-model="user.email"
					type="email"
					class="form-control border-primary"
					placeholder="Enter your email"
					aria-label="Enter your email"
					name="email"
					aria-describedby="signup__button">
				<div class="input-group-append">
					<button class="btn btn-primary" :class="{ 'is-loading': isLoading }" type="submit">
						Get Started
					</button>
				</div>
			</div>
			<small v-if="validationFields['user.email']" class="form-text text-danger text-center">
				{{ validationFields['user.email'][0] }}
			</small>
			<small v-else class="form-text text-muted text-center">
				Get started for free. No credit card required.
			</small>
		</form>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		props: {
			autofocus: {
				type: Boolean,
			},

			dashboardButtonCentered: {
				type: Boolean,
			},
		},

		data() {
			return {
				user: {
					email: null,
				},

				validationFields: {},
				isLoading: false,
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
			]),
		},

		mounted() {
			this.autofocus && this.$refs.email && this.$refs.email.focus();
		},

		methods: {
			async checkEmailAndContinue() {
				this.isLoading = true;

				try {
					await this.$store.dispatch('checkEmail', this.user.email);
					this.isLoading = false;

					if (this.auth.email.user) {
						await this.$router.push({ name: 'auth.login', params: { locale: this.locale } });
					} else {
						await this.$router.push({ name: 'auth.register', params: { locale: this.locale } });
					}
				} catch (error) {
					this.isLoading = false;

					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						!this.user.email && this.$refs.email.focus();
						return;
					}

					throw error;
				}
			},
		},
	};
</script>

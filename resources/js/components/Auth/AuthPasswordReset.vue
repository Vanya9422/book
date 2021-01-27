<template>
	<div>
		<div v-if="passwordHasBeenReset"
			class="container-fluid login_page d-flex flex-column justify-content-center align-items-center">
			<div class="login_page__logo">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" width="35" height="35" class="d-inline-block align-top" alt="">
				</router-link>
			</div>
			<p class="text-center">
				Your password has been reset!
			</p>
			<p class="text-center">
				<router-link class="btn btn-primary" :to="{ name: auth.user.entryPointRoute }">
					Continue
				</router-link>
			</p>
		</div>
		<div v-else class="container-fluid login_page d-flex flex-column justify-content-center align-items-center">
			<div class="login_page__logo">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/book_dark.svg" width="30" height="30" class="d-inline-block align-top" alt="">
				</router-link>
			</div>
			<p class="text-center">
				Reset your password
			</p>
			<div class="col-lg-4 border p-4 rounded">
				<form @submit.prevent="reset">
					<div class="form-group">
						<label for="password">New Password</label>
						<input id="password" ref="password" v-model="user.password"
							type="password" class="form-control"
							:class="{ 'is-invalid': validationFields['user.password'] }" name="password" autocomplete="new-password">
						<div v-if="validationFields['user.password']" class="invalid-feedback" role="alert">
							{{ validationFields['user.password'][0] }}
						</div>
					</div>
					<div class="form-group">
						<label for="password-confirm">Confirm New Password</label>
						<input id="password-confirm" v-model="user.passwordConfirmation" type="password" class="form-control"
							name="password_confirmation" autocomplete="new-password">
					</div>
					<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }">
						Reset Password
					</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {
				user: {
					email: this.$route.query.email,
					password: null,
					passwordConfirmation: null,
				},

				token: this.$route.params.token,
				validationFields: {},
				isLoading: false,
				passwordHasBeenReset: false,
			};
		},

		computed: {
			...mapState([
				'auth',
				'locale',
			]),
		},

		mounted() {
			this.$refs.password.focus();
		},

		methods: {
			async reset() {
				this.isLoading = true;

				try {
					let response = await this.$http.post('/auth/password/reset', {
						user: this.user,
						token: this.token,
					});

					this.$store.commit('setAuth', response.data.data);
					this.passwordHasBeenReset = true;
					this.isLoading = false;
				} catch (error) {
					this.isLoading = false;

					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						return;
					}

					if (error.response && error.response.data.error === 'Invalid Token') {
						return this.$notify({
							text: 'This password reset token is invalid.',
							type: 'error',
						});
					}

					throw error;
				}
			},
		},
	};
</script>

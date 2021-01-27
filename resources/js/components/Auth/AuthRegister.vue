<template>
	<div>
		<div class="container-fluid signup_page d-flex flex-column justify-content-center align-items-center">
			<div class="signup_page__logo">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" alt="" class="d-inline-block align-top" width="35" height="35">
				</router-link>
			</div>
			<p v-if="!preferStandardRegistration && auth.email && !auth.email.user && auth.email.type">
				Hi {{ user.email }}!
			</p>
			<p v-else>
				Sign up with Bookify for free
			</p>
			<div class="col-lg-4 border p-4 rounded">
				<form
					v-if="!preferStandardRegistration && auth.email && !auth.email.user && auth.email.type === 'GOOGLE'"
					@submit.prevent="signUpThroughGoogle">
					<p>
						The easiest way for you to sign up is with Google. This will automatically connect your calendar
						so you can start using Bookify right away!
					</p>
					<p class="text-center">
						<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
							:disabled="isLoading">
							Sign up with Google
						</button>
					</p>
					<p>
						Prefer to create an account with a password?
						<br>
						<a href="#" @click.prevent="switchToStandardRegistration">Click here.</a>
					</p>
				</form>
				<form v-else @submit.prevent="register">
					<div class="form-group">
						<label for="register_email">Enter your email to get started.</label>
						<input id="register_email" ref="email" v-model="user.email" type="email" name="email"
							class="form-control" placeholder="Email address"
							:class="{ 'is-invalid': validationFields['user.email'] || (auth.email && auth.email.user && emailChecked) }"
							aria-describedby="emailHelp">
						<div v-if="validationFields['user.email']" class="invalid-feedback">
							{{ validationFields['user.email'][0] }}
						</div>
						<div v-else-if="auth.email && auth.email.user && emailChecked" class="invalid-feedback">
							{{ 'An account already exists with this email address.' }}
						</div>
					</div>
					<div v-if="auth.email && !auth.email.user" class="row">
						<div class="col form-group">
							<label :for="`${_uid}-first-name`">Enter your first name.</label>
							<input :id="`${_uid}-first-name`" ref="firstName" v-model="user.firstName" type="text"
								name="first_name" class="form-control"
								:class="{ 'is-invalid': validationFields['user.first_name'] }" placeholder="John">
							<div v-if="validationFields['user.first_name']" class="invalid-feedback">
								{{ validationFields['user.first_name'][0] }}
							</div>
						</div>
						<div class="col form-group">
							<label :for="`${_uid}-last-name`">Enter your last name.</label>
							<input :id="`${_uid}-last-name`" ref="lastName" v-model="user.lastName" type="text"
								name="last_name" class="form-control"
								:class="{ 'is-invalid': validationFields['user.last_name'] }" placeholder="Doe">
							<div v-if="validationFields['user.last_name']" class="invalid-feedback">
								{{ validationFields['user.last_name'][0] }}
							</div>
						</div>
					</div>
					<div v-if="auth.email && !auth.email.user" class="form-group">
						<label for="register_password">Choose a password with at least 8 characters.</label>
						<input id="register_password" ref="password" v-model="user.password" type="password"
							name="password" class="form-control" placeholder="Password"
							:class="{ 'is-invalid': validationFields['user.password'] }">
						<div v-if="validationFields['user.password']" class="invalid-feedback">
							{{ validationFields['user.password'][0] }}
						</div>
					</div>
					<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
						:disabled="isLoading">
						Continue
					</button>
					<p class="signup_page__account">
						Don't have an account?&nbsp;
						<router-link :to="{ name: 'auth.login', params: { locale } }">
							Login
						</router-link>.
					</p>
				</form>
			</div>
			<div class="btn-group signup_page__language">
				<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
					aria-haspopup="true" aria-expanded="false">
					Language
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#">English</a>
					<a class="dropdown-item" href="#">Français</a>
				</div>
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
					email: this.$store.state.auth.email && !this.$store.state.auth.email.user ? this.$store.state.auth.email.value : null,
					firstName: null,
					lastName: null,
					password: null,
					timezoneCode: this.$moment.tz.guess(),
				},
				
				validationFields: {},
				emailChecked: false,
				preferStandardRegistration: false,
				isLoading: false,
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
				'detectedLocality',
			]),
		},
		
		mounted() {
			if (!this.auth.email || (this.auth.email && this.auth.email.user)) {
				this.$refs.email && this.$refs.email.focus();
			} else if (!this.auth.email.user) {
				this.$refs.firstName && this.$refs.firstName.focus();
			}
		},
		
		methods: {
			switchToStandardRegistration() {
				this.preferStandardRegistration = true;
				
				this.$nextTick(() => {
					this.$refs.firstName.focus();
				});
			},
			
			async checkEmail() {
				this.isLoading = true;
				
				try {
					let response = await this.$http.post('/auth/email/check', {
						user: {
							email: this.user.email,
						},
					});
					
					this.$store.commit('setAuthEmail', response.data.data);
					this.isLoading = false;
					this.emailChecked = true;
					this.validationFields = {};
					
					if (!this.auth.email.user && !this.auth.email.type) {
						return this.$nextTick(() => {
							this.$refs.name && this.$refs.firstName.focus();
						});
					}
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...this.validationFields, ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			async register() {
				if (!this.auth.email || this.auth.email.user) {
					return await this.checkEmail();
				}
				
				this.isLoading = true;
				
				try {
					await this.$store.dispatch('register', {
						user: {
							email: this.user.email,
							firstName: this.user.firstName,
							lastName: this.user.lastName,
							password: this.user.password,
							localityKey: this.detectedLocality ? this.detectedLocality.key : null,
						},
						
						rememberMe: true,
					});
					
					await this.$router.push({ name: this.auth.user.entryPointRoute });
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...this.validationFields, ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			signUpThroughGoogle() {
				this.isLoading = true;
				window.location.href = this.auth.urls.google.login;
			},
		},
	};
</script>

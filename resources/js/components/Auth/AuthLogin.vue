<template>
	<div>
		<div v-if="resetPasswordEmailSent" class="container-fluid" style="padding-top: 65px;">
			<div class="text-center mb-2">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" alt="" class="d-inline-block align-top" width="35" height="35">
				</router-link>
			</div>
			<div class="text-center mb-2">
				Please check your {{ user.email }} inbox for a reset password link.
			</div>
			<div class="text-center">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					Go to home page.
				</router-link>
			</div>
		</div>
		<div v-else class="container-fluid login_page d-flex flex-column justify-content-center align-items-center">
			<div class="login_page__logo">
				<router-link :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" alt="" class="d-inline-block align-top" width="35" height="35">
				</router-link>
			</div>
			<p v-if="!auth.email || !auth.email.user">
				Log into your Bookify account.
			</p>
			<p v-if="auth.email && auth.email.user" class="text-center">
				Welcome back, {{ auth.email.user.name || auth.email.value }}!
				<br>
				<a href="#" @click.prevent="forgetEmail">(This is not me.)</a>
			</p>
			<div class="col-lg-4 border p-4 rounded">
				<form v-if="!auth.email || !auth.email.user" @submit.prevent="checkEmail">
					<div id="email_field" class="form-group">
						<label for="exampleInputEmail1">Enter your email to get started.</label>
						<input id="exampleInputEmail1" ref="email" v-model="user.email" type="email"
							name="email" class="form-control"
							:class="{ 'is-invalid': validationFields['user.email'] || (auth.email && !auth.email.user && emailChecked) }"
							placeholder="Enter Email address" aria-describedby="emailHelp">
						<div v-if="validationFields['user.email']" class="invalid-feedback">
							{{ validationFields['user.email'][0] }}
						</div>
						<div v-else-if="auth.email && !auth.email.user && emailChecked" class="invalid-feedback">
							No account exists for {{ user.email }}
						</div>
					</div>
					<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
						:disabled="isLoading">
						Continue
					</button>
					<p class="login_page__account">
						Don't have an account?
						<router-link :to="{ name: 'auth.register', params: { locale } }">
							Sign up
						</router-link>.
					</p>
				</form>
				<form v-else-if="auth.email.user && auth.email.user.authMethod === 'GOOGLE'">
					<button type="button" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
						:disabled="isLoading" @click="loginThroughGoogle">
						Login with Google
					</button>
					<p class="login_page__account">
						Don't have an account?
						<router-link :to="{ name: 'auth.register', params: { locale } }">
							Sign up
						</router-link>.
					</p>
				</form>
				<form v-else-if="auth.email.user && !auth.email.user.authMethod" @submit.prevent="login">
					<div class="form-group">
						<label for="exampleInputPassword1">Enter your password to log in.</label>
						<input id="exampleInputPassword1" ref="password" v-model="user.password" type="password"
							name="password" class="form-control" placeholder="Enter Password"
							:class="{ 'is-invalid': validationFields['user.email'] || validationFields['user.password'] }"
							aria-describedby="passwordHelp">
						<div v-if="validationFields['user.email']" class="invalid-feedback">
							{{ validationFields['user.email'][0] }}
						</div>
						<div v-else-if="validationFields['user.password']" class="invalid-feedback">
							{{ validationFields['user.password'][0] }}
						</div>
					</div>
					<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
						:disabled="isLoading">
						Login
					</button>
					<p class="mb-1" style="margin-top: 30px;">
						I forgot my password.
						Please <a href="#" @click.prevent="sendRecoveryEmail">send me a recovery email</a>.
					</p>
					<p>
						Don't have an account?&nbsp;
						<router-link :to="{ name: 'auth.register', params: { locale } }">
							Sign up
						</router-link>.
					</p>
				</form>
			</div>
			<div class="btn-group login_page__language">
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
					email: this.$store.state.auth.email && this.$store.state.auth.email.user ? this.$store.state.auth.email.value : null,
					password: null,
				},
				
				rememberMe: true,
				emailChecked: false,
				validationFields: {},
				isLoading: false,
				resetPasswordEmailSent: false,
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
			]),
		},
		
		mounted() {
			if (!this.auth.email || (this.auth.email && !this.auth.email.user)) {
				this.$refs.email && this.$refs.email.focus();
			} else if (this.auth.email.user) {
				this.$refs.password && this.$refs.password.focus();
			}
		},
		
		methods: {
			async checkEmail() {
				this.isLoading = true;
				
				try {
					await this.$store.dispatch('checkEmail', this.user.email);
					this.isLoading = false;
					this.emailChecked = true;
					
					if (!this.auth.email.user) {
						return;
					}
					
					this.validationFields = {};
					
					if (this.auth.email.user.authMethod) {
						return;
					}
					
					this.$nextTick(() => {
						this.$refs.password.focus();
					});
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			async forgetEmail() {
				await this.$store.dispatch('forgetEmail');
				this.user.email = null;
				
				this.$nextTick(() => {
					this.$refs.email.focus();
				});
			},
			
			async login() {
				this.isLoading = true;
				
				try {
					await this.$store.dispatch('login', {
						user: this.user,
						rememberMe: this.rememberMe,
					});
					
					await this.$router.push({ name: this.auth.user.entryPointRoute });
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			async sendRecoveryEmail() {
				await this.$http.post('/auth/password/email', {
					user: {
						email: this.user.email,
					},
				});
				
				this.resetPasswordEmailSent = true;
			},
			
			loginThroughGoogle() {
				this.isLoading = true;
				window.location.href = this.auth.urls.google.login;
			},
		},
	};
</script>

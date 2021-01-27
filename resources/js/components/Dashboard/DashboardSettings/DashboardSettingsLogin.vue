<template>
	<div>
		<div class="card">
			<div class="card-body">
				<div class="row align-items-center">
					<div class="col" style="max-width: 100px;">
						<img src="/img/avatar.png" alt="" style="max-width: 100%; border-radius: 50%;">
					</div>
					<div class="col">
						<span class="text-secondary">
							<small>
								You logged in with a Google account.
							</small>
						</span>
					</div>
				</div>
				<div class="mt-2 row justify-content-between align-items-center">
					<div class="col-lg-8">
						<strong>Google account</strong>
						<span>someemail@gmail.com</span>
					</div>
					<div class="col-lg-4">
						<a class="btn btn-primary" href="#">Change Login</a>
					</div>
				</div>
				<div class="mt-2 d-flex align-items-center">
					<span class="text-secondary">
						<small>You logged in with a Google account.</small>
					</span>
				</div>
				<div class="mt-3 d-flex justify-content-between align-items-end">
					<div class="name">
						<strong class="d-block">Email Address</strong>
						<span>{{ auth.user.email }}</span>
					</div>
					<button type="button" class="btn btn-link text-decoration-none" @click="openChangeEmailModal">
						Change Email
					</button>
				</div>
				<div class="mt-3 d-flex justify-content-between align-items-end">
					<div class="name">
						<strong class="d-block">Password</strong>
						<span>********</span>
					</div>
					<button type="button" class="btn btn-link text-decoration-none" @click="openChangePasswordModal">
						Change Password
					</button>
				</div>
				<div class="mt-4 text-secondary">
					Please <a href="#">contact support</a> if you need assistance.
				</div>
			</div>
		</div>
		<form ref="changeEmailModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true" @submit.prevent="saveChangeEmailModal">
			<div class="modal-dialog" role="document">
				<div v-if="changeEmailModal" class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Change Login Email
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input id="exampleInputPassword1" ref="changeEmailModalCurrentPassword" v-model="changeEmailModal.form.currentPassword"
								type="password"
								class="form-control" :class="{ 'is-invalid': changeEmailModal.validationFields['user.current_password'] }" placeholder="Password">
							<div v-if="changeEmailModal.validationFields['user.current_password']" class="invalid-feedback">
								{{ changeEmailModal.validationFields['user.current_password'][0] }}
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Email</label>
							<input id="exampleInputEmail1" v-model="changeEmailModal.form.email" type="email"
								class="form-control"
								:class="{ 'is-invalid': changeEmailModal.validationFields['user.email'] }" aria-describedby="emailHelp"
								placeholder="New email address">
							<div v-if="changeEmailModal.validationFields['user.email']" class="invalid-feedback">
								{{ changeEmailModal.validationFields['user.email'][0] }}
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"
							:class="{ 'is-loading': changeEmailModal.isLoading }"
							:disabled="changeEmailModal.isLoading">
							Save Changes
						</button>
					</div>
				</div>
			</div>
		</form>
		<form ref="changePasswordModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true" @submit.prevent="saveChangePasswordModal">
			<div class="modal-dialog" role="document">
				<div v-if="changePasswordModal" class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Change Password
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleInputPassword1">Current password</label>
							<input id="exampleInputPassword1" ref="changePasswordModalCurrentPassword" v-model="changePasswordModal.form.currentPassword"
								type="password"
								class="form-control" :class="{ 'is-invalid': changePasswordModal.validationFields['user.current_password'] }" placeholder="Password">
							<div v-if="changePasswordModal.validationFields['user.current_password']"
								class="invalid-feedback">
								{{ changePasswordModal.validationFields['user.current_password'][0] }}
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">New password</label>
							<input id="exampleInputPassword1" v-model="changePasswordModal.form.password" type="password"
								class="form-control"
								:class="{ 'is-invalid': changePasswordModal.validationFields['user.password'] }" placeholder="New password">
							<div v-if="changePasswordModal.validationFields['user.password']" class="invalid-feedback">
								{{ changePasswordModal.validationFields['user.password'][0] }}
							</div>
							<input id="exampleInputPassword1" v-model="changePasswordModal.form.passwordConfirmation" type="password"
								class="form-control mt-2"
								placeholder="Repeat new password">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="submit" class="btn btn-primary"
							:class="{ 'is-loading': changePasswordModal.isLoading }"
							:disabled="changePasswordModal.isLoading">
							Save Changes
						</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {
				changeEmailModal: null,
				changePasswordModal: null,
			};
		},

		computed: {
			...mapState([
				'auth',
			]),
		},

		mounted() {
			console.log('DashboardSettingsLogin mounted');

			$(this.$refs.changeEmailModal).on('shown.bs.modal', () => {
				this.$refs.changeEmailModalCurrentPassword && this.$refs.changeEmailModalCurrentPassword.focus();
			});

			$(this.$refs.changePasswordModal).on('shown.bs.modal', () => {
				this.$refs.changePasswordModalCurrentPassword && this.$refs.changePasswordModalCurrentPassword.focus();
			});
		},

		beforeDestroy() {
			$(this.$refs.changeEmailModal).off();
			$(this.$refs.changePasswordModal).off();
		},

		methods: {
			openChangeEmailModal() {
				this.changeEmailModal = {
					form: {
						currentPassword: null,
						email: null,
					},

					isLoading: false,
					validationFields: {},
				};

				$(this.$refs.changeEmailModal).modal('show');
			},

			async saveChangeEmailModal() {
				this.changeEmailModal.isLoading = true;

				try {
					let response = await this.$http.post('/users/me/change_email', {
						user: this.changeEmailModal.form,
					});

					this.$store.commit('mergeAuthUser', response.data.data);
					$(this.$refs.changeEmailModal).modal('hide');

					this.$notify({
						text: 'Your email successfully changed!',
						type: 'success',
					});
				} catch (error) {
					this.changeEmailModal.isLoading = false;

					if (error.response && error.response.data.error === 'Validation') {
						this.$set(this.changeEmailModal, 'validationFields', error.response.data.validationFields);
						return;
					}

					throw error;
				}
			},

			openChangePasswordModal() {
				this.changePasswordModal = {
					form: {
						currentPassword: null,
						password: null,
						passwordConfirmation: null,
					},

					isLoading: false,
					validationFields: {},
				};

				$(this.$refs.changePasswordModal).modal('show');
			},

			async saveChangePasswordModal() {
				this.changePasswordModal.isLoading = true;

				try {
					let response = await this.$http.post('/auth/password/change', {
						user: this.changePasswordModal.form,
					});

					this.$store.commit('setAuth', response.data.data);
					$(this.$refs.changePasswordModal).modal('hide');

					this.$notify({
						text: 'Your password successfully changed!',
						type: 'success',
					});
				} catch (error) {
					this.changePasswordModal.isLoading = false;

					if (error.response && error.response.data.error === 'Validation') {
						this.$set(this.changePasswordModal, 'validationFields', error.response.data.validationFields);
						return;
					}

					throw error;
				}
			},
		},
	};
</script>

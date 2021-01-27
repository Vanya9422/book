<template>
	<form @submit.prevent="saveData({ pressedButton: 'finish' })">
		<div class="container d-flex justify-content-center pt-4 pb-4">
			<div class="col-lg-7 pt-4 pb-4">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row justify-content-between align-items-end">
							<div class="col-lg-12 pt-3">
								<h5>
									Personalize your experience
								</h5>
								<p class="text-secondary mt-4">
									Tell us about your role at work. This will help us to provide a tailored support experience.
								</p>
							</div>
							<div v-if="false" class="col-lg-4">
								<img src="/img/role.svg" alt="" style="max-width: 100%;">
							</div>
						</div>
					</div>
					<div class="card-body">
						<small class="mb-3 d-block">
							<strong>What is your day-to-day role at work?</strong>
						</small>
						<div>
							<div v-for="(roleKey, roleIndex) of Object.keys(__('users.roles'))" :key="roleKey"
								class="custom-control mb-3 custom-radio">
								<input :id="'control-radio-' + roleIndex" v-model="user.role" type="radio"
									class="custom-control-input" :value="roleKey" required>
								<label class="custom-control-label" :for="'control-radio-' + roleIndex">
									{{ __('users.roles.' + roleKey + '.title') }}
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-4">
					<div class="col-lg-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-3">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90"
										aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col">
								<div class="d-flex justify-content-end align-items-center">
									<button class="btn btn-primary ml-3"
										:class="{ 'is-loading': loadingButton === 'finish' }"
										:disabled="!user.role || loadingButton === 'finish'">
										Finish
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
				user: {
					role: null,
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
			async saveData({ pressedButton }) {
				this.loadingButton = pressedButton;
				
				try {
					let response = await this.$http.post('/intro/role', {
						user: {
							role: this.user.role,
						},
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

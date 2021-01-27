<template>
	<form @submit.prevent="saveData({ pressedButton: 'continue_without_calendar' })">
		<div class="container d-flex justify-content-center pt-4 pb-4">
			<div class="col-lg-7 pt-4 pb-4">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row justify-content-between align-items-end">
							<div class="col-lg-12 pt-3">
								<h5>
									Connect your calendar
								</h5>
								<p class="text-secondary mt-4">
									Connect your calendar to auto-check for busy times and add new bookings as they are scheduled.
								</p>
							</div>
							<div v-if="false" class="col-lg-4">
								<img src="/img/welcome_calendar.svg" alt="" style="max-width: 100%;">
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-2 p-0">
									<img src="/img/google.svg" alt="" width="20">
									<div>
										Google
									</div>
								</div>
								<div class="col-lg-10 pr-0 ">
									<div class="card">
										<div class="card-body" style="cursor: pointer;" @click="redirectToGoogle">
											<div class="row">
												<div class="col-lg-2">
													<img src="/img/google_calendar.svg" alt="" style="max-width: 100%;">
												</div>
												<div class="col-lg-10">
													<h5 class="card-title mb-2">
														Google Calendar
													</h5>
													<p class="card-text text-secondary">
														<small>Gmail, G Suite</small>
													</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="d-none">
							<hr>
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-2 p-0">
										<img src="/img/windows.svg" alt="" width="20">
										<div>
											Microsoft
										</div>
									</div>
									<div class="col-lg-10 pr-0 ">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-2">
														<img src="/img/office.svg" alt="" style="max-width: 100%;">
													</div>
													<div class="col-lg-10">
														<h5 class="card-title mb-2">
															Office 365 Calendar
														</h5>
														<p class="card-text text-secondary">
															<small>Office 365, Outlook.com, live.com, or hotmail calendar</small>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 mt-3">
								<div class="row">
									<div class="col-lg-2 p-0"></div>
									<div class="col-lg-10 pr-0 ">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-2">
														<img src="/img/exchange.svg" alt="" style="max-width: 100%;">
													</div>
													<div class="col-lg-10">
														<h5 class="card-title mb-2">
															Exchange Calendar
														</h5>
														<p class="card-text text-secondary">
															<small>Exchange Server 2013, 2016, or 2019</small>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12 mt-3">
								<div class="row">
									<div class="col-lg-2 p-0"></div>
									<div class="col-lg-10 pr-0 ">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-2">
														<img src="/img/outlook.svg" alt="" style="max-width: 100%;">
													</div>
													<div class="col-lg-10">
														<h5 class="card-title mb-2">
															Outlook Plug-In
														</h5>
														<p class="card-text text-secondary">
															<small>Outlook 2007, 2010, 2013 or 2016 with Windows XP, Vista, 7, 8, 8.1 or 10.</small>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-2 p-0">
										<img src="/img/apple.svg" alt="" width="20">
										<div>
											Apple
										</div>
									</div>
									<div class="col-lg-10 pr-0 ">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-2">
														<img src="/img/cloud.svg" alt="" style="max-width: 100%;">
													</div>
													<div class="col-lg-10">
														<h5 class="card-title mb-2">
															iCloud Calendar
														</h5>
														<p class="card-text text-secondary">
															<small>Default calendar for all Apple products.</small>
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-4">
					<div class="col-lg-12">
						<div class="row justify-content-between align-items-center">
							<div class="col-lg-3">
								<div class="progress">
									<div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40"
										aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<div class="col">
								<div class="d-flex justify-content-end align-items-center">
									<button type="submit" class="btn"
										:class="{ 'is-loading': loadingButton === 'continue_without_calendar' }"
										:disabled="loadingButton === 'continue_without_calendar'">
										Continue without calendar
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
			redirectToGoogle() {
				window.location.href = this.$store.state.auth.urls.google.calendar;
			},

			async saveData({ pressedButton }) {
				this.loadingButton = pressedButton;

				try {
					let response = await this.$http.post('/intro/calendar', {
						skip: (['continue_without_calendar'].indexOf(pressedButton) > -1 ? true : null),
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

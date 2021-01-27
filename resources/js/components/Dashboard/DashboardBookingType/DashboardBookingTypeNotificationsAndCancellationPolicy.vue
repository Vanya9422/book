<template>
	<div class="card">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover collapsed text-left">
							Notifications and Cancellation Policy
							<div>
								<small class="text-secondary text-left d-block">
									Calendar Invitations, No Reminders
								</small>
							</div>
						</button>
						<div class="btn-group fade" :class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
							<button type="button" class="btn btn-outline-secondary" @click.stop="cancel">
								Cancel
							</button>
							<button type="button" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
								:disabled="isLoading" @click.stop="saveNotificationAndCancellationPolicy">
								{{ bookingType.id ? 'Save & Close' : 'Next' }}
							</button>
						</div>
					</div>
				</div>
			</h2>
		</div>
		<form ref="form" class="border-top collapse" onsubmit="return false">
			<div class="card-body">
				<div v-if="!showEmailConfirmations">
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/invitee_invitation.svg" alt="" width="62">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Calendar Invitations
								</strong>
								<p class="mb-2">
									An event will be created in your calendar and your invitee will be added as an attendee.
								</p>
								<p class="mb-2">
									<small class="text-secondary">
										<strong>
											Note:
										</strong>
										Requires a Google, Office 365 or Exchange calendar connection with the ability to add new Bookify events.
									</small>
								</p>
								<button class="btn btn-link pl-0" @click="switchToEmailConfirmations(true)">
									Switch to Email Confirmations
								</button>
							</div>
							<div class="col-lg-3 align-self-top">
								<div class="row align-items-center"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/invitee_reminder.svg" alt="" width="60">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Reminders
								</strong>
								<p class="mb-2">
									An invitee will receive a reminder email before a scheduled event at specified times.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch8"
											v-model="notificationAndCancellationPolicy.isInviteeReminderEnabled"
											type="checkbox" class="custom-control-input" checked>
										<label class="custom-control-label" for="customSwitch8"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/email_follow_up.svg" alt="" width="60">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Follow-Up
								</strong>
								<p class="mb-2">
									Request a review or prompt next steps with an automated email sent after the event is over.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch9"
											v-model="notificationAndCancellationPolicy.isInviteeEmailFollowUpEnabled"
											type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="customSwitch9"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/sms_reminder.svg" alt="" width="39">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Text Reminders
								</strong>
								<p class="mb-2">
									Your invitees will have the option of receiving text reminders before a scheduled event at specified times.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch7"
											v-model="notificationAndCancellationPolicy.isInviteeSmsReminderEnabled"
											type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="customSwitch7"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div v-else>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/invitee_confirmation-2.svg" alt="" width="62">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Confirmations
								</strong>
								<p class="mb-2">
									Your invitee will receive an email confirmation with links to create their own calendar event.
								</p>
								<button class="btn btn-link pl-0" @click="switchToEmailConfirmations(false)">
									Switch to Calendar Invitations
								</button>
							</div>
							<div class="col-lg-3 align-self-top">
								<div class="row align-items-center"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/invitee_cancellation-2.svg" alt="" width="62">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Cancellations
								</strong>
								<p class="mb-2">
									Email notifications will be sent to your invitee if you cancel the event.
								</p>
							</div>
							<div class="col-lg-3 align-self-top">
								<div class="row align-items-center"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/invitee_reminder.svg" alt="" width="60">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Reminders
								</strong>
								<p class="mb-2">
									An invitee will receive a reminder email before a scheduled event at specified times.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch8"
											v-model="notificationAndCancellationPolicy.isInviteeReminderEnabled"
											type="checkbox" class="custom-control-input" checked>
										<label class="custom-control-label" for="customSwitch8"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/email_follow_up.svg" alt="" width="60">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Email Follow-Up
								</strong>
								<p class="mb-2">
									Request a review or prompt next steps with an automated email sent after the event is over.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch9"
											v-model="notificationAndCancellationPolicy.isInviteeEmailFollowUpEnabled"
											type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="customSwitch9"></label>
									</div>
								</div>
							</div>
							<div class="checkbox mt-3 ml-5">
								<strong style="display: block">
									Use a no-reply email address
								</strong>
								<input type="checkbox" class="mr-2" value="">
								Your invitee will not see your email address in event
								notifications sent by Bookify (this doesn't impact calendar invitations).
							</div>
						</div>
					</div>
					<div class="col-lg-12 pb-4 mb-4 border-bottom">
						<div class="row align-items-top">
							<div class="col-lg-1 text-center">
								<img src="/img/sms_reminder.svg" alt="" width="39">
							</div>
							<div class="col-lg-8">
								<strong class="mb-3 d-block">
									Text Reminders
								</strong>
								<p class="mb-2">
									Your invitees will have the option of receiving text reminders before a scheduled event at specified times.
								</p>
							</div>
							<div class="col-lg-3 align-self-center">
								<div class="row align-items-center">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch7"
											v-model="notificationAndCancellationPolicy.isInviteeSmsReminderEnabled"
											type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="customSwitch7"></label>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<p>
					<a v-if="showPolicy" class="btn btn-primary" href="#" data-toggle="collapse"
						@click="showCancellationPolicy(false)">
						Hide Cancellation Policy
					</a>
					<a v-else class="btn btn-primary" href="#" data-toggle="collapse"
						@click="showCancellationPolicy(true)">
						Show Cancellation Policy
					</a>
				</p>
				<div v-if="showPolicy" class="col-lg-6">
					<div class="row flex-column">
						<div id="collapseExample" class="collapse show">
							<div class="card card-body border-0">
								<form onsubmit="return false">
									<div class="form-group form-check">
										<input id="exampleCheck1"
											v-model="notificationAndCancellationPolicy.isCancellationAllowed"
											type="checkbox" class="form-check-input">
										<label class="form-check-label" for="exampleCheck1">
											Include cancel and reschedule links in notifications
										</label>
									</div>
									<div class="form-group">
										<label>
											Cancellation Policy
										</label>
										<input v-model="notificationAndCancellationPolicy.cancellationPolicyText"
											type="text" class="form-control">
									</div>
								</form>
							</div>
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
							:disabled="isLoading" @click="saveNotificationAndCancellationPolicy">
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
				showPolicy: false,
				questions_and_answers: null,
				location: null,
				event_description: null,
				event_time: null,
				event_date: null,
				event_name: null,
				invitee_full_name: null,
				my_name: null,
				calendarInvitations: false,
				showEmailConfirmations: false,
				notificationAndCancellationPolicy: {
					isInviteeReminderEnabled: false,
					isInviteeSmsReminderEnabled: false,
					isInviteeEmailFollowUpEnabled: false,
					isCancellationAllowed: false,
					cancellationPolicyText: '',
				},
			};
		},
		
		mounted() {
			this.notificationAndCancellationPolicy.isInviteeReminderEnabled = this.bookingType.isInviteeReminderEnabled;
			this.notificationAndCancellationPolicy.isInviteeSmsReminderEnabled = this.bookingType.isInviteeSmsReminderEnabled;
			this.notificationAndCancellationPolicy.isInviteeEmailFollowUpEnabled = this.bookingType.isInviteeEmailFollowUpEnabled;
			this.notificationAndCancellationPolicy.isCancellationAllowed = this.bookingType.isCancellationAllowed;
			this.notificationAndCancellationPolicy.cancellationPolicyText = this.bookingType.cancellationPolicyText;
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
			
			showCancellationPolicy(check) {
				this.showPolicy = check;
			},
			
			switchToEmailConfirmations(check) {
				this.showEmailConfirmations = check;
			},
			
			async saveNotificationAndCancellationPolicy() {
				this.isLoading = true;
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
					bookingType: this.notificationAndCancellationPolicy,
				});
				
				this.isLoading = false;
				
				this.close({ animate: !!this.bookingType.id });
			},
		},
	};
</script>

<template>
	<div>
		<form class="container d-flex justify-content-center pt-4 pb-4"
			@submit.prevent="saveData({ pressedButton: 'continue' })">
			<div class="col-lg-7 pt-4 pb-4">
				<div class="card">
					<div class="card-header pb-0">
						<div class="row justify-content-between align-items-end">
							<div class="col-lg-8 pt-3">
								<h5>
									Your Google Calendar’s connected!
								</h5>
								<p class="text-secondary mt-4">
									Bookify will auto-check your calendar for busy times and add new bookings as they are scheduled.
								</p>
							</div>
							<div class="col-lg-4">
								<img src="/img/welcome_calendar.svg" alt="" style="max-width: 100%;">
							</div>
						</div>
					</div>
					<div class="card-body">
						<h5 class="card-title pb-4">
							Here’s how Bookify will work with {{ calendarConnection.identifier }}…
						</h5>
						<div class="col-lg-12 mt-3">
							<div class="row">
								<div class="col pl-0">
									<span class="badge badge-dark rounded-circle mr-2">1</span>
									<span v-if="sourceCalendarIds.length > 0">
										We’ll check <strong>"{{ calendars.filter((calendar) => {
											return sourceCalendarIds.indexOf(calendar.id) > -1;
										}).map(calendar => calendar.name).join(', ') }}"</strong> for conflicts
									</span>
									<span v-else>Do not check any calendars for conflicts</span>
								</div>
								<div class="col-lg-2 p-0 d-flex justify-content-end">
									<a href="#" @click.prevent="openSourceCalendarsModal">Edit</a>
								</div>
							</div>
						</div>
						<hr>
						<div class="col-lg-12 mt-3">
							<div class="row">
								<div class="col pl-0">
									<span class="badge badge-dark rounded-circle mr-2">2</span>
									<span v-if="destinationCalendarId">
										We’ll add bookings to <strong>"{{ calendars.filter((calendar) => {
											return calendar.id == destinationCalendarId;
										})[0].name }}"</strong>
									</span>
									<span v-else>Do not add new bookings to a calendar</span>
								</div>
								<div class="col-lg-2 p-0 d-flex justify-content-end">
									<a href="#" @click.prevent="openDestinationCalendarModal">Edit</a>
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
									<div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50"
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
		</form>
		
		<!-- Modal Source Calendars -->
		<div ref="sourceCalendarsModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div v-if="sourceCalendarsModal" class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel"
							class="modal-title">
							Which calendars should we check for conflicts?
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div v-for="(calendar, calendarIndex) in calendars"
							:key="calendar.id" class="custom-control custom-checkbox my-1 mr-sm-2">
							<input :id="'custom-control-inline-' + calendarIndex" v-model="sourceCalendarsModal.sourceCalendarIds"
								type="checkbox" class="custom-control-input"
								:value="calendar.id">
							<label class="custom-control-label" :for="'custom-control-inline-' + calendarIndex">
								{{ calendar.name }}
							</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary" @click="updateSourceCalendars">
							Update
						</button>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal Destination Calendar -->
		<div ref="destinationCalendarModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div v-if="destinationCalendarModal" class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Which calendar should we add new bookings to?
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div v-for="(calendar, calendarIndex) in calendars"
							:key="calendar.id" class="custom-control custom-checkbox my-1 mr-sm-2">
							<input :id="'custom-control-inline-event-' + calendarIndex" v-model="destinationCalendarModal.destinationCalendarId"
								type="radio" class="custom-control-input"
								:value="calendar.id">
							<label class="custom-control-label" :for="'custom-control-inline-event-' + calendarIndex">
								{{ calendar.name }}
							</label>
						</div>
						<div class="custom-control custom-checkbox my-1 mr-sm-2">
							<input id="custom-control-inline-event-none" v-model="destinationCalendarModal.destinationCalendarId" type="radio"
								class="custom-control-input" :value="null">
							<label class="custom-control-label" for="custom-control-inline-event-none">
								None
							</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary" @click="updateDestinationCalendar">
							Update
						</button>
					</div>
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
				sourceCalendarIds: this.$store.state.auth.user.calendarConnections[0].sourceCalendarIds,
				destinationCalendarId: this.$store.state.auth.user.calendarConnections[0].destinationCalendarId,
				calendarConnection: this.$store.state.auth.user.calendarConnections[0],
				calendars: this.$store.state.auth.user.calendarConnections[0].calendars,
				sourceCalendarsModal: null,
				destinationCalendarModal: null,
				loadingButton: null,
			};
		},
        
		computed: {
			...mapState([
				'auth',
			]),
		},
        
		mounted() {
			//
		},
        
		methods: {
			openSourceCalendarsModal() {
				this.sourceCalendarsModal = {
					sourceCalendarIds: [...this.sourceCalendarIds],
				};
                
				$(this.$refs.sourceCalendarsModal).modal('show');
			},
            
			updateSourceCalendars() {
				this.sourceCalendarIds = this.sourceCalendarsModal.sourceCalendarIds;
				$(this.$refs.sourceCalendarsModal).modal('hide');
			},
            
			openDestinationCalendarModal() {
				this.destinationCalendarModal = {
					destinationCalendarId: this.destinationCalendarId,
				};
                
				$(this.$refs.destinationCalendarModal).modal('show');
			},
            
			updateDestinationCalendar() {
				this.destinationCalendarId = this.destinationCalendarModal.destinationCalendarId;
				$(this.$refs.destinationCalendarModal).modal('hide');
			},
            
			async saveData({ pressedButton }) {
				this.loadingButton = pressedButton;
                
				try {
					let response = await this.$http.post('/intro/calendar/settings', {
						calendarConnection: {
							sourceCalendarIds: this.sourceCalendarIds,
							destinationCalendarId: this.destinationCalendarId,
						},
                        
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

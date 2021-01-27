<template>
	<div class="card">
		<div :id="`${_uid}-header`" class="card-header cursor-pointer border-bottom-0" @click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover">
							When can people book this booking type?
							<div>
								<small class="text-secondary text-left d-block">
									{{ bookingType.durations.toString() }} min,
									{{ Math.floor(bookingType.maxBookingTime / (24 * 60 * 60)) }} rolling days
								</small>
							</div>
						</button>
						<div class="btn-group fade" :class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
							<button type="button" class="btn btn-outline-secondary" @click.stop="close">
								Cancel
							</button>
							<button type="button" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
								:disabled="isLoading" @click.stop="save">
								{{ 'Save & Close' }}
							</button>
						</div>
					</div>
				</div>
			</h2>
		</div>
		<form v-if="form" id="availability-collapse" ref="form" class="collapse border-top"
			:aria-labelledby="`${_uid}-header`" @submit.prevent="save">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="d-flex justify-content-between align-items-center mb-3">
							<div class="div">
								<strong class="d-block">
									Booking Duration *
								</strong>
								<small class="mb-2 d-block">
									You can choose multiple Durations to give options to your clients.
								</small>
							</div>
							<button type="button" class="btn btn-primary" @click="addCustomDuration">
								Add Custom Duration
							</button>
						</div>
						<div class="btn-group-toggle btn-group d-flex"
							:class="{ 'is-invalid': validationFields['booking_type.duration'] }" style="font-size: 0;">
							<label v-for="(duration) in form.duration" :key="duration"
								class="btn btn-outline-primary border-solid" :class="{
									'active': (
										form.duration.includes(duration) && duration !== null
									),
								}" @click="setDefaultDuration(duration)">
								<strong class="d-block">{{ duration }}</strong>
								<input v-if="duration === null" v-model.number="newCustomDuration" type="number"
									class="form-control duration-margin-auto" @keyup.enter="saveCustomDuration()">
								<small>
									Mins
								</small>
							</label>
						</div>
						<div v-if="validationFields['booking_type.duration']" class="invalid-feedback">
							{{ validationFields['booking_type.duration'][0] }}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 mt-4">
						<strong class="mb-2 d-block">Date Range</strong>
						<div class="text-secondary">
							<span v-if="form.periodType === 'MOVING'">
								Events can be scheduled over {{ Math.floor(form.maxBookingTime / (24 * 60 * 60)) }} rolling days
							</span>
							<span v-else-if="form.periodType === 'FIXED'">
								Events can be scheduled from
								{{ $moment(form.startDate).format(form.startDate.getYear() === form.endDate.getYear() ? 'D MMM' : 'D MMM YYYY') }}
								to
								{{ $moment(form.endDate).format('D MMM YYYY') }}
							</span>
							<span v-else-if="form.periodType === 'UNLIMITED'">
								Events can be scheduled indefinitely into the future
							</span>
							<button type="button" class="btn btn-primary ml-4" @click="openAvailabilityModal">
								Edit
							</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 mt-4">
						<strong class="mb-2 d-block">
							Event Time Zone
						</strong>
						<div v-if="form.timezoneType === 'LOCAL'" class="text-secondary">
							You're in {{ auth.user.timezoneCode }} Time.
							Your invitees will see your availability in their local time zone.
							<button type="button" class="btn btn-primary ml-4" @click="openTimezoneModal">
								Edit
							</button>
						</div>
						<div v-else-if="form.timezoneType === 'LOCKED'" class="text-secondary">
							This event type's time zone is locked to {{ form.timezoneCode }}.
							Invitees will see your availability in this time zone.
							<button type="button" class="btn btn-primary ml-4" @click="openTimezoneModal">
								Edit
							</button>
						</div>
					</div>
				</div>
				<div v-if="tempBookingTypeType === 0" class="row">
					<div class="col-lg-12 mt-4">
						<strong class="mb-2 d-block">Availability</strong>
						<div class="text-secondary">
							Set your available hours when people can schedule meetings with you.
						</div>
					</div>
				</div>
				<div v-else-if="tempBookingTypeType === 1" class="row">
					<div class="col-lg-12 mt-4">
						<strong class="mb-2 d-block">Select Webinar Dates</strong>
						<div class="text-secondary">
							Select the dates for this webinar below. You can chose multiple dates.
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 mt-4">
						<div style="padding-right: 2px;">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a id="hours-tab" class="nav-link active" href="#hours" data-toggle="tab" role="tab"
										aria-controls="hours" aria-selected="true">
										Hours
									</a>
								</li>
								<li class="nav-item">
									<a id="advanced-tab" class="nav-link" href="#advanced" data-toggle="tab" role="tab"
										aria-controls="advanced" aria-selected="false">
										Advanced
									</a>
								</li>
								<li v-if="tempBookingTypeType === 0" class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
										aria-haspopup="true" aria-expanded="false">
										Copy availability from...
									</a>
									<div class="dropdown-menu p-0">
										<div class="input-group mb-0">
											<input type="text" class="form-control border-left-0 rounded-0 border-top-0"
												placeholder="Copy availability from..."
												aria-label="Recipient's username" aria-describedby="basic-addon2">
											<div class="input-group-append">
												<span id="basic-addon2"
													class="input-group-text border-right-0 border-top-0 rounded-0">
													Search
												</span>
											</div>
										</div>
										<div class="col-lg-12">
											<div class="row flex-column">
												<div class="col d-flex align-items-center p-2 bg-light">
													<div class="rounded-circle mr-2"
														style="width: 10px; height: 10px; background: red;"></div>
													<span class="text-secondary">
														15 Minutes Meeting
													</span>
												</div>
												<div class="col d-flex align-items-center p-2">
													<div class="rounded-circle mr-2"
														style="width: 10px; height: 10px; background: yellow;"></div>
													<span class="text-secondary">
														30 Minutes Meeting
													</span>
												</div>
												<div class="col d-flex align-items-center p-2">
													<div class="rounded-circle mr-2"
														style="width: 10px; height: 10px; background: lightblue;"></div>
													<span class="text-secondary">
														60 Minutes Meeting
													</span>
												</div>
											</div>
										</div>
									</div>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div id="hours" class="tab-pane fade show active" role="tabpanel"
									aria-labelledby="hours-tab">
									<VDatePicker ref="datePicker" v-model="availabilityDateRange"
										class="[ dashboard-booking-type-availability__availability-calendar ] border-top-0"
										mode="range" is-inline :masks="availabilityCalendarMasks"
										:attributes="availabilityCalendarAttributes"
										@input="onAvailabilityDateRangeChanged" @dayclick="onAvailabilityDayClicked">
										<div slot="day-content" slot-scope="{ day, attributes }" class="vc-day-content"
											:class="{
												'vc-day-selected': day.attributesMap && day.attributesMap['select-drag'],
												'vc-day-invalid': firstInvalidRule && $moment(day.date).isSame(firstInvalidRule.date, 'day'),
											}" @mouseenter="$refs.datePicker.onDayMouseEnter(day)"
											@mousedown="$refs.datePicker.onDayClick(day)"
											@mouseup="$refs.datePicker.onDayClick(day)">
											<component
												:is="(day.day === 1 || $moment().isSame(day.date, 'day')) ? 'b' : 'span'"
												class="availability-calendar-date">
												<span v-if="$moment().isSame(day.date, 'day')">Today,</span>
												{{ day.day }}
												<span v-if="day.day === 1">{{ $moment(day.date).format('MMMM') }}</span>
											</component>
											<div v-if="attributes && attributes.length > 0"
												class="availability-calendar-content">
												<div v-if="(
													(attribute = attributes.find((attribute) => {
														return attribute.key.startsWith('RULE_DATE');
													}))
													&&
													attribute.customData.intervals.length > 0
												)" class="availability-calendar-rule">
													<div
														v-for="(interval, intervalIndex) in attribute.customData.intervals"
														:key="intervalIndex" class="availability-calendar-interval">
														<span>
															{{ $moment(interval.from, 'HH:mm').format(timeFormats[auth.user.timeFormat]) }}
															-
															{{ $moment(interval.to, 'HH:mm').format(timeFormats[auth.user.timeFormat]) }}
														</span>
													</div>
												</div>
												<div v-else-if="(
													(attribute = attributes.find((attribute) => {
														return attribute.key.startsWith('RULE_WEEK_DAY');
													}))
													&&
													attribute.customData.intervals.length > 0
												)" class="availability-calendar-rule is-repetitive">
													<div
														v-for="(interval, intervalIndex) in attribute.customData.intervals"
														:key="intervalIndex" class="availability-calendar-interval">
														<span>
															{{ $moment(interval.from, 'HH:mm').format(timeFormats[auth.user.timeFormat]) }}
															-
															{{ $moment(interval.to, 'HH:mm').format(timeFormats[auth.user.timeFormat]) }}
														</span>
													</div>
												</div>
											</div>
										</div>
									</VDatePicker>
								</div>
								<div id="advanced" class="tab-pane fade border border-top-0 p-3" role="tabpanel"
									aria-labelledby="advanced-tab">
									<strong class="mb-2 d-block pt-4">
										Availability Increments
									</strong>
									<div class="col-lg-12 pb-4 border-bottom">
										<div class="row">
											<div class="col-lg-6 pl-0">
												<small>
													Set the frequency of available time slots for your invitees.
												</small>
											</div>
											<div class="col-lg-6 pr-0">
												<small class="mb-2 d-block">
													Show availability in increments of
												</small>
												<div class="form-group">
													<select v-model.number="form.spotStep" class="form-control"
														:class="{ 'is-invalid': validationFields['booking_type.spot_step'] }">
														<option v-for="(spotStep) in spotSteps" :key="spotStep"
															:value="spotStep">
															{{ spotStep }} min
														</option>
													</select>
													<div v-if="validationFields['booking_type.spot_step']"
														class="invalid-feedback">
														{{ validationFields['booking_type.spot_step'][0] }}
													</div>
												</div>
											</div>
										</div>
									</div>
									<strong class="mb-2 d-block pt-4">
										Event Max Per Day
									</strong>
									<div class="col-lg-12 pb-4 border-bottom">
										<div class="row">
											<div class="col-lg-6 pl-0">
												<small>
													Use this optional setting to limit the number of events that can be scheduled in a day.
												</small>
											</div>
											<div class="col-lg-6 pr-0">
												<small class="mb-2 d-block">
													Max number of events per day
												</small>
												<div class="form-group">
													<input v-model.number="form.maxBookingsPerDay" type="number"
														class="form-control"
														:class="{ 'is-invalid': validationFields['booking_type.max_bookings_per_day'] }">
													<div v-if="validationFields['booking_type.max_bookings_per_day']"
														class="invalid-feedback">
														{{ validationFields['booking_type.max_bookings_per_day'][0] }}
													</div>
												</div>
											</div>
										</div>
									</div>
									<strong class="mb-2 d-block pt-4">
										Minimum Scheduling Notice
									</strong>
									<div class="col-lg-12 pb-4 border-bottom">
										<div class="row">
											<div class="col-lg-6 pl-0">
												<small>
													Use this setting to prevent last minute events.
												</small>
											</div>
											<div class="col-lg-6 pr-0">
												<small class="mb-2 d-block">
													Prevent events less than
												</small>
												<div class="input-group mb-3"
													:class="{ 'is-invalid': validationFields['booking_type.min_booking_time'] }">
													<input v-model.number="form.minBookingTimeInHours" type="text"
														class="form-control" @input="setMinBookingTimeInHours">
													<div class="input-group-append">
														<span class="input-group-text">hours away</span>
													</div>
												</div>
												<div v-if="validationFields['booking_type.min_booking_time']"
													class="invalid-feedback">
													{{ validationFields['booking_type.min_booking_time'][0] }}
												</div>
											</div>
										</div>
									</div>
									<strong class="mb-2 d-block pt-4">
										Event Buffers
									</strong>
									<div class="col-lg-12 pb-4 border-bottom">
										<div class="row">
											<div class="col-lg-6 pl-0">
												<small>
													Use this to set aside preparation, rest or travel time before or after events. For example,
													if you define a 5 minute buffer before your events Bookify will make sure you have 5 minutes
													of free time before your scheduled events.
												</small>
											</div>
											<div class="col-lg-6 pr-0">
												<small class="mb-2 d-block">Buffer before event</small>
												<div class="form-group">
													<select v-model.number="form.bufferBefore" class="form-control"
														:class="{ 'is-invalid': validationFields['booking_type.buffer_before'] }">
														<option v-for="(buffer) in buffers" :key="buffer"
															:value="buffer">
															{{ buffer }} min
														</option>
													</select>
													<div v-if="validationFields['booking_type.buffer_before']"
														class="invalid-feedback">
														{{ validationFields['booking_type.buffer_before'][0] }}
													</div>
												</div>
												<small class="mb-2 d-block">Buffer after event</small>
												<div class="form-group">
													<select v-model.number="form.bufferAfter" class="form-control"
														:class="{ 'is-invalid': validationFields['booking_type.buffer_after'] }">
														<option v-for="(buffer) in buffers" :key="buffer"
															:value="buffer">
															{{ buffer }} min
														</option>
													</select>
													<div v-if="validationFields['booking_type.buffer_after']"
														class="invalid-feedback">
														{{ validationFields['booking_type.buffer_after'][0] }}
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
				<div class="row">
					<div class="col-lg-12 mt-4">
						<strong class="mb-2 d-block">
							Secret Event
						</strong>
						<div class="text-secondary">
							Hide this event from your main Bookify page?
						</div>
						<div class="custom-control custom-switch mt-3">
							<input id="customSwitch2" v-model="form.isPublic" type="checkbox"
								class="custom-control-input" :false-value="true" :true-value="false">
							<label class="custom-control-label" for="customSwitch2"></label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="d-flex align-items-center justify-content-end">
							<button type="button" class="btn btn-link">
								Cancel
							</button>
							<button type="button" class="btn btn-primary ml-2" :class="{ 'is-loading': isLoading }"
								:disabled="isLoading" @click.stop="save">
								Save & Close
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div ref="availabilityModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="availabilityModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div v-if="availabilityModal" class="modal-content">
					<div class="modal-header">
						<h5 id="availabilityModalLabel" class="modal-title">
							Availability
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleFormControlSelect5">
								When can events be scheduled?
							</label>
							<select id="exampleFormControlSelect5" v-model="availabilityModal.periodType"
								class="form-control">
								<option value="MOVING">
									Over a period of rolling days
								</option>
								<option value="FIXED">
									Over a date range
								</option>
								<option value="UNLIMITED">
									Indefinitely
								</option>
							</select>
						</div>
						<div v-if="availabilityModal.periodType === 'MOVING'" class="form-group">
							<label for="days">
								Your invitees will be offered availability for a number of days into the future.
							</label>
							<div class="input-group mb-3">
								<input v-model="availabilityModal.maxBookingTimeInDays" type="text" class="form-control"
									aria-describedby="basic-addon2">
								<div class="input-group-append">
									<span id="basic-addon2" class="input-group-text">
										rolling days
									</span>
								</div>
							</div>
						</div>
						<div v-else-if="availabilityModal.periodType === 'FIXED'" class="form-group">
							<label for="days">
								Your invitees will be offered availability within a defined range of dates.
							</label>
							<div class="mb-3">
								<VDatePicker v-model="availabilityModal.dates" mode="range" :masks="{ weekdays: 'WWW' }"
									is-expanded is-inline />
							</div>
						</div>
						<div v-else-if="availabilityModal.periodType === 'UNLIMITED'" class="form-group">
							<label for="days">
								Your invitees will be offered availability indefinitely into the future.
							</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary" @click="applyAvailability">
							Apply
						</button>
					</div>
				</div>
			</div>
		</div>
		<div ref="timezoneModal" class="modal fade" tabindex="-2" role="dialog" aria-labelledby="timezoneModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div v-if="timezoneModal" class="modal-content">
					<div class="modal-header">
						<h5 id="timezoneModalLabel" class="modal-title">
							Time zone style
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body pb-0">
						<div class="row">
							<div class="col-6">
								<label>
									<input v-model="timezoneModal.timezoneType" type="radio" value="LOCAL">
									Local
								</label>
							</div>
							<div class="col-6">
								<label>
									<input v-model="timezoneModal.timezoneType" type="radio" value="LOCKED">
									Locked
								</label>
							</div>
						</div>
						<div class="row">
							<div v-if="timezoneModal.timezoneType === 'LOCAL'" class="col-12">
								<p>
									Invitees will see your availability in their time zone. Recommended for virtual meetings.
								</p>
								<p>
									(Your account settings are configured for {{ auth.user.timezoneCode }})
								</p>
							</div>
							<div v-else-if="timezoneModal.timezoneType === 'LOCKED'" class="col-12">
								...(v-select here)...
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary" @click="applyTimezone">
							Apply
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="availabilityRulesModal" ref="availabilityRulesModal" class="modal fade" tabindex="-3" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div v-if="availabilityRulesModal && availabilityRulesModal.overrideQuestionIsShown"
					class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Override date-specific availability?
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<div v-if="availabilityRulesModal.multipleModeIsOn" class="col text-center">
							For {{ availabilityRulesModal.multiple.weekDays.map((weekDay) => __(`weekdays.${weekDay}.singular`)).join(', ') }}
							you have date-specific availability defined on {{ availabilityRulesModal.countOfConflicts }} date(s).
							Would you like to override this date?
						</div>
						<div v-else class="col text-center">
							For {{ __(`weekdays.${availabilityRulesModal.weekDay}.singular`) }}
							you have date-specific availability defined on {{ availabilityRulesModal.countOfConflicts }} date(s).
							Would you like to override this date?
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="saveAvailabilityRules('WEEK_DAY', false)">
							Don't override
						</button>
						<button type="button" class="btn btn-secondary"
							@click="saveAvailabilityRules('WEEK_DAY', true)">
							Override
						</button>
					</div>
				</div>
				<form v-else-if="availabilityRulesModal && !availabilityRulesModal.multipleModeIsOn"
					class="modal-content" @submit.prevent="saveAvailabilityRules('DATE')">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Edit Availability
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body row">
						<div class="col-lg-12">
							<div v-if="availabilityRulesModal.intervals.length > 0">
								<div v-for="(interval, intervalIndex) in availabilityRulesModal.intervals"
									:key="interval" class="row mb-2">
									<div class="col">
										<div class="row">
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">from</span>
													</div>
													<input v-model="interval.from" type="text" class="form-control"
														aria-label="Time" aria-describedby="basic-addon1"
														:placeholder="auth.user.timeFormat === '12H' ? 'hh:mm am' : 'hh:mm'"
														@focusout="autocompleteIntervalTimeInput(interval, 'from')">
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">to</span>
													</div>
													<input v-model="interval.to" type="text" class="form-control"
														aria-label="Time" aria-describedby="basic-addon1"
														:placeholder="auth.user.timeFormat === '12H' ? 'hh:mm am' : 'hh:mm'"
														@focusout="autocompleteIntervalTimeInput(interval, 'to')">
												</div>
											</div>
											<div class="col" style="max-width: 50px;">
												<a href="#" tabindex="-1"
													@click.prevent="removeInterval(intervalIndex)">
													&times;
												</a>
											</div>
										</div>
										<div v-if="interval.validation" class="row">
											<div class="col text-danger">
												{{ interval.validation }}
											</div>
										</div>
									</div>
								</div>
							</div>
							<div v-else class="border p-2 text-center rounded">
								Unavailable
							</div>
							<div class="row">
								<div class="col">
									<button type="button" class="btn btn-link pl-0"
										@click="addIntervalInAvailabilityRulesModal">
										+ New Interval
									</button>
								</div>
							</div>
							<div class="row mt-3">
								<div class="col">
									<button type="button" class="btn btn-sm btn-outline-primary"
										@click="clearAllIntervalsInAvailabilityRulesModal">
										I'm unavailable
									</button>
								</div>
							</div>
							<div v-if="availabilityRulesModal.dates.length === 1" class="row flex-column mt-4">
								<div class="col">
									<button type="submit" class="btn btn-primary btn-block mb-2">
										Apply to 28 Dec only
									</button>
									<button type="button" class="btn btn-primary btn-block"
										@click="saveAvailabilityRules('WEEK_DAY')">
										Apply to all Saturdays
									</button>
								</div>
							</div>
						</div>
					</div>
					<div v-if="availabilityRulesModal.dates.length > 1" class="modal-footer">
						<button type="submit" class="btn btn-primary">
							Apply
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
					</div>
					<div v-else class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary"
							@click.stop="toggleAvailabilityRulesMultipleMode(true)">
							Or apply to multiple...
						</button>
					</div>
				</form>
				<form v-else-if="availabilityRulesModal && availabilityRulesModal.multipleModeIsOn"
					class="modal-content" @submit.prevent="saveAvailabilityRules()">
					<div class="modal-header">
						<button type="button" class="back" @click="toggleAvailabilityRulesMultipleMode(false)">
							<span aria-hidden="true">&lt;</span>
						</button>
						<h5 id="exampleModalLabel" class="modal-title">
							Edit Availability
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="rounded border p-3 w-100 mb-3">
							<div class="form-check">
								<input :id="`{{ _uid }}-exampleRadios1`" v-model="availabilityRulesModal.multiple.type"
									type="radio" name="exampleRadios" class="form-check-input" value="DATES">
								<label class="form-check-label" :for="`{{ _uid }}-exampleRadios1`">
									specific dates
								</label>
							</div>
							<div class="form-check">
								<input :id="`{{ _uid }}-exampleRadios2`" v-model="availabilityRulesModal.multiple.type"
									type="radio" name="exampleRadios" class="form-check-input" value="WEEK_DAYS">
								<label class="form-check-label" :for="`{{ _uid }}-exampleRadios2`">
									repeating days of the week
								</label>
							</div>
						</div>
						<div v-if="availabilityRulesModal.multiple.type === 'DATES'">
							<VDatePicker v-model="availabilityRulesModal.multiple.dates" mode="multiple"
								:masks="{ weekdays: 'WWW' }" is-expanded is-inline />
						</div>
						<div v-else-if="availabilityRulesModal.multiple.type === 'WEEK_DAYS'">
							<div v-for="(weekDay) in weekDays" :key="weekDay.code" class="form-check">
								<input :id="`${_uid}-defaultCheck-${weekDay.code}`"
									v-model="availabilityRulesModal.multiple.weekDays" type="checkbox"
									class="form-check-input" :value="weekDay.code"
									:disabled="weekDay.code === availabilityRulesModal.weekDay">
								<label class="form-check-label" :for="`${_uid}-defaultCheck-${weekDay.code}`">
									{{ $trans(`weekdays.${weekDay.code}.plural`) }}
								</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">
							Apply
						</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';
	
	export default {
		components: {
			VDatePicker: () => import('v-calendar/lib/components/date-picker.umd'),
		},
		
		props: {
			bookingType: {
				type: Object,
				required: true,
			},
		},
		
		data() {
			return {
				tempBookingTypeType: 0,
				form: null,
				availabilityModal: null,
				timezoneModal: null,
				availabilityRulesModal: null,
				availabilityDateRange: null,
				availabilityDay: null,
				firstInvalidRule: null,
				
				isOpen: false,
				isLoading: false,
				validationFields: {},
				defaultDurations: [15, 30, 45, 60],
				spotSteps: [10, 15, 20, 30, 45, 60],
				buffers: [0, 5, 10, 15, 30, 45, 60, 90, 120, 150, 180],
				newCustomDuration: '',
				
				weekDays: [
					{
						code: 'MONDAY',
						number: 2,
					},
					{
						code: 'TUESDAY',
						number: 3,
					},
					{
						code: 'WEDNESDAY',
						number: 4,
					},
					{
						code: 'THURSDAY',
						number: 5,
					},
					{
						code: 'FRIDAY',
						number: 6,
					},
					{
						code: 'SATURDAY',
						number: 7,
					},
					{
						code: 'SUNDAY',
						number: 1,
					},
				],
				
				timeFormats: {
					'12H': 'hh:mm a',
					'24H': 'HH:mm',
				},
			};
		},
		
		computed: {
			...mapState(['auth']),
			
			availabilityCalendarAttributes() {
				return [
					{
						key: 'just-force-to-update-attributes',
						
						dates: {
							weekdays: [1, 2, 3, 4, 5, 6, 7],
						},
					},
					
					...this.form.availabilityRules.map((rule, ruleIndex) => {
						let attribute = {
							key: 'RULE_' + rule.type + '_' + ruleIndex,
							customData: rule,
						};
						
						if (rule.type === 'WEEK_DAY') {
							attribute.dates = {
								weekdays: this.weekDays.find((weekDay) => {
									return weekDay.code === rule.weekDay;
								}).number,
							};
						} else if (rule.type === 'DATE') {
							attribute.dates = new Date(rule.date);
						}
						
						return attribute;
					}),
				];
			},
			
			availabilityCalendarMasks() {
				return { weekdays: 'WWW' };
			},
		},
		
		watch: {
			bookingType() {
				this.buildForm();
				this.buildAvailabilityModal();
				this.buildTimezoneModal();
			},
		},
		
		mounted() {
			this.buildForm();
			this.buildAvailabilityModal();
			this.buildTimezoneModal();
			$(this.$refs.availabilityRulesModal).on('hide.bs.modal', this.onAvailabilityRulesModalClosed);
		},
		
		beforeDestroy() {
			$(this.$refs.availabilityRulesModal).off();
		},
		
		methods: {
			buildForm() {
				this.form = {
					durations: this.bookingType.durations ? this.bookingType.durations : [],
					durationDefault: (this.defaultDurations.includes(this.bookingType.durations) ? this.bookingType.durations : null),
					durationCustom: (this.defaultDurations.includes(this.bookingType.durations) ? null : this.bookingType.durations),
					durationType: (this.defaultDurations.includes(this.bookingType.durations) ? 'DEFAULT' : 'CUSTOM'),
					periodType: this.bookingType.periodType,
					maxBookingTime: this.bookingType.maxBookingTime,
					startDate: (this.bookingType.startDate ? new Date(this.bookingType.startDate) : null),
					endDate: (this.bookingType.endDate ? new Date(this.bookingType.endDate) : null),
					timezoneCode: this.bookingType.timezoneCode,
					timezoneType: this.bookingType.timezoneType,
					spotStep: this.bookingType.spotStep,
					minBookingTime: this.bookingType.minBookingTime,
					minBookingTimeInHours: Math.floor(this.bookingType.minBookingTime / (60 * 60)),
					maxBookingsPerDay: this.bookingType.maxBookingsPerDay,
					bufferBefore: this.bookingType.bufferBefore,
					bufferAfter: this.bookingType.bufferAfter,
					isPublic: this.bookingType.isPublic,
					
					availabilityRules: this.bookingType.availabilityRules.map((bookingTypeAvailabilityRule) => {
						return {
							...bookingTypeAvailabilityRule,
							
							intervals: bookingTypeAvailabilityRule.intervals.map((interval) => {
								return {
									...interval,
									validation: null,
								};
							}),
						};
					}),
				};
			},
			
			buildAvailabilityModal() {
				this.availabilityModal = {
					periodType: this.form.periodType,
					maxBookingTimeInDays: Math.floor(this.form.maxBookingTime / (24 * 60 * 60)),
					
					dates: {
						start: this.form.startDate,
						end: this.form.endDate,
					},
				};
			},
			
			buildTimezoneModal() {
				this.timezoneModal = {
					timezoneCode: this.form.timezoneCode || this.auth.user.timezoneCode,
					timezoneType: this.form.timezoneType,
				};
			},
			
			buildAvailabilityRulesModal(day, dateRange) {
				let intervals = [];
				let dates = null;
				let weekDay = null;
				let ruleType = null;
				
				if (dateRange) {
					let countOfDates = this.$moment(dateRange.end).diff(dateRange.start, 'days') + 1;
					
					dates = Array(countOfDates).fill(null).map((date, dateIndex) => {
						return this.$moment(dateRange.start).add(dateIndex, 'day').toDate();
					});
				} else if (day) {
					dates = [day.date];
					
					weekDay = this.weekDays.find((weekDay) => {
						return weekDay.number === day.weekday;
					}).code;
					
					if (day.attributes) {
						let attribute = day.attributes.find((attribute) => attribute.key.startsWith('RULE_DATE'));
						attribute = attribute || day.attributes.find((attribute) => attribute.key.startsWith('RULE_WEEK_DAY'));
						let rule = (attribute ? attribute.customData : null);
						intervals = (rule ? rule.intervals : []);
						ruleType = (rule ? rule.type : null);
					}
				} else {
					throw new Error('No day or range given');
				}
				
				this.availabilityRulesModal = {
					dates,
					weekDay,
					
					multiple: {
						type: (ruleType === 'DATE' ? 'DATES' : 'WEEK_DAYS'),
						dates: dates,
						weekDays: (weekDay ? [weekDay] : []),
					},
					
					intervals: intervals.map((interval) => {
						return {
							from: this.$moment(interval.from, 'HH:mm').format(this.timeFormats[this.auth.user.timeFormat]),
							to: this.$moment(interval.to, 'HH:mm').format(this.timeFormats[this.auth.user.timeFormat]),
							validation: interval.validation || null,
						};
					}),
					
					multipleModeIsOn: false,
					overrideQuestionIsShown: false,
					matchedDateRules: [],
					countOfConflicts: 0,
				};
			},
			
			// ---------------------------------------------------------------------- //
			
			open({ animate = true } = {}) {
				if (animate) {
					$(this.$refs.form).collapse('show');
				} else {
					$(this.$refs.form).addClass('show');
				}
				
				this.isOpen = true;
				this.$emit('open');
			},
			
			close() {
				$(this.$refs.form).collapse('hide');
				this.isOpen = false;
				this.$emit('close');
			},
			
			toggle() {
				this.isOpen ? this.close() : this.open();
			},
			
			async save() {
				this.sortAvailabilityRules();
				
				if (await this.validateAvailabilityIntervalDurations()) {
					return;
				}
				
				this.isLoading = true;
				
				try {
					let response = await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
						bookingType: this.form,
					});
					
					this.isLoading = false;
					this.validationFields = {};
					this.close();
					this.$emit('saved', response.data.data);
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = { ...error.response.data.validationFields };
						return;
					}
					
					throw error;
				}
			},
			
			// ---------------------------------------------------------------------- //
			
			setDefaultDuration(duration) {
				if (this.form.durations.includes(duration) && this.form.durations.length > 1 && duration !== null) {
					this.form.durations.splice(this.form.durations.indexOf(duration), 1);
				}
				
				this.form.durationDefault = duration;
				this.form.durationType = 'DEFAULT';
			},
			
			addCustomDuration() {
				if (!this.form.durations.includes(null)) {
					this.form.durations.push(null);
				}
			},
			
			saveCustomDuration() {
				if (!this.form.durations.includes(this.newCustomDuration)) {
					this.form.durations.push(this.newCustomDuration);
					this.form.durations.sort((a, b) => a - b);
					this.form.durations.splice(this.form.durations.indexOf(null), 1);
				}
			},
			
			setCustomDuration() {
				this.form.durations = this.form.durationCustom;
			},
			
			setDurationTypeAsCustom() {
				this.form.durationType = 'CUSTOM';
			},
			
			onAvailabilityDateRangeChanged() {
				if (!this.availabilityDateRange) {
					return;
				}
				
				if (this.$moment(this.availabilityDateRange.start).diff(this.availabilityDateRange.end, 'days') === 0) {
					this.buildAvailabilityRulesModal(this.availabilityDay, null);
				} else {
					this.buildAvailabilityRulesModal(null, this.availabilityDateRange);
				}
				
				$(this.$refs.availabilityRulesModal).modal('show');
			},
			
			onAvailabilityDayClicked(day) {
				this.availabilityDay = day;
			},
			
			openAvailabilityModal() {
				this.buildAvailabilityModal();
				$(this.$refs.availabilityModal).modal('show');
			},
			
			applyAvailability() {
				this.form = {
					...this.form,
					periodType: this.availabilityModal.periodType,
					maxBookingTime: this.availabilityModal.maxBookingTimeInDays * (24 * 60 * 60),
					startDate: this.availabilityModal.dates.start,
					endDate: this.availabilityModal.dates.end,
				};
				
				$(this.$refs.availabilityModal).modal('hide');
			},
			
			openTimezoneModal() {
				this.buildTimezoneModal();
				$(this.$refs.timezoneModal).modal('show');
			},
			
			applyTimezone() {
				this.form = {
					...this.form,
					timezoneCode: this.timezoneModal.timezoneCode,
					timezoneType: this.timezoneModal.timezoneType,
				};
				
				$(this.$refs.timezoneModal).modal('hide');
			},
			
			setMinBookingTimeInHours() {
				this.form.minBookingTime = this.form.minBookingTimeInHours * (60 * 60);
			},
			
			onAvailabilityRulesModalClosed() {
				this.availabilityDateRange = null;
			},
			
			addIntervalInAvailabilityRulesModal() {
				this.availabilityRulesModal.intervals.push({
					from: '',
					to: '',
					validation: null,
				});
			},
			
			clearAllIntervalsInAvailabilityRulesModal() {
				this.availabilityRulesModal.intervals = [];
			},
			
			autocompleteIntervalTimeInput(interval, type) {
				if (!interval[type]) {
					return;
				}
				
				let date = this.$parseTimeString(interval[type]);
				interval[type] = this.$moment(date).format(this.timeFormats[this.auth.user.timeFormat]);
			},
			
			removeInterval(intervalIndex) {
				this.availabilityRulesModal.intervals.splice(intervalIndex, 1);
			},
			
			toggleAvailabilityRulesMultipleMode(toggle) {
				this.availabilityRulesModal.multipleModeIsOn = toggle;
			},
			
			getAvailabilityRuleIntervalMinutes(interval, type) {
				let moment = this.$moment(interval[type], this.timeFormats[this.auth.user.timeFormat]);
				let minutes = moment.hours() * 60 + moment.minutes();
				return (type === 'to' && minutes === 0 ? 24 * 60 : minutes);
			},
			
			async validateAvailabilityIntervalDurations() {
				let getIntervalDurationInMinutes = (interval) => {
					let fromInMinutes = this.getAvailabilityRuleIntervalMinutes(interval, 'from');
					let toInMinutes = this.getAvailabilityRuleIntervalMinutes(interval, 'to');
					return toInMinutes - fromInMinutes;
				};
				
				this.firstInvalidAvailabilityRule = this.form.availabilityRules.find((rule) => {
					if (rule.type !== 'DATE') {
						return false;
					}
					
					if (this.$moment().diff(rule.date, 'days') > 0) {
						return false; // is in the past from now
					}
					
					return rule.intervals.filter((interval) => {
						if (getIntervalDurationInMinutes(interval) >= this.form.durations) {
							return false;
						}
						
						interval.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_should_be_at_least', {
							minutes: this.form.durations,
						});
						
						return true;
					}).length > 0;
				});
				
				if (!this.firstInvalidAvailabilityRule) {
					return;
				}
				
				await this.$refs.datePicker.$refs.calendar.focusDate(new Date(this.firstInvalidAvailabilityRule.date), {
					transition: 'none',
				});
				
				let calendarDay = this.$refs.datePicker.$refs.calendar.$refs.pages[0].$refs.days.find((calendarDay) => {
					return this.$moment(calendarDay.day.date).isSame(this.firstInvalidAvailabilityRule.date, 'day');
				});
				
				await new Promise((resolve) => {
					if (!calendarDay) {
						return resolve();
					}
					
					this.$scrollTo(calendarDay.$el, {
						offset: -140,
						onDone: resolve,
						onCancel: resolve,
					});
				});
				
				this.$notify({
					text: 'There is a problem with one or more of your availability intervals.',
					type: 'error',
				});
				
				return true;
			},
			
			calculateAvailabilityMatchedDateRules(weekDays) {
				let weekDayNumbers = [];
				
				weekDayNumbers = weekDays.map((weekDayCode) => {
					return this.weekDays.find((weekDay) => {
						return weekDay.code === weekDayCode;
					}).number;
				});
				
				this.availabilityRulesModal.matchedDateRules = [];
				this.availabilityRulesModal.countOfConflicts = 0;
				
				if (weekDayNumbers.length === 0) {
					return;
				}
				
				this.availabilityRulesModal.matchedDateRules = this.form.availabilityRules.filter((bookingTypeAvailabilityRule) => {
					if (bookingTypeAvailabilityRule.type !== 'DATE') {
						return false;
					}
					
					if (this.$moment().diff(bookingTypeAvailabilityRule.date, 'days') > 0) {
						return false; // is in the past from now
					}
					
					let hasConflictingWeekDay = weekDayNumbers.some((weekDayNumber) => {
						return this.$moment(bookingTypeAvailabilityRule.date).weekday() + 1 === weekDayNumber;
					});
					
					if (!hasConflictingWeekDay) {
						console.log('[CC] DO NOT HAS CONFLICTING WEEK DAYS');
						return false;
					}
					
					if (JSON.stringify(this.availabilityRulesModal.intervals) === JSON.stringify(bookingTypeAvailabilityRule.intervals)) {
						console.log('[CC] SAME INTERVALS');
						return true;
					}
					
					++this.availabilityRulesModal.countOfConflicts;
					return true;
				});
			},
			
			validateAvailabilityIntervals() {
				this.availabilityRulesModal.intervals.forEach((interval) => {
					interval.validation = null;
				});
				
				this.availabilityRulesModal.intervals.forEach((interval) => {
					if (!interval.from) {
						interval.validation = this.$trans('booking_type_availability_rules.interval_errors.start_time_cannot_be_blank');
						return;
					}
					
					if (!interval.to) {
						interval.validation = this.$trans('booking_type_availability_rules.interval_errors.end_time_cannot_be_blank');
						return;
					}
					
					let intervalFromInMinutes = this.getAvailabilityRuleIntervalMinutes(interval, 'from');
					let intervalToInMinutes = this.getAvailabilityRuleIntervalMinutes(interval, 'to');
					
					if (intervalFromInMinutes >= intervalToInMinutes) {
						interval.validation = this.$trans('booking_type_availability_rules.interval_errors.end_time_cannot_be_before_start_time');
						return;
					}
					
					let totalMinutes = (intervalToInMinutes - intervalFromInMinutes);
					
					if (totalMinutes < this.form.durations) {
						interval.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_should_be_at_least', {
							minutes: this.form.durations,
						});
					}
				});
				
				this.availabilityRulesModal.intervals.forEach((interval0, intervalIndex, intervals) => {
					let interval0FromInMinutes = this.getAvailabilityRuleIntervalMinutes(interval0, 'from');
					let interval0ToInMinutes = this.getAvailabilityRuleIntervalMinutes(interval0, 'to');
					
					intervals.slice(0, intervalIndex).forEach((interval1) => {
						let interval1FromInMinutes = this.getAvailabilityRuleIntervalMinutes(interval1, 'from');
						let interval1ToInMinutes = this.getAvailabilityRuleIntervalMinutes(interval1, 'to');
						
						if (interval0FromInMinutes <= interval1FromInMinutes && interval0ToInMinutes > interval1FromInMinutes) {
							interval0.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_are_overlapping');
							interval1.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_are_overlapping');
							return;
						}
						
						if (interval0FromInMinutes < interval1ToInMinutes && interval0ToInMinutes >= interval1ToInMinutes) {
							interval0.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_are_overlapping');
							interval1.validation = this.$trans('booking_type_availability_rules.interval_errors.intervals_are_overlapping');
						}
					});
				});
				
				return !!this.availabilityRulesModal.intervals.find((interval) => interval.validation);
			},
			
			sortAvailabilityRules() {
				this.form.availabilityRules.sort((ruleA, ruleB) => {
					if (ruleA.type === 'DATE' && ruleB.type === 'DATE') {
						return this.$moment(ruleA.date).diff(ruleB.date, 'days');
					}
					
					if (ruleA.type === 'DATE' && ruleB.type === 'WEEK_DAY') {
						return -1;
					}
					
					if (ruleA.type === 'WEEK_DAY' && ruleB.type === 'DATE') {
						return +1;
					}
					
					return +1;
				});
			},
			
			saveAvailabilityRules(ruleType, override = null) {
				console.log('saveAvailabilityRules', ruleType, override);
				
				if (this.validateAvailabilityIntervals()) {
					return;
				}
				
				let dates = [];
				let weekDays = [];
				let intervals = this.availabilityRulesModal.intervals;
				
				if (this.availabilityRulesModal.multipleModeIsOn) {
					if (this.availabilityRulesModal.multiple.type === 'DATES') {
						dates = this.availabilityRulesModal.multiple.dates;
					} else if (this.availabilityRulesModal.multiple.type === 'WEEK_DAYS') {
						weekDays = this.availabilityRulesModal.multiple.weekDays;
					} else {
						throw new Error('Unknown state');
					}
				} else {
					if (ruleType === 'DATE') {
						dates = this.availabilityRulesModal.dates;
					} else if (ruleType === 'WEEK_DAY') {
						weekDays = [this.availabilityRulesModal.weekDay];
					} else {
						throw new Error('Unknown state');
					}
				}
				
				if (dates.length > 0) {
					this.form.availabilityRules = this.form.availabilityRules.filter((rule) => {
						if (rule.type !== 'DATE') {
							return true;
						}
						
						let hasMatchedDate = dates.some((date) => {
							return this.$moment(date).isSame(rule.date, 'day');
						});
						
						if (!hasMatchedDate) {
							return true;
						}
						
						if (this.firstInvalidRule && this.$moment(rule.date).isSame(this.firstInvalidRule.date, 'day')) {
							this.firstInvalidRule = null;
						}
						
						return false;
					});
					
					dates.forEach((date) => {
						this.form.availabilityRules.push({
							type: 'DATE',
							date: this.$moment(date).format('YYYY-MM-DD'),
							
							intervals: intervals.map((interval) => {
								return {
									from: this.$moment(interval.from, this.timeFormats[this.auth.user.timeFormat]).format('HH:mm'),
									to: this.$moment(interval.to, this.timeFormats[this.auth.user.timeFormat]).format('HH:mm'),
								};
							}),
						});
					});
					
					$(this.$refs.availabilityRulesModal).modal('hide');
					return;
				} else if (weekDays.length > 0) {
					if (!this.availabilityRulesModal.overrideQuestionIsShown) {
						this.calculateAvailabilityMatchedDateRules(weekDays);
					}
					
					if (this.availabilityRulesModal.countOfConflicts > 0 && override === null) {
						this.availabilityRulesModal.overrideQuestionIsShown = true;
						return;
					}
					
					this.form.availabilityRules = this.form.availabilityRules.filter((rule) => {
						if (rule.type === 'WEEK_DAY') {
							return !weekDays.includes(rule.weekDay);
						}
						
						if (rule.type === 'DATE') {
							if (!this.availabilityRulesModal.matchedDateRules.includes(rule)) {
								return true;
							}
							
							if (override) {
								return false;
							}
							
							if (this.firstInvalidRule && this.$moment(rule.date).isSame(this.firstInvalidRule.date, 'day')) {
								this.firstInvalidRule = null;
							}
							
							return true;
						}
						
						return false;
					});
					
					weekDays.forEach((weekDay) => {
						this.form.availabilityRules.push({
							type: 'WEEK_DAY',
							weekDay: weekDay,
							
							intervals: intervals.map((interval) => {
								return {
									from: this.$moment(interval.from, this.timeFormats[this.auth.user.timeFormat]).format('HH:mm'),
									to: this.$moment(interval.to, this.timeFormats[this.auth.user.timeFormat]).format('HH:mm'),
								};
							}),
						});
					});
					
					$(this.$refs.availabilityRulesModal).modal('hide');
					return;
				}
				
				throw new Error('Unknown state');
			},
		},
	};
</script>

<style lang="scss">
	.dashboard-booking-type-availability__availability-calendar.vc-container {
		--day-border: 1px solid #dee2e6;
		--day-border-highlight: 1px solid #dee2e6;
		--day-width: 90px;
		--day-height: 90px;
		--day-selected-background-color: #eef6fa;
		--weekday-bg: #f8fafc;
		--weekday-border: 1px solid #eaeaea;
		
		width: 100%;
		border-radius: 0;
		border-color: #dee2e6;
		
		.vc-header {
			background-color: #f1f5f8;
			padding: 10px 0;
		}
		
		.vc-weeks {
			padding: 0;
		}
		
		.vc-weekday {
			background-color: var(--weekday-bg);
			border-bottom: var(--weekday-border);
			border-top: var(--weekday-border);
			padding: 5px 0;
		}
		
		.vc-grid-container {
			overflow: visible;
		}
		
		.vc-day {
			position: relative;
			z-index: 0;
			padding: 0;
			text-align: left;
			//height: var(--day-height);
			min-width: var(--day-width);
			background-color: #ffffff;
			cursor: pointer;
			//border-bottom: 1px solid #dee2e6;
			
			&:hover {
				z-index: 1;
				border-color: yellow;
			}
			
			.vc-opacity-0 {
				opacity: 1.0;
			}
			
			.vc-pointer-events-none {
				pointer-events: all;
			}
			
			.vc-highlights {
				overflow: visible;
				top: -1px;
				right: -1px;
				bottom: -1px;
				left: -1px;
			}
			
			&:hover .vc-day-layer.vc-day-box-center-center::before,
			&:hover .vc-day-layer.vc-day-box-right-center::before {
				display: block;
				content: '<';
				position: absolute;
				z-index: 1;
				top: (140px / 2) - 10px;
				left: -20px;
				width: 20px;
				height: 20px;
				color: #000000;
			}
			
			&:hover .vc-day-layer.vc-day-box-center-center::after,
			&:hover .vc-day-layer.vc-day-box-left-center::after {
				display: block;
				content: '>';
				position: absolute;
				z-index: 1;
				top: (140px / 2) - 10px;
				right: -20px;
				width: 20px;
				height: 20px;
				color: #000000;
				text-align: right;
			}
			
			.vc-day-layer.vc-day-box-center-center {
				background-color: var(--day-selected-background-color);
				border: 1px solid #00a2ff;
			}
			
			.vc-day-layer.vc-day-box-left-center + .vc-day-box-center-center,
			.vc-day-layer.vc-day-box-right-center + .vc-day-box-center-center {
				&::before,
				&::after {
					display: none;
				}
			}
			
			.vc-day-layer .vc-highlight {
				display: none;
			}
			
			&:not(.on-bottom) {
				border-bottom: var(--day-border);
				
				&.weekday-1 {
					border-bottom: var(--day-border-highlight);
				}
			}
			
			&:not(.on-right) {
				border-right: var(--day-border);
			}
		}
		
		.vc-day-content {
			display: block;
			width: 100%;
			height: 140px;
			margin: 0;
			padding: 0;
			
			&::before {
				display: block;
				content: '';
				position: absolute;
				z-index: 1;
				top: -1px;
				right: -1px;
				bottom: -1px;
				left: -1px;
				border: 1px solid #00a2ff;
				box-shadow: 0 1px 10px rgba(#000000, 20%);
				pointer-events: none;
				
				//&::before {
				//	position: absolute;
				//	z-index: 1;
				//	top: -1px;
				//	right: -1px;
				//	bottom: -1px;
				//	left: -1px;
				//	display: block;
				//	content: '';
				//	border: 1px solid #00a2ff;
				//	pointer-events: none;
				//	box-shadow: 0 1px 10px rgba(#000000, 20%);
				//}
			}
			
			&:not(:hover):not(.vc-day-invalid)::before {
				display: none;
			}
			
			&:hover {
				background-color: transparent;
			}
			
			&.vc-day-invalid::before {
				border-color: #e41600;
			}
		}
		
		.vc-day.weekday-1 .vc-day-content,
		.vc-day.weekday-7 .vc-day-content {
			background-color: #eff8ff;
		}
		
		.vc-day .vc-day-content.vc-day-invalid,
		.vc-day .vc-day-content.vc-day-invalid:hover {
			background-color: #f4dad7;
		}
		
		.vc-opacity-0 .vc-day-content > * {
			opacity: 0.5;
		}
		
		.availability-calendar-date {
			display: block;
			padding: 11px 11px 0;
		}
		
		.availability-calendar-content {
			padding: 5px;
		}
		
		.availability-calendar-rule {
			position: relative;
			border: 1px solid #d0d0d0;
			border-radius: 2px;
			padding: 5px;
			font-size: 12px;
			
			&::before,
			&::after {
				position: absolute;
				display: block;
				content: '';
				width: 12px;
				height: 6px;
				background-image: url('/img/arrowhead-transparent.png');
				background-size: contain;
				background-color: #ffffff;
			}
			
			&::before {
				top: -3px;
				right: 10px;
			}
			
			&::after {
				bottom: -3px;
				left: 10px;
				transform: scaleX(-1);
			}
			
			&:not(.is-repetitive) {
				border-color: transparent;
				
				&::before,
				&::after {
					display: none;
				}
			}
		}
		
		.vc-day.weekday-1,
		.vc-day.weekday-7 {
			.availability-calendar-rule::before,
			.availability-calendar-rule::after {
				background-color: #ffffff;
			}
		}
		
		.vc-day-content.vc-day-selected {
			.availability-calendar-rule::before,
			.availability-calendar-rule::after {
				background-color: var(--day-selected-background-color);
			}
		}
		
		.vc-day.weekday-1 .vc-day-content,
		.vc-day.weekday-7 .vc-day-content {
			.availability-calendar-rule::before,
			.availability-calendar-rule::after {
				background-color: #eff8ff;
			}
		}
		
		.vc-day .vc-day-content.vc-day-invalid {
			.availability-calendar-rule::before,
			.availability-calendar-rule::after {
				background-color: #f4dad7;
			}
		}
	}
	
	.duration-margin-auto {
		margin: auto;
		width: 60px;
	}
	
	.border-solid{
		border: 1px solid;
		border-color: #ffdddd !important;
	}
</style>

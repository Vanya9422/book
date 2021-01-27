<template>
	<div class="container dashboard-scheduled">
		<div class="col-lg-12 pt-4">
			<div class="row justify-content-end pt-2">
				<span>Displaying 0 – 0 of 0 Events</span>
			</div>
		</div>
		<div class="col-lg-12 pt-4 pb-2">
			<div class="row align-items-center justify-content-between">
				<div class="d-flex">
					<router-link class="btn btn-outline-primary mr-2" role="tab" :to="{ name: 'dashboard.scheduled.upcoming' }" exact>
						<div class="d-flex align-items-center">
							<span class="badge badge-primary border border-white d-block mt-1 mr-2">0</span>
							<span>Upcoming</span>
						</div>
					</router-link>
					<router-link class="btn btn-outline-primary mr-2" role="tab" :to="{ name: 'dashboard.scheduled.past' }">
						<div class="d-flex align-items-center">
							<span class="badge badge-primary border border-white d-block mt-1 mr-2">3</span>
							<span>Past</span>
						</div>
					</router-link>
					<div class="dropdown">
						<button class="btn btn-outline-primary dropdown-toggle" type="button" @click="openDateRange">
							Date Range
						</button>
					</div>
					<date-range-picker ref="picker"
						v-model="dateRange"
						:options="options"
						class="date-range-picker"
						@toggle="checkOpen"
						@update="updateValues" />
				</div>
				<div>
					<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" class="btn btn-primary" data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse">
							Filter
						</button>
						<button type="button" class="btn btn-primary">
							Export
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="filterCollapse" class="collapse">
			<div class="card card-body rounded-0 border-bottom-0 pl-0 pr-0 pt-4 pb-4">
				<div class="row m-0">
					<div class="col-lg-2">
						<small><strong class="text-secondary">Teams</strong></small>
						<div class="dropdown">
							<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								All Teams
							</button>
							<div class="dropdown-menu pb-0" style="width: 300px;" aria-labelledby="dropdownMenuButton">
								<div class="col-lg-12 pl-0">
									<div class="input-group mb-3">
										<div class="input-group-prepend border-0">
											<span id="inputGroupPrepend2" class="input-group-text border-0 bg-white"><img src="/img/search_black.svg" width="15" alt=""></span>
										</div>
										<input id="validationDefaultUsername" type="text" class="form-control border-0" placeholder="Filter" aria-describedby="inputGroupPrepend2" required="">
									</div>
								</div>
								<div class="col-lg-12 mb-4">
									<div class="row m-0">
										<a href="#">select all</a>
										<span class="ml-1 mr-1">/</span>
										<a href="#">clear</a>
									</div>
								</div>
								<div class="col-lg-12 pt-4 pb-2 bg-light">
									<small><strong class="text-secondary">SELECTED ITEMS</strong></small>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="hihi" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="hihi">hihi</label>
									</div>
								</div>
								<div class="col-lg-12 pt-4 pb-4 bg-light">
									<small><strong class="text-secondary">TEAMS</strong></small>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="bbq" type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="bbq">teamBBQ</label>
									</div>
								</div>
								<div class="col-lg-12 pt-3 pb-3">
									<div class="row">
										<div class="col-lg-6">
											<button class="btn btn-primary btn-block">
												Apply
											</button>
										</div>
										<div class="col-lg-6">
											<button class="btn btn-outline-secondary btn-block">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<small><strong class="text-secondary">Event Types</strong></small>
						<div class="dropdown">
							<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								All Event Types
							</button>
							<div class="dropdown-menu pb-0" style="width: 300px;" aria-labelledby="dropdownMenuButton">
								<div class="col-lg-12 pl-0">
									<div class="input-group mb-3">
										<div class="input-group-prepend border-0">
											<span id="inputGroupPrepend2" class="input-group-text border-0 bg-white"><img src="/img/search_black.svg" width="15" alt=""></span>
										</div>
										<input id="validationDefaultUsername" type="text" class="form-control border-0" placeholder="Filter" aria-describedby="inputGroupPrepend2" required="">
									</div>
								</div>
								<div class="col-lg-12 mb-4">
									<div class="row m-0">
										<a href="#">select all</a>
										<span class="ml-1 mr-1">/</span>
										<a href="#">clear</a>
									</div>
								</div>
								<div class="col-lg-12 pt-4 pb-2 bg-light">
									<small><strong class="text-secondary">RUSLAN</strong></small>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="asdasdaadasd" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="asdasdaadasd">asdasdaadasd</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="thirtyMins" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="thirtyMins">Sample 30-min Event Type</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="sixtyMins" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="sixtyMins">Sample 60-min Event Type</label>
									</div>
								</div>
								<div class="col-lg-12 pt-3 pb-3">
									<div class="row">
										<div class="col-lg-6">
											<button class="btn btn-primary btn-block">
												Apply
											</button>
										</div>
										<div class="col-lg-6">
											<button class="btn btn-outline-secondary btn-block">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<small><strong class="text-secondary">Status</strong></small>
						<div class="dropdown">
							<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Active Events
							</button>
							<div class="dropdown-menu pb-0" style="width: 300px;" aria-labelledby="dropdownMenuButton">
								<div class="col-lg-12 pt-4 pb-2 bg-light">
									<small><strong class="text-secondary">STATUS</strong></small>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="active" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="active">Active events</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="canceled" type="checkbox" class="custom-control-input">
										<label class="custom-control-label" for="canceled">Canceled events</label>
									</div>
								</div>
								<div class="col-lg-12 pt-3 pb-3">
									<div class="row">
										<div class="col-lg-6">
											<button class="btn btn-primary btn-block">
												Apply
											</button>
										</div>
										<div class="col-lg-6">
											<button class="btn btn-outline-secondary btn-block">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<small><strong class="text-secondary">Tracking ID</strong></small>
						<div class="dropdown">
							<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								All IDs
							</button>
							<div class="dropdown-menu pb-0" style="width: 300px;" aria-labelledby="dropdownMenuButton">
								<div class="col-lg-12 pl-0">
									<div class="input-group mb-3">
										<div class="input-group-prepend border-0">
											<span id="inputGroupPrepend2" class="input-group-text border-0 bg-white"><img src="/img/search_black.svg" width="15" alt=""></span>
										</div>
										<input id="validationDefaultUsername" type="text" class="form-control border-0" placeholder="Filter" aria-describedby="inputGroupPrepend2" required="">
									</div>
								</div>
								<div class="col-lg-12 mb-4">
									<div class="row m-0">
										<a href="#">select all</a>
										<span class="ml-1 mr-1">/</span>
										<a href="#">clear</a>
									</div>
								</div>
								<div class="col-lg-12 pt-2 pb-2 bg-light">
									<small><strong class="text-secondary">UTM_CAMPAIGN</strong></small>
									<span class="d-block pl-4 text-secondary">No items found</span>
								</div>
								<div class="col-lg-12 pt-2 pb-2 bg-light">
									<small><strong class="text-secondary">UTM_Source</strong></small>
									<span class="d-block pl-4 text-secondary">No items found</span>
								</div>
								<div class="col-lg-12 pt-2 pb-2 bg-light">
									<small><strong class="text-secondary">UTM_MEDIUM</strong></small>
									<span class="d-block pl-4 text-secondary">No items found</span>
								</div>
								<div class="col-lg-12 pt-2 pb-2 bg-light">
									<small><strong class="text-secondary">UTM_CONTENT</strong></small>
									<span class="d-block pl-4 text-secondary">No items found</span>
								</div>
								<div class="col-lg-12 pt-2 pb-2 bg-light">
									<small><strong class="text-secondary">UTM_TERM</strong></small>
									<span class="d-block pl-4 text-secondary">No items found</span>
								</div>
								<div class="col-lg-12 pt-3 pb-3">
									<div class="row">
										<div class="col-lg-6">
											<button class="btn btn-primary btn-block">
												Apply
											</button>
										</div>
										<div class="col-lg-6">
											<button class="btn btn-outline-secondary btn-block">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<small><strong class="text-secondary">Invitee Emails</strong></small>
						<div class="dropdown">
							<button id="dropdownMenuButton" class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								All Invitee Emails
							</button>
							<div class="dropdown-menu pb-0" style="width: 300px;" aria-labelledby="dropdownMenuButton">
								<div class="col-lg-12 pl-0">
									<div class="input-group mb-3">
										<div class="input-group-prepend border-0">
											<span id="inputGroupPrepend2" class="input-group-text border-0 bg-white"><img src="/img/search_black.svg" width="15" alt=""></span>
										</div>
										<input id="validationDefaultUsername" type="text" class="form-control border-0" placeholder="Filter" aria-describedby="inputGroupPrepend2" required="">
									</div>
								</div>
								<div class="col-lg-12 mb-4">
									<div class="row m-0">
										<a href="#">select all</a>
										<span class="ml-1 mr-1">/</span>
										<a href="#">clear</a>
									</div>
								</div>
								<div class="col-lg-12 pt-4 pb-2 bg-light">
									<small><strong class="text-secondary">INVITEE EMAILS</strong></small>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="ajskhdakj@aksjdh.asdasdskjdhf" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="ajskhdakj@aksjdh.asdasdskjdhf">ajskhdakj@aksjdh.asdasdskjdhf</label>
									</div>
									<div class="custom-control custom-checkbox mr-sm-2 mt-2">
										<input id="asdasd@asdasd.asdasd" type="checkbox" checked="" class="custom-control-input">
										<label class="custom-control-label" for="asdasd@asdasd.asdasd">asdasd@asdasd.asdasd</label>
									</div>
								</div>
								<div class="col-lg-12 pt-3 pb-3">
									<div class="row">
										<div class="col-lg-6">
											<button class="btn btn-primary btn-block">
												Apply
											</button>
										</div>
										<div class="col-lg-6">
											<button class="btn btn-outline-secondary btn-block">
												Cancel
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-2">
						<button class="btn btn-outline-secondary btn-block">
							Reset
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-12 border">
			<router-view />
		</div>
	</div>
</template>

<script>
	import DateRangePicker from 'vue2-daterange-picker';
	import 'vue2-daterange-picker/dist/vue2-daterange-picker.css';

	export default {

		components: {
			DateRangePicker,
		},
		data() {
			return {
				dateRange: {},
				options: {
					timePicker: true,
					startDate: this.$moment().startOf('hour'),
					endDate: this.$moment().startOf('hour').add(32, 'hour'),
					locale: {
						format: 'DD-MM-YYYY',
					},
				},

			};
		},

		mounted() {
			//
		},

		methods: {
			checkOpen() {

			},

			openDateRange() {
				setTimeout((ev) => {
					this.$refs.picker.togglePicker();
				}, 50);
			},

			updateValues(e) {
				// let startDate = this.$moment(e.startDate).format('DD MMMM');
				// let endDate = this.$moment(e.endDate).format('DD MMMM YYYY');
				// let startDateEndDate = startDate + ' - ' + endDate;
			},
		},
	};
</script>

<style scoped>
    .date-range-picker{
        position: absolute;
        left: 220px;
    }

</style>

<template>
	<div>
		<div class="d-flex justify-content-between align-items-center pt-3">
			<div class="btn-group">
				<button class="btn btn-primary">
					0 Recieved
				</button>
				<button class="btn btn-outline-primary">
					1 Sent
				</button>
			</div>
			<div class="d-flex align-items-center">
				<div class="input-group mb-lg-0 mb-2 mr-lg-2 w-100 w-md-auto">
					<div class="input-group-prepend border-0">
						<span id="inputGroupPrepend2" class="input-group-text border-0 bg-white">
							<img src="/img/search_black.svg" alt="" width="15" style="opacity: 0.3;">
						</span>
					</div>
					<input id="validationDefaultUsername" type="text" placeholder="Filter" aria-describedby="Filter" required="required" class="form-control border-0">
				</div>
				<strong class="ml-2 mr-2">Filter by</strong>
				<div class="form-group mb-0">
					<select class="form-control">
						<option>
							Date Range
						</option>
						<option>
							Date Range
						</option>
						<option>
							Date Range
						</option>
						<option>
							Date Range
						</option>
						<option>
							Date Range
						</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-12 mt-4 mb-2">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-10 p-0">
					<div class="d-flex justify-content-between align-items-center">
						<div class="col-1 p-0 text-center">
							<strong class="text-secondary text-uppercase">id</strong>
						</div>
						<div class="col-1 p-0 text-center">
							<strong class="text-secondary">Paid</strong>
						</div>
						<div class="col-3 p-0 text-center">
							<strong class="text-secondary">Date Paid</strong>
						</div>
						<div class="col-3 p-0 text-center">
							<strong class="text-secondary">Date Booked</strong>
						</div>
						<div class="col-2 p-0 text-center">
							<strong class="text-secondary">Booked Time</strong>
						</div>
						<div class="col-2 p-0 text-center">
							<strong class="text-secondary">From</strong>
						</div>
					</div>
				</div>
				<div class="col-lg-2 p-0">
					<div class="d-flex justify-content-between align-items-center">
						<div class="col-6 p-0 text-center">
							<strong class="text-secondary">Status</strong>
						</div>
						<div class="col-6 p-0 text-center"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 mt-4 mb-2">
			<div class="row justify-content-between align-items-center">
				<div class="col-lg-10 p-0">
					<div class="d-flex justify-content-between align-items-center">
						<div class="col-1 p-0 text-center">
							<span class="text-secondary text-uppercase">24439</span>
						</div>
						<div class="col-1 p-0 text-center">
							<span class="d-flex align-items-center justify-content-center">
								<span class="mr-1">$55</span>
								<span style="font-size: 0;">
									<img src="/img/info.svg" width="13" alt="">
								</span>
							</span>
						</div>
						<div class="col-3 p-0 text-center">
							<span class="text-secondary">9h11 GMT-4 12 Jan 2014</span>
						</div>
						<div class="col-3 p-0 text-center">
							<span class="text-secondary">9h11 GMT-4 12 Jan 2014</span>
						</div>
						<div class="col-2 p-0 text-center">
							<span class="text-secondary">30 mins</span>
						</div>
						<div class="col-2 p-0 text-center">
							<span class="text-secondary">Mark Bruk</span>
						</div>
					</div>
				</div>
				<div class="col-lg-2 p-0">
					<div class="d-flex justify-content-between align-items-center">
						<div class="col-6 p-0 text-center">
							<span class="text-secondary">Paid</span>
						</div>
						<div class="col-6 p-0 text-center">
							<button class="btn btn-secondary btn-block btn-sm">
								Refund
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		components: {
			//
		},
		data() {
			return {
				//
			};
		},

		mounted() {
			console.log('DashboardBillingOverview mounted!');
		},

		methods: {
			//
		},
	};
</script>

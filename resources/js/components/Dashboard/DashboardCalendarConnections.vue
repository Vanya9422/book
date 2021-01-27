<template>
	<div>
		<div class="container-fluid shadow-sm p-4 admin_main">
			<div class="container">
				<h2>
					Calendar Connections
				</h2>
			</div>
		</div>
		<div class="container-fluid pt-4 pb-4">
			<div class="container">
				<div class="card">
					<div class="card-header">
						<div class="col-lg-12">
							<div class="row justify-content-between align-items-center">
								<span>My Calendar Account <span class="text-secondary ml-2">1/6</span></span>
								<a class="btn btn-outline-primary btn-sm"
									href="connect_calendar.html">+ Add Calendar Account</a>
							</div>
						</div>
					</div>
					<div class="card- p-0">
						<div class="col-lg-12 p-4 bg-light">
							<div class="row m-0 align-items-center">
								<div
									class="icon p-0 bg-white rounded-circle d-flex justify-content-center align-items-center shadow"
									style="width: 50px; height: 50px;">
									<img src="img/svg/google_calendar.svg" alt="" width="25">
								</div>
								<div class="col">
									<p class="mb-1 text-secondary">
										Google
									</p>
									<h5>
										ruslangarapov1994@gmail.com
									</h5>
								</div>
								<button class="btn btn-outline-secondary disabled" data-toggle="modal"
									data-target="#disconnectCalendar">
									Disconnect
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="card mt-4">
					<div class="card-header">
						<div class="col-lg-12">
							<div class="row justify-content-between align-items-center">
								<span>Configuration</span>
							</div>
						</div>
					</div>
					<div class="card- p-0">
						<div class="col-lg-12 p-4">
							<div class="row m-0 align-items-top">
								<div class="icon p-0 mr-3">
									<img src="img/svg/google_calendar.svg" alt="" width="25">
								</div>
								<div class="col">
									<h5>
										Check for conflicts
									</h5>
									<p class="mt-1 mb-0 text-secondary">
										Set the calendar(s) to check for conflicts to prevent double bookings.
									</p>
								</div>
								<div class="col pr-4 pl-4 pt-2 pb-2 align-self-center border rounded">
									<div class="row align-items-top">
										<div
											class="icon p-0 bg-white rounded-circle d-flex justify-content-center align-items-center shadow"
											style="width: 25px; height: 25px;">
											<img src="img/svg/google_calendar.svg" alt="" width="15">
										</div>
										<div class="col">
											<p class="mb-1">
												<small class="text-secondary">Check ruslangarapov1994@gmail.com</small>
											</p>
											<ul class="pl-3">
												<li>
													ruslangarapov1994@gmail.com
												</li>
											</ul>
										</div>
										<a href="#" data-toggle="modal" data-target="#exampleModal">edit</a>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="col-lg-12 p-4">
							<div class="row m-0 align-items-top">
								<div class="icon p-0 mr-3">
									<img src="img/svg/google_calendar.svg" alt="" width="25">
								</div>
								<div class="col">
									<h5>
										Add to calendar
									</h5>
									<p class="mt-1 mb-0 text-secondary">
										Set the calendar you would like to add new events to as they’re scheduled.
									</p>
								</div>
								<div class="col pr-4 pl-4 pt-2 pb-2 align-self-center border rounded">
									<div class="row align-items-top">
										<div
											class="icon p-0 bg-white rounded-circle d-flex justify-content-center align-items-center shadow"
											style="width: 25px; height: 25px;">
											<img src="img/svg/google_calendar.svg" alt="" width="15">
										</div>
										<div class="col">
											<p class="mb-1">
												<small class="text-secondary">Add ruslangarapov1994@gmail.com</small>
											</p>
											<ul class="pl-3">
												<li>
													ruslangarapov1994@gmail.com
												</li>
											</ul>
										</div>
										<a href="#" data-toggle="modal" data-target="#exampleModal2">edit</a>
									</div>
								</div>
							</div>
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
				// events: [],
			};
		},
        
		mounted() {
			//
		},
        
		methods: {
			//
		},
	};
</script>

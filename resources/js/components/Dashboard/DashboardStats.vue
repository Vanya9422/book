<template>
	<div>
		<div class="container">
			<div class="col-12 pt-4 mb-3">
				<div class="row justify-content-end align-items-center">
					<div class="text-secondary">
						<strong>4%</strong> Booked <strong>1%</strong> Cancelled
					</div>
					<div class="form-group mb-0 ml-3">
						<select id="exampleFormControlSelect1" class="form-control">
							<option>
								5 Per Page
							</option>
							<option>
								10 Per Page
							</option>
							<option>
								15 Per Page
							</option>
							<option>
								25 Per Page
							</option>
							<option>
								50 Per Page
							</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 p-0">
				<img src="/img/chart.png" width="100%" height="120" alt="">
			</div>
			<div class="col-12 mt-5">
				<div class="row justify-content-between align-items-center">
					<div class="row align-items-center m-0">
						<button type="button" class="btn btn-secondary btn-sm mr-1">
							All (33)
						</button>
						<div class="dropdown mr-1">
							<button id="dropdownMenuButton" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Invited (332)
							</button>
							<div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
								<div class="custom-control custom-checkbox">
									<input id="customCheck1" type="checkbox" class="custom-control-input">
									<label class="custom-control-label" for="customCheck1">Followed-On</label>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-secondary btn-sm mr-1">
							Viewed
						</button>
						<div class="dropdown mr-1">
							<button id="dropdownMenuButton" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Visited (55)
							</button>
							<div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
								<div class="custom-control custom-checkbox">
									<input id="customCheck2" type="checkbox" class="custom-control-input">
									<label class="custom-control-label" for="customCheck2">All</label>
								</div>
								<div class="custom-control custom-checkbox">
									<input id="customCheck3" type="checkbox" class="custom-control-input">
									<label class="custom-control-label" for="customCheck3">Not Invited</label>
								</div>
								<div class="custom-control custom-checkbox">
									<input id="customCheck4" type="checkbox" class="custom-control-input">
									<label class="custom-control-label" for="customCheck4">Invited</label>
								</div>
							</div>
						</div>
						<div class="dropdown mr-1">
							<button id="dropdownMenuButton" class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Booked (55)
							</button>
							<div class="dropdown-menu p-2" aria-labelledby="dropdownMenuButton">
								<div class="custom-control custom-checkbox">
									<input id="customCheck5" type="checkbox" class="custom-control-input">
									<label class="custom-control-label" for="customCheck5">Rescheduled</label>
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-secondary btn-sm mr-1">
							Cancelled (22)
						</button>
					</div>
					<div class="row align-items-center m-0">
						<div class="dropdown mr-1 p-0">
							<button id="dropdownMenuButton" class="btn btn-link p-0 btn-sm dropdown-toggle text-decoration-none" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img width="20" src="img/svg/calendar.svg" alt="">
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#">Date Range</a>
								<div class="dropdown-divider "></div>
								<a class="dropdown-item" href="#">All Time</a>
								<a class="dropdown-item" href="#">Today</a>
								<a class="dropdown-item" href="#">Last 24h</a>
								<a class="dropdown-item" href="#">This week</a>
								<a class="dropdown-item" href="#">Last 7 Days</a>
								<a class="dropdown-item" href="#">This month</a>
								<a class="dropdown-item" href="#">Last month</a>
							</div>
						</div>
						<div class="form-group mb-0 mr-1">
							<select id="exampleFormControlSelect1" class="form-control form-control-sm">
								<option>
									Sort By
								</option>
								<option>
									Newest
								</option>
								<option>
									Oldest
								</option>
								<option>
									Updated
								</option>
							</select>
						</div>
						<div class="form-group mb-0">
							<input type="text" class="form-control form-control-sm" placeholder="Find via Email or Title">
						</div>
						<div class="form-group mb-0 ml-1">
							<select id="exampleFormControlSelect1" class="form-control form-control-sm">
								<option>
									All Event Types
								</option>
								<option>
									All Event Types
								</option>
								<option>
									All Event Types
								</option>
								<option>
									All Event Types
								</option>
								<option>
									All Event Types
								</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 mt-3">
				<div class="row align-items-center mb-1">
					<div class="col-2">
						<div class="row align-items-center">
							<img src="/img/country-flags/US.png" width="20" alt="">
							<small class="ml-2">New York, USA</small>
						</div>
					</div>
					<div class="col-2 p-0">
						<div class="row align-items-center m-0">
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-primary d-block">From Email</span>
							</div>
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-success d-block">Visited</span>
							</div>
						</div>
					</div>
					<div class="col-3 text-center pl-1 pr-1">
						<small>PayPage 10min meeting</small>
					</div>
					<div class="col-2 pl-1 pr-1">
						<small>12h33pm EST - <strong class="badge badge-light text-secondary">33m ago</strong></small>
					</div>
					<div class="col-3">
						<div class="row justify-content-end align-items-center">
							<small>info.bmvo@gmail.com</small>
							<div class="col">
								<div class="row justify-content-end align-items-center">
									<button class="btn btn-link btn-sm ml-3" data-toggle="modal" data-target="#notes">
										<img src="/img/note.svg" width="30" style="opacity: .5;" alt="">
									</button>
									<button class="btn btn-link btn-sm ml-1" data-toggle="modal" data-target="#history">
										<img src="/img/history.svg" style="opacity: .5;" width="22" alt="">
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row align-items-center mb-1">
					<div class="col-2">
						<div class="row align-items-center">
							<img src="/img/country-flags/US.png" width="20" alt="">
							<small class="ml-2">Montreal, QC, Canada</small>
						</div>
					</div>
					<div class="col-2 p-0">
						<div class="row align-items-center m-0">
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-primary d-block">From Email</span>
							</div>
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-success d-block">Booked</span>
							</div>
						</div>
					</div>
					<div class="col-3 text-center pl-1 pr-1">
						<small>Buy my dinos</small>
					</div>
					<div class="col-2 pl-1 pr-1">
						<small>9h33pm EST - <strong class="badge badge-light text-secondary">1m ago</strong></small>
					</div>
					<div class="col-3">
						<div class="row justify-content-end align-items-center">
							<small>a3om77@gmail.com</small>
							<div class="col">
								<div class="row justify-content-end align-items-center">
									<button class="btn btn-link btn-sm ml-3" data-toggle="modal" data-target="#notes">
										<span class="row align-items-center justify-content-end m-0">
											<span class="badge badge-dark mt-1">1</span><img src="/img/note.svg" width="30" style="opacity: .5;" alt="">
										</span>
									</button>
									<button class="btn btn-link btn-sm ml-1" data-toggle="modal" data-target="#history">
										<img src="/img/history.svg" style="opacity: .5;" width="22" alt="">
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row align-items-center mb-1">
					<div class="col-2">
						<div class="row align-items-center">
							<img src="/img/country-flags/US.png" width="20" alt="">
							<small class="ml-2">New York, USA</small>
						</div>
					</div>
					<div class="col-2 p-0">
						<div class="row align-items-center m-0">
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-primary d-block">From Email</span>
							</div>
							<div class="col-6 pl-1 pr-1">
								<span class="badge badge-success d-block">Invited</span>
							</div>
						</div>
					</div>
					<div class="col-3 text-center pl-1 pr-1">
						<small>Pizza time</small>
					</div>
					<div class="col-2 pl-1 pr-1">
						<small>12h33pm EST - <strong class="badge badge-light text-secondary">33m ago</strong></small>
					</div>
					<div class="col-3">
						<div class="row justify-content-end align-items-center">
							<small>mama@hotmail.com</small>
							<div class="col">
								<div class="row justify-content-end align-items-center">
									<button class="btn btn-link btn-sm ml-3" data-toggle="modal" data-target="#notes">
										<img src="/img/note.svg" width="30" style="opacity: .5;" alt="">
									</button>
									<button class="btn btn-link btn-sm ml-1" data-toggle="modal" data-target="#history">
										<img src="/img/history.svg" style="opacity: .5;" width="22" alt="">
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 p-0 mt-5">
				<strong class="d-block mb-2">No one yet.</strong>
				<div class="text-secondary mb-2">
					To get bookings, send your event links.
				</div>
				<button class="btn-primary btn">
					Show me How
				</button>
			</div>
		</div>
		<div id="notes" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 id="exampleModalLabel" class="modal-title">
							PayPage 10min with info.bmvo@gmail.com (Alicia Bonin)
						</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="input-group mb-3">
							<input type="text" class="form-control" placeholder="Type your note" aria-label="Type your note" aria-describedby="button-addon2">
							<div class="input-group-append">
								<button id="button-addon2" class="btn btn-outline-secondary" type="button">
									Add Note
								</button>
							</div>
						</div>
						<div class="text-secodary mt-5">
							This is what is supposed to happen at this meeting and we should meet up there
						</div>
						<div class="col-12 mt-2">
							<div class="row justify-content-between align-items-center">
								<div class="text-secondary">
									Added by <strong>Mark Bruk</strong> Feb 22 2019
								</div>
								<div class="row align-items-center">
									<button class="btn btn-link">
										<img src="/img/edit.svg" width="15" alt="">
									</button>
									<button class="btn btn-link" data-toggle="modal" data-target="#delete" data-dismiss="modal">
										<img src="/img/delete.svg" width="15" alt="">
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="history" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 id="exampleModalLabel" class="modal-title">
							Booking History
						</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<p>
							<strong>PayPage 10min</strong> with <strong>Alicia Bonin</strong> <span class="badge badge-dark">info.bmvo@gmail.com</span>
						</p>
						<div>
							Feb 22 2019 10h33am - <strong>Reschedule</strong>
						</div>
						<div>
							Feb 22 2019 10h33am - <strong>Cancelled</strong>
						</div>
						<div>
							Feb 22 2019 10h33am - <strong>Booked</strong>
						</div>
						<div>
							Feb 22 2019 10h33am - <strong>Visited</strong>
						</div>
						<div>
							Feb 22 2019 10h33am - <strong>Viewed</strong>
						</div>
						<div>
							Feb 22 2019 10h33am - <strong>Invited</strong>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: 'DashboardHomeStats',
	};
</script>

<template>
	<dashboard-layout>
		<dashboard-home-layout>
			<div class="container">
				<div class="col-lg-12 pt-4">
					<div class="row justify-content-end pt-2">
						<span>Displaying 0 – 0 of 0 Events</span>
					</div>
				</div>
				<div class="col-lg-12 pt-4">
					<div class="row align-items-center justify-content-between">
						<ul class="nav nav-pills mt-3" id="pills-tab" role="tablist">
							<li class="nav-item rounded-top">
								<a class="nav-link rounded-0 rounded-top active" href="#pills-upcoming"
									id="pills-upcoming-tab" data-toggle="pill" role="tab" aria-controls="pills-upcoming"
									aria-selected="true">
									Upcoming
								</a>
							</li>
							<li class="nav-item rounded-top">
								<a class="nav-link rounded-0 rounded-top" href="#pills-past" id="pills-past-tab"
									data-toggle="pill" role="tab" aria-controls="pills-past" aria-selected="false">
									Past
								</a>
							</li>
							<li class="dropdown">
								<button type="button" class="btn btn-white dropdown-toggle" id="dropdownMenuButton"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Date Range
								</button>
								<div class="dropdown-menu p-4" aria-labelledby="dropdownMenuButton">
									<div class="col-lg-12 p-0 pb-4">
										<div class="btn-group" role="group" aria-label="Basic example">
											<button type="button" class="btn btn-secondary">Today</button>
											<button type="button" class="btn btn-secondary">This week</button>
											<button type="button" class="btn btn-secondary">This month</button>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="row d-flex" style="width: 600px;">
											<div class="col-lg-6 pl-0">
												<table id="calendar">
													<tbody>
													<tr class="weekdays">
														<th scope="col">Sun</th>
														<th scope="col">Mon</th>
														<th scope="col">Tue</th>
														<th scope="col">Wed</th>
														<th scope="col">Thu</th>
														<th scope="col">Fri</th>
														<th scope="col">Sat</th>
													</tr>
													<tr class="days">
														<td class="day other-month">
															<div class="date">27</div>
														</td>
														<td class="day other-month">
															<div class="date">28</div>
														</td>
														<td class="day other-month">
															<div class="date">29</div>
														</td>
														<td class="day other-month">
															<div class="date">30</div>
														</td>
														<td class="day other-month">
															<div class="date">31</div>
														</td>
														<td class="day">
															<div class="date">1</div>
														</td>
														<td class="day">
															<div class="date">2</div>
														</td>
													</tr>
													<tr>
														<td class="day bg-primary">
															<div class="date text-white"><strong>3</strong></div>
														</td>
														<td class="day">
															<div class="date">4</div>
														</td>
														<td class="day">
															<div class="date">5</div>
														</td>
														<td class="day">
															<div class="date">6</div>
														</td>
														<td class="day">
															<div class="date">7</div>
														</td>
														<td class="day">
															<div class="date">8</div>
														</td>
														<td class="day">
															<div class="date">9</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">10</div>
														</td>
														<td class="day">
															<div class="date">11</div>
														</td>
														<td class="day">
															<div class="date">12</div>
														</td>
														<td class="day">
															<div class="date">13</div>
														</td>
														<td class="day">
															<div class="date">14</div>
														</td>
														<td class="day">
															<div class="date">15</div>
														</td>
														<td class="day">
															<div class="date">16</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">17</div>
														</td>
														<td class="day">
															<div class="date">18</div>
														</td>
														<td class="day">
															<div class="date">19</div>
														</td>
														<td class="day">
															<div class="date">20</div>
														</td>
														<td class="day">
															<div class="date">21</div>
														</td>
														<td class="day">
															<div class="date">22</div>
														</td>
														<td class="day">
															<div class="date">23</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">24</div>
														</td>
														<td class="day">
															<div class="date">25</div>
														</td>
														<td class="day">
															<div class="date">26</div>
														</td>
														<td class="day">
															<div class="date">27</div>
														</td>
														<td class="day">
															<div class="date">28</div>
														</td>
														<td class="day">
															<div class="date">29</div>
														</td>
														<td class="day">
															<div class="date">30</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">31</div>
														</td>
														<td class="day other-month">
															<div class="date">1</div>
															<!-- Next Month -->
														</td>
														<td class="day other-month">
															<div class="date">2</div>
														</td>
														<td class="day other-month">
															<div class="date">3</div>
														</td>
														<td class="day other-month">
															<div class="date">4</div>
														</td>
														<td class="day other-month">
															<div class="date">5</div>
														</td>
														<td class="day other-month">
															<div class="date">6</div>
														</td>
													</tr>
													</tbody>
												</table>
											</div>
											<div class="col-lg-6 pr-0">
												<table id="calendar">
													<tbody>
													<tr class="weekdays">
														<th scope="col">Sun</th>
														<th scope="col">Mon</th>
														<th scope="col">Tue</th>
														<th scope="col">Wed</th>
														<th scope="col">Thu</th>
														<th scope="col">Fri</th>
														<th scope="col">Sat</th>
													</tr>
													<tr class="days">
														<td class="day other-month">
															<div class="date">27</div>
														</td>
														<td class="day other-month">
															<div class="date">28</div>
														</td>
														<td class="day other-month">
															<div class="date">29</div>
														</td>
														<td class="day other-month">
															<div class="date">30</div>
														</td>
														<td class="day other-month">
															<div class="date">31</div>
														</td>
														<td class="day">
															<div class="date">1</div>
														</td>
														<td class="day">
															<div class="date">2</div>
														</td>
													</tr>
													<tr>
														<td class="day bg-primary">
															<div class="date text-white"><strong>3</strong></div>
														</td>
														<td class="day">
															<div class="date">4</div>
														</td>
														<td class="day">
															<div class="date">5</div>
														</td>
														<td class="day">
															<div class="date">6</div>
														</td>
														<td class="day">
															<div class="date">7</div>
														</td>
														<td class="day">
															<div class="date">8</div>
														</td>
														<td class="day">
															<div class="date">9</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">10</div>
														</td>
														<td class="day">
															<div class="date">11</div>
														</td>
														<td class="day">
															<div class="date">12</div>
														</td>
														<td class="day">
															<div class="date">13</div>
														</td>
														<td class="day">
															<div class="date">14</div>
														</td>
														<td class="day">
															<div class="date">15</div>
														</td>
														<td class="day">
															<div class="date">16</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">17</div>
														</td>
														<td class="day">
															<div class="date">18</div>
														</td>
														<td class="day">
															<div class="date">19</div>
														</td>
														<td class="day">
															<div class="date">20</div>
														</td>
														<td class="day">
															<div class="date">21</div>
														</td>
														<td class="day">
															<div class="date">22</div>
														</td>
														<td class="day">
															<div class="date">23</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">24</div>
														</td>
														<td class="day">
															<div class="date">25</div>
														</td>
														<td class="day">
															<div class="date">26</div>
														</td>
														<td class="day">
															<div class="date">27</div>
														</td>
														<td class="day">
															<div class="date">28</div>
														</td>
														<td class="day">
															<div class="date">29</div>
														</td>
														<td class="day">
															<div class="date">30</div>
														</td>
													</tr>
													<tr>
														<td class="day">
															<div class="date">31</div>
														</td>
														<td class="day other-month">
															<div class="date">1</div>
															<!-- Next Month -->
														</td>
														<td class="day other-month">
															<div class="date">2</div>
														</td>
														<td class="day other-month">
															<div class="date">3</div>
														</td>
														<td class="day other-month">
															<div class="date">4</div>
														</td>
														<td class="day other-month">
															<div class="date">5</div>
														</td>
														<td class="day other-month">
															<div class="date">6</div>
														</td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="col-lg-12 pt-4">
										<div class="row justify-content-center align-items-center">
											<button type="button" class="btn btn-primary mr-4">Apply</button>
											<button type="button" class="btn">Cancel</button>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-primary" href="#filterCollapse"
									data-toggle="collapse" role="button" aria-expanded="false"
									aria-controls="filterCollapse">
									Filter
								</button>
								<button type="button" class="btn btn-primary">Export</button>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse" id="filterCollapse">
					<div class="card card-body rounded-0 border-bottom-0 pl-0 pr-0 pt-4 pb-4">
						<div class="row m-0">
							<div class="col-lg-2">
								<small><strong class="text-secondary">Teams</strong></small>
								<div class="dropdown">
									<button type="button" class="btn btn-link pl-0 dropdown-toggle"
										id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										All Teams
									</button>
									<div class="dropdown-menu pb-0" style="width: 300px;"
										aria-labelledby="dropdownMenuButton">
										<div class="col-lg-12 pl-0">
											<div class="input-group mb-3">
												<div class="input-group-prepend border-0">
													<span class="input-group-text border-0 bg-white"
														id="inputGroupPrepend2">
														<img src="/img/search_black.svg" alt="" width="15">
													</span>
												</div>
												<input type="text" class="form-control border-0"
													id="validationDefaultUsername" placeholder="Filter"
													aria-describedby="inputGroupPrepend2" required>
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
												<input type="checkbox" class="custom-control-input" id="hihi" checked>
												<label class="custom-control-label" for="hihi">hihi</label>
											</div>
										</div>
										<div class="col-lg-12 pt-4 pb-4 bg-light">
											<small><strong class="text-secondary">TEAMS</strong></small>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input" id="bbq">
												<label class="custom-control-label" for="bbq">teamBBQ</label>
											</div>
										</div>
										<div class="col-lg-12 pt-3 pb-3">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn btn-primary btn-block">Apply</button>
												</div>
												<div class="col-lg-6">
													<button class="btn btn-outline-secondary btn-block">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<small><strong class="text-secondary">Booking Types</strong></small>
								<div class="dropdown">
									<button type="button" class="btn btn-link pl-0 dropdown-toggle"
										id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										All Booking Types
									</button>
									<div class="dropdown-menu pb-0" style="width: 300px;"
										aria-labelledby="dropdownMenuButton">
										<div class="col-lg-12 pl-0">
											<div class="input-group mb-3">
												<div class="input-group-prepend border-0">
													<span class="input-group-text border-0 bg-white"
														id="inputGroupPrepend2">
														<img src="/img/search_black.svg" alt="" width="15">
													</span>
												</div>
												<input type="text" class="form-control border-0"
													id="validationDefaultUsername" placeholder="Filter"
													aria-describedby="inputGroupPrepend2" required>
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
												<input type="checkbox" class="custom-control-input" id="asdasdaadasd"
													checked>
												<label class="custom-control-label"
													for="asdasdaadasd">asdasdaadasd</label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input" id="thirtyMins"
													checked>
												<label class="custom-control-label"
													for="thirtyMins">Sample 30-min Booking Type</label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input" id="sixtyMins"
													checked>
												<label class="custom-control-label"
													for="sixtyMins">Sample 60-min Booking Type</label>
											</div>
										</div>
										<div class="col-lg-12 pt-3 pb-3">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn btn-primary btn-block">Apply</button>
												</div>
												<div class="col-lg-6">
													<button class="btn btn-outline-secondary btn-block">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<small><strong class="text-secondary">Status</strong></small>
								<div class="dropdown">
									<button type="button" class="btn btn-link pl-0 dropdown-toggle"
										id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										Active Bookings
									</button>
									<div class="dropdown-menu pb-0" style="width: 300px;"
										aria-labelledby="dropdownMenuButton">
										<div class="col-lg-12 pt-4 pb-2 bg-light">
											<small><strong class="text-secondary">STATUS</strong></small>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input" id="active" checked>
												<label class="custom-control-label" for="active">Active booking types</label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input" id="canceled">
												<label class="custom-control-label" for="canceled">
													Canceled booking types
												</label>
											</div>
										</div>
										<div class="col-lg-12 pt-3 pb-3">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn btn-primary btn-block">Apply</button>
												</div>
												<div class="col-lg-6">
													<button class="btn btn-outline-secondary btn-block">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<small><strong class="text-secondary">Tracking ID</strong></small>
								<div class="dropdown">
									<button type="button" class="btn btn-link pl-0 dropdown-toggle"
										id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										All IDs
									</button>
									<div class="dropdown-menu pb-0" style="width: 300px;"
										aria-labelledby="dropdownMenuButton">
										<div class="col-lg-12 pl-0">
											<div class="input-group mb-3">
												<div class="input-group-prepend border-0">
													<span class="input-group-text border-0 bg-white"
														id="inputGroupPrepend2">
														<img src="/img/search_black.svg" alt="" width="15">
													</span>
												</div>
												<input type="text" class="form-control border-0"
													id="validationDefaultUsername" placeholder="Filter"
													aria-describedby="inputGroupPrepend2" required>
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
													<button class="btn btn-primary btn-block">Apply</button>
												</div>
												<div class="col-lg-6">
													<button class="btn btn-outline-secondary btn-block">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<small><strong class="text-secondary">Invitee Emails</strong></small>
								<div class="dropdown">
									<button type="button" class="btn btn-link pl-0 dropdown-toggle"
										id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
										aria-expanded="false">
										All Invitee Emails
									</button>
									<div class="dropdown-menu pb-0" style="width: 300px;"
										aria-labelledby="dropdownMenuButton">
										<div class="col-lg-12 pl-0">
											<div class="input-group mb-3">
												<div class="input-group-prepend border-0">
													<span class="input-group-text border-0 bg-white"
														id="inputGroupPrepend2">
														<img src="/img/search_black.svg" alt="" width="15">
													</span>
												</div>
												<input type="text" class="form-control border-0"
													id="validationDefaultUsername" placeholder="Filter"
													aria-describedby="inputGroupPrepend2" required>
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
												<input type="checkbox" class="custom-control-input"
													id="ajskhdakj@aksjdh.asdasdskjdhf" checked>
												<label class="custom-control-label" for="ajskhdakj@aksjdh.asdasdskjdhf">
													ajskhdakj@aksjdh.asdasdskjdhf
												</label>
											</div>
											<div class="custom-control custom-checkbox mr-sm-2 mt-2">
												<input type="checkbox" class="custom-control-input"
													id="asdasd@asdasd.asdasd" checked>
												<label class="custom-control-label" for="asdasd@asdasd.asdasd">
													asdasd@asdasd.asdasd
												</label>
											</div>
										</div>
										<div class="col-lg-12 pt-3 pb-3">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn btn-primary btn-block">Apply</button>
												</div>
												<div class="col-lg-6">
													<button class="btn btn-outline-secondary btn-block">Cancel</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2">
								<button class="btn btn-outline-danger btn-block">Reset</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 border">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="pills-upcoming" role="tabpanel"
							aria-labelledby="pills-upcoming-tab">
							<div class="row flex-column align-items-center justify-content-center">
								<div class="col-lg-12 bg-light p-4 border-bottom">
									Tuesday, 31 December 2019
								</div>
								<div class="col-lg-12" href="#collapseExample" data-toggle="collapse" role="button"
									aria-expanded="false" aria-controls="collapseExample">
									<div class="row p-4">
										<div class="col-lg-4">
											<div class="row m-0 align-items-center">
												<div class="rounded-circle bg-primary mr-4"
													style="width: 30px;height: 30px;"></div>
												<span>10:00 - 10:45</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="text">
												<strong>ajshdkajshd</strong> with you
											</div>
											<div class="text">
												Booking type <strong>kxcvkjhxckjv</strong>
											</div>
										</div>
										<div class="col">
											<div class="row m-0 justify-content-end">
												<button class="btn btn-link">Details</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 p-4">
									<div class="collapse" id="collapseExample">
										<div class="row m-0 p-2">
											<div class="mr-4" style="width: 30px;"></div>
											<div class="col-lg-3 pt-2 border-top pl-0">
												<a class="btn btn-link pl-0" href="#">
													Edit Booking Type
												</a>
												<a class="btn btn-link pl-0" href="#">
													Filter by Booking Type
												</a>
												<a class="btn btn-link pl-0" href="#">
													Schedule Invitee Again
												</a>
											</div>
											<div class="col ml-4">
												<div class="col-lg-12 border-top mb-3 pt-2">
													<strong class="d-block">EMAIL</strong>
													<span>ajskhdakj@aksjdh.asdasdskjdhf</span>
												</div>
												<div class="col-lg-12 mb-3">
													<strong class="d-block">INVITEE TIME ZONE</strong>
													<span>Pakistan, Maldives Time</span>
												</div>
												<div class="col-lg-12 mb-3">
													<strong class="d-block">QUESTIONS</strong>
													<span class="d-block text-secondary">
														Please share anything that will help prepare for our meeting.
													</span>
													<span>dkjhfskjdf</span>
												</div>
												<div class="col-lg-12 mb-3 pt-4">
													<span class="text-secondary">created 30 December 2019</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<img src="/img/no-events.svg" alt="">
								<h4 class="text-center text-secondary">No Events Yet</h4>
								<p class="text-center text-secondary mt-3 mb-4">Share Booking Type links to schedule bookings.</p>
								<button type="button" class="btn btn-primary btn-sm mt-4">View Booking Types</button>
							</div>
						</div>
						<div class="tab-pane fade" id="pills-past" role="tabpanel" aria-labelledby="pills-past-tab">
							<div class="row flex-column align-items-center justify-content-center">
								<div class="col-lg-12 bg-light p-4 border-bottom">
									Tuesday, 31 December 2019
								</div>
								<div class="col-lg-12" href="#collapseExample2" data-toggle="collapse" role="button"
									aria-expanded="false" aria-controls="collapseExample2">
									<div class="row p-4">
										<div class="col-lg-4">
											<div class="row m-0 align-items-center">
												<div class="rounded-circle bg-primary mr-4"
													style="width: 30px;height: 30px;"></div>
												<span>10:00 - 10:45</span>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="text">
												<strong>ajshdkajshd</strong> with you
											</div>
											<div class="text">
												Event type <strong>kxcvkjhxckjv</strong>
											</div>
										</div>
										<div class="col">
											<div class="row m-0 justify-content-end">
												<button class="btn btn-link">Details</button>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 p-4">
									<div class="collapse" id="collapseExample2">
										<div class="row m-0 p-2">
											<div class="mr-4" style="width: 30px;"></div>
											<div class="col-lg-3 pt-2 border-top pl-0">
												<a class="btn btn-link pl-0" href="#">
													Edit Booking Type
												</a>
												<a class="btn btn-link pl-0" href="#">
													Filter by Booking Type
												</a>
												<a class="btn btn-link pl-0" href="#">
													Schedule Invitee Again
												</a>
											</div>
											<div class="col ml-4">
												<div class="col-lg-12 border-top mb-3 pt-2">
													<strong class="d-block">EMAIL</strong>
													<span>ajskhdakj@aksjdh.asdasdskjdhf</span>
												</div>
												<div class="col-lg-12 mb-3">
													<strong class="d-block">INVITEE TIME ZONE</strong>
													<span>Pakistan, Maldives Time</span>
												</div>
												<div class="col-lg-12 mb-3">
													<strong class="d-block">QUESTIONS</strong>
													<span class="d-block text-secondary">
														Please share anything that will help prepare for our meeting.
													</span>
													<span>dkjhfskjdf</span>
												</div>
												<div class="col-lg-12 mb-3 pt-4">
													<span class="text-secondary">created 30 December 2019</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<img src="/img/no-events.svg" alt="">
								<h4 class="text-center text-secondary">No Past Events</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
		</dashboard-home-layout>
	</dashboard-layout>
</template>

<script>
    const DashboardLayout = () => import('../layouts/DashboardLayout');
    const DashboardHomeLayout = () => import('../layouts/DashboardHomeLayout');
    
    export default {
        data() {
            return {
                //
            };
        },
        
        mounted() {
            //
        },
        
        components: {
            DashboardLayout,
            DashboardHomeLayout,
        },
        
        methods: {
            //
        },
    };
</script>

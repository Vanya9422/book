<template>
	<div>
		<div class="container position-relative pt-3 d-flex justify-content-end">
			<div class="form-group mb-0 mr-2 d-inline-block">
				<span class="switch switch-sm">
					<input id="edit_mode" type="checkbox" checked="checked" class="switch" @change="switchEditMode">
					<label for="edit_mode" class="m-0"> Enable Edit Mode</label>
				</span>
			</div>
		</div>
		<Draggable class="container pt-4" :class="{ 'draggable-wrap': isEditable }" handle=".handle">
			<div class="w-50 d-flex align-items-center mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch1" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch1" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="col-2 px-0 mr-2">
					<div class="square-box rounded overflow-hidden">
						<div class="square-box-in">
							<img src="/img/image.png" alt="">
						</div>
					</div>
				</div>
				<h3>
					Pepsi Corporation
				</h3>
			</div>
			<div class="w-50 d-flex mb-3 align-items-center bg-white">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch2" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch2" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="col-2 pl-0 pr-0 rounded-circle position-relative" style="font-size: 0px;">
					<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
					<div class="p-2 rounded-circle bg-success position-absolute border border-white" style="border-width: 3px !important; box-sizing: border-box; top: 74%; right: 74%;"></div>
				</div>
				<div class="col-9 pr-0 pt-2">
					<h4>
						Mark Bruk
					</h4>
					<div class="d-flex justify-content-start align-items-center mb-2">
						<img src="/img/country-flags/DE.png" alt="">
						<span class="ml-2">Montreal</span>
					</div>
					<span class="d-flex justify-content-start align-items-center">
						<img src="/img/suitcase.svg" width="24" alt="" style="opacity: .2;">
						<span class="ml-2">Super Laywer at</span>
						<a href="#" class="btn btn-link p-1 text-decoration-none ml-1">Pepsi Corporation</a>
					</span>
				</div>
			</div>
			<div class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch3" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch3" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="booking-types-wrap">
					<div class="row mr-0">
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1 active" style="border-left-width: 5px !important;">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<img src="/img/confirm_primary.svg" width="20" alt="">
										<strong class="d-block ml-2" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-1 mt-1">
								<div class="row align-items-center">
									<div class="col text-left d-flex align-items-center">
										<strong class="d-block" style="line-height: 1;">Booking Type Name</strong>
									</div>
									<div class="row pr-3 m-0 flex-column align-items-end">
										<span class="h5 mb-0 d-flex align-items-center">
											<strong class="mr-1">$55</strong>
											<div class="dropdown mr-2">
												<a id="dropdownMenuLink" class="btn btn-link p-1" style="font-size: 0;" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													<img src="/img/info.svg" width="15" style="opacity: .2;" alt="">
												</a>

												<div class="dropdown-menu border-0 shadow py-0" style="min-width: 220px;" aria-labelledby="dropdownMenuLink">
													<div class="d-flex justify-content-between align-items-center p-3 border-bottom">
														<strong>Rate Details</strong>
														<a href="#" class="btn btn-link p-1" style="opacity: .3; font-size: 0;">
															<img src="/img/close.svg" width="10" alt="">
														</a>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Base Price</span>
														<strong>$50</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
														<span>Transaction Fee</span>
														<strong>$1</strong>
													</div>
													<div class="d-flex justify-content-between align-items-center px-3 py-2">
														<span>Platform Fee</span>
														<strong>$1</strong>
													</div>
												</div>
											</div>
											<small class="text-right">
												<span class="badge badge-light">30min</span>
											</small>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch4" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch4" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="video-container rounded overflow-hidden" style="font-size: 0px;">
					<iframe src="https://www.youtube.com/embed/-IMRGMGLuPY" allowfullscreen="allowfullscreen" frameborder="0" width="100%" height="100%"></iframe>
				</div>
			</div>
			<div class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch5" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch5" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="d-flex align-items-center">
					<h3 class="mb-0">
						Rate
					</h3>
					<h4 class="mb-0 ml-2">
						$50 / 30 mins
					</h4>
				</div>
			</div>
			<div class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch15" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch15" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div class="scroll-text-container" style="height: 230px;">
					<div class="row m-0 overflow-auto h-100">
						<div class="col-12 pl-0 py-3">
							<span>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 w-33 pr-2 py-2">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch6" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch6" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<router-link :to="{ name: 'temp.booking_page.desktop.calendar' }" class="btn btn-block btn-primary py-3 next-step">
					<span class="d-flex justify-content-center align-items-center w-100">
						<span class="h4 mb-0">Book Now</span>
					</span>
				</router-link>
			</div>
			<div class="mb-3 py-2 pr-2">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch7" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch7" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div>
					<div class="row">
						<div class="col-6">
							<h5 class="text-center mb-4">
								Pick a Day
							</h5>
							<VCalendar class="border-0" :attributes="calendarAttributes"
								:masks="calendarMasks" is-expanded is-inline />
						</div>
						<div class="col-6 overflow-auto">
							<h5 class="text-center mb-4">
								Pick a Time
							</h5>

							<div class="btn-group-vertical d-block">
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
								<div class="col-lg-12 mb-3">
									<div class="row flex-nowrap">
										<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2">
											09:00
										</button>
										<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mb-3 py-2 pr-2">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch8" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch8" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div>
					<h5 class="text-center mb-4">
						Confirm your Booking
					</h5>
					<form>
						<div class="row">
							<div class="col-6 pr-1">
								<div class="form-group">
									<label for="first_name">First Name *</label>
									<input id="first_name" type="text" class="form-control" aria-describedby="nameHelp">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<label for="last_name">Last Name *</label>
									<input id="last_name" type="text" class="form-control" aria-describedby="nameHelp">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Your Email</label>
							<input id="exampleInputEmail1" type="email" class="form-control" aria-describedby="emailHelp">
							<button class="btn btn-outline-primary mt-2">
								Add Guests
							</button>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">Guest Email(s)</label>
							<textarea id="exampleFormControlTextarea1" class="form-control" rows="3"></textarea>
							<small class="form-text text-muted">Notify up to 10 additional guests of the scheduled event.</small>
						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">What would you like to talk about on the call?</label>
							<textarea id="exampleFormControlTextarea1" class="form-control" rows="3"></textarea>
						</div>
						<div class="input-group mb-3 align-items-stretch">
							<div class="input-group-prepend">
								<button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="mr-2">
										<img width="20" src="/img/country-flags/DE.png" alt="">
									</i>
									<span>+1</span>
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Action</a>
								</div>
							</div>
							<input type="text" class="form-control py-4" aria-label="Text input with dropdown button">
						</div>
						<div class="form-group">
							<label for="credit_card">Credit Card</label>
							<input id="credit_card" type="text" class="form-control" aria-describedby="nameHelp">
						</div>
						<div class="row">
							<div class="col-6 pr-1">
								<div class="form-group">
									<label for="expiration_date">Expiration Date *</label>
									<input id="expiration_date" type="text" class="form-control" aria-describedby="nameHelp">
								</div>
							</div>
							<div class="col-6 pl-1">
								<div class="form-group">
									<label for="cvc">CVC *</label>
									<input id="cvc" type="text" class="form-control" aria-describedby="nameHelp">
								</div>
							</div>
						</div>
						<div class="custom-control custom-checkbox mb-3">
							<input id="agree_terms" type="checkbox" class="custom-control-input">
							<label class="custom-control-label" for="agree_terms">I agree with <a href="#">Terms of Service &amp; Privacy Policy</a></label>
						</div>
						<div class="w-33">
							<button type="button" class="btn btn-block btn-primary py-3 next-step">
								<span class="h4 mb-0">Finish & Pay</span>
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="mb-3 py-2">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch9" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch9" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<div>
					<img src="/img/confirm_primary.svg" width="60" alt="">
					<h4 class="mt-2">
						Confirmed
					</h4>
					<div class="text-secondary pb-5 mt-3">
						You are scheduled with <strong>Ruslan</strong>.
					</div>
					<div class="w-33">
						<router-link :to="{ name: 'dashboard.scheduled.upcoming' }" class="btn btn-block btn-primary py-3 next-step">
							<span class="d-flex justify-content-center align-items-center w-100">
								<span class="h4 mb-0">See Scheduled Bookings</span>
							</span>
						</router-link>
					</div>
				</div>
			</div>
			<h1 class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch10" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch10" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<strong>Bookify Page Title</strong>
			</h1>
			<div class="mb-3 is-only-has-image">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch11" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch11" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<img src="/img/fullpage_title_image.jpg" width="100%" alt="">
			</div>
			<h3>
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch12" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch12" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				Page Header
			</h3>
			<div class="mb-3">
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch13" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch13" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam aliquid aperiam asperiores corporis, culpa cumque, delectus dolor dolorum, earum eos eveniet facilis fuga illo inventore iste iusto nam nisi nostrum nulla officiis porro quibusdam quis quo recusandae rem rerum sint temporibus veritatis voluptatibus. Architecto aspernatur at atque blanditiis consectetur consequuntur cumque cupiditate delectus deserunt distinctio dolorem doloribus dolorum ducimus ea earum esse est et expedita ipsa iure laboriosam magni maxime natus nostrum odit omnis pariatur perspiciatis quae quos, ratione repellat reprehenderit rerum sed sint tempore temporibus unde. Adipisci aliquam, aliquid animi at aut autem commodi consequuntur delectus facere iusto maiores maxime mollitia nihil nobis obcaecati porro praesentium, sed sunt veritatis voluptate. Accusantium, deserunt eius, eum fuga id laboriosam minima minus nesciunt quas qui quibusdam quos. Asperiores commodi corporis doloribus eveniet, excepturi id illo impedit laborum magni mollitia necessitatibus nemo perspiciatis porro quasi quo reprehenderit suscipit tempora totam veniam voluptatibus? Aliquam dolorem eius expedita iusto libero magnam nobis, placeat qui rem sed voluptates voluptatum! Aperiam assumenda dolore ducimus eaque eos eum excepturi exercitationem in, laboriosam laborum nisi obcaecati possimus ratione recusandae reprehenderit sapiente sit tempora! Commodi, cumque dolores doloribus est fugiat itaque modi molestiae nulla odio placeat quas saepe veniam?
			</div>
			<strong>
				<div v-if="isEditable" class="form-group mb-0 mr-2 on-of-switcher">
					<span class="switch switch-sm">
						<input id="events_switch14" type="checkbox" checked="checked" class="switch" @change="disableElements">
						<label for="events_switch14" class="m-0"></label>
					</span>
				</div>
				<div v-if="isEditable" class="handle"></div>
				<p>Réserve ton entrevue dès maintenant!</p>
				<p>*** Prenez note que toutes les plages horaires des 20-21-22 mars sont maintenant comblées. Toutefois, il reste encore des places disponibles pour les 27-28-29 mars.</p>
			</strong>
		</Draggable>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		components: {
			VCalendar: () => import('v-calendar/lib/components/calendar.umd'),
			Draggable: () => import('vuedraggable'),
		},
		
		data() {
			return {
				isEditable: true,
				form: null,
				timeFormat: this.$store.state.auth.user ? this.$store.state.auth.user.timeFormat : '12H',
				selectedLocalityTime: null,
				localitySelectSelectedOption: (this.$store.state.auth.user ? this.$store.state.auth.user.locality : this.$store.state.detectedLocality),
				localitySelectOptions: [],
				localitySelectCancel: null,
				localityTimeInterval: null,
				calendarCurrentDate: null,
				calendarCurrentMonthFirstDate: null,
				calendarCurrentMonthLastDate: null,
				calendarSelectedDate: null,
				availableDates: [],
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
				'detectedLocality',
				'bookingPage',
				'bookingType',
				'timeFormats',
			]),

			calendarMasks() {
				return { weekdays: 'WWW' };
			},

			calendarAttributes() {
				return [
					{
						key: 'just-force-to-update-attributes',

						dates: {
							weekdays: [1, 2, 3, 4, 5, 6, 7],
						},
					},

					...(this.calendarCurrentDate ? [{
						dot: 'red',
						dates: this.calendarCurrentDate,
					}] : []),

					{
						highlight: {
							color: 'blue',
							fillMode: 'light',
						},

						dates: this.availableDates.map((availableDate) => {
							return new Date(availableDate.value);
						}),
					},

					{
						highlight: {
							color: 'blue',
							fillMode: 'solid',
						},

						dates: this.calendarSelectedDate,
					},
				];
			},

			selectedAvailableDateSpots() {
				let selectedAvailableDate = this.availableDates.find((availableDate) => {
					return availableDate.value === this.$moment(this.calendarSelectedDate).format('YYYY-MM-DD');
				});

				if (!selectedAvailableDate) {
					return [];
				}

				return selectedAvailableDate.spots;
			},
		},
		
		mounted() {},

		methods: {
			switchEditMode: function (event) {
				this.isEditable = event.target.checked;
			},
			disableElements: function (event) {
				console.log(event);
				event.target.parentElement.parentElement.parentElement.classList.toggle('isDisabled');
			},
		},
	};
</script>

<style lang="scss" scoped>
    .isDisabled {
        opacity: .2;
    }
    .editable-switcher {
        position: absolute;
        right: 0;
        top: 0;
    }
    .left-bordered-title {
        padding-left: 10px;
        border-left: 4px solid var(--primary);
    }
    .draggable-wrap {
        .on-of-switcher {
            position: absolute;
            left: -90px;
            top: 50%;
            transform: translateY(-50%) scale(.8);
            font-size: 0;
        }
        & > * {
            display: block;
            padding-left: 20px;
            position: relative;
            border: 1px solid transparent;
            border-radius: 3px;
            &:hover {
                border-color: var(--secondary);
            }
            &:before {
                content: "";
                position: absolute;
                top: 0;
                bottom: 0;
                left: 0;
                width: 10px;
                background: var(--secondary);
                border-radius: 3px;
            }
            & > .handle {
                position: absolute;
                top: 50%;
                left: -30px;
                width: 20px;
                height: 20px;
                transform: translateY(-50%);
                background: url('/img/drag.svg') 50% 50%/cover no-repeat;
                cursor: grab;
                opacity: .3;
                &:active {
                    cursor: grabbing;
                }
            }

        }
    }
    .booking-types-wrap {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .video-container {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        height: 0;
    }
    .video-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>

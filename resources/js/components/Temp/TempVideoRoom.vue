<template>
	<div class="row flex-column m-0 h-100 flex-nowrap overflow-hidden">
		<div class="navbar navbar-white bg-white">
			<div class="container-fluid p-0">
				<div class="row align-items-center m-0">
					<a class="navbar-brand mr-4" href="index.html">
						<img src="/img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
					</a>
					<div class="dropdown">
						<button id="dropdownMenuButton" class="btn btn-simple dropdown-toggle pl-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<h5 class="d-inline">
								My bookify
							</h5>
						</button>
						<div class="dropdown-menu admin_main__my-book" style="min-width: 20em;" aria-labelledby="dropdownMenuButton">
							<div class="col-md-12 mb-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span id="inputGroupPrepend2" class="input-group-text">Filter</span>
									</div>
									<input id="validationDefaultUsername" type="text" class="form-control" aria-describedby="inputGroupPrepend2" required="">
								</div>
								<p>
									Work together with a Book organization
								</p>
								<p>
									When you add users to your Book organization you can create Team Pages, Team Event Types, and much more.
								</p>
								<p>
									<a href="#">Visit your Users page to learn more</a>
								</p>
								<p>
									<a href="#">Add Users</a>
								</p>
								<small><strong class="text-secondary">Primary</strong></small>
								<div class="col-lg-12 mt-2">
									<div class="row align-items-center">
										<div class="circle rounded-circle bg-secondary text-white text-center mr-2" style="width: 20px;height: 20px;line-height: 20px;">
											R
										</div>
										<span><small>My Book</small></span>
									</div>
								</div>
								<div class="col-lg-12 mt-2">
									<div class="row align-items-center">
										<div class="circle rounded-circle bg-secondary text-white text-center mr-2" style="width: 20px;height: 20px;line-height: 20px;"></div>
										<span><small>All Users &amp; Teams</small></span>
									</div>
								</div>
								<div class="col-lg-12 mt-4">
									<div class="row justify-content-between align-items-center">
										<small><strong class="text-secondary">Users</strong></small>
										<a href="#"><strong><small>+ NEW USER</small></strong></a>
									</div>
								</div>
								<div class="col-lg-12 mt-2">
									<div class="row align-items-center">
										<div class="circle rounded-circle bg-secondary text-white text-center mr-2" style="width: 20px;height: 20px;line-height: 20px;"></div>
										<span><small>All Users</small></span>
									</div>
								</div>
								<div class="col-lg-12 mt-4">
									<div class="row justify-content-between align-items-center">
										<small><strong class="text-secondary">Teams</strong></small>
										<a href="new_team.html"><strong><small>+ NEW TEAM</small></strong></a>
									</div>
								</div>
								<div class="col-lg-12 mt-2">
									<div class="row align-items-center">
										<div class="circle rounded-circle bg-secondary text-white text-center mr-2" style="width: 20px;height: 20px;line-height: 20px;"></div>
										<span><small>All Teams</small></span>
									</div>
								</div>
								<div class="col-lg-12 mt-2">
									<div class="row align-items-center">
										<div class="circle rounded-circle bg-secondary text-white text-center mr-2" style="width: 20px;height: 20px;line-height: 20px;">
											A
										</div>
										<span><small>Adasd</small></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row align-items-center m-0">
					<button class="btn btn-outline-link pt-2 outline-none p-1 mr-3" style="box-shadow: none;" data-toggle="modal" data-target="#settings_video">
						<img src="/img/settings_video.svg" width="23px" alt="">
					</button>
					<button class="btn btn-outline-link pt-2 outline-none p-1 mr-3 participant_opener" style="box-shadow: none;" @click="openParticipants">
						<img src="/img/audience.svg" width="28px" alt="">
					</button>
					<button class="btn btn-outline-link outline-none p-1 chat_opener" style="box-shadow: none;" @click="openChat">
						<img src="/img/chat.svg" width="21px" alt="">
					</button>
					<button class="btn btn-primary ml-4" data-toggle="modal" data-target="#invite_modal">
						Invite
					</button>
				</div>
				<nav class="navbar navbar-expand-lg navbar-white bg-white">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div id="navbarNavDropdown" class="collapse navbar-collapse">
						<ul class="navbar-nav align-items-center">
							<li class="nav-item dropdown dropleft">
								<a id="navbarDropdown" class="nav-link pr-0 d-flex align-items-center justify-content-end" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i style="font-size: 0;">
										<img width="35" src="/img/user_icon.svg" alt="">
									</i>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown">
									<a class="dropdown-item d-flex align-items-center" href="admin.html">
										Dashboard
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item d-flex align-items-center" href="users.html">
										Users
									</a>
									<!-- <a class="dropdown-item d-flex align-items-center" href="salesforce.html">

                                        Integrations
                                    </a> -->
									<a class="dropdown-item d-flex align-items-center" href="calendar_connections.html">
										Calendar Connections
									</a>
									<a class="dropdown-item d-flex align-items-center" data-toggle="modal" data-target="#exampleModalShare" href="#">
										Share your Link
									</a>
									<!-- <a class="dropdown-item d-flex align-items-center" href="apps.html">

                                        Apps
                                    </a> -->
									<a class="dropdown-item d-flex align-items-center" href="billing.html">
										Billing
									</a>
									<a class="dropdown-item d-flex align-items-center" href="settings.html">
										Account Settings
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item d-flex align-items-center" href="index.html">
										Logout
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<!-- Modal -->
		<div id="exampleModalShare" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalShareLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalShareLabel" class="modal-title">
							Share Your Link
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="#">
							<label for="basic-url">Copy Your Link</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button id="basic-addon3" type="button" class="btn btn-primary bg-primary input-group-text">
										<img width="15" src="/img/link.svg" alt="">
									</button>
								</div>
								<input id="basic-url" type="text" value="book.com/yimoc66017" class="form-control" aria-describedby="basic-addon3">
							</div>
							<label for="basic-url">Email Your Link</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button id="basic-addon3" type="button" class="btn btn-primary bg-primary input-group-text">
										<img width="20" src="/img/envelope.svg" alt="">
									</button>
								</div>
								<input id="basic-url" value="book.com/yimoc66017" type="text" class="form-control" aria-describedby="basic-addon3">
							</div>
							<label for="basic-url">Add to Your Website</label>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<button id="basic-addon3" type="button" class="btn btn-primary bg-primary input-group-text">
										<img width="15" src="/img/html-coding.svg" alt="">
									</button>
								</div>
								<input id="basic-url" value="book.com/yimoc66017" type="text" class="form-control" aria-describedby="basic-addon3">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="help_form d-flex flex-column align-items-end">
			<div id="collapseMain" class="help_form__main js-help_form__main bg-dark rounded collapse">
				<div class="help_form__title js-help_form__title col-lg-12 p-4 bg-secondary">
					<h6 class="text-white">
						Getting Started Guide
					</h6>
					<div class="progress mt-3">
						<div class="progress-bar bg-success progress-bar-animated" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="help_form__body js-help_form__body col-lg-12 p-4" style="height: 0px;">
					<div id="accordion">
						<div class="help_form__toggler pt-2 pb-2" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">1</span>
									<strong class="text-white">Connect your Calendar</strong>
								</div>
							</div>
						</div>
						<div id="collapseOne" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne" data-parent="#accordion">
							<small>
								Bookify can check Google calendar, Office 365, Outlook or iCloud for conflicts and add new events to your calendar so you're never double booked.
							</small>
							<button class="js-help_form__connect btn btn-primary btn-block mt-2" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Connect Calendar
							</button>
						</div>
						<div class="help_form__toggler pt-2 pb-2 border-top" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">2</span>
									<strong class="text-white">Customize an Event Type</strong>
								</div>
							</div>
						</div>
						<div id="collapseTwo" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne" data-parent="#accordion">
							<small class="mb-2">
								Make sure invitees attend by adding reminder notifications.
							</small>
							<small>Not sure how? Learn more <a href="#">here</a>.</small>
						</div>

						<div class="help_form__toggler pt-2 pb-2 border-top" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">3</span>
									<strong class="text-white">Check your Availability</strong>
								</div>
							</div>
						</div>
						<div id="collapseThree" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne" data-parent="#accordion">
							<small class="mb-2">
								Make sure invitees attend by adding reminder notifications.
							</small>
							<small>Not sure how? Learn more <a href="#">here</a>.</small>
						</div>
					</div>
				</div>
			</div>
			<div class="help_form__button btn btn-dark btn-sm mt-2" data-toggle="collapse" data-target="#collapseMain" aria-expanded="true" aria-controls="collapseMain">
				Getting Started Guide
				<span class="badge badge-danger ml-2">2</span>
			</div>
		</div>
		<div id="invite_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Invite Users
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<strong class="d-block mb-2">Invite Via Link</strong>
						<div class="input-group mb-3">
							<input type="text" class="form-control" value="video.com/5464665465" readonly="">
							<div class="input-group-append">
								<button id="button-addon2" class="btn btn-outline-secondary" type="button">
									Copy
								</button>
							</div>
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1"><strong>Invite Via Email</strong></label>
							<input id="exampleInputEmail1" type="email" class="form-control" aria-describedby="emailHelp">
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
		<div class="container-fluid" style="height: calc(100% - 65px);">
			<div class="row h-100 position-relative">
				<div ref="chat" class="col-4 col-md-2 border-right h-100 position-absolute chat" :class="{ opened: chatOpened }">
					<div class="row m-0 flex-column flex-nowrap h-100">
						<div class="col-12" style="flex: 1 0 auto; ">
							<div class="row"></div>
						</div>
						<div class="col-12 p-0" style="flex: none;">
							<div class="row flex-nowrap">
								<div class="form-group m-0">
									<textarea class="form-control rounded-0 border-left-0 border-right-0 border-bottom-0" placeholder="Type Your Message Here"></textarea>
								</div>
								<button class="btn btn-outline-secondary rounded-0 border-right-0 border-bottom-0">
									Send
								</button>
							</div>
						</div>
					</div>
				</div>
				<div ref="videosWrap" class="col-12 pb-4 h-100 overflow-auto videos_wrap" :style="{ 'padding-right': participantsWidth + 'px', 'padding-left': chatWidth + 'px' }" :class="{ 'participants-opened': participantsOpened, 'chat-opened': chatOpened }" style="padding-left: 15px; padding-right: 15px;">
					<div class="row m-0 flex-column flex-nowrap h-100">
						<div class="col-lg-12 px-0 py-3" style="flex: none;">
							<div class="col-lg-12 p-0">
								<div id="sortable" class="row px-2 ui-sortable">
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="dialog-item p-1 ui-sortable-handle">
										<div class="position-relative">
											<img src="/img/webcam.png" width="100%" alt="">
											<div class="col-lg-12 fixed-bottom position-absolute p-3">
												<div class="row m-0 justify-content-end">
													<button class="btn btn-primary btn-sm">
														Fullscreen
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12" style="flex: 1 0 auto; ">
							<div class="row"></div>
						</div>
					</div>
				</div>
				<div ref="participants" class="col-4 col-md-2 border-left position-absolute participants" :class="{ opened: participantsOpened }">
					<div class="row justify-content-center align-items-center p-3 border-bottom">
						<strong>2 Participants</strong>
					</div>
					<div class="row flex-column">
						<div class="col-12">
							<div class="row m-0 justify-content-between align-items-center">
								<div class="py-2 text-center">
									<div class="row m-0 align-items-center">
										<span class="mr-2">
											<img src="/img/germany.svg" width="20" alt="">
										</span>
										<img src="/img/user.svg" width="20" alt="">
										<span class="ml-2">Mark</span>
									</div>
								</div>
								<div class="dropdown">
									<button id="dropdownMenuButton" class="btn btn-link p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<img src="/img/drop.svg" width="20" alt="">
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Profile</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Add to Contacts</a>
										<a class="dropdown-item" href="#">Mute</a>
										<a class="dropdown-item" href="#">Remove</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="row m-0 justify-content-between align-items-center">
								<div class="py-2 text-center">
									<div class="row m-0 align-items-center">
										<span class="mr-2">
											<img src="/img/germany.svg" width="20" alt="">
										</span>
										<img src="/img/user.svg" width="20" alt="">
										<span class="ml-2">Ruslan</span>
									</div>
								</div>
								<div class="dropdown">
									<button id="dropdownMenuButton" class="btn btn-link p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<img src="/img/drop.svg" width="20" alt="">
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#">Profile</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Add to Contacts</a>
										<a class="dropdown-item" href="#">Mute</a>
										<a class="dropdown-item" href="#">Remove</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="settings_video" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header pb-0">
						<ul id="myTab" class="nav nav-tabs border-0" role="tablist">
							<li class="nav-item">
								<a id="audio-tab" class="nav-link active" data-toggle="tab" href="#audio" role="tab" aria-controls="audio" aria-selected="true">Audio</a>
							</li>
							<li class="nav-item">
								<a id="video-tab" class="nav-link" data-toggle="tab" href="#video" role="tab" aria-controls="video" aria-selected="false">Video</a>
							</li>
						</ul>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div id="myTabContent" class="tab-content">
							<div id="audio" class="tab-pane fade show active" role="tabpanel" aria-labelledby="audio-tab">
								<div class="col-lg-12">
									<div class="row mb-3">
										<div class="col-lg-8 pl-0">
											<div class="form-group mb-0">
												<label for="micro">Microphone</label>
												<select id="micro" class="form-control">
													<option>
														Microphone (Realtek(R) Audio)
													</option>
													<option>
														Microphone (Realtek(R) Audio)
													</option>
													<option>
														Microphone (Realtek(R) Audio)
													</option>
													<option>
														Microphone (Realtek(R) Audio)
													</option>
													<option>
														Microphone (Realtek(R) Audio)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 pr-0">
											<button class="btn btn-primary btn-sm h-100 btn-block" disabled="">
												Microphone is off
											</button>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-8 pl-0">
											<div class="form-group mb-0">
												<label for="speakers">Speakers</label>
												<select id="speakers" class="form-control">
													<option>
														Speakers (Realtek(R) Audio)
													</option>
													<option>
														Speakers (Realtek(R) Audio)
													</option>
													<option>
														Speakers (Realtek(R) Audio)
													</option>
													<option>
														Speakers (Realtek(R) Audio)
													</option>
													<option>
														Speakers (Realtek(R) Audio)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 pr-0">
											<button class="btn btn-primary btn-sm h-100 btn-block">
												Test
											</button>
										</div>
									</div>
								</div>
							</div>
							<div id="video" class="tab-pane fade" role="tabpanel" aria-labelledby="video-tab">
								<div class="col-lg-12">
									<div class="row mb-3">
										<div class="col-lg-8 pl-0">
											<div class="form-group mb-0">
												<label for="camera">Camera</label>
												<select id="camera" class="form-control">
													<option>
														USB 2.0 HD UVC WebCam (1as1d21ad21)
													</option>
													<option>
														USB 2.0 HD UVC WebCam (1as1d21ad21)
													</option>
													<option>
														USB 2.0 HD UVC WebCam (1as1d21ad21)
													</option>
													<option>
														USB 2.0 HD UVC WebCam (1as1d21ad21)
													</option>
													<option>
														USB 2.0 HD UVC WebCam (1as1d21ad21)
													</option>
												</select>
											</div>
										</div>
										<div class="col-lg-4 pr-0">
											<img src="img/webcam.png" width="100%" height="100%" alt="">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-lg-12 p-0">
											<div class="form-group mb-0">
												<label for="sound_res">Sound Resolution (maximum)</label>
												<select id="sound_res" class="form-control">
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
												</select>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 p-0">
											<div class="form-group mb-0">
												<label for="recieve_res">Recieve Resolution (maximum)</label>
												<select id="recieve_res" class="form-control">
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
													<option>
														High Definition (720p)
													</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">
							Done
						</button>
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
				chatOpened: false,
				participantsOpened: false,
				participantsWidth: 15,
				chatWidth: 15,
			};
		},

		mounted() {
			console.log('TempVideoRoom mounted!');
		},

		methods: {
			openParticipants: function () {
				this.participantsOpened = !this.participantsOpened;

				if (this.participantsOpened) {
					this.participantsWidth = this.$refs.participants.offsetWidth + 15;
				} else {
					this.participantsWidth = 15;
				}
			},
			openChat: function () {
				this.chatOpened = !this.chatOpened;

				if (this.chatOpened) {
					this.chatWidth = this.$refs.chat.offsetWidth + 15;
				} else {
					this.chatWidth = 15;
				}
			},
		},
	};
</script>

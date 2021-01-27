<template>
	<div class="d-flex flex-column flex-nowrap overflow-hidden" style="height: 100vh;">
		<div class="navbar navbar-light bg-white admin_main" style="height: 60px;">
			<div class="container">
				<div class="d-flex align-items-center">
					<a class="navbar-brand mr-2 btn btn-link">
						<img src="/img/logo.svg" alt="" width="35">
					</a>
					<button class="btn btn-link mr-2">
						<img src="/img/menu.svg" alt="" width="20" style="opacity: .3;">
					</button>
					<div class="d-flex align-items-center ml-3">
						<span style="font-size: 0;">
							<img src="/img/placeholder_logo.png" alt="" height="20">
						</span>
						<span class="ml-2">
							Some Name of Some Company
						</span>
						<span class="ml-2" style="font-size: 0;" data-toggle="tooltip" data-placement="bottom"
							title="Tooltip on Bottom">
							<img src="/img/info.svg" alt="" width="15">
						</span>
					</div>
				</div>
				<div class="d-flex align-items-center">
					<div class="d-flex align-items-center mr-3">
						<img src="/img/techstars.png" alt="" height="30">
						<span class="ml-2">Techstars</span>
					</div>
					<button class="btn btn-success mr-3">
						Follow
					</button>
					<button class="btn btn-link text-secondary d-flex align-items-center mr-3">
						<img src="/img/share.svg" alt="" style="opacity: .6;" width="15">
						<span class="ml-2">Share</span>
					</button>
					<div class="dropdown">
						<button id="dropdownMenuButton" type="button"
							class="btn btn-link text-secondary d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="/img/more.svg" alt="" style="opacity: .6;" height="15">
							<span class="ml-2">Options</span>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="height: calc(100vh - 60px);">
			<div class="col-9 pr-0 h-100">
				<div class="d-flex h-100 flex-column flex-nowrap">
					<div class="h-100" style="height: calc(100% - 50px);">
						<iframe src="https://www.youtube.com/embed/NKDM0JPoAyY" width="100%" height="100%"
							frameborder="0"
							allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
							allowfullscreen></iframe>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-dark px-4 py-2 w-100"
						style="height: 50px;">
						<div class="d-flex align-items-center">
							<button class="btn btn-outline-clip d-flex align-items-center mr-2">
								<img src="/img/video-clip.svg" alt="" width="20">
								<span class="ml-2 text-white">Clip Moment</span>
							</button>
							<span class="text-light">REPLAY</span>
						</div>
						<div class="d-flex align-items-center">
							<div class="dropdown mr-4 dropleft">
								<button id="dropdownMenuButton" type="button"
									class="btn btn-outline-clip d-flex align-items-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="text-white mr-2">Ask Question</span>
									<span class="badge badge-light">5</span>
								</button>
								<div class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton"
									style="width: 400px; height: 400px;">
									<div
										class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
										<h6 class="mb-0">
											Questions & Answers
										</h6>
										<button type="button" class="btn btn-link p-2">
											<h3 class="mb-0 text-dark" style="line-height: 1;">
												&times;
											</h3>
										</button>
									</div>
									<ul id="answerTabs" class="nav nav-pills justify-content-center py-2"
										role="tablist">
										<li class="nav-item">
											<a id="topAnswers-tab" class="nav-link active" href="#topAnswers"
												data-toggle="tab" role="tab" aria-controls="topAnswers"
												aria-selected="true">Top(11)</a>
										</li>
										<li class="nav-item">
											<a id="answeredAnswers-tab" class="nav-link" href="#answeredAnswers"
												data-toggle="tab" role="tab" aria-controls="answeredAnswers"
												aria-selected="false">Answered</a>
										</li>
									</ul>
									<div id="myTabContent" class="tab-content py-3" style="height: calc(100% - 109px);">
										<div id="topAnswers" class="tab-pane fade px-3 show active h-100  overflow-auto"
											role="tabpanel" aria-labelledby="topAnswers-tab">
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
										</div>
										<div id="answeredAnswers"
											class="tab-pane fade px-3 show active h-100  overflow-auto" role="tabpanel"
											aria-labelledby="answeredAnswers-tab">
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
											<div class="row border-bottom py-2">
												<div class="col-3">
													<div
														class="d-flex flex-column align-items-center justify-content-center">
														<span>^</span>
														<span>8</span>
														<span>VOTES</span>
													</div>
												</div>
												<div class="col-9 pl-0">
													<small class="text-secondary mb-2 d-block">40m 38s</small>
													<div>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam commodi cupiditate delectus dolor dolores, eaque eius harum modi possimus vero?
													</div>
													<div class="d-flex align-items-center py-2">
														<button class="btn btn-primary mr-2">
															View Answer
														</button>
														<button class="btn btn-outline-primary">
															Share Answer
														</button>
													</div>
													<div class="d-flex align-items-center">
														<span class="mr-2"
															style="font-size: 0px; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
															<img src="/img/avatar.png" alt=""
																style="width: 100%; height: 100%; object-fit: cover;">
														</span>
														<span>Name</span>
													</div>
													<button class="btn btn-link text-dark mt-2">
														COMMENT
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex align-items-center">
								<span class="text-white mr-2">People</span>
								<div class="d-flex align-items-center">
									<span
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
									<span class="ml-n2"
										style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
										<img src="/img/avatar.png" alt=""
											style="width: 100%; height: 100%; object-fit: cover;">
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-3 pl-0 h-100">
				<div class="d-flex h-100 flex-column flex-nowrap">
					<div class="bg-dark py-2 overflow-auto h-100" style="max-height: calc( 100% - 50px );">
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex flex-row-reverse px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="mr-2">
								<div class="text-secondary text-right d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
						<div class="d-flex px-4 py-2">
							<span
								style="font-size: 0; width: 20px; height: 20px; overflow: hidden; border-radius: 50%;">
								<img src="/img/avatar.png" alt="" style="width: 100%; height: 100%; object-fit: cover;">
							</span>
							<div class="ml-2">
								<div class="text-secondary d-block mb-2">
									Some Name
								</div>
								<div class="bg-white rounded text-dark p-2">
									Lorem ipsum dolor sit.
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center bg-dark px-4 py-2 w-100"
						style="height: 50px;">
						<div class="input-group rounded bg-white h-100">
							<div class="input-group-prepend h-100">
								<button id="button-addon2"
									type="button"
									class="btn btn-outline-secondary border-left-0 border-top-0 border-bottom-0 h-100">
									+
								</button>
							</div>
							<input type="text" class="form-control h-100" placeholder="Say something nice"
								aria-label="Say something nice" aria-describedby="button-addon2">
							<div class="input-group-append h-100">
								<button id="button-addon2"
									type="button"
									class="btn btn-outline-secondary h-100 border-right-0 border-top-0 border-bottom-0">
									<img src="/img/smile.svg" alt="" width="15" style="opacity: .3;">
								</button>
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
		data() {
			return {
				//
			};
		},
		
		mounted() {
			$('[data-toggle="tooltip"]').tooltip();
		},
		
		methods: {
			//
		},
	};
</script>

<style lang="scss" scoped>
	.btn-outline-clip {
		border: 1px solid #fff;
	}
	
	.navbar-brand:hover img {
		animation: animation 1s ease forwards;
	}
	
	/*  ______keyframes_____  */
	
	@keyframes animation {
		0% {
			transform: scale(1);
		}
		30% {
			transform: scale(1.2);
		}
		40% {
			transform: scale(.8);
		}
		50% {
			transform: scale(1.1);
		}
		60% {
			transform: scale(.9);
		}
		70% {
			transform: scale(1);
		}
		100% {
			transform: scale(1);
		}
	}
</style>

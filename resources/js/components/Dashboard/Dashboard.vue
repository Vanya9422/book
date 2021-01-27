<template>
	<div class="[ dashboard ]">
		<div class="navbar navbar-light bg-white admin_main">
			<div class="container flex-md-row flex-column">
				<router-link class="navbar-brand mr-2 btn btn-link" :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" alt="" class="d-inline-block align-top" width="35" height="35">
				</router-link>
				<div class="col p-0">
					<div class="d-flex justify-content-between align-items-center">
						<div class="d-flex align-items-center flex-wrap">
							<router-link v-if="false" class="btn btn-link text-decoration-none mr-2" role="tab"
								:to="{ name: 'dashboard.stats' }">
								Stats
							</router-link>
							<router-link class="btn btn-link text-decoration-none mr-2" role="tab"
								:to="{ name: 'dashboard.home' }" exact>
								Booking Types
							</router-link>
							<router-link class="btn btn-link text-decoration-none mr-2" role="tab"
								:to="{ name: 'dashboard.scheduled.upcoming' }">
								3 Scheduled
							</router-link>
						</div>
						<nav class="navbar navbar-expand-lg navbar-light bg-white p-0 dropleft">
							<a id="navbarDropdown" class="btn btn-link p-1 d-flex align-items-center" href="#"
								role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i style="font-size: 0;">
									<img alt="" :src="auth.user.avatar.url"
										style="width: 35px; height: 35px; border-radius: 50%;">
								</i>
							</a>
							<div class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
								<router-link class="dropdown-item d-flex align-items-center"
									:to="{ name: 'dashboard.home' }" exact>
									Dashboard
								</router-link>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item d-flex align-items-center disabled" href="users.html">Users</a>
								<router-link class="dropdown-item d-flex align-items-center disabled"
									:to="{ name: 'dashboard.calendar_connections' }">
									Calendar Connections
								</router-link>
								<a class="dropdown-item d-flex align-items-center disabled" href="#"
									data-toggle="modal" data-target="#exampleModalShare">Share your link</a>
								<router-link class="dropdown-item d-flex align-items-center"
									:to="{ name: 'dashboard.billing.overview' }">
									Billing
								</router-link>
								<router-link class="dropdown-item d-flex align-items-center"
									:to="{ name: 'dashboard.settings.profile' }">
									Account Settings
								</router-link>
								<!--                                    <a class="dropdown-item d-flex align-items-center disabled" href="apps.html">Apps</a>-->
								<div class="dropdown-divider"></div>
								<a class="dropdown-item d-flex align-items-center" href="#"
									@click.prevent="logout">Logout</a>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<router-view />
		<div class="help_form d-flex flex-column align-items-end">
			<div id="collapseMain" class="help_form__main js-help_form__main bg-dark rounded collapse">
				<div class="help_form__title js-help_form__title col-lg-12 p-4 bg-secondary">
					<h6 class="text-white">
						Getting Started Guide
					</h6>
					<div class="progress mt-3">
						<div class="progress-bar bg-success progress-bar-animated" role="progressbar" style="width: 25%"
							aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="help_form__body js-help_form__body col-lg-12 p-4">
					<div id="accordion">
						<div class="help_form__toggler pt-2 pb-2" data-toggle="collapse" data-target="#collapseOne"
							aria-expanded="true" aria-controls="collapseOne">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">1</span>
									<strong class="text-white">Connect your Calendar</strong>
								</div>
							</div>
						</div>
						<div id="collapseOne" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne"
							data-parent="#accordion">
							<small>
								Bookify can check Google calendar, Office 365, Outlook or iCloud for
								conflicts and add new bookings to your calendar so you're never double booked.
							</small>
							<button class="js-help_form__connect btn btn-primary btn-block mt-2" data-toggle="collapse"
								data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Connect Calendar
							</button>
						</div>
						<div class="help_form__toggler pt-2 pb-2 border-top" data-toggle="collapse"
							data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">2</span>
									<strong class="text-white">Customize an Booking Type</strong>
								</div>
							</div>
						</div>
						<div id="collapseTwo" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne"
							data-parent="#accordion">
							<small class="mb-2">
								Make sure invitees attend by adding reminder notifications.
							</small>
							<small>Not sure how? Learn more <a href="#">here</a>.</small>
						</div>
						<div class="help_form__toggler pt-2 pb-2 border-top" data-toggle="collapse"
							data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
							<div class="col-lg-12">
								<div class="row align-items-center">
									<span class="badge badge-success mr-2">3</span>
									<strong class="text-white">Check your Availability</strong>
								</div>
							</div>
						</div>
						<div id="collapseThree" class="collapse pl-4 pb-3 text-white mt-2" aria-labelledby="headingOne"
							data-parent="#accordion">
							<small class="mb-2">
								Make sure invitees attend by adding reminder notifications.
							</small>
							<small>Not sure how? Learn more <a href="#">here</a>.</small>
						</div>
					</div>
				</div>
			</div>
			<div class="help_form__button btn btn-dark btn-sm mt-2" data-toggle="collapse" data-target="#collapseMain"
				aria-expanded="true" aria-controls="collapseMain">
				Getting Started Guide
				<span class="badge badge-danger ml-2">2</span>
			</div>
		</div>
		<div id="upgrade" ref="update_modal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header flex-column align-items-center">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
						<h5 id="exampleModalLabel" class="modal-title d-block">
							See User Pricing
						</h5> <span
							class="d-block text-center"><small>You are enjoying a trial with access to all features</small></span>
					</div>
					<div class="modal-body">
						<div class="card no-hover-effect mb-4">
							<div class="card-header">
								<div class="row align-items-center">
									<div class="col-2">
										<div class="form-group">
											<label for="users_count">How many users?</label>
											<input id="users_count" v-model.number="customValue" type="number"
												class="form-control form-control-lg" @change="fromCustomValue">
										</div>
									</div>
									<div v-if="rangeSliderIsShown" class="col">
										<VueSlideBar v-model="slider.value" :min="1" :max="sliderMax"
											:range="slider.range" :process-style="slider.processStyle"
											:line-height="slider.lineHeight" @input="updatePrice">
											<template slot="tooltip">
												<span class="vue-slide-bar-tooltip"
													:style="{ backgroundColor: '#1066fd', borderColor: '#1066fd' }">
													{{ customValue }}
												</span>
											</template>
										</VueSlideBar>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-3">
										<h6 class="mb-3">
											<span v-if="!planType">MONTHLY</span><span
												v-else>YEARLY</span> PRICING SUMMARY
										</h6>
										<div class="d-flex align-items-end mb-2 flex-wrap">
											<h3 id="final_price" class="mb-0">
												{{ price }}
											</h3><span v-if="planType" id="plan_type">/year.</span><span
												v-else id="plan_type">/mo.</span>
											<small v-if="planType" class=" d-block w-100"><strong
												class="text-success">You save {{ annualDiscount }}</strong></small>
										</div>
										<small class="d-block">Flat rate</small>
										<small class="d-flex align-items-center">For
											<div v-if="infoState === 1" class="mx-1">1 - 10</div>
											<div v-else-if="infoState === 2" class="mx-1">11 - 100</div>
											<div v-else-if="infoState === 3" class="mx-1">101 - 1000</div>
											<div v-else-if="infoState === 4" class="mx-1">{{ slider.value }}</div>
											users</small>
									</div>
									<div class="col">
										<div class="d-flex align-items-center mb-3">
											<label class="mb-0 mr-2" for="monthly_annual">Monthly</label>
											<span class="switch switch-sm">
												<input id="monthly_annual" v-model="planType" type="checkbox"
													class="switch" value="true" checked="checked" @change="updatePrice">
												<label class="m-0" for="monthly_annual">Annual</label>
											</span>
											<!--                                            <div class="custom-control custom-switch pl-0">-->
											<!--                                                <label class="mr-5 mb-0" for="monthly_annual">Monthly</label>-->
											<!--                                                <input type="checkbox" @change="updatePrice" v-model="planType" value="true" class="custom-control-input" id="monthly_annual">-->
											<!--                                                <label class="custom-control-label" for="monthly_annual">Annual</label>-->
											<!--                                            </div>-->
											<strong class="ml-3"
												:class="{ 'text-success' : planType }">Discount: 20%</strong>
										</div>
										<div id="calculator_info" class="card card-body p-3 no-hover-effect">
											<div v-if="infoState === 1">
												<span
													class="d-block">Pay a monthly flat rate of $5 for up to 10 users. </span><span
													class="d-block">Teams of 11+ are $4 per user/month.</span>
											</div>
											<div v-else-if="infoState === 2">
												<span
													class="d-block">Pay a monthly flat rate of $4 for up to 100 users. </span>
											</div>
											<div v-else-if="infoState === 3">
												<span
													class="d-block">Pay a monthly flat rate of $3 for up to 1000 users. </span>
											</div>
											<div v-else-if="infoState === 4">
												<span
													class="d-block">Pay a monthly flat rate of $2 for up to 1000+ users. </span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
							data-target="#for_develop1">
							Compare Features
						</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
							data-target="#upgrade2">
							Continue to Pay
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div id="upgrade2" class="modal fade" style="overflow-y: scroll;" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div id="coupon_code_collapse" class="collapse pt-3 multi-collapse">
							<div class="form-group mb-0">
								<label for="coupon_code">Coupon Code</label>
								<div class="d-flex">
									<div class="col p-0">
										<input id="coupon_code" v-model="isCouponEnabled" type="text"
											class="form-control">
									</div>
									<button class="btn btn-primary ml-2">
										Apply Coupon
									</button>
									<button type="button" class="btn btn-secondary ml-2" data-toggle="collapse"
										data-target=".multi-collapse" aria-expanded="false"
										aria-controls="coupon_code_collapse coupon_code_collapse_button">
										Cancel
									</button>
								</div>
							</div>
							<hr>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-3">
							<h4 class="mb-0">
								<strong>Payment Details</strong>
							</h4>
							<div id="coupon_code_collapse_button" class="collapse show multi-collapse">
								<button type="button" class="btn btn-link" data-toggle="collapse"
									data-target=".multi-collapse" aria-expanded="false"
									aria-controls="coupon_code_collapse coupon_code_collapse_button">
									I have a Coupon Code
								</button>
							</div>
						</div>
						
						<form action="#">
							<div class="row">
								<div class="col-8">
									<div class="form-group">
										<label for="card_number">Card Number</label>
										<input id="card_number" type="text" class="form-control">
									</div>
								</div>
								<div class="col-4">
									<div class="form-group">
										<label for="zip_code">Postal/ZIP Code</label>
										<input id="zip_code" type="text" class="form-control">
									</div>
								</div>
								<div class="col-12 mb-2">
									<span>Expiration</span>
								</div>
								<div class="col-5">
									<select id="expiration_month" class="form-control">
										<option>
											Month
										</option>
										<option>
											Jan
										</option>
										<option>
											Fev
										</option>
										<option>
											Mart
										</option>
										<option>
											Apr
										</option>
										<option>
											May
										</option>
										<option>
											Jun
										</option>
										<option>
											Jul
										</option>
										<option>
											Avg
										</option>
										<option>
											Sep
										</option>
										<option>
											Nov
										</option>
										<option>
											Dec
										</option>
									</select>
								</div>
								<div class="col-5">
									<select id="expiration_year" class="form-control">
										<option>
											Year
										</option>
										<option value="">
											1909
										</option>
										<option value="">
											1910
										</option>
										<option value="">
											1911
										</option>
										<option value="">
											1912
										</option>
										<option value="">
											1913
										</option>
										<option value="">
											1914
										</option>
										<option value="">
											1915
										</option>
										<option value="">
											1916
										</option>
										<option value="">
											1917
										</option>
										<option value="">
											1918
										</option>
										<option value="">
											1919
										</option>
										<option value="">
											1920
										</option>
										<option value="">
											1921
										</option>
										<option value="">
											1922
										</option>
										<option value="">
											1923
										</option>
										<option value="">
											1924
										</option>
										<option value="">
											1925
										</option>
										<option value="">
											1926
										</option>
										<option value="">
											1927
										</option>
										<option value="">
											1928
										</option>
										<option value="">
											1929
										</option>
										<option value="">
											1930
										</option>
										<option value="">
											1931
										</option>
										<option value="">
											1932
										</option>
										<option value="">
											1933
										</option>
										<option value="">
											1934
										</option>
										<option value="">
											1935
										</option>
										<option value="">
											1936
										</option>
										<option value="">
											1937
										</option>
										<option value="">
											1938
										</option>
										<option value="">
											1939
										</option>
										<option value="">
											1940
										</option>
										<option value="">
											1941
										</option>
										<option value="">
											1942
										</option>
										<option value="">
											1943
										</option>
										<option value="">
											1944
										</option>
										<option value="">
											1945
										</option>
										<option value="">
											1946
										</option>
										<option value="">
											1947
										</option>
										<option value="">
											1948
										</option>
										<option value="">
											1949
										</option>
										<option value="">
											1950
										</option>
										<option value="">
											1951
										</option>
										<option value="">
											1952
										</option>
										<option value="">
											1953
										</option>
										<option value="">
											1954
										</option>
										<option value="">
											1955
										</option>
										<option value="">
											1956
										</option>
										<option value="">
											1957
										</option>
										<option value="">
											1958
										</option>
										<option value="">
											1959
										</option>
										<option value="">
											1960
										</option>
										<option value="">
											1961
										</option>
										<option value="">
											1962
										</option>
										<option value="">
											1963
										</option>
										<option value="">
											1964
										</option>
										<option value="">
											1965
										</option>
										<option value="">
											1966
										</option>
										<option value="">
											1967
										</option>
										<option value="">
											1968
										</option>
										<option value="">
											1969
										</option>
										<option value="">
											1970
										</option>
										<option value="">
											1971
										</option>
										<option value="">
											1972
										</option>
										<option value="">
											1973
										</option>
										<option value="">
											1974
										</option>
										<option value="">
											1975
										</option>
										<option value="">
											1976
										</option>
										<option value="">
											1977
										</option>
										<option value="">
											1978
										</option>
										<option value="">
											1979
										</option>
										<option value="">
											1980
										</option>
										<option value="">
											1981
										</option>
										<option value="">
											1982
										</option>
										<option value="">
											1983
										</option>
										<option value="">
											1984
										</option>
										<option value="">
											1985
										</option>
										<option value="">
											1986
										</option>
										<option value="">
											1987
										</option>
										<option value="">
											1988
										</option>
										<option value="">
											1989
										</option>
										<option value="">
											1990
										</option>
										<option value="">
											1991
										</option>
										<option value="">
											1992
										</option>
										<option value="">
											1993
										</option>
										<option value="">
											1994
										</option>
										<option value="">
											1995
										</option>
										<option value="">
											1996
										</option>
										<option value="">
											1997
										</option>
										<option value="">
											1998
										</option>
										<option value="">
											1999
										</option>
										<option value="">
											2000
										</option>
										<option value="">
											2001
										</option>
										<option value="">
											2002
										</option>
										<option value="">
											2003
										</option>
										<option value="">
											2004
										</option>
										<option value="">
											2005
										</option>
										<option value="">
											2006
										</option>
										<option value="">
											2007
										</option>
										<option value="">
											2008
										</option>
										<option value="">
											2009
										</option>
										<option value="">
											2010
										</option>
										<option value="">
											2011
										</option>
										<option value="">
											2012
										</option>
										<option value="">
											2013
										</option>
										<option value="">
											2014
										</option>
										<option value="">
											2015
										</option>
										<option value="">
											2016
										</option>
										<option value="">
											2017
										</option>
										<option value="">
											2018
										</option>
										<option value="">
											2019
										</option>
										<option value="">
											2020
										</option>
									</select>
								</div>
								<div class="col-2">
									<div class="form-group">
										<input id="cvc" type="text" class="form-control" placeholder="CVC">
									</div>
								</div>
							</div>
						</form>
						<div class="d-flex justify-content-between mt-4">
							<strong>Subtotal</strong>
							<strong>{{ fullPrice }}</strong>
						</div>
						<div v-if="planType" class="d-flex justify-content-between text-success">
							<strong>20% Yearly plan discount</strong>
							<strong>-{{ annualDiscount }}</strong>
						</div>
						<div v-if="isCouponEnabled" class="d-flex justify-content-between text-success">
							<strong>10% Coupon Discount</strong>
							<strong>-$24.00</strong>
						</div>
						<div class="d-flex justify-content-between mt-5">
							<div class="pr-5">
								<strong class="d-block mb-2">Total billed today</strong>
								<p class="mb-2 pr-5">
									All prices are in USD and all sales are final. You will be charged {{ price }} every year while this subsciption is active. Cancel any time.
								</p>
							</div>
							<strong>{{ price }}</strong>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal"
							data-target="#upgrade">
							Back
						</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal"
							data-target="#upgrade_success">
							Subscribe & Checkout
						</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div id="upgrade_success" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Success
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid consequuntur delectus dolorem excepturi explicabo id illum impedit minus nam neque, officiis, pariatur porro quis sint soluta temporibus ullam unde ut.
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="for_develop1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			style="display: none;" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header border-0">
						<h5 id="exampleModalLabel" class="modal-title  text-center w-100">
							Lorem ipsum dolor.
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-lg-12">
							<div class="row">
								<div class="col-lg-4 d-flex flex-column align-items-center justify-content-between"></div>
								<div class="col-lg-4 d-flex flex-column align-items-center justify-content-between">
									<div class="circle rounded-circle bg-secondary mb-4"
										style="width: 40px; height: 40px;"></div>
									<div class="d-flex flex-column align-items-center">
										<span>Standard</span>
										<span class="d-block mt-2"><small>Free</small></span>
									</div>
								</div>
								<div class="col-lg-4 d-flex flex-column align-items-center justify-content-between">
									<div class="circle rounded-circle bg-secondary mb-4"
										style="width: 40px; height: 40px;"></div>
									<div class="d-flex flex-column align-items-center">
										<small>30 Days Remaining</small>
										<span>Premium</span>
										<button class="btn btn-primary btn-sm mt-2" data-dismiss="modal"
											data-toggle="modal" data-target="#upgrade">
											Estimate Pricing
										</button>
										<span class="d-block mt-2"><small>starting at $8/month</small></span> <span
											class="text-secondary">Price in USD</span>
									</div>
								</div>
							</div>
							<div class="row pt-3">
								<div class="col-4 px-0">
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
								</div>
								<div class="col-4 px-0">
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
								</div>
								<div class="col-4 px-0">
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
									</div>
									<div class="d-flex align-items-center border-bottom py-2 justify-content-center">
										<img src="/img/true.png" alt="" width="20">
										<span class="ml-2">Lorem ipsum dolor</span>
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
	import { mapState } from 'vuex';
	
	export default {
		data() {
			return {
				rangeSliderIsShown: false,
				pricePerUser: 5,
				price: 5,
				fullPrice: 0,
				customValue: 1,
				annualDiscount: 0,
				isCouponEnabled: '',
				infoState: 1, // 1 - shows 1-10 info, 2 - shows 11-100 info, 3 - shows 101-1000 info, 4 - shows 1001+ info
				sliderMax: 5000,
				planType: true, // false == monthly, true == annual
				slider: {
					value: 1,
					processStyle: {
						backgroundColor: '#1066fd',
					},
					range: [
						{
							label: '1 User',
						},
						{
							label: '10',
						},
						{
							label: '100',
						},
						{
							label: '250',
						},
						{
							label: '500',
						},
						{
							label: '1000',
						},
						{
							label: '5000',
						},
					],
				},
			};
		},
		
		computed: mapState([
			'auth',
			'locale',
		]),
		
		mounted() {
			console.log('DashboardLayout mounted');
			$(this.$refs.update_modal).on('shown.bs.modal', (e) => {
				this.rangeSliderIsShown = true;
			});
			$(this.$refs.update_modal).on('hide.bs.modal', (e) => {
				this.rangeSliderIsShown = false;
			});
		},
		
		methods: {
			async logout() {
				try {
					let response = await this.$http.post('/auth/logout');
					await this.$router.push({ name: 'main.home', params: { locale: this.locale } });
					this.$store.commit('setAuth', response.data.data);
				} catch (error) {
					this.$notify({ text: error, type: 'error' });
				}
			},
			toCustomValue(value) {
				if (value >= 1 && value <= 830) {
					this.customValue = Math.ceil(value / 830 * 10);
				} else if (value >= 831 && value <= 1675) {
					this.customValue = Math.ceil(value / 1675 * 100);
				} else if (value >= 1676 && value <= 2500) {
					this.customValue = Math.ceil(value / 2500 * 250);
				} else if (value >= 2501 && value <= 3325) {
					this.customValue = Math.ceil(value / 3325 * 500);
				} else if (value >= 2501 && value <= 4165) {
					this.customValue = Math.ceil(value / 4165 * 1000);
				} else if (value >= 4166 && value <= 5000) {
					this.customValue = Math.ceil(value / 5000 * 5000);
				}
			},
			fromCustomValue() {
				// if (this.customValue >=1 && this.customValue <= 10 ) {
				//     this.slider.value = Math.round(this.customValue * 830 / 10);
				// } else if (this.customValue >= 11 && this.customValue <= 100) {
				//     this.slider.value = Math.round(this.customValue * 1675 / 100);
				// } else if (this.customValue >= 101 && this.customValue <= 250) {
				//     this.slider.value = Math.round(this.customValue * 2500 / 250);
				// } else if (this.customValue >= 251 && this.customValue <= 500) {
				//     this.slider.value = Math.round(this.customValue * 3325 / 500);
				// } else if (this.customValue >= 501 && this.customValue <= 1000) {
				//     this.slider.value = Math.round(this.customValue * 4165 / 1000);
				// } else if (this.customValue >= 1001 && this.customValue <= 5000) {
				//     this.slider.value = Math.round(this.customValue * 5000 / 5000);
				// }
				console.log('have some bugs, need to refactor');
			},
			updatePrice() {
				console.log(this.planType);
				this.toCustomValue(this.slider.value);
				if (this.customValue <= 10) {
					this.pricePerUser = 5;
					this.infoState = 1;
				} else if (this.customValue <= 100) {
					this.pricePerUser = 4;
					this.infoState = 2;
				} else if (this.customValue <= 1000) {
					this.pricePerUser = 3;
					this.infoState = 3;
				} else {
					this.pricePerUser = 2;
					this.infoState = 4;
				}
				
				if (this.planType) {
					this.price = parseFloat(((this.customValue * this.pricePerUser * 12) - (this.customValue * this.pricePerUser * 12 * 20 / 100)).toFixed(2)).toLocaleString('en-US', {
						style: 'currency',
						currency: 'USD',
					});
					this.fullPrice = parseFloat((this.customValue * this.pricePerUser * 12).toFixed(2)).toLocaleString('en-US', {
						style: 'currency',
						currency: 'USD',
					});
				} else {
					this.fullPrice = parseFloat((this.customValue * this.pricePerUser).toFixed(2)).toLocaleString('en-US', {
						style: 'currency',
						currency: 'USD',
					});
					this.price = parseFloat((this.customValue * this.pricePerUser).toFixed(2)).toLocaleString('en-US', {
						style: 'currency',
						currency: 'USD',
					});
				}
				this.annualDiscount = parseFloat((this.customValue * this.pricePerUser * 12 * 20 / 100).toFixed(2)).toLocaleString('en-US', {
					style: 'currency',
					currency: 'USD',
				});
			},
		},
	};
</script>

<style lang="scss">
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

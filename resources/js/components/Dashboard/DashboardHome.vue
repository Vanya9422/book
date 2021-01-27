<template>
	<div class="container pt-3">
		<div v-if="selectedBookingPage" class="row dashboard-booking-page-item">
			<div class="col-lg-12 pb-4">
				<div
					class="d-flex flex-md-row flex-column justify-content-between align-items-md-center align-items-start booking-page-header rounded">
					<div class="admin_main__name d-flex align-items-center">
						<div class="dropdown mr-1">
							<button id="dropdownMenuButton" type="button"
								class="py-3 px-3 booking-type-options border-0 rounded-left btn-no-opacity" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<span class="d-flex align-items-center">
									<span class="mr-2">
										<img src="/img/more.svg" style="opacity: .3;" alt="" :height="20">
									</span>
									<div class="admin_main__left rounded overflow-hidden" style="font-size: 0;">
										<img alt="" :src="selectedBookingPage.computedUserAvatar.url" style="width: 40px; height: 40px;">
									</div>
								</span>
							</button>
							<div class="dropdown-menu border-0 shadow" aria-labelledby="dropdownMenuButton">
								<router-link class="dropdown-item" :to="{ name: 'dashboard.booking_pages.create' }">
									<strong>New Booking Page</strong>
								</router-link>
								<div class="dropdown-divider"></div>
								
								<a v-if="false" class="dropdown-item d-flex align-items-center" href="#"
									data-toggle="modal" data-target="#addToWebsite">
									<i class="mb-1 mr-2">
										<img src="/img/html_dark.svg" alt="" style="opacity: .2;" width="15">
									</i>
									<span>Add To Website</span>
								</a>
								
								<div class="input-group">
									<div class="input-group-prepend border-0">
										<span id="inputGroupPrepend4545" class="input-group-text border-0 bg-white"><img
											src="/img/search_black.svg" alt="" width="15" style="opacity: 0.3;"></span>
									</div>
									<input id="validationDefaultUsername2" type="text" class="form-control border-0"
										placeholder="Find by User" aria-describedby="Find by User">
								</div>
								
								<strong class="d-block mb-2 px-2">Switch To</strong>
								<a v-for="(bookingPage) in bookingPages" :key="bookingPage.id" class="dropdown-item"
									:class="{ 'active': bookingPage === selectedBookingPage }" href="#"
									@click.prevent="onBookingPageSelected(bookingPage)">
									<span class="d-flex align-items-center">
										<span class="d-block rounded-circle overflow-hidden"
											:style="{ 'width': '20px', 'height': '20px', 'font-size': '0' }">
											<img src="/img/avatar.png" alt=""
												:style="{ 'width': '100%', 'height': '100%', 'object-fit': 'cover' }">
										</span>
										<span class="ml-2">{{ bookingPage.computedTitle }}</span>
									</span>
								</a>
							</div>
						</div>
						<div class="admin_main__right py-1">
							<strong class="d-block mb-1 pl-3">{{ selectedBookingPage.computedTitle }}</strong>
							<router-link class="border-0 btn btn-light text-decoration-none text-primary px-3"
								:to="{ name: 'booking_page.home', params: { locale, bookingPageSlug: selectedBookingPage.slug } }"
								target="_blank">
								bookify.ai/{{ selectedBookingPage.slug }}
							</router-link>
							<a class="btn btn-link" href="#" style="font-size: 0;" @click.prevent="copyLink">
								<img src="/img/copy.svg" alt="" style="opacity: .2;" width="15">
							</a>
							<router-link class="btn btn-link" style="font-size: 0;"
								:to="{ name: 'dashboard.booking_page.edit', params: { bookingPageId: selectedBookingPage.id } }">
								<img src="/img/edit.svg" alt="" style="opacity: .2;" width="15">
							</router-link>
							<router-link :to="{ name: 'temp.booking_page.mobile.intro' }" target="_blank">
								<span class="badge badge-success">New Mob</span>
							</router-link>
							<router-link :to="{ name: 'temp.booking_page.desktop.intro' }" target="_blank">
								<span class="badge badge-success">New Desk</span>
							</router-link>
							<router-link :to="{ name: 'temp.booking_page.fullpage.intro' }" target="_blank">
								<span class="badge badge-success">New Full</span>
							</router-link>
							<router-link :to="{ name: 'temp.stream_room' }" target="_blank">
								<span class="badge badge-success">Stream</span>
							</router-link>
							<router-link :to="{ name: 'temp.webinar_booking' }" target="_blank">
								<span class="badge badge-success">Webinar</span>
							</router-link>
						</div>
					</div>
					<div
						class="admin_main__buttons d-flex align-items-lg-center align-items-end flex-lg-row flex-column pl-lg-0 pr-lg-3 p-2 w-100 w-md-auto">
						<div class="input-group mb-lg-0 mb-2 mr-lg-2 filter_wrapper"
							:class="{ 'isOpened' : isFilterOpen }">
							<div class="input-group-prepend border-0">
								<label class="input-group-text border-0 cursor-pointer bg-white mb-0" for="filter_input"
									@click="openFilter">
									<img src="/img/search_black.svg" alt="" width="15" style="opacity: .3;">
								</label>
							</div>
							<input id="filter_input" type="text" class="form-control border-0 filter_input"
								:class="{ 'isOpened' : isFilterOpen }" style="max-width: 130px;" placeholder="Filter"
								aria-describedby="Filter" required>
						</div>
						<div class="input-group mb-lg-0 mb-2 bg-white rounded flex-nowrap overflow-hidden add_user"
							:class="{ 'isOpened' : isAddUserOpen }">
							<div class="input-group-prepend border-0">
								<label class="input-group-text border-0 bg-white py-1 cursor-pointer"
									for="add_user_input" @click="openAddUser">
									<img v-if="!isAddUserOpen" src="/img/person_add.svg" alt="" width="23"
										style="opacity: .3;">
									<img v-else src="/img/at.svg" alt="" width="18" style="opacity: .3;">
									<span v-if="!isAddUserOpen"
										class="text-nowrap align-self-center ml-2 pointer-events-none">Add User</span>
								</label>
							</div>
							
							<input id="add_user_input" v-model="isNotEmpty" type="text"
								class="form-control border-0 pl-0" placeholder="Type Email to Invite or"
								aria-describedby="Type Email to Invite or" required>
							<div v-if="!isNotEmpty" class="input-group-append">
								<button type="button" class="btn btn-primary d-flex align-items-center" data-toggle="modal"
									data-target="#invite_link">
									<span class="mr-2" style="font-size: 0;">
										<img src="/img/link.svg" width="16" alt="">
									</span>
									<span>
										Get Invite Link
									</span>
								</button>
							</div>
							<div v-else class="input-group-append">
								<button type="button" class="btn btn-primary d-flex align-items-center">
									<span class="mr-2" style="font-size: 0;">
										<img src="/img/email.svg" width="20" alt="">
									</span>
									<span>
										Send Invite
									</span>
								</button>
							</div>
						</div>
						<div class="d-flex align-items-center pr-lg-2 w-100 w-md-auto">
							<div class="btn-group w-100 w-md-auto">
								<button v-if="false" type="button"
									class="btn btn-primary text-white dropdown-toggle dropdown-toggle-split"
									data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div v-if="false" class="dropdown-menu">
									<a class="dropdown-item mb-3" href="#">
										<div class="row align-items-center">
											<i class="mr-2 mb-1">
												<img src="/img/number.svg" alt="" width="15">
											</i>
											<span>
												Create Single-Use Link
											</span>
										</div>
										<div class="text-secondary"><small>Generate a one-time link
											<br>that expires after the first booking.</small></div>
									</a>
									<a class="dropdown-item mb-3" href="#">
										<div>Add Times to Email</div>
										<div class="text-secondary"><small>Visually embed times
											<br>directly into an email.</small>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div v-if="selectedBookingPage.bookingTypes.length > 0">
					<Draggable class="row pt-4" :list="selectedBookingPage.bookingTypes"
						:options="{ group: 'bookingType' }" handle=".handle" @end="onBookingTypesMoved">
						<div v-for="(bookingType, bookingTypeIndex) in selectedBookingPage.bookingTypes"
							:key="bookingType.id" class="col-lg-3 col-md-6 col-12 pb-4">
							<DashboardBookingTypeItem :booking-page="selectedBookingPage" :booking-type="bookingType"
								@saved="onBookingTypeUpdated(bookingTypeIndex, $event.bookingType)" />
						</div>
						<div class="col-lg-3 col-md-6 col-12 pb-4">
							<router-link
								class="dashboard-booking-type-item text-decoration-none text-dark rounded overflow-hidden p-0 card mb-3 cursor-pointer border-left-0 border-right-0 h-100 border-top-0"
								:to="{ name: 'dashboard.booking_page.booking_types.create', params: { bookingPageId: selectedBookingPage.id } }"
								:style="{ 'border-bottom': `4px solid gray` }">
								<div
									class="card-body bg-light d-flex align-items-center justify-content-center flex-column">
									<img src="/img/add_dark.svg" alt="" class="isScaleOnHover" style="opacity: .3;"
										width="40">
									<strong class="d-block mt-3">New Booking Type</strong>
								</div>
							</router-link>
						</div>
					</Draggable>
				</div>
				<div v-else class="text-center pt-4">
					<h5>
						This Booking Page doesn't have any booking types yet.
					</h5>
					<small>Add a new booking type to start scheduling bookings.</small>
				</div>
			</div>
			<div class="container px-0 py-3 border-top border-bottom mb-4">
				<div
					class="dashboard-booking-type-item rounded overflow-hidden p-0 card mb-3 cursor-pointer border-left-0 border-right-0 border-top-0"
					:style="{ 'border-bottom': `4px solid gray` }">
					<div class="card-body bg-light d-flex align-items-center justify-content-center flex-column"
						style="min-height: 200px;">
						<img src="/img/add_dark.svg" alt="" class="isScaleOnHover" style="opacity: .3;" width="40">
						<strong class="d-block mt-3 mb-2">New Booking Page</strong>
						<span
							class="text-center">If you need another Booking Page and Event-Types for you or another project/team/brand.</span>
					</div>
				</div>
			</div>
			<div class="container pb-4">
				<h4>
					<strong>Optimization</strong>
				</h4>
				<div class="row mt-4">
					<div class="col-12 col-md-6 col-lg-4 pb-4">
						<div class="card border-0 shadow h-100 dashboard-booking-type-item">
							<div class="card-header bg-white p-3">
								<div class="d-flex justify-content-between align-items-center">
									<strong>Optimization 1</strong>
									<img src="/img/confirm.svg" alt="" height="26">
								</div>
							</div>
							<div class="card-body">
								<span>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi architecto commodi deleniti, eveniet explicabo laudantium odio quos tempore tenetur!
								</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 pb-4">
						<div class="card border-0 shadow h-100 dashboard-booking-type-item">
							<div class="card-header bg-white p-3">
								<div class="d-flex justify-content-between align-items-center">
									<strong>Optimization 2</strong>
									<img src="/img/confirm.svg" alt="" height="26">
								</div>
							</div>
							<div class="card-body">
								<span>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi architecto commodi deleniti, eveniet explicabo laudantium odio quos tempore tenetur!
								</span>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-4 pb-4">
						<div class="card border-0 shadow dashboard-booking-type-item btn-no-opacity">
							<div class="card-header bg-white p-3">
								<div class="d-flex justify-content-between align-items-center">
									<strong>Optimization 3</strong>
									<button class="btn btn-primary btn-sm">
										I Did This
									</button>
								</div>
							</div>
							<div class="card-body">
								<span>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi architecto commodi deleniti, eveniet explicabo laudantium odio quos tempore tenetur!
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div id="invite_link" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
				aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 id="exampleModalLabel" class="modal-title">
								Invitation Link
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">http://bookify.ai/</span>
								</div>
								<input type="text" class="form-control" value="1a3s21d2as32d">
								<div class="input-group-append">
									<button id="button-addon2" type="button" class="btn btn-outline-secondary">
										Copy
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div v-else class="h-100 d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 65px);">
			<span><img src="/img/preloader.svg" width="40" alt=""></span>
		</div>
	</div>
</template>

<script>
	import Draggable from 'vuedraggable';
	import { mapState } from 'vuex';
	
	export default {
		components: {
			Draggable,
			DashboardBookingTypeItem: () => import('./components/DashboardBookingTypeItem'),
		},
		
		data() {
			return {
				bookingPages: null,
				selectedBookingPage: null,
				isFilterOpen: false,
				isAddUserOpen: false,
				isNotEmpty: '',
			};
		},
		
		computed: {
			...mapState([
				'locale',
			]),
		},
		
		async mounted() {
			console.log('DashboardHome mounted');
			$(document).on('click', this.checkTarget);
			await this.getBookingPages();
		},
		
		beforeDestroy() {
			$(document).off('click', this.checkTarget);
		},
		
		methods: {
			async getBookingPages() {
				let response = await this.$http.get(`/users/me/booking_pages`);
				this.bookingPages = response.data.data;
				this.selectedBookingPage = this.bookingPages[0];
			},
			
			async copyLink() {
				try {
					await this.$copyText('https://bookify.ai/' + this.selectedBookingPage.slug);
					
					this.$notify({
						text: 'Link copied!',
						type: 'success',
					});
				} catch (error) {
					console.error(error);
					
					this.$notify({
						text: `Sorry! Can't copy.`,
						type: 'error',
					});
				}
			},
			
			onBookingTypeUpdated(bookingTypeIndex, updatedBookingType) {
				this.$set(this.selectedBookingPage.bookingTypes, bookingTypeIndex, {
					...this.selectedBookingPage.bookingTypes[bookingTypeIndex],
					...updatedBookingType,
				});
			},
			
			onBookingPageSelected(bookingPage) {
				this.selectedBookingPage = bookingPage;
			},
			
			onBookingTypesMoved(event) {
			
			},
			
			openFilter() {
				this.isFilterOpen = !this.isFilterOpen;
			},
			
			openAddUser() {
				this.isAddUserOpen = !this.isAddUserOpen;
			},
			
			checkTarget(event) {
				if ($(event.target).closest('.admin_main__buttons').length) {
					return;
				}
				
				this.isFilterOpen = false;
				this.isAddUserOpen = false;
			},
		},
	};
</script>

<style lang="scss" scoped>
	.dashboard-booking-type-item:hover .isScaleOnHover {
		animation: animation 1s ease forwards;
	}
	
	.filter_wrapper {
		width: 39px !important;
		border-radius: 0.4rem !important;
		overflow: hidden;
		transition: all .3s ease;
		
		&.isOpened {
			width: 169px !important;
		}
	}
	
	.filter_input {
		width: 0 !important;
		box-sizing: border-box;
		transition: all .3s ease;
		
		&:not(.isOpened) {
			padding: 0;
		}
		
		&.isOpened {
			width: 130px !important;
		}
		
	}
	
	.add_user {
		transition: all .3s ease;
		width: 111px;
		height: 35px;
		
		&.isOpened {
			width: 310px;
		}
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

<template>
	<div class="dashboard-booking-type-item p-0 card mb-3 cursor-pointer border-left-0 border-right-0 border-top-0"
		:style="{ 'border-bottom': `4px solid #${bookingType.color}` }"
		:class="{ 'is-disabled': !bookingType.isActive }">
		<!--@click="goToEditPage"-->
		<!--		<div class="card-header border-bottom-0">-->
		<!--			<div class="col-lg-12">-->
		<!--				<div class="row justify-content-between align-items-center">-->
		<!--					<div class="form-group form-check">-->
		<!--						&lt;!&ndash;<input type="checkbox" class="form-check-input" id="exampleCheck1">&ndash;&gt;-->
		<!--					</div>-->
		<!--					-->
		<!--				</div>-->
		<!--			</div>-->
		<!--		</div>-->
		<div class="card-header p-1 border-0 handle text-center">
			<img src="/img/drag.svg" height="25" style="opacity: .3; transform: rotate(90deg);" alt="">
		</div>
		<div class="card-body border-0">
			<div class="d-flex justify-content-between align-items-top">
				<div class="w-100">
					<div class="d-flex mb-2 justify-content-between align-items-center">
						<router-link class="btn btn-light text-primary text-decoration-none"
							:to="{ name: 'booking_page.booking_type', params: { locale, bookingPageSlug: bookingPage.slug, bookingTypeSlug: bookingType.slug } }"
							target="_blank" @click.native.stop>
							/{{ bookingType.slug }}
						</router-link>
						<div v-if="bookingType.isActive" ref="footerButtonGroup" class="btn-group">
							<button v-if="false" type="button"
								class="border-0 btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split rounded-left"
								style="border-radius: 0;" data-toggle="dropdown" aria-haspopup="true"
								aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<button ref="bookingTypeLink" type="button"
								class="border-0 btn btn-light p-2 btn-sm rounded m-0" data-toggle="tooltip" data-placement="top" title="Copy Link"
								@click.stop="copyLink">
								<img src="/img/copy.svg" alt="" width="15">
							</button>
							<div v-if="false" class="dropdown-menu">
								<a class="dropdown-item mb-3" href="#" data-toggle="modal" data-target="#singleUseLink">
									<div class="row align-items-center">
										<i class="mr-2 mb-1">
											<img src="/img/number.svg" alt="" width="15">
										</i>
										<span>
											Create Single-Use Link
										</span>
									</div>
									<div class="text-secondary">
										<small>Generate a one-time link
											<br>that expires after the first booking.</small>
									</div>
								</a>
								<a class="dropdown-item mb-3" href="#" data-toggle="modal" data-target="#addTimes">
									<div class="row align-items-center">
										<i class="mr-2 mb-1">
											<img src="/img/email_follow_up.svg" alt="" width="15">
										</i>
										<span>
											Add Times to Email
										</span>
									</div>
									<div class="text-secondary">
										<small>Visually embed available times directly<br> into an email.</small>
									</div>
								</a>
							</div>
						</div>
						<button v-else type="button" class="btn btn-secondary btn-sm"
							:class="{ 'is-loading': loadingButton === 'TURN_ON' }"
							:disabled="loadingButton === 'TURN_ON'" @click.stop="activate">
							Turn On
						</button>
					</div>
					<div class="d-flex justify-content-between align-items-start mb-2">
						<h5 class="card-title mb-0 pt-2">
							{{ bookingType.name }}
						</h5>
						<div ref="headerDropdown" class="dropdown dropleft">
							<button id="dropdownMenuLink" type="button"
								class="btn btn-light p-2 d-flex align-items-center" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<img src="/img/edit.svg" alt="" width="15">
							</button>
							<div class="dropdown-menu border-0 shadow" aria-labelledby="dropdownMenuLink">
								<router-link class="dropdown-item d-flex align-items-center"
									:to="{ name: 'dashboard.booking_page.booking_type.edit', params: { bookingPageId: bookingPage.id, bookingTypeId: bookingType.id } }">
									<div class="d-flex align-items-center">
										<img src="/img/edit.svg" alt="" width="15" style="opacity: .2;">
										<span class="ml-2">Edit</span>
									</div>
								</router-link>
								<a v-if="false" class="dropdown-item d-flex align-items-center" href="#"
									data-toggle="modal" data-target="#internalNote">
									<span>
										Add Internal Note
									</span>
								</a>
								<a v-if="false" class="dropdown-item d-flex align-items-center" href="#">
									<span>
										Clone
									</span>
								</a>
								<a v-if="false" class="dropdown-item d-flex align-items-center" href="#">
									<span>
										Save to Template
									</span>
								</a>
								<a v-if="false" class="dropdown-item d-flex align-items-center" href="#"
									data-toggle="modal" data-target="#addToWebsite">
									<span>
										Add to Website
									</span>
								</a>
								<a class="dropdown-item d-flex align-items-center" href="#" data-toggle="modal"
									data-target="#deleteForm">
									<div class="d-flex align-items-center">
										<img src="/img/delete.svg" alt="" width="15" style="opacity: .2;">
										<span class="ml-2">Delete</span>
									</div>
								</a>
								<div class="dropdown-divider"></div>
								<label class="dropdown-item mb-0">
									<div class="custom-control custom-switch">
										<input :id="`${_uid}-customSwitch1`" v-model="isActive" type="checkbox"
											class="custom-control-input" @change="isActiveChanged">
										<label class="custom-control-label"
											:for="`${_uid}-customSwitch1`">On/Off</label>
									</div>
								</label>
							</div>
						</div>
					</div>
					<p class="h4 card-text text-center mb-n3">
						<span class="badge badge-primary mr-2 p-1">$50</span>
						<span class="badge badge-light mr-2 p-1">{{ bookingType.duration }} mins</span>
						<span class="badge badge-light p-1 handle">One-on-One</span>
					</p>
					<p v-if="bookingType.internalNote" class="text-secondary">
						<small>
							<em>"{{ bookingType.internalNote }}"</em>
						</small>
					</p>
				</div>
			</div>
		</div>
		<!--        <div class="card-body border-0">-->
		<!--            <h5 class="card-title">Chat/Video Conference Room</h5>-->
		<!--            <p class="card-text">Some Text</p>-->
		<!--            <div class="row mr-0 ml-0 mt-4 align-items-center justify-content-between ">-->
		<!--                <div class="col pl-0">-->
		<!--                    <label for="pass_protected" class="mb-1" data-toggle="modal" data-target="#create_password">Password Protected</label>-->
		<!--                    <button type="button" class="btn btn-link pl-0 pt-0 d-block"><span class="d-block" data-toggle="modal" data-target="#create_password">Edit Password</span></button>-->
		<!--                </div>-->
		<!--                <div class="form-group mb-0 ml-2 mr-0">-->
		<!--                    <span class="switch" data-toggle="modal">-->
		<!--                        <input type="checkbox" class="switch" id="pass_protected">-->
		<!--                        <label for="pass_protected" class="m-0"></label>-->
		<!--                    </span>-->
		<!--                </div>-->
		<!--            </div>-->
		<!--        </div>-->
		<!--        <div class="card-footer border-0">-->
		<!--            <div class="d-flex justify-content-between align-items-center">-->
		<!--&lt;!&ndash;                <router-link&ndash;&gt;-->
		<!--&lt;!&ndash;                    :to="{ name: 'booking_page.booking_type', params: { locale, bookingPageSlug: bookingPage.slug, bookingTypeSlug: bookingType.slug } }"&ndash;&gt;-->
		<!--&lt;!&ndash;                    target="_blank" @click.native.stop>&ndash;&gt;-->
		<!--&lt;!&ndash;                    /{{ bookingType.slug }}&ndash;&gt;-->
		<!--&lt;!&ndash;                </router-link>&ndash;&gt;-->
		<!--&lt;!&ndash;                <a href="#">/15min-room</a>&ndash;&gt;-->
		<!--                <router-link :to="{ name: 'temp.video_room' }">/15min-room</router-link>-->
		<!--                <div v-if="bookingType.isActive" class="btn-group" ref="footerButtonGroup">-->
		<!--                    <button type="button" class="btn btn-outline-primary btn-sm" @click.stop="copyLink">-->
		<!--                        Copy link-->
		<!--                    </button>-->
		<!--                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle dropdown-toggle-split"-->
		<!--                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
		<!--                        <span class="sr-only">Toggle Dropdown</span>-->
		<!--                    </button>-->
		<!--                    <div class="dropdown-menu">-->
		<!--                        <a class="dropdown-item mb-3" href="#" data-toggle="modal" data-target="#singleUseLink">-->
		<!--                            <div class="row align-items-center">-->
		<!--                                <i class="mr-2 mb-1">-->
		<!--                                    <img src="/img/number.svg" alt="" width="15">-->
		<!--                                </i>-->
		<!--                                <span>-->
		<!--									Create Single-Use Link-->
		<!--								</span>-->
		<!--                            </div>-->
		<!--                            <div class="text-secondary">-->
		<!--                                <small>Generate a one-time link <br>that expires after the first booking.</small>-->
		<!--                            </div>-->
		<!--                        </a>-->
		<!--                        <a class="dropdown-item mb-3" href="#" data-toggle="modal" data-target="#addTimes">-->
		<!--                            <div class="row align-items-center">-->
		<!--                                <i class="mr-2 mb-1">-->
		<!--                                    <img src="/img/email_follow_up.svg" alt="" width="15">-->
		<!--                                </i>-->
		<!--                                <span>-->
		<!--									Add Times to Email-->
		<!--								</span>-->
		<!--                            </div>-->
		<!--                            <div class="text-secondary">-->
		<!--                                <small>Visually embed available times directly<br> into an email.</small>-->
		<!--                            </div>-->
		<!--                        </a>-->
		<!--                    </div>-->
		<!--                </div>-->
		<!--                <button v-else type="button" class="btn btn-secondary btn-sm" @click.stop="activate"-->
		<!--                        :class="{ 'is-loading': loadingButton === 'TURN_ON' }"-->
		<!--                        :disabled="loadingButton === 'TURN_ON'">-->
		<!--                    Turn On-->
		<!--                </button>-->
		<!--            </div>-->
		<!--        </div>-->
		<div id="create_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
			style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="staticBackdropLabel" class="modal-title">
							Set Conference Room Password
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input id="exampleInputPassword1" type="password" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary">
							Set
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';
	
	export default {
		props: {
			bookingType: {
				type: Object,
				default: null,
			},
			
			bookingPage: {
				type: Object,
				default: null,
			},
		},
		
		data() {
			return {
				loadingButton: null,
				isActive: this.bookingType.isActive,
			};
		},
		
		computed: mapState([
			'locale',
		]),
		
		beforeDestoy() {
			$(this.$refs.bookingTypeLink).tooltip('disable');
		},
		
		watch: {
			bookingType() {
				this.isActive = this.bookingType.isActive;
			},
		},
		
		mounted() {
			$(this.$refs.bookingTypeLink).tooltip('enable');
		},
		
		methods: {
			async copyLink() {
				try {
					await this.$copyText('https://bookify.ai/' + this.bookingPage.slug + '/' + this.bookingType.slug);
					
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
			
			goToEditPage(event) {
				let stopEvent = $(event.target).closest([
					this.$refs.headerDropdown,
					this.$refs.footerButtonGroup,
				]).length > 0;
				
				if (stopEvent) {
					return;
				}
				
				this.$router.push({
					name: 'dashboard.booking_page.booking_type',
					params: { bookingPageId: this.bookingPage.id, bookingTypeId: this.bookingType.id },
				});
			},
			
			async isActiveChanged() {
				let response = await this.$http.post(`/booking_types/${this.bookingType.id}/${this.isActive ? 'activate' : 'deactivate'}`);
				this.$emit('saved', { bookingType: response.data.data });
			},
			
			async activate() {
				this.loadingButton = 'TURN_ON';
				
				try {
					let response = await this.$http.post(`/booking_types/${this.bookingType.id}/activate`);
					this.$emit('saved', { bookingType: response.data.data });
					this.loadingButton = null;
				} catch (error) {
					this.loadingButton = null;
					throw error;
				}
			},
		},
	};
</script>

<style lang="scss">
	.dashboard-booking-type-item {
		height: 100%;
		
		&.is-disabled {
			background-color: #f9f9f9;
			color: #a8a8a8;
		}
		
		&.is-disabled .card-body a,
		&.is-disabled .card-footer a {
			color: #a8a8a8;
		}
		
		.card-header {
			padding: 0;
		}
		
		&.is-disabled .card-header {
			border-top-color: #a8a8a8 !important;
		}
		
		.card-header .dropdown-toggle {
			padding: 0.75rem 1.25rem;
		}
	}
	
	.sortable-chosen {
		filter: grayscale(1);
	}
</style>

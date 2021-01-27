<template>
	<div class="card dashboard-booking-type-confirmation-page">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link no-bg-on-hover collapsed text-left">
							Confirmation Page
							<div>
								<small class="text-secondary text-left d-block">
									Bookify confirmation page, no active links
								</small>
							</div>
						</button>
						<div v-if="isOpen" class="btn-group">
							<button type="button" class="btn btn-outline-secondary" data-toggle="modal"
								data-target="#cancel">
								Cancel
							</button>
							<button class="btn btn-primary" :class="{ 'is-loading': isLoading }" href="#"
								@click="save()">
								Save & Close
							</button>
						</div>
					</div>
				</div>
			</h2>
		</div>
		<form ref="form" class="border-top collapse" onsubmit="return false">
			<div class="card-body">
				<div class="col-lg-6 mb-4 pb-2">
					<div>
						<div class="form-group">
							<label>
								On confirmation
							</label>
							<select v-model="form.confirmationActionType" class="form-control"
								@click="changeOnConfirmation">
								<option value="DISPLAY_CONFIRMATION_PAGE">
									Display Bookify confirmation page
								</option>
								<option value="REDIRECT_TO_EXTERNAL_WEBSITE">
									Redirect to an external site
								</option>
							</select>
						</div>
						<div v-if="form.confirmationActionType === 'DISPLAY_CONFIRMATION_PAGE'" class="form-group">
							<label :class="{ disabled: !anotherEvent }">
								Display button to schedule another event?
							</label>
							<div class="col-lg-12">
								<div class="row align-items-center flex-nowrap">
									<input v-model="form.scheduleAnotherEventButtonText" type="email"
										class="form-control" value="Schedule another event"
										:disabled="!form.isScheduleAnotherEventButtonShown">
									<div class="custom-control custom-switch ml-4">
										<input id="customSwitch10" v-model="form.isScheduleAnotherEventButtonShown"
											type="checkbox" class="custom-control-input" @click="switchAnotherEvent">
										<label class="custom-control-label" for="customSwitch10"></label>
									</div>
								</div>
							</div>
						</div>
						
						<div v-if="form.confirmationActionType === 'REDIRECT_TO_EXTERNAL_WEBSITE'" class="form-group">
							<div>
								<label for="redirectUrl">
									Redirect URL *
								</label>
								<input id="redirectUrl" ref="bookingTypeNameInput"
									v-model="form.externalWebsiteRedirectUrl" type="text" class="form-control"
									:class="{ 'is-invalid': validationFields['redirectUrl'] }"
									placeholder="https://www.example.com">
								<div v-if="validationFields['redirectUrl']" class="invalid-feedback">
									{{ validationFields['redirectUrl'][0] }}
								</div>
								<div class="checkbox mt-3">
									<input v-model="form.passEventDetailsToRedirectedUrl" type="checkbox" class="mr-2">
									<label>
										Pass event details to your redirected page.
									</label>
									<a href="/help" target="_blank">Learn More</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div v-if="form.confirmationActionType === 'DISPLAY_CONFIRMATION_PAGE'" class="col-lg-12">
					<p class="text-secondary">
						<small>
							Use this section to display custom links after this event is confirmed. For example, you might link to a
							custom thank you page on your website. Custom links will appear as buttons to invitees.
						</small>
					</p>
				</div>
				<div class="col-lg-6 mt-4">
					<div v-for="(link, linkIndex) in form.links" :key="link.id" class="links mb-4">
						<div class="row">
							<div class="col pr-2">
								<span class="ml-5">{{ link.title }}</span>
							</div>
							
							<div class="col">
								<div class="custom-control custom-switch pt-4 pl-switch">
									<input :id="`${linkIndex}-customSwitch`" v-model="form.links[linkIndex].isEnabled"
										type="checkbox" class="custom-control-input">
									<label class="custom-control-label" :for="`${linkIndex}-customSwitch`"></label>
								</div>
							</div>
							
							<div class="col pr-2">
								<button type="button" class="btn btn-link" @click="editLinks(link, linkIndex)">
									Edit
								</button>
							</div>
						</div>
					</div>
					<div v-if="addCustomLink" class="row pt-5">
						<div class="col-11">
							<ValidationObserver ref="validationObserver">
								<form @submit.prevent>
									<div class="form-group form-inline">
										<label v-if="!editCustomLink" class="d-inline col-12" for="Your_Custom_Link">
											Add Link
										</label>
										<label v-else class="d-inline col-12" for="Your_Custom_Link">
											Edit Link
										</label>
										<ValidationProvider v-slot="valiadtion" class="col-10 p-0" rules="required">
											<input id="Your_Custom_Link" v-model="addedLink.title" type="text"
												name="your custom link" class="form-control w-100"
												:class="{ 'is-invalid': valiadtion.failed }"
												placeholder="Your Custom Link">
											<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
												The custom link filed is required
											</div>
										</ValidationProvider>
										<div class="custom-control custom-switch ml-2 mb-3">
											<input id="customSwitch12" v-model="addedLink.isEnabled" type="checkbox"
												class="custom-control-input">
											<label class="custom-control-label" for="customSwitch12"></label>
										</div>
									</div>
									
									<div class="form-group form-inline">
										<ValidationProvider v-slot="valiadtion" class="col-10 p-0" rules="required">
											<input id="Your_Custom_Link2" v-model="addedLink.url" type="text"
												name="link" class="form-control w-100"
												:class="{ 'is-invalid': valiadtion.failed }"
												placeholder="https://www.example.com">
											<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
												The link filed is required
											</div>
										</ValidationProvider>
										<button v-if="editCustomLink" type="button" class="btn btn-danger ml-2"
											@click="deleteLink">
											Delete
										</button>
									</div>
									<div class="row justify-content-between align-items-center m-0">
										<div class="btn-group">
											<button v-if="!editCustomLink" type="button" class="btn btn-outline-primary"
												@click="saveLink">
												Add
											</button>
											<button v-else type="button" class="btn btn-outline-primary"
												@click="saveLink">
												Edit
											</button>
											<a class="btn btn-primary" href="#" @click.prevent="cancelCustomLink">
												Cancel
											</a>
										</div>
									</div>
								</form>
							</ValidationObserver>
						</div>
					</div>
				</div>
				
				<div v-if="!addCustomLink" class="col-lg-12">
					<button class="btn btn-outline-primary" @click="customLink">
						Add Custom Link
					</button>
				</div>
				<div class="row pt-4 pl-2 pr-2 pb-0 border-top mt-4 justify-content-end align-items-center">
					<button type="button" class="btn btn-link mr-2" @click="toggle">
						Cancel
					</button>
					<button type="button" class="btn btn-primary mr-2" @click="save()">
						Save & Close
					</button>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	import { ValidationObserver } from 'vee-validate';
	
	export default {
		components: {
			ValidationObserver,
		},
		
		props: {
			bookingPage: {
				type: Object,
				required: true,
			},
			
			bookingType: {
				type: Object,
				default: null,
			},
		},
		
		data() {
			return {
				isOpen: !this.bookingType.id,
				form: null,
				validationFields: {},
				isLoading: false,
				anotherEvent: false,
				scheduleAnotherEvent: null,
				selectedConfirmation: 1,
				addCustomLink: false,
				addedLink: {
					title: '',
					url: '',
					isEnabled: false,
				},
				addedLinkIndex: null,
				links: [],
				editCustomLink: false,
				value: '',
			};
		},
		
		created() {
			this.buildForm();
			this.form.confirmationActionType = this.form.confirmationActionType ? this.form.confirmationActionType : 'DISPLAY_CONFIRMATION_PAGE';
		},
		
		methods: {
			buildForm() {
				this.form = {
					confirmationActionType: this.bookingType.id ? this.bookingType.confirmationActionType : null,
					scheduleAnotherEventButtonText: this.bookingType.id ? this.bookingType.scheduleAnotherEventButtonText : null,
					isScheduleAnotherEventButtonShown: this.bookingType.id ? this.bookingType.isScheduleAnotherEventButtonShown : null,
					externalWebsiteRedirectUrl: this.bookingType.id ? this.bookingType.externalWebsiteRedirectUrl : null,
					passEventDetailsToRedirectedUrl: this.bookingType.id ? this.bookingType.passEventDetailsToRedirectedUrl : null,
					
					links: this.bookingType.id ? this.bookingType.links.map((bookingTypeLinks) => {
						return {
							id: bookingTypeLinks.id,
							title: bookingTypeLinks.title,
							url: bookingTypeLinks.url,
							isEnabled: bookingTypeLinks.isEnabled,
						};
					}) : [],
				};
			},
			
			open() {
				$(this.$refs.form).collapse('show');
				this.isOpen = true;
				this.$emit('open');
			},
			
			close({ animate = true } = {}) {
				if (animate) {
					$(this.$refs.form).collapse('hide');
				} else {
					$(this.$refs.form).removeClass('show');
				}
				
				this.isOpen = false;
				this.$emit('close');
			},
			
			toggle() {
				if (!this.bookingType.id) {
					return;
				}
				
				this.isOpen ? this.close() : this.open();
			},
			
			cancel() {
				if (this.bookingType.id) {
					return this.close();
				}
			},
			
			switchAnotherEvent() {
				this.anotherEvent = !this.anotherEvent;
				if (this.anotherEvent) {
					this.scheduleAnotherEvent = 'Schedule another event';
				} else {
					this.scheduleAnotherEvent = '';
				}
			},
			
			changeOnConfirmation() {
				console.log(this.selectedConfirmation);
			},
			
			customLink() {
				this.addCustomLink = true;
			},
			
			cancelCustomLink() {
				this.addCustomLink = false;
			},
			
			async saveLink() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				if (this.addedLinkIndex !== null) {
					this.form.links[this.addedLinkIndex] = this.addedLink;
					this.addedLink = {};
					this.addedLinkIndex = null;
				} else {
					this.form.links.push(this.addedLink);
					this.addedLink = {};
				}
				this.addCustomLink = false;
			},
			
			editLinks(link, linkIndex) {
				this.addCustomLink = true;
				this.editCustomLink = true;
				this.addedLinkIndex = linkIndex;
				this.addedLink = { ...link };
			},
			
			deleteLink() {
				this.addedLink = {};
				this.editCustomLink = false;
				this.addCustomLink = false;
				this.form.links.splice(this.addedLinkIndex, 1);
			},
			
			async save() {
				this.isLoading = true;
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
					bookingType: this.form,
				});
				
				this.isLoading = false;
				
				if (!this.bookingType.id) {
					return;
				}
				
				this.close();
			},
			
		},
	};
</script>

<style lang="scss" scoped>
	.links {
		height: 60px;
		border: 1px solid #dadada;
		line-height: 60px;
	}
	
	.pl-switch {
		padding-left: 300px;
	}
	
	.invalid-feedback {
		color: red;
		display: block;
	}
	
	.w-100 {
		width: 100%;
	}
</style>

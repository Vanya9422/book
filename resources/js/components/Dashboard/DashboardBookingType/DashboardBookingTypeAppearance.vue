<template>
	<div class="card dashboard-booking-type-invitee-questions">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link collapsed no-bg-on-hover text-left">
							Appearance
							<div>
								<small class="text-secondary text-left d-block">
									Change the Styling and Appearance.
								</small>
							</div>
						</button>
						<div class="btn-group fade" :class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
							<button type="button" class="btn btn-outline-secondary" @click.stop="cancel">
								Cancel
							</button>
							<button type="button" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
								:disabled="isLoading" @click.stop="save">
								{{ bookingType.id ? 'Save & Close' : 'Next' }}
							</button>
						</div>
					</div>
				</div>
			</h2>
		</div>
		<ValidationObserver ref="validationObserver">
			<form v-if="form" ref="form" class="border-top collapse" @submit.prevent>
				<div class="card-body">
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<div class="d-flex align-items-center">
									<div class="form-group mb-0 mr-2">
										<span class="switch switch-sm">
											<input id="appearance_photo" v-model="appearance.isMainPhotoEnabled"
												type="checkbox" class="switch" checked="checked">
											<label class="m-0" for="appearance_photo"></label>
										</span>
									</div>
									<label class="mb-0" for="appearance_photo">
										<strong>
											Enable Main Photo
										</strong>
									</label>
								</div>
								<small class="d-block">
									This will display the uploaded photo on the top of your page.
								</small>
							</div>
						</div>
						<div v-if="appearance.isMainPhotoEnabled" class="col-4">
							<div class="card mb-2">
								<label v-if="photoUrl" class="card-body m-0 overflow-hidden
                            rounded file-uploader d-flex align-items-center justify-content-center"
									for="appearance_photo_uploader"
									:style="{ backgroundImage: 'url(' + photoUrl + ')' }">
									<span class="file-uploader-overlay"></span>
									<img src="/img/add.svg" alt="" width="30">
								</label>
								
								<label v-else class="card-body m-0 overflow-hidden
                            rounded file-uploader d-flex align-items-center justify-content-center"
									for="appearance_photo_uploader"
									:style="{ backgroundImage: 'url(' + appearance.url.replace('/', '') + ')' }">
									<span class="file-uploader-overlay"></span>
									<img src="/img/add.svg" alt="" width="30">
								</label>
								
								<input id="appearance_photo_uploader" ref="photoFile" type="file" class="d-none"
									@change="onPhotoFileSelected">
							</div>
							<div class="d-flex justify-content-between align-items-start">
								<small class="text-uppercase">file must be <strong>jpg</strong> or <strong>png</strong></small>
								<button class="btn btn-secondary btn-sm" @click="remove">
									Remove
								</button>
							</div>
						</div>
					</div>
					<hr>
					
					<div class="mb-3">
						<div class="d-flex align-items-center ">
							<label class="mb-0 mr-2" for="appearance_switch_type">
								<strong>
									Procedural
								</strong>
							</label>
							<div class="form-group mb-0 mr-2">
								<span class="switch switch-sm switch-doublesided">
									<input id="appearance_switch_type" v-model="appearance.pageType" type="checkbox"
										class="switch" checked="checked">
									<label class="m-0" for="appearance_switch_type"></label>
								</span>
							</div>
							<label class="mb-0" for="appearance_switch_type">
								<strong>
									Fullpage
								</strong>
							</label>
						</div>
						<small class="d-block">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, tempora?
						</small>
					</div>
					<div class="form-group w-50">
						<label for="appearance_page_title">
							Page Title
						</label>
						<ValidationProvider v-slot="valiadtion" rules="required">
							<input id="appearance_page_title" v-model="appearance.pageTitle" type="text"
								class="form-control" :class="{ 'is-invalid': valiadtion.failedRules.required }">
							<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
								The page title is required
							</div>
						</ValidationProvider>
						<small class="d-block">
							Will appear on top of the picture.
						</small>
					</div>
					<div class="form-group w-50">
						<label for="appearance_page_header">
							Page Header
						</label>
						<ValidationProvider v-slot="valiadtion" rules="required">
							<input id="appearance_page_header" v-model="appearance.pageHeader" type="text"
								class="form-control" :class="{ 'is-invalid': valiadtion.failedRules.required }">
							<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
								The page header is required
							</div>
						</ValidationProvider>
						<small class="d-block">
							Will appear under the picture.
						</small>
					</div>
					<div class="form-group w-50">
						<label for="appearance_page_text">Body Text</label>
						<ValidationProvider v-slot="valiadtion" rules="required">
							<textarea id="appearance_page_text" v-model="appearance.bodyText" class="form-control"
								:class="{ 'is-invalid': valiadtion.failedRules.required }" rows="3"></textarea>
							<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
								The body text is required
							</div>
						</ValidationProvider>
						<small class="d-block">
							Will appear under the header text.
						</small>
					</div>
					<div class="form-group w-50">
						<label for="appearance_footer_text">
							Footer Text
						</label>
						<ValidationProvider v-slot="valiadtion" rules="required">
							<textarea id="appearance_footer_text" v-model="appearance.footerText" class="form-control"
								:class="{ 'is-invalid': valiadtion.failedRules.required }" rows="3"></textarea>
							<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
								The footer text is required
							</div>
						</ValidationProvider>
						<small class="d-block">
							Will appear in bold font under the body text.
						</small>
					</div>
					<div class="form-group w-50">
						<label for="appearance_button_text">
							Main Button Text
						</label>
						<ValidationProvider v-slot="valiadtion" rules="required">
							<input id="appearance_button_text" v-model="appearance.mainButtonText" type="text"
								class="form-control" :class="{ 'is-invalid': valiadtion.failedRules.required }"
								value="Book Now">
							<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
								The main button text is required
							</div>
						</ValidationProvider>
						<small class="d-block">
							Will appear inside on the booking button.
						</small>
					</div>
					<div class="mb-3 w-33">
						<div class="d-flex justify-content-between align-items-center">
							<label class="mb-0" for="appearance_button_color">
								Main Button Color
							</label>
							<input id="appearance_button_color" v-model="appearance.mainButtonColor" type="color"
								class="color-picker-sm rounded" value="#084ce3">
						</div>
					</div>
					
					<div class="mb-3 w-33">
						<div class="d-flex justify-content-between align-items-center">
							<label class="mb-0" for="appearance_button_text_color">
								Main Button Text Color
							</label>
							<input id="appearance_button_text_color" v-model="appearance.mainButtonTextColor"
								type="color" class="color-picker-sm rounded" value="#ffffff">
						</div>
					</div>
					<div class="mb-3 w-33">
						<div class="d-flex justify-content-between align-items-center">
							<label class="mb-0" for="appearance_font_color">
								Main Text Color
							</label>
							<input id="appearance_font_color" v-model="appearance.mainTextColor" type="color"
								class="color-picker-sm rounded" value="#000000">
						</div>
					</div>
					<div class="mb-3 w-33">
						<div class="d-flex justify-content-between align-items-center">
							<label class="mb-0 w-100 d-block" for="appearance_font">
								Main Font
							</label>
							<select id="appearance_font" v-model="appearance.mainFont" class="form-control">
								<option value="Helvetica">
									Helvetica
								</option>
								<option value="Roboto">
									Roboto
								</option>
								<option value="Arial">
									Arial
								</option>
								<option value="Noto Sans">
									Noto Sans
								</option>
							</select>
						</div>
					</div>
				</div>
				<CropperModal ref="photoCropperModal" :mode="avatar" @cropped="onPhotoCropped" />
			</form>
		</ValidationObserver>
	</div>
</template>

<script>
	import { ValidationObserver } from 'vee-validate';
	
	export default {
		components: {
			ValidationObserver,
			CropperModal: () => import('../../components/CropperModal'),
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
				validationFields: {},
				isLoading: false,
				selectedQuestion: null,
				selectedQuestionIndex: null,
				photoUrl: '',
				image: '',
				form: null,
				avatar: '4:1',
				appearance: {
					id: '',
					isMainPhotoEnabled: false,
					pageType: false,
					pageTitle: '',
					pageHeader: '',
					bodyText: '',
					footerText: '',
					mainButtonText: '',
					mainButtonColor: '#131111',
					mainButtonTextColor: '#131111',
					mainTextColor: '#131111',
					mainFont: 'Arial',
					url: '',
				},
			};
		},
		
		created() {
			this.buildForm();
			if (this.form.appearances[0]) {
				this.appearance = this.form.appearances[0];
				this.appearance.pageType = this.form.appearances[0].pageType === 'FULL_PAGE';
			}
		},
		
		methods: {
			buildForm() {
				this.form = {
					appearances: this.bookingType.id ? this.bookingType.appearances.map((bookingTypeAppearances) => {
						return {
							id: bookingTypeAppearances.id,
							isMainPhotoEnabled: bookingTypeAppearances.isMainPhotoEnabled,
							pageType: bookingTypeAppearances.pageType,
							pageTitle: bookingTypeAppearances.pageTitle,
							pageHeader: bookingTypeAppearances.pageHeader,
							bodyText: bookingTypeAppearances.bodyText,
							footerText: bookingTypeAppearances.footerText,
							mainButtonText: bookingTypeAppearances.mainButtonText,
							mainButtonColor: bookingTypeAppearances.mainButtonColor,
							mainButtonTextColor: bookingTypeAppearances.mainButtonTextColor,
							mainTextColor: bookingTypeAppearances.mainTextColor,
							mainFont: bookingTypeAppearances.mainFont,
							url: bookingTypeAppearances.photo.url,
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
			
			async save() {
				this.isLoading = true;
				if (!await this.$refs.validationObserver.validate()) {
					this.isLoading = false;
					return;
				}
				
				this.appearance.pageType = this.appearance.pageType ? 'FULL_PAGE' : 'PROCEDURAL';
				
				let formData = new FormData();
				formData.append('booking_type[appearances][0][id]', this.appearance.id);
				formData.append('booking_type[appearances][0][is_main_photo_enabled]', this.appearance.isMainPhotoEnabled ? 1 : 0);
				formData.append('booking_type[appearances][0][page_type]', this.appearance.pageType);
				formData.append('booking_type[appearances][0][page_title]', this.appearance.pageTitle);
				formData.append('booking_type[appearances][0][page_header]', this.appearance.pageHeader);
				formData.append('booking_type[appearances][0][body_text]', this.appearance.bodyText);
				formData.append('booking_type[appearances][0][footer_text]', this.appearance.footerText);
				formData.append('booking_type[appearances][0][main_button_text]', this.appearance.mainButtonText);
				formData.append('booking_type[appearances][0][main_button_color]', this.appearance.mainButtonColor);
				formData.append('booking_type[appearances][0][main_button_text_color]', this.appearance.mainButtonTextColor);
				formData.append('booking_type[appearances][0][main_text_color]', this.appearance.mainTextColor);
				formData.append('booking_type[appearances][0][main_font]', this.appearance.mainFont);
				formData.append('booking_type[appearances][0][image]', this.image);
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, formData);
				
				this.appearance.pageType = this.appearance.pageType === 'FULL_PAGE';
				
				if (!this.bookingType.id) {
					return;
				}
				
				this.isLoading = false;
				
				this.close({ animate: !!this.bookingType.id });
			},
			
			onPhotoFileSelected() {
				this.$refs.photoCropperModal.show(this.$refs.photoFile.files[0]);
			},
			
			getPhoto(event) {
				this.image = event.target.files[0];
				this.photoUrl = URL.createObjectURL(event.target.files[0]);
			},
			
			remove() {
				this.photoUrl = '';
			},
			
			onPhotoCropped({ blob, base64, fileName }) {
				this.photoUrl = base64;
				this.image = blob;
			},
		},
	};
</script>

<style lang="scss" scoped>
	.file-uploader {
		min-height: 100px;
		position: relative;
		cursor: pointer;
		
		&-overlay {
			position: absolute;
			left: 0;
			right: 0;
			bottom: 0;
			top: 0;
			background: rgba(0, 0, 0, .3);
		}
		
		& > img {
			position: relative;
			z-index: 10;
		}
		
		&-overlay, & > img {
			opacity: 0;
			visibility: hidden;
			transition: all .3s ease;
		}
		
		&:hover {
			.file-uploader-overlay, & > img {
				opacity: 1;
				visibility: visible;
			}
		}
	}
	
	.file-uploader {
		background-position: 50% 50%;
		background-repeat: no-repeat;
		background-size: cover;
	}
	
	.cropper-rounded .cropper-crop-box, .cropper-rounded .cropper-view-box {
		border-radius: 0%;
	}
	
	.cropper-crop-box, .cropper-view-box {
		border-radius: 0 !important;
	}
</style>

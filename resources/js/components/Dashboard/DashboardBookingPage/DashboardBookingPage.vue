<template>
	<div>
		<div v-if="pageIsLoading" class="h-100 d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 65px);">
			<span><img src="/img/preloader.svg" width="40" alt=""></span>
		</div>
		<div v-else>
			<div class="container-fluid shadow-sm p-4 admin_main">
				<div class="container">
					<div class="row">
						<div class="col-lg-3 d-flex">
							<router-link class="btn btn-primary d-flex align-items-center"
								:to="{ name: 'dashboard.home' }">
								<img src="/img/back.svg" alt="" width="12">
								<span class="ml-2">Back</span>
							</router-link>
						</div>
						<div class="col-lg-6 d-flex align-items-center justify-content-center">
							<h5 v-if="bookingPage.id" class="mb-0">
								Edit Booking Page
							</h5>
							<h5 v-else class="mb-0">
								Create New Booking Page
							</h5>
						</div>
						<div class="col-lg-3 d-flex align-items-center justify-content-end"></div>
					</div>
				</div>
			</div>
			<div class="container-fluid pt-4 pb-4">
				<div class="container">
					<form v-if="form" class="card" @submit.prevent="saveData">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group mb-1">
										<label :for="`${_uid}-title-input`">Booking Page title</label>
										<input v-if="form.useUserNameAsTitle" :id="`${_uid}-title-input`" type="text"
											class="form-control"
											:class="{ 'is-invalid': validationFields['booking_page.title'] }"
											aria-describedby="emailHelp" :value="bookingPage.assignedUser.fullName"
											disabled>
										<input v-else :id="`${_uid}-title-input`" ref="useUserNameAsTiteInput" v-model="form.title"
											type="text" class="form-control"
											:class="{ 'is-invalid': validationFields['booking_page.title'] }"
											aria-describedby="emailHelp" placeholder="Enter Booking Page title">
										<div v-if="validationFields['booking_page.title']" class="invalid-feedback">
											{{ validationFields['booking_page.title'][0] }}
										</div>
									</div>
									<div class="form-check mb-3">
										<input :id="`${_uid}-use-user-name-checkbox`" v-model="form.useUserNameAsTitle"
											type="checkbox" class="form-check-input"
											@change="onUseUserNameAsTitleChanged">
										<label class="form-check-label" :for="`${_uid}-use-user-name-checkbox`">
											Use user name as title
										</label>
									</div>
									<div class="form-group">
										<label :for="`${_uid}-link-input`">Booking Page link *</label>
										<small v-if="bookingPage.id" class="d-block text-secondary mb-2">
											Changing your Bookify URL will mean that all of your copied links will no longer work and will need to be updated.
										</small>
										<div class="input-group mb-2">
											<div class="input-group-prepend">
												<span id="basic-addon1" class="input-group-text">bookify.ai/</span>
											</div>
											<input :id="`${_uid}-link-input`" v-model="form.slug" type="text"
												class="form-control" :class="{
													'is-invalid': validationFields['booking_page.slug'],
													'is-valid': slugIsValid === true,
												}" placeholder="your-username" aria-label="Username"
												aria-describedby="basic-addon1" @input="onBookingPageSlugChanged">
											<div v-if="validationFields['booking_page.slug']" class="invalid-feedback">
												{{ validationFields['booking_page.slug'][0] }}
											</div>
										</div>
									</div>
									<div class="form-group mb-2">
										<label for="exampleInputName2">User Avatar</label>
										<div v-if="form.useUserAvatarAsUserAvatar" class="d-flex align-items-center">
											<div style="width: 90px;">
												<img alt="" :src="bookingPage.assignedUser.avatar.url"
													style="width: 90px; height: 90px; border-radius: 50%;">
											</div>
										</div>
										<div v-else-if="form.userAvatar.id" class="d-flex align-items-center">
											<div style="width: 90px;">
												<img alt="" :src="form.userAvatar.url"
													style="width: 90px; height: 90px; border-radius: 50%;">
											</div>
											<div class="ml-3">
												<label class="btn btn-outline-primary mb-0">
													Update
													<input ref="userAvatarFile" type="file" class="d-none"
														@change="onUserAvatarFileSelected">
												</label>
												<button class="btn btn-outline-secondary" @click="removeUserAvatar">
													Remove
												</button>
											</div>
										</div>
										<div v-else class="d-flex align-items-center">
											<div style="width: 90px;">
												<img src="/img/avatar.png" alt=""
													style="width: 90px; height: 90px; border-radius: 50%;">
											</div>
											<div class="ml-3">
												<div>
													<label class="btn btn-outline-primary mb-0">
														Upload Picture
														<input ref="userAvatarFile" type="file" class="d-none"
															@change="onUserAvatarFileSelected">
													</label>
												</div>
												<span class="text-secondary">
													<small>JPG, GIF or PNG. Max size of 5MB.</small>
												</span>
											</div>
										</div>
									</div>
									<div class="form-check mb-3">
										<input :id="`${_uid}-use-user-image-checkbox`" v-model="form.useUserAvatarAsUserAvatar"
											type="checkbox" class="form-check-input">
										<label class="form-check-label" :for="`${_uid}-use-user-image-checkbox`">
											Use user avatar as Booking Page user avatar
										</label>
									</div>
									<div class="form-group">
										<label for="exampleInputName2">Logo</label>
										<div
											class="image d-flex justify-content-center align-items-center border rounded mb-3"
											style="width: 100%; height: 174px;">
											<img v-if="form.logo.id" alt="" :src="form.logo.url"
												style="max-width: 220px; max-height: 120px;">
											<strong v-else>No Logo</strong>
										</div>
										<div v-if="form.logo.id">
											<label class="btn btn-outline-primary mb-0">
												Update
												<input ref="logoFile" type="file" class="d-none"
													@change="onLogoFileSelected">
											</label>
											<button class="btn btn-outline-secondary" @click="removeLogo">
												Remove
											</button>
										</div>
										<div v-else class="d-flex align-items-center justify-content-between">
											<label class="btn btn-outline-primary mb-0">
												Upload Image
												<input ref="logoFile" type="file" class="d-none"
													@change="onLogoFileSelected">
											</label>
											<span>
												<small class="text-secondary">JPG, GIF or PNG. Max size of 5MB.</small>
											</span>
										</div>
										<div v-if="false" class="custom-control custom-checkbox my-1 mr-sm-2 mb-4">
											<input id="customControlInline" type="checkbox"
												class="custom-control-input">
											<label class="custom-control-label"
												for="customControlInline">Enforce this display for all users</label>
											<div
												class="circle d-inline-block ml-4 rounded-circle border text-center text-secodary pb-1"
												title="Use this setting to ensure the event type pages for all users and teams have the same logo display. Checking this box will also restrict users without admin permissions to use their own logo."
												style="cursor: pointer; width: 20px; height: 20px; line-height: 20px;">
												?
											</div>
										</div>
									</div>
									<hr>
									<div class="col-lg-12 mb-4">
										<div class="row justify-content-between align-items-center">
											<label for="customSwitch1">Bookify Branding</label>
											<div class="custom-control custom-switch">
												<input id="customSwitch1" type="checkbox" class="custom-control-input">
												<label class="custom-control-label" for="customSwitch1"></label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-flex justify-content-end">
								<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
									:disabled="isLoading">
									Save Changes
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<CropperModal ref="userAvatarCropperModal" mode="avatar" @cropped="onUserAvatarCropped" />
		<CropperModal ref="logoCropperModal" mode="logo" @cropped="onLogoCropped" />
	</div>
</template>

<script>
	export default {
		components: {
			CropperModal: () => import('../../components/CropperModal'),
		},
		
		data() {
			return {
				isLoading: false,
				form: null,
				
				bookingPage: {
					id: null,
					slug: null,
					title: null,
					useUserNameAsTitle: true,
					useUserAvatarAsUserAvatar: true,
					assignedUser: this.$store.state.auth.user,
				},
				
				pageIsLoading: true,
				slugIsValid: false,
				validationFields: {},
			};
		},
		
		async mounted() {
			if (this.$router.currentRoute.params.bookingPageId) {
				await this.getBookingPage();
			}
			
			console.log('GOT BOOKING PAGE', this.bookingPage);
			this.pageIsLoading = false;
			this.buildForm();
		},
		
		methods: {
			buildForm() {
				this.form = {
					title: this.bookingPage.title,
					slug: this.bookingPage.slug,
					useUserNameAsTitle: this.bookingPage.useUserNameAsTitle,
					
					userAvatar: {
						...this.bookingPage.userAvatar,
						blob: null,
						fileName: null,
						isUpdated: false,
					},
					
					useUserAvatarAsUserAvatar: this.bookingPage.useUserAvatarAsUserAvatar,
					
					logo: {
						...this.bookingPage.logo,
						blob: null,
						fileName: null,
						isUpdated: false,
					},
				};
			},
			
			async getBookingPage() {
				let response = await this.$http.get('/booking_pages/' + this.$router.currentRoute.params.bookingPageId, {
					params: {
						include: ['user'],
					},
				});
				
				this.bookingPage = response.data.data;
			},
			
			onBookingPageSlugChanged() {
				//
			},
			
			onUseUserNameAsTitleChanged() {
				if (!this.form.useUserNameAsTitle) {
					this.$nextTick(() => {
						this.$refs.useUserNameAsTiteInput.focus();
					});
				}
			},
			
			onUserAvatarFileSelected() {
				this.$refs.userAvatarCropperModal.show(this.$refs.userAvatarFile.files[0]);
			},
			
			onUserAvatarCropped({ blob, base64, fileName }) {
				this.form.userAvatar.id = 'new';
				this.form.userAvatar.blob = blob;
				this.form.userAvatar.url = base64;
				this.form.userAvatar.fileName = fileName;
				this.form.userAvatar.isUpdated = true;
			},
			
			removeUserAvatar() {
				this.form.userAvatar.id = null;
				this.form.userAvatar.blob = null;
				this.form.userAvatar.url = null;
				this.form.userAvatar.fileName = null;
				this.form.userAvatar.isUpdated = true;
			},
			
			onLogoFileSelected() {
				this.$refs.logoCropperModal.show(this.$refs.logoFile.files[0]);
			},
			
			onLogoCropped({ blob, base64, fileName }) {
				this.form.logo.id = 'new';
				this.form.logo.blob = blob;
				this.form.logo.url = base64;
				this.form.logo.fileName = fileName;
				this.form.logo.isUpdated = true;
			},
			
			removeLogo() {
				this.form.logo.id = null;
				this.form.logo.blob = null;
				this.form.logo.url = null;
				this.form.logo.fileName = null;
				this.form.logo.isUpdated = true;
			},
			
			async saveData() {
				this.isLoading = true;
				
				try {
					let formData = new FormData();
					formData.append('booking_page[title]', this.form.title);
					formData.append('booking_page[slug]', this.form.slug);
					formData.append('booking_page[use_user_name_as_title]', this.form.useUserNameAsTitle ? '1' : '0');
					
					if (this.form.userAvatar.isUpdated) {
						if (this.form.userAvatar.blob) {
							formData.append('booking_page[user_avatar_file]', this.form.userAvatar.blob, this.form.userAvatar.fileName);
						} else {
							formData.append('booking_page[user_avatar_file]', '');
						}
					}
					
					formData.append('booking_page[use_user_avatar_as_user_avatar]', this.form.useUserAvatarAsUserAvatar ? '1' : '0');
					
					if (this.form.logo.isUpdated) {
						if (this.form.logo.blob) {
							formData.append('booking_page[logo_file]', this.form.logo.blob, this.form.logo.fileName);
						} else {
							formData.append('booking_page[logo_file]', '');
						}
					}
					
					let requestUrl = this.bookingPage.id ? `/booking_pages/${this.bookingPage.id}/update` : `/booking_pages/create`;
					await this.$http.post(requestUrl, formData);
					
					this.$notify({
						text: 'Booking Page has been saved!',
						type: 'success',
					});
					
					this.isLoading = false;
					this.validationFields = {};
				} catch (error) {
					this.isLoading = false;
					
					if (error.response && error.response.data.error === 'Validation') {
						this.validationFields = error.response.data.validationFields;
						return;
					}
					
					throw error;
				}
			},
		},
	};
</script>

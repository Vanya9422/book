<template>
	<div class="card dashboard-booking-type-invitee-questions">
		<div :id="`${_uid}-header`" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link collapsed no-bg-on-hover text-left">
							File Upload(s)
							<div>
								<small class="text-secondary text-left d-block">
									Allow users to upload files.
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
		<form v-if="form" ref="form" class="border-top collapse" @submit.prevent>
			<div class="card-body">
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<div class="d-flex align-items-center">
							<div class="form-group mb-0 mr-2">
								<span class="switch switch-sm">
									<input id="file_upload" v-model="form.isFileUploadEnabled" type="checkbox"
										class="switch" checked="checked">
									<label class="m-0" for="file_upload"></label>
								</span>
							</div>
							<label class="mb-0" for="file_upload">
								<strong>
									Allow File Uploading
								</strong>
							</label>
						</div>
						<small class="d-block">
							This will show a box for users to upload files via drag and drop.
						</small>
					</div>
					<button v-if="form.isFileUploadEnabled" class="btn btn-primary" data-toggle="modal"
						data-target="#add_upload_section" @click="uploadSectionModal">
						Add Upload Section
					</button>
				</div>
				<div v-if="form.isFileUploadEnabled" class="w-100">
					<Draggable handle=".handle" :list="form.uploads" @end="onUploadsMoved">
						<div v-for="(uploadItem, uploadItemIndex) in form.uploads" :key="uploadItem.id"
							class="d-flex align-items-center mb-3 mt-3">
							<div class="d-flex align-items-center">
								<div class="form-group mb-0 mr-2">
									<span class="switch switch-sm">
										<input :id="`${uploadItemIndex}-some_id`" v-model="uploadItem.isEnabled"
											type="checkbox" class="switch" checked="checked">
										<label class="m-0" :for="`${uploadItemIndex}-some_id`"></label>
									</span>
								</div>
								<div class="handle is-only-has-image mr-2">
									<img src="/img/drag.svg" alt="" width="20" style="opacity: .3;">
								</div>
							</div>
							<div class="card card-body">
								<div class="d-flex justify-content-between align-items-center">
									<div class="text-secondary">
										{{ uploadItem.title }}
									</div>
									<div class="d-flex align-items-center">
										<button class="btn btn-link mr-2" style="font-size: 0;" data-toggle="modal"
											@click="openUploadModal(uploadItemIndex, uploadItem)">
											<img src="/img/edit.svg" alt="" width="15" style="opacity: .3;">
										</button>
										<button class="btn btn-link mr-2" style="font-size: 0;" data-toggle="modal"
											@click="openDeleteModal(uploadItemIndex)">
											<img src="/img/delete.svg" alt="" width="15" style="opacity: .3;">
										</button>
									</div>
								</div>
							</div>
						</div>
					</Draggable>
				</div>
			</div>
		</form>
		<!-- Modal -->
		<ValidationObserver ref="validationObserver">
			<div id="add_upload_section" ref="uploadSectionModal" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 v-if="uploadIndex === null" id="exampleModalLabel" class="modal-title">
								Add Upload Section
							</h5>
							<h5 v-else id="exampleModalLabel" class="modal-title">
								Edit Upload Section
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="mb-3">
								<div class="d-flex align-items-center">
									<div class="form-group mb-0 mr-2">
										<span class="switch switch-sm">
											<input id="file_required" v-model="upload.isRequired" type="checkbox"
												class="switch" checked="checked">
											<label class="m-0" for="file_required"></label>
										</span>
									</div>
									<label class="mb-0" for="file_required">
										<strong>
											Make this File Upload required
										</strong>
									</label>
								</div>
								<small class="d-block">
									This will make the file upload non-optional.
									Users will absolutely have to upload a file to continue.
								</small>
							</div>
							<div class="form-group">
								<label class="mb-0" for="upload_text">
									Upload Box Text
								</label>
								<small class="d-block mb-2">
									This text will appear inside the upload box as the main line.
								</small>
								<ValidationProvider v-slot="valiadtion" rules="required">
									<input id="upload_text" v-model="upload.uploadBoxText" type="text"
										name="upload_box_text" class="form-control"
										:class="{ 'is-invalid': valiadtion.failedRules.required }"
										aria-describedby="title">
									<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
										The upload box text is required
									</div>
								</ValidationProvider>
							</div>
							<div class="form-group">
								<label class="mb-0" for="upload_description">
									Upload Box Description
								</label>
								<small class="d-block mb-2">
									This text will appear inside the upload box as the second line, with smaller text.
								</small>
								<ValidationProvider v-slot="valiadtion" rules="required">
									<input id="upload_description" v-model="upload.uploadBoxDescription" type="text"
										name="upload_box_description" class="form-control"
										:class="{ 'is-invalid': valiadtion.failedRules.required }"
										aria-describedby="title">
									<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
										The upload box description text is required
									</div>
								</ValidationProvider>
							</div>
							<div class="form-group">
								<label class="mb-0" for="file_title">Title</label>
								<small class="d-block mb-2">This sets the title of the Upload File section.</small>
								<ValidationProvider v-slot="valiadtion" rules="required">
									<input id="file_title" v-model="upload.title" type="text" name="title"
										class="form-control" :class="{ 'is-invalid': valiadtion.failedRules.required }"
										aria-describedby="title">
									<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
										The title text is required
									</div>
								</ValidationProvider>
							</div>
							<div class="form-group">
								<label class="mb-0" for="file_description">
									Description
								</label>
								<small class="d-block mb-2">
									This will set the description under the whole upload process.
								</small>
								<ValidationProvider v-slot="valiadtion" rules="required">
									<textarea id="file_description" v-model="upload.description" name="description"
										class="form-control" :class="{ 'is-invalid': valiadtion.failedRules.required }"
										rows="3"></textarea>
									<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
										The description text is required
									</div>
								</ValidationProvider>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
							<button v-if="uploadIndex === null" type="button" class="btn btn-primary"
								@click="saveUpload">
								Add
							</button>
							<button v-else type="button" class="btn btn-primary" @click="saveUpload">
								Edit
							</button>
						</div>
					</div>
				</div>
			</div>
		</ValidationObserver>
		<!-- Modal -->
		<div id="delete_upload_section" ref="deleteModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Delete Upload Section
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Are you sure that you wish to delete this upload section ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							No
						</button>
						<button type="button" class="btn btn-primary" @click="deleteUpload">
							Yes
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { ValidationObserver } from 'vee-validate';
	import Draggable from 'vuedraggable';
	
	export default {
		components: {
			ValidationObserver,
			Draggable,
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
				form: null,
				isOpen: !this.bookingType.id,
				validationFields: {},
				isLoading: false,
				upload: null,
				uploadIndex: null,
			};
		},
		
		created() {
			this.upload = {
				uploadBoxText: '',
				uploadBoxDescription: '',
				title: '',
				description: '',
				isEnabled: true,
				isRequired: true,
			};
		},
		
		mounted() {
			this.buildForm();
		},
		
		methods: {
			buildForm() {
				this.form = {
					isFileUploadEnabled: this.bookingType.id ? this.bookingType.isFileUploadEnabled : false,
					
					uploads: this.bookingType.id ? this.bookingType.uploads.map((bookingTypeUpload) => {
						return {
							id: bookingTypeUpload.id,
							uploadBoxText: bookingTypeUpload.uploadBoxText,
							uploadBoxDescription: bookingTypeUpload.uploadBoxDescription,
							title: bookingTypeUpload.title,
							description: bookingTypeUpload.description,
							isEnabled: bookingTypeUpload.isEnabled,
							isRequired: bookingTypeUpload.isRequired,
							position: bookingTypeUpload.position,
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
			
			async saveUpload() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				if (this.uploadIndex !== null) {
					this.form.uploads[this.uploadIndex] = this.upload;
					this.upload = { ...this.form.uploads[this.uploadIndex] };
				} else {
					this.form.uploads.push(this.upload);
				}
				
				$(this.$refs.uploadSectionModal).modal('hide');
			},
			
			uploadSectionModal() {
				this.upload = {
					uploadBoxText: '',
					uploadBoxDescription: '',
					title: '',
					description: '',
					isEnabled: true,
					isRequired: true,
				};
				
				this.uploadIndex = null;
			},
			
			openUploadModal(uploadItemIndex, uploadItem) {
				$(this.$refs.uploadSectionModal).modal('show');
				this.upload = { ...this.form.uploads[uploadItemIndex] };
				this.uploadIndex = uploadItemIndex;
			},
			
			openDeleteModal(uploadItemIndex) {
				this.uploadIndex = uploadItemIndex;
				$(this.$refs.deleteModal).modal('show');
			},
			
			async deleteUpload() {
				this.form.uploads.splice(this.uploadIndex, 1);
				this.uploadIndex = null;
				$(this.$refs.deleteModal).modal('hide');
			},
			
			async save() {
				this.isLoading = true;
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
					bookingType: this.form,
				});
				
				if (!this.bookingType.id) {
					return;
				}
				
				this.isLoading = false;
				
				this.close({ animate: !!this.bookingType.id });
			},
			
			async onUploadsMoved() {
				$.each(this.form.uploads, function (key, upload) {
					upload.position = key;
				});
			},
		},
	};
</script>

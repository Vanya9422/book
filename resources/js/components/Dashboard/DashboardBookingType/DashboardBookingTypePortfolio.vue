<template>
	<div class="card dashboard-booking-type-invitee-portfolio">
		<div id="headingThree" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link collapsed no-bg-on-hover text-left">
							Portfolio
							<div>
								<small class="text-secondary text-left d-block">
									Manage portfolio sections and photos.
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
				<div class="d-flex justify-content-between align-items-center mb-4">
					<div>
						<p>
							You can add multiple sections and inside you can add many photos.
						</p>
						<div class="d-flex align-items-center">
							<div class="form-group mb-0 mr-2">
								<span class="switch switch-sm">
									<input id="enable_portfilio" v-model="form.isPortfolioEnabled" type="checkbox"
										class="switch" checked="checked">
									<label class="m-0" for="enable_portfilio"></label>
								</span>
							</div>
							<label class="mb-0" for="enable_portfilio">
								<strong>
									Enable Portfolio
								</strong>
							</label>
						</div>
						<small>
							If you enable a portfolio be sure to add sections first then add photos inside .
						</small>
					</div>
					<button v-if="form.isPortfolioEnabled" class="btn btn-primary" data-toggle="modal"
						data-target="#add_portfolio_section" @click="addSection">
						Add Section
					</button>
				</div>
				<div v-if="form.isPortfolioEnabled" class="w-100">
					<Draggable handle=".handle" :list="form.portfolios" :options="{ group: 'portfolioItem' }"
						@end="onPortfoliosMoved">
						<div v-for="(portfolioItem, portfolioItemIndex) in form.portfolios" :key="portfolioItem.id"
							class="d-flex align-items-center mb-3 mt-3">
							<div class="d-flex align-items-center">
								<div class="form-group mb-0 mr-2">
									<span class="switch switch-sm">
										<input :id="`events_switch-${portfolioItemIndex}`"
											v-model="portfolioItem.isEnabled" type="checkbox" class="switch"
											checked="checked">
										<label class="m-0" :for="`events_switch-${portfolioItemIndex}`"></label>
									</span>
								</div>
								<div class="handle is-only-has-image mr-2">
									<img src="/img/drag.svg" alt="" width="20" style="opacity: .3;">
								</div>
							</div>
							<div class="card card-body">
								<div class="d-flex align-items-center justify-content-between">
									<button type="button" class="btn btn-link" data-toggle="collapse"
										:href="`#multiCollapseExample-${portfolioItemIndex}`" role="button"
										aria-expanded="false"
										:aria-controls="`multiCollapseExample-${portfolioItemIndex}`">
										{{ portfolioItem.name }}
									</button>
									<button class="btn btn-primary" data-toggle="modal" data-target="#add_photo"
										@click="addPhoto(portfolioItemIndex, portfolioItem.id)">
										Add Photo
									</button>
								</div>
								<div :id="`multiCollapseExample-${portfolioItemIndex}`"
									class="collapse multi-collapse mt-3">
									<Draggable :key="portfolioItemIndex" handle=".photo-handle" @end="onPhotosMoved">
										<div v-for="(photoItem, photoItemIndex) in portfolioItem.photos"
											:key="photoItem.id" class="d-flex align-items-center mt-2 mb-2">
											<div class="photo-handle is-only-has-image mr-2">
												<img src="/img/drag.svg" alt="" width="20" style="opacity: .3;">
											</div>
											
											<div class="rounded overflow-hidden">
												<div v-if="photoItem.photo" class="portfolio-image"
													:style="{ 'background-image': 'url(' + photoItem.photo.url.replace('/', '') + ')' }"></div>
												<div v-else class="portfolio-image"
													:style="{ 'background-image': 'url(' + photoItem.url + ')' }"></div>
											</div>
											<div class="col pr-0 d-flex align-items-center justify-content-between">
												<div>
													<strong class="d-block mb-2">{{ photoItem.title }}</strong>
													<span>{{ photoItem.description }}</span>
												</div>
												<div class="d-flex">
													<button class="btn btn-link mr-2" data-toggle="modal"
														data-target="#add_photo"
														@click="editPhoto(portfolioItemIndex, photoItemIndex)">
														<img src="/img/edit.svg" alt="" width="15" style="opacity: .3;">
													</button>
													
													<button class="btn btn-link" data-toggle="modal"
														data-target="#delete_photo"
														@click="getPhotoIndex(portfolioItemIndex, photoItemIndex)">
														<img src="/img/delete.svg" alt="" width="15"
															style="opacity: .3;">
													</button>
												</div>
											</div>
										</div>
									</Draggable>
								</div>
							</div>
						</div>
					</Draggable>
				</div>
			</div>
		</form>
		<!-- Modal -->
		<ValidationObserver ref="validationObserver">
			<div id="add_portfolio_section" ref="portfolioSectionModal" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 id="exampleModalLabel" class="modal-title">
								Add Portfolio Section
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label for="section_name">
									Section Name
								</label>
								<ValidationProvider v-slot="valiadtion" rules="required">
									<input id="section_name" v-model="portfolio.name" type="text" class="form-control"
										:class="{ 'is-invalid': valiadtion.failedRules.required }">
									<div v-if="valiadtion.failedRules.required" class="invalid-feedback ">
										The section name is required
									</div>
								</ValidationProvider>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
							<button type="button" class="btn btn-primary" @click="savePortfolio">
								Save changes
							</button>
						</div>
					</div>
				</div>
			</div>
		</ValidationObserver>
		<!-- Modal -->
		<ValidationObserver ref="validationObserver">
			<div id="add_photo" ref="addPhotoModal" class="modal fade" tabindex="-1" role="dialog"
				aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 id="exampleModalLabel" class="modal-title">
								Add Photo
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="custom-file mb-3">
								<input id="photo_chooser" type="file" class="custom-file-input"
									@change="getPhoto($event)">
								<label class="custom-file-label" for="photo_chooser">{{ photoName }}</label>
							</div>
							<div class="form-group">
								<label for="photo_title">
									Title (Optional)
								</label>
								<input id="photo_title" v-model="photo.title" type="text" class="form-control">
							</div>
							<div class="form-group mb-0">
								<label for="photo_description">
									Description (Optional)
								</label>
								<textarea id="photo_description" v-model="photo.description" class="form-control"
									rows="3"></textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
							<button v-if="photoIndex === null" type="button" class="btn btn-primary"
								@click="savePhoto">
								Add
							</button>
							<button v-else type="button" class="btn btn-primary" @click="savePhoto">
								Edit
							</button>
						</div>
					</div>
				</div>
			</div>
		</ValidationObserver>
		<!-- Modal -->
		<div id="delete_photo" ref="deletePhotoModal" class="modal fade" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Delete Photo
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Are you sure that you wish to delete this photo ?
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							No
						</button>
						<button type="button" class="btn btn-primary" @click="deletePhoto">
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
				selectedQuestion: null,
				selectedQuestionIndex: null,
				portfolio: null,
				portfolioIndex: null,
				photo: null,
				isEnabledByIndex: [],
				photoIndex: null,
				name: '',
				photos: [],
				photoName: 'Choose Photo from Device',
				ids: [],
			};
		},
		
		created() {
			this.portfolio = {
				name: '',
				photos: [],
				isEnabled: true,
			};
			
			this.photo = {
				id: '',
				bookingTypePortfolioId: '',
				title: '',
				position: 1,
				image: '',
				isEnabled: '',
				url: '',
			};
		},
		
		mounted() {
			this.buildForm();
		},
		
		methods: {
			buildForm() {
				this.form = {
					isPortfolioEnabled: this.bookingType.id ? this.bookingType.isPortfolioEnabled : false,
					portfolios: this.bookingType.id ? this.bookingType.portfolios.map((bookingTypePortfolio) => {
						return {
							id: bookingTypePortfolio.id,
							name: bookingTypePortfolio.name,
							isEnabled: bookingTypePortfolio.isEnabled,
							photos: bookingTypePortfolio.photos,
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
			
			addSection() {
				this.portfolio = {
					name: '',
					photos: [],
					isEnabled: true,
				};
			},
			
			async savePortfolio() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				if (this.portfolioIndex !== null) {
					this.form.portfolios[this.portfolioIndex] = this.portfolio;
					this.portfolioIndex = null;
				} else {
					this.form.portfolios.push(this.portfolio);
					this.portfolioIndex = null;
					$(this.$refs.portfolioSectionModal).modal('hide');
				}
			},
			
			async save() {
				this.isLoading = true;
				
				await this.$http.post(`/booking_types/${this.bookingType.id}/update`, {
					bookingType: this.form,
				});
				
				this.photos.forEach((value, index) => {
					let formData = new FormData();
					formData.append('id', value.id);
					formData.append('bookingTypePortfolioId', value.bookingTypePortfolioId);
					formData.append('title', value.title);
					formData.append('position', value.position);
					formData.append('description', value.description);
					formData.append('image', value.image);
					formData.append('isEnabled', value.isEnabled);
					this.$http.post(`/booking_types/portfolio_photos`, formData);
				});
				
				await this.$http.post(`/booking_types/portfolio_photos`, {
					deletePhotos: this.ids,
					type: 'delete',
				});
				
				if (!this.bookingType.id) {
					return;
				}
				
				this.isLoading = true;
				
				this.close({ animate: !!this.bookingType.id });
			},
			
			async onPortfoliosMoved() {
				$.each(this.form.portfolios, function (key, portfolio) {
					portfolio.position = key;
				});
			},
			
			async onPhotosMoved() {
				$.each(this.photos, function (key, portfolio) {
					portfolio.position = key;
				});
			},
			
			addPhoto(portfolioItemIndex, portfolioId) {
				this.portfolioIndex = portfolioItemIndex;
				this.photoIndex = null;
				this.photoName = 'Choose Photo from Device';
				this.photo = {
					id: '',
					bookingTypePortfolioId: '',
					title: '',
					position: 1,
					description: '',
					image: '',
					isEnabled: this.isEnabledByIndex[this.portfolioIndex],
					url: '',
				};
				
				this.photo.bookingTypePortfolioId = portfolioId;
			},
			
			getPhoto(event) {
				this.photo.image = event.target.files[0];
				this.photoName = event.target.files[0].name;
				this.photo.url = URL.createObjectURL(event.target.files[0]);
			},
			
			async savePhoto() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				if (this.photoIndex !== null) {
					this.form.portfolios[this.portfolioIndex].photos[this.photoIndex] = this.photo;
					this.form.portfolios[this.portfolioIndex].name = this.name;
					this.photos.push(this.photo);
					this.portfolioIndex = null;
					$(this.$refs.addPhotoModal).modal('hide');
				} else {
					this.form.portfolios[this.portfolioIndex].photos.push(this.photo);
					this.photoIndex = null;
					this.photos.push(this.photo);
					$(this.$refs.addPhotoModal).modal('hide');
				}
			},
			
			editPhoto(portfolioItemIndex, photoIndex) {
				this.portfolioIndex = portfolioItemIndex;
				this.photoIndex = photoIndex;
				this.photo.title = this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].title;
				this.photo.description = this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].description;
				this.name = this.form.portfolios[this.portfolioIndex].name + ' ';
				this.photo.bookingTypePortfolioId = this.form.portfolios[this.portfolioIndex].id;
				this.photo.id = this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].id;
				this.photo.isEnabled = this.isEnabledByIndex[this.portfolioIndex];
				
				this.photoName = this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].media
					? this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].media[0].fileName : this.photoName;
			},
			
			getPhotoIndex(portfolioItemIndex, photoItemIndex) {
				this.portfolioIndex = portfolioItemIndex;
				this.photoIndex = photoItemIndex;
			},
			
			deletePhoto() {
				this.ids.push(this.form.portfolios[this.portfolioIndex].photos[this.photoIndex].id);
				this.form.portfolios[this.portfolioIndex].photos.splice(this.photoIndex, 1);
				this.portfolioIndex = null;
				this.photoIndex = null;
				$(this.$refs.deletePhotoModal).modal('hide');
			},
		},
	};
</script>

<style lang="scss" scoped>
	.portfolio-image {
		width: 150px;
		padding-bottom: 56.6%;
		background-position: 50% 50%;
		background-size: cover;
	}
</style>

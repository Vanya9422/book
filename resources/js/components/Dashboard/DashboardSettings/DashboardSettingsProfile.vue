<template>
	<div>
		<form v-if="form" class="card" @submit.prevent="saveData">
			<div class="card-body">
				<div class="form-group">
					<div v-if="form.avatar.id" class="d-flex align-items-center">
						<div style="width: 90px;">
							<img alt="" :src="form.avatar.url" style="width: 90px; height: 90px; border-radius: 50%;">
						</div>
						<div class="ml-3">
							<label class="btn btn-outline-primary mb-0">
								Update
								<input ref="avatarFile" type="file" class="d-none" @change="onAvatarFileSelected">
							</label>
							<button class="btn btn-outline-secondary" @click="removeAvatar">
								Remove
							</button>
						</div>
					</div>
					<div v-else class="d-flex align-items-center">
						<div style="width: 90px;">
							<img src="/img/avatar.png" alt="" style="width: 90px; height: 90px; border-radius: 50%;">
						</div>
						<div class="ml-3">
							<div>
								<label class="btn btn-outline-primary mb-0">
									Upload Picture
									<input ref="avatarFile" type="file" class="d-none" @change="onAvatarFileSelected">
								</label>
							</div>
							<span class="text-secondary">
								<small>JPG, GIF or PNG. Max size of 5MB.</small>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 form-group">
						<label :for="`${_uid}-first-name`">First Name</label>
						<input :id="`${_uid}-first-name`" v-model="form.firstName" type="text"
							class="form-control" :class="{ 'is-invalid': validationFields['user.first_name'] }"
							aria-describedby="emailHelp">
						<div v-if="validationFields['user.first_name']" class="invalid-feedback">
							{{ validationFields['user.first_name'][0] }}
						</div>
					</div>

					<div class="col-12 col-md-6 form-group">
						<label :for="`${_uid}-last-name`">Last Name</label>
						<input id="`${_uid}-last-name`" v-model="form.lastName" type="text"
							class="form-control" :class="{ 'is-invalid': validationFields['user.last_name'] }"
							aria-describedby="emailHelp">
						<div v-if="validationFields['user.last_name']" class="invalid-feedback">
							{{ validationFields['user.last_name'][0] }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label :for="`${_uid}-user-title`">Title</label>
					<input :id="`${_uid}-user-title`" v-model="form.title" type="text"
						class="form-control"
						:class="{ 'is-invalid': validationFields['user.booking_page.title'] }">
					<div v-if="validationFields['user.booking_page.title']" class="invalid-feedback">
						{{ validationFields['user.booking_page.title'][0] }}
					</div>
				</div>
				<div class="form-group">
					<label :for="`${_uid}-user-work-place`">Workplace Name</label>
					<input :id="`${_uid}-user-work-place`" v-model="form.workplaceName" type="text"
						class="form-control"
						:class="{ 'is-invalid': validationFields['user.booking_page.workplace_name'] }" placeholder="E.g.: Pepsi">
					<div v-if="validationFields['user.booking_page.workplace']" class="invalid-feedback">
						{{ validationFields['user.booking_page.workplace'][0] }}
					</div>
				</div>
				<div class="form-group">
					<label :for="`${_uid}-user-work-place-website`">Workplace Website/URL</label>
					<input :id="`${_uid}-user-work-place-website`" v-model="form.workplaceWebsiteUrl" type="text"
						class="form-control"
						:class="{ 'is-invalid': validationFields['user.booking_page.workplace_website_url'] }"
						placeholder="E.g.: https://pepsi.com">
					<div v-if="validationFields['user.booking_page.workplace_website_url']" class="invalid-feedback">
						{{ validationFields['user.booking_page.workplace_website_url'][0] }}
					</div>
				</div>
				<div v-if="false" class="form-group">
					<label for="exampleFormControlTextarea1">Welcome Message</label>
					<textarea id="exampleFormControlTextarea1" v-model="form.bookingPage.welcomeMessage"
						class="form-control" :class="{ 'is-invalid': validationFields['user.booking_page.welcome_message'] }"
						rows="3"></textarea>
					<div v-if="validationFields['user.booking_page.welcome_message']" class="invalid-feedback">
						{{ validationFields['user.booking_page.welcome_message'][0] }}
					</div>
				</div>
				<div class="form-group">
					<label for="#exampleSelect1">Language</label>
					<select id="exampleSelect1" v-model="form.locale"
						class="form-control" :class="{ 'is-invalid': validationFields['user.locale'] }">
						<option v-for="language in languages" :key="language.id" :value="language.code">
							{{ language.nativeName }}
						</option>
					</select>
					<div v-if="validationFields['user.locale']" class="invalid-feedback">
						{{ validationFields['user.locale'][0] }}
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label for="#exampleSelect2">Date Format</label>
							<select id="exampleSelect2" v-model="form.dateFormat"
								class="form-control"
								:class="{ 'is-invalid': validationFields['user.date_format'] }">
								<option v-for="(dateFormat, dateFormatKey) in dateFormats" :key="dateFormatKey"
									:value="dateFormatKey">
									{{ __(`users.date_formats.${dateFormatKey}`) }}
								</option>
							</select>
							<div v-if="validationFields['user.date_format']" class="invalid-feedback">
								{{ validationFields['user.date_format'][0] }}
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							<label for="#exampleSelect3">Time Format</label>
							<select id="exampleSelect3" v-model="form.timeFormat"
								class="form-control"
								:class="{ 'is-invalid': validationFields['user.time_format'] }" @change="onTimeFormatChanged">
								<option v-for="(timeFormat, timeFormatKey) in timeFormats" :key="timeFormatKey"
									:value="timeFormatKey">
									{{ __(`users.time_formats.${timeFormatKey}`) }}
								</option>
							</select>
							<div v-if="validationFields['user.time_format']" class="invalid-feedback">
								{{ validationFields['user.time_format'][0] }}
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="d-flex justify-content-between align-items-center" for="#exampleSelect5">
						<span>Your Location</span>
						<span v-if="selectedLocalityTime" class="text-secondary">
							<small>Current Time: {{ selectedLocalityTime }}</small>
						</span>
					</label>
					<VSelect id="exampleSelect5" v-model="localitySelectSelectedOption" :options="localitySelectOptions"
						label="fullAddress" placeholder="Select localtion..."
						:class="{ 'is-invalid': validationFields['user.locality_key'] }" :filterable="false"
						@input="onLocalityInputChanged" @search="onLocalityInputSearchChanged">
						<template slot="selected-option" slot-scope="option">
							<div class="d-flex align-items-center">
								<img class="mr-1" :src="`/img/country-flags/${option.countryCode}.png`">
								{{ option.fullAddress }}
							</div>
						</template>
						<template slot="option" slot-scope="option">
							<div class="d-flex align-items-center">
								<img class="mr-1" :src="`/img/country-flags/${option.countryCode}.png`">
								{{ option.fullAddress }}
							</div>
						</template>
						<template slot="no-options">
							Type to search your location...
						</template>
					</VSelect>
					<div v-if="validationFields['user.locality_key']" class="invalid-feedback">
						{{ validationFields['user.locality_key'][0] }}
					</div>
				</div>
				<div class="mt-4 pt-4 pr-0 d-flex justify-content-end align-items-center">
					<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
						:disabled="isLoading">
						Save Changes
					</button>
				</div>
			</div>
		</form>
		<CropperModal ref="avatarCropperModal" mode="avatar" @cropped="onAvatarCropped" />
	</div>
</template>

<script>
	import { debounce } from 'lodash';
	import { mapState } from 'vuex';

	export default {
		components: {
			CropperModal: () => import('../../components/CropperModal'),
		},

		data() {
			return {
				form: null,
				isLoading: false,
				validationFields: {},
				selectedLocalityTime: null,
				localitySelectSelectedOption: null,
				localitySelectOptions: [],
				localitySelectCancel: null,
				localityTimeInterval: null,
			};
		},

		computed: {
			...mapState([
				'dateFormats',
				'timeFormats',
				'languages',
				'auth',
			]),
		},

		watch: {
			auth() {
				this.buildForm();
			},
		},

		mounted() {
			this.buildForm();
			this.updateSelectedLocalityTime();

			this.localityTimeInterval = setInterval(() => {
				this.updateSelectedLocalityTime();
			}, 1000);
		},

		beforeDestroy() {
			clearInterval(this.localityTimeInterval);
		},

		methods: {
			buildForm() {
				this.form = {
					firstName: this.auth.user.firstName,
					lastName: this.auth.user.lastName,
					title: this.auth.user.title,
					workplaceName: this.auth.user.workplaceName,
					workplaceWebsiteUrl: this.auth.user.workplaceWebsiteUrl,
					locale: this.auth.user.locale,
					timeFormat: this.auth.user.timeFormat,
					dateFormat: this.auth.user.dateFormat,
					localityKey: this.auth.user.locality ? this.auth.user.locality.key : null,

					avatar: {
						...this.auth.user.avatar,
						blob: null,
						fileName: null,
						isUpdated: false,
					},
				};

				this.localitySelectSelectedOption = this.auth.user.locality ? { ...this.auth.user.locality } : null;
			},

			onAvatarFileSelected() {
				this.$refs.avatarCropperModal.show(this.$refs.avatarFile.files[0]);
			},

			onAvatarCropped({ blob, base64, fileName }) {
				this.form.avatar.id = 'new';
				this.form.avatar.blob = blob;
				this.form.avatar.url = base64;
				this.form.avatar.fileName = fileName;
				this.form.avatar.isUpdated = true;
			},

			removeAvatar() {
				this.form.avatar.id = null;
				this.form.avatar.blob = null;
				this.form.avatar.url = null;
				this.form.avatar.fileName = null;
				this.form.avatar.isUpdated = true;
			},

			onTimeFormatChanged() {
				this.updateSelectedLocalityTime();
			},

			async onLocalityInputChanged() {
				if (this.localitySelectSelectedOption) {
					this.form.localityKey = this.localitySelectSelectedOption.key;
					let response = await this.$http.get(`/localities/${this.form.localityKey}`);
					this.$set(this.localitySelectSelectedOption, 'timezoneCode', response.data.data.timezoneCode);
					this.updateSelectedLocalityTime();
				} else {
					this.form.localityKey = null;
					this.selectedLocalityTime = null;
				}
			},

			onLocalityInputSearchChanged(query, loading) {
				this.localitySelectCancel && this.localitySelectCancel();

				if (!query) {
					return;
				}

				loading(true);
				this.searchLocation(query, loading);
			},

			searchLocation: debounce(async function (query, loading) {
				try {
					let response = await this.$http.get('/localities/autocomplete', {
						params: { query },

						cancelToken: new this.$http.CancelToken((cancel) => {
							this.localitySelectCancel = cancel;
						}),
					});

					this.localitySelectOptions = response.data.data;
					loading(false);
				} catch (error) {
					if (this.$http.isCancel(error)) {
						return;
					}

					loading(false);
					Vue.config.errorHandler(error, this);
				}
			}, 250),

			updateSelectedLocalityTime() {
				if (!this.localitySelectSelectedOption || !this.localitySelectSelectedOption.timezoneCode) {
					return;
				}

				this.selectedLocalityTime = this.$moment.tz(this.localitySelectSelectedOption.timezoneCode).format(this.timeFormats[this.form.timeFormat]);
			},

			async saveData() {
				this.isLoading = true;

				try {
					let formData = new FormData();

					if (this.form.avatar.isUpdated) {
						if (this.form.avatar.blob) {
							formData.append('user[avatar_file]', this.form.avatar.blob, this.form.avatar.fileName);
						} else {
							formData.append('user[avatar_file]', '');
						}
					}

					formData.append('user[first_name]', this.form.firstName);
					formData.append('user[last_name]', this.form.lastName);
					formData.append('user[locale]', this.form.locale);
					formData.append('user[time_format]', this.form.timeFormat);
					formData.append('user[date_format]', this.form.dateFormat);
					formData.append('user[locality_key]', this.form.localityKey);
					formData.append('user[title]', this.form.title);
					formData.append('user[workplace_name]', this.form.workplaceName);
					formData.append('user[workplace_website_url]', this.form.workplaceWebsiteUrl);

					let response = await this.$http.post('/users/me/update', formData);
					this.$store.commit('mergeAuthUser', response.data.data);

					this.$notify({
						text: 'Your settings have been saved!',
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

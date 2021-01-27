<template>
	<div class="card dashboard-booking-type-invitee-questions">
		<div id="headingThree" class="card-header border-bottom-0" :class="{ 'cursor-pointer': bookingType.id }"
			@click="toggle">
			<h2 class="mb-0">
				<div class="col-lg-12">
					<div class="row justify-content-between align-items-center">
						<button type="button" class="btn btn-link collapsed no-bg-on-hover text-left">
							Questions
							<div>
								<small class="text-secondary text-left d-block">
									Name, Email + 1 question
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
				<div class="col-lg-6">
					<div class="hover-guest" data-toggle="modal" data-target="#addGuest">
						<div class="row">
							<div class="form-group col">
								<label>
									First Name *
								</label>
								<input type="text" class="form-control" readonly>
							</div>
							<div class="form-group col">
								<label>
									Last Name *
								</label>
								<input type="text" class="form-control" readonly>
							</div>
						</div>
						<div class="form-group">
							<label>
								Email *
							</label>
							<input type="email" class="form-control" readonly>
						</div>
						<div class="form-group">
							<a class="btn btn-outline-secondary btn-sm" href="#" data-toggle="modal"
								data-target="#addGuest">
								Add Guests
							</a>
						</div>
					</div>
					<div class="form-group hover-question" data-toggle="modal" data-target="#addQuestion">
						<label>
							Please share anything that will help prepare for our meeting.
						</label>
						<input type="text" class="form-control" readonly>
					</div>
					<Draggable :list="form.questions" :options="{ group: 'question' }" @end="onAnswersMoved">
						<template v-for="(question, questionIndex) in form.questions">
							<template
								v-if="question.answerType !== 'CHECKBOXES' && question.answerType !== 'RADIO_BUTTONS'">
								<div :key="question.id" class="form-group"
									@click="openQuestionModal(question, questionIndex)">
									<label>{{ question.title }}</label>
									<div class="col-lg-12 mt-2 mb-2 ui-sortable-handle">
										<div class="row align-items-center">
											<div class="col-lg-1 pl-0">
												<img src="/img/arrows.svg" alt="">
											</div>
											<div class="col pl-0">
												<div class="form-group m-0">
													<input type="text" class="form-control" readonly>
												</div>
											</div>
										</div>
									</div>
								</div>
							</template>
							<template v-else>
								<div :key="question.id" class="form-group"
									@click="openQuestionModal(question, questionIndex)">
									<label>{{ question.title }}</label>
									<div class="col-lg-12 mt-2 mb-2 ui-sortable-handle">
										<div class="row align-items-center">
											<div class="col-lg-1 pl-0">
												<img src="/img/arrows.svg" alt="">
											</div>
											<template v-if="question.answerType === 'RADIO_BUTTONS'">
												<div v-for="answer in question.answerOptions" :key="answer"
													class="col-lg-12 pl-4">
													<input type="radio" name="gender" value="male" disabled>
													<label>{{ answer }}</label><br>
												</div>
											</template>
											<template v-else-if="question.answerType === 'CHECKBOXES'">
												<div v-for="answer in question.answerOptions" :key="answer"
													class="col-lg-12 pl-4">
													<input type="checkbox" name="gender" value="male" disabled>
													<label>{{ answer }}</label><br>
												</div>
											</template>
										</div>
									</div>
								</div>
							</template>
						</template>
					</Draggable>
					<div class="form-group">
						<a class="btn btn-primary btn-sm" href="#" @click="addNewQuestion">
							+ Add New Question
						</a>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="d-flex justify-content-end align-items-center"
						:class="{ 'show': isOpen, 'pointer-events-none': !isOpen }">
						<button type="button" class="btn btn-default mr-4" @click="cancel">
							Cancel
						</button>
						<button type="submit" class="btn btn-primary" :class="{ 'is-loading': isLoading }"
							:disabled="isLoading" @click="save">
							{{ bookingType.id ? 'Save & Close' : 'Next' }}
						</button>
					</div>
				</div>
			</div>
		</form>
		<div ref="questionModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addQuestion"
			style="display: none;" aria-hidden="true">
			<ValidationObserver ref="validationObserver">
				<form class="modal-dialog" role="document" @submit.prevent>
					<div class="modal-content">
						<div class="modal-header">
							<h5 id="exampleModalLongTitle" class="modal-title">
								Modal title
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div v-if="selectedQuestion" class="modal-body">
							<div class="form-group">
								<label for="question">
									Question *
								</label>
								<ValidationProvider v-slot="{ errors }" class="col-10 p-0" rules="required">
									<input id="question" v-model="selectedQuestion.title" type="text"
										class="form-control" aria-describedby="question">
									<div v-if="errors[0]" class="invalid-feedback">
										The question field is required
									</div>
								</ValidationProvider>
								<div class="col-lg-12 mt-2">
									<div class="row justify-content-between">
										<div class="custom-control custom-switch">
											<input id="customSwitch5" v-model="selectedQuestion.isEnabled"
												type="checkbox" class="custom-control-input">
											<label class="custom-control-label" for="customSwitch5"></label>
										</div>
										<div class="form-check">
											<input id="exampleCheck8" v-model="selectedQuestion.isRequired"
												type="checkbox" class="form-check-input">
											<label class="form-check-label" for="exampleCheck8">
												Required
											</label>
										</div>
									</div>
								</div>
								<div class="form-group mt-4">
									<label for="answer-type">Answer Type</label>
									<select id="answer-type" v-model="selectedQuestion.answerType" class="form-control">
										<option value="ONE_LINE">
											One Line
										</option>
										<option value="MULTIPLE_LINES">
											Multiple Lines
										</option>
										<option value="RADIO_BUTTONS">
											Radio Buttons
										</option>
										<option value="CHECKBOXES">
											Checkboxes
										</option>
										<option value="PHONE_NUMBER">
											Phone Number
										</option>
									</select>
								</div>
								<div v-if="['RADIO_BUTTONS', 'CHECKBOXES'].includes(selectedQuestion.answerType)">
									<strong class="mt-4 d-block">Answers *</strong>
									<small
										class="text-secondary mb-2 d-block">Invitee can select one of the following:</small>
									<div id="sortable" class="ui-sortable">
										<Draggable :list="selectedQuestion.answerOptions">
											<div
												v-for="(answerOption, answerOptionsIndex) in selectedQuestion.answerOptions"
												:key="answerOptionsIndex"
												class="col-lg-12 mt-2 mb-2 ui-sortable-handle">
												<div class="row align-items-center">
													<div class="col-lg-1 pl-0">
														<img src="/img/arrows.svg" alt="">
													</div>
													<div class="col pl-0">
														<div class="form-group m-0">
															<ValidationProvider v-slot="{ errors }" class="col-10 p-0"
																rules="required">
																<input
																	v-model="selectedQuestion.answerOptions[answerOptionsIndex]"
																	type="text" class="form-control"
																	:placeholder="`Answer ${answerOptionsIndex +1 }`">
																<div v-if="errors[0]" class="invalid-feedback">
																	The answer {{ answerOptionsIndex +1 }} field is required
																</div>
															</ValidationProvider>
														</div>
													</div>
													<div v-if="selectedQuestion.answerOptions.length > 1"
														class="col-lg-1 pr-0">
														<img src="/img/delete.svg" alt="" style="max-width: 100%;"
															@click="deleteAnswerOption(answerOptionsIndex)">
													</div>
												</div>
											</div>
										</Draggable>
									</div>
								</div>
								
								<div v-if="['RADIO_BUTTONS', 'CHECKBOXES'].includes(selectedQuestion.answerType)"
									class="col-lg-12 pl-4 mt-2">
									<div class="col-lg-12">
										<a href="javascript:void(0)" @click="addAnotherAnswerOption">
											+ Add Another
										</a>
									</div>
								</div>
								<div v-if="['RADIO_BUTTONS', 'CHECKBOXES'].includes(selectedQuestion.answerType)"
									class="col-lg-12 pl-4 mt-2">
									<div class="col-lg-12">
										<div class="form-check">
											<input id="exampleCheck6" v-model="selectedQuestion.otherOptionAllowed"
												type="checkbox" class="form-check-input">
											<label class="form-check-label" for="exampleCheck6">
												Include "other" option
											</label>
										</div>
									</div>
								</div>
								<div v-if="selectedQuestionIndex !== null" class="col-lg-12 mt-4">
									<div class="row justify-content-center">
										<button class="btn btn-danger" @click="deleteQuestion()">
											Delete Question
										</button>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Cancel
							</button>
							<button type="button" class="btn btn-primary" @click="saveQuestion">
								Apply
							</button>
						</div>
					</div>
				</form>
			</ValidationObserver>
		</div>
		<div id="addGuest" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addGuest"
			style="display: none;" aria-hidden="true">
			<form class="modal-dialog" role="document" onsubmit="return false">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLongTitle" class="modal-title">
							Modal title
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group pl-4">
							<input id="exampleCheck7" type="checkbox" class="form-check-input">
							<label class="form-check-label" for="exampleCheck7">
								Autofill Invitee Name, Email,
								and Text Reminder Phone Number (when applicable)
								from prior bookings
							</label>
						</div>
						<div class="form-group pl-4">
							<input id="exampleCheck5" type="checkbox" class="form-check-input">
							<label class="form-check-label" for="exampleCheck5">
								Allow invitees to add additional guests
							</label>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Cancel
						</button>
						<button type="button" class="btn btn-primary">
							Apply
						</button>
					</div>
				</div>
			</form>
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
			};
		},
		
		mounted() {
			this.buildForm();
		},
		
		methods: {
			buildForm() {
				this.form = {
					questions: this.bookingType.id ? this.bookingType.questions.map((bookingTypeQuestion) => {
						return {
							id: bookingTypeQuestion.id,
							title: bookingTypeQuestion.title,
							answerType: bookingTypeQuestion.answerType,
							answerOptions: bookingTypeQuestion.answerOptions,
							otherOptionAllowed: bookingTypeQuestion.otherOptionAllowed,
							position: bookingTypeQuestion.position,
							isRequired: bookingTypeQuestion.isRequired,
							isEnabled: bookingTypeQuestion.isEnabled,
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
			
			updateQuestion() {
				$(this.$refs.questionModal).modal('hide');
			},
			
			async saveQuestion() {
				if (!await this.$refs.validationObserver.validate()) {
					return;
				}
				
				if (!['RADIO_BUTTONS', 'CHECKBOXES'].includes(this.selectedQuestion.answerType)) {
					this.selectedQuestion.answerOptions = [];
				}
				
				if (this.selectedQuestionIndex !== null) {
					this.form.questions[this.selectedQuestionIndex] = this.selectedQuestion;
					this.selectedQuestion = null;
				} else {
					this.form.questions.push(this.selectedQuestion);
					this.selectedQuestion = null;
				}
				$(this.$refs.questionModal).modal('hide');
			},
			
			addNewQuestion() {
				this.selectedQuestion = {
					title: '',
					answerType: 'ONE_LINE',
					answerOptions: ['', '', ''],
					otherOptionAllowed: false,
					position: 1,
					isRequired: false,
					isEnabled: false,
				};
				this.selectedQuestionIndex = null;
				$(this.$refs.questionModal).modal('show');
			},
			
			deleteAnswerOption(index) {
				this.selectedQuestion.answerOptions.splice(index, 1);
			},
			
			addAnotherAnswerOption() {
				this.selectedQuestion.answerOptions.push('');
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
			
			openQuestionModal(question, questionIndex) {
				this.selectedQuestion = {
					...question,
					answerOptions: [...question.answerOptions],
				};
				this.selectedQuestionIndex = questionIndex;
				$(this.$refs.questionModal).modal('show');
			},
			
			deleteQuestion() {
				this.form.questions.splice(this.selectedQuestionIndex, 1);
				this.selectedQuestionIndex = null;
				this.selectedQuestion = null;
				$(this.$refs.questionModal).modal('hide');
			},
			
			async onAnswersMoved() {
				$.each(this.form.questions, function (key, question) {
					question.position = key;
				});
			},
			
		},
	};
</script>

<style lang="scss">
	.dashboard-booking-type-invitee-questions {
		.invalid-feedback {
			color: red;
			display: block;
		}
	}
</style>

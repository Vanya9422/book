<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto p-3 card-body rounded-0 border-0"
				style="min-height: 100%; width: 100%; max-width: 360px;">
				<div class="d-flex flex-column align-items-center pb-5 pt-2 position-relative">
					<button class="btn btn-back p-0 position-absolute rounded-circle"
						style="top: 5px; left: 0; font-size: 0;" @click="goBack">
						<img src="/img/left.svg" alt="" width="30">
					</button>
					<strong class="text-center d-block">{{ date }} {{ time }}</strong>
				</div>
				<form>
					<div class="row">
						<div class="col-6 pr-1">
							<div class="form-group">
								<label for="first_name">First Name *</label>
								<input id="first_name" type="text" class="form-control" aria-describedby="nameHelp">
							</div>
						</div>
						<div class="col-6 pl-1">
							<div class="form-group">
								<label for="last_name">Last Name *</label>
								<input id="last_name" type="text" class="form-control" aria-describedby="nameHelp">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Your Email</label>
						<input id="exampleInputEmail1" type="email" class="form-control" aria-describedby="emailHelp">
						<button class="btn btn-outline-primary mt-2">
							Add Guests
						</button>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Guest Email(s)</label>
						<textarea id="exampleFormControlTextarea1" class="form-control" rows="3"></textarea>
						<small
							class="form-text text-muted">Notify up to 10 additional guests of the scheduled event.</small>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">What would you like to talk about on the call?</label>
						<textarea id="exampleFormControlTextarea1" class="form-control" rows="3"></textarea>
					</div>
					<div class="input-group mb-3 align-items-stretch">
						<div class="input-group-prepend">
							<button type="button"
								class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="mr-2">
									<img src="/img/country-flags/DE.png" alt="" style="width: 20px;">
								</i>
								<span>+1</span>
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Action</a>
							</div>
						</div>
						<input type="text" class="form-control py-4" aria-label="Text input with dropdown button">
					</div>
					<div class="form-group">
						<label for="credit_card">Credit Card</label>
						<input id="credit_card" type="text" class="form-control" aria-describedby="nameHelp">
					</div>
					<div class="row">
						<div class="col-6 pr-1">
							<div class="form-group">
								<label for="expiration_date">Expiration Date *</label>
								<input id="expiration_date" type="text" class="form-control"
									aria-describedby="nameHelp">
							</div>
						</div>
						<div class="col-6 pl-1">
							<div class="form-group">
								<label for="cvc">CVC *</label>
								<input id="cvc" type="text" class="form-control" aria-describedby="nameHelp">
							</div>
						</div>
					</div>
					<div class="custom-control custom-checkbox mb-3">
						<input id="agree_terms" type="checkbox" class="custom-control-input">
						<label class="custom-control-label" for="agree_terms">I agree with <a
							href="#">Terms of Service &amp; Privacy Policy</a></label>
					</div>
					<button type="button" class="btn btn-primary btn-block" @click="goNext">
						Finish & Pay
					</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		components: {},
		
		data() {
			return {
				date: false,
				time: false,
			};
		},
		
		created() {
			this.date = this.$route.params.date;
			this.time = this.$route.params.time;
		},
		
		mounted() {
		
		},
		
		methods: {
			goBack: function () {
				this.$router.go(-1); // i don't think it's correct
			},
			
			goNext: function () {
				this.$router.push({
					name: 'temp.booking_page.mobile.confirmed',
					params: { date: this.date, time: this.time },
				});
			},
		},
	};
</script>

<style scoped>

</style>

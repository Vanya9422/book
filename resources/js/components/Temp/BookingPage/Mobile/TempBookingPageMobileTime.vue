<template>
	<div class="d-flex flex-column flex-nowrap align-items-center" style="height: 100vh;">
		<div class="overflow-auto w-100 h-100">
			<div class="card m-auto p-3 card-body rounded-0 border-0" style="min-height: 100%; width: 100%; max-width: 360px;">
				<div class="d-flex flex-column align-items-center pb-3 position-relative">
					<button class="btn btn-back p-0 position-absolute rounded-circle" style="left: 0; font-size: 0;" @click="goBack">
						<img src="/img/left.svg" width="30" alt="">
					</button>
					<div class="col-2 p-1 bg-white rounded-circle" style="font-size: 0px;">
						<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
					</div>
					<strong>Mark Bruk</strong>
					<span class="d-block">Super Laywer Consultant</span>
				</div>
				<strong class="text-center mb-3 d-block">{{ date }}</strong>
				<div v-if="showTime" class="btn-group-vertical d-block">
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
					<div class="col-lg-12 mb-3">
						<div class="row flex-nowrap">
							<button type="button" class="btn btn-outline-secondary btn-block mt-0 mr-2" @click="goNext">
								09:00
							</button>
							<a href="#" type="button" class="btn btn-secondary btn-block mt-0 ml-2">Confirm</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		components: {},
		data() {
			return {
				date: 'Please select date on previous page',
				time: '09:00',
				showTime: false,
			};
		},
		created() {
			if (this.$route.params.date) {
				this.date = this.$route.params.date;
				this.showTime = true;
			}
			console.log(this.$route.params);
		},

		mounted() {

		},

		methods: {
			goBack: function () {
				this.$router.go(-1); // i don't think it's correct
			},
			goNext: function () {
				this.$router.push({ name: 'temp.booking_page.mobile.confirm', params: { date: this.date, time: this.time } });
			},
		},
	};
</script>

<style scoped>

</style>

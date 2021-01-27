<template>
	<div>
		<div class="row flex-column align-items-center justify-content-center pb-4">
			<div class="col-lg-12 bg-light p-4 border-bottom">
				{{ startDateEndDate }}
			</div>
			<div class="col-lg-12" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
				<div class="row p-4">
					<div class="col-lg-4">
						<div class="row m-0 align-items-center">
							<div class="rounded-circle bg-primary mr-4" style="width: 30px;height: 30px;"></div>
							<span>10:00 - 10:45</span>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="text">
							<strong>Guest Name</strong>
						</div>
						<div class="text">
							<strong>Booking Type Name</strong>
						</div>
					</div>
					<div class="col">
						<div class="row m-0 justify-content-end">
							<button class="btn btn-link text-decoration-none">
								Details
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-12 p-4">
				<div id="collapseExample" class="collapse">
					<div class="row m-0 p-2">
						<div class="mr-4" style="width: 30px;"></div>
						<div class="col-lg-3 pt-2 border-top pl-0">
							<a href="#" class="btn btn-link text-decoration-none">
								Edit Event Type
							</a>
							<a href="#" class="btn btn-link text-decoration-none">
								Filter by Event Type
							</a>
							<a href="#" class="btn btn-link text-decoration-none">
								Schedule Invitee Again
							</a>
						</div>
						<div class="col ml-4">
							<div class="col-lg-12 border-top mb-3 pt-2">
								<strong class="d-block">EMAIL</strong>
								<span>ajskhdakj@aksjdh.asdasdskjdhf</span>
							</div>
							<div class="col-lg-12 mb-3">
								<strong class="d-block">INVITEE TIME ZONE</strong>
								<span>Pakistan, Maldives Time</span>
							</div>
							<div class="col-lg-12 mb-3">
								<strong class="d-block">QUESTIONS</strong>
								<span class="d-block text-secondary">Please share anything that will help prepare for our meeting.</span>
								<span>dkjhfskjdf</span>
							</div>
							<div class="col-lg-12 mb-3 pt-4">
								<span class="text-secondary">created 30 December 2019</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<img src="img/svg/no-events.svg" alt="">
			<h4 class="text-center text-secondary">
				No Events Yet
			</h4>
			<p class="text-center text-secondary mt-3 mb-4">
				Share Event Type links to schedule events.
			</p>
			<button type="button" class="btn btn-primary btn-sm mt-4">
				View Event Types
			</button>
		</div>
	</div>
</template>

<script>

	export default {

		components: {},
		data() {
			return {
				startDateEndDate: '',
			};
		},

		mounted() {

		},

		methods: {
			//
		},
	};
</script>

<style scoped>

</style>

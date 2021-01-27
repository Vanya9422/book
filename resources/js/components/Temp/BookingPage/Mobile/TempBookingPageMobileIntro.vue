<template>
	<div class="d-flex flex-column flex-nowrap align-items-center">
		<div class="overflow-auto w-100" style="height: 100vh; padding-bottom: 60px;">
			<div class="card m-auto p-3 card-body rounded-0 border-0" style="min-height: 100%; width: 100%; max-width: 360px;">
				<div class="d-flex align-items-center mb-2">
					<div class="col-2 px-0">
						<div class="square-box rounded overflow-hidden">
							<div class="square-box-in">
								<img src="/img/image.png" alt="">
							</div>
						</div>
					</div>
					<div class="col-10 pr-0">
						<strong>Mark's Bookify Page</strong>
						<div class="col-12">
							<div class="row align-items-center">
								<img src="/img/country-flags/DE.png" alt="">
								<small class="ml-2">Montreal</small>
							</div>
						</div>
					</div>
				</div>
				<div class="border-bottom rounded overflow-hidden mb-1" style="font-size: 0px;">
					<iframe src="https://www.youtube.com/embed/-IMRGMGLuPY" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="allowfullscreen" frameborder="0" width="100%" height="100%"></iframe>
				</div>
				<div class="d-flex py-2 align-items-start sticky-top bg-white">
					<div class="col-2 p-0 rounded-circle" style="font-size: 0px;">
						<img src="/img/avatar.png" alt="" width="100%" style="border-radius: 50%;">
					</div>
					<div class="col-10 pr-0 pt-2">
						<strong>Mark Bruk</strong>
						<span class="d-block">Super Laywer Consultant</span>
					</div>
				</div>
				<div class="row m-0 scroll-text-container">
					<div class="col-12 pl-0 py-3 overflow-auto" style="max-height: 200px;">
						<span>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid asperiores assumenda deleniti distinctio dolorum error est ex facere ipsa ipsam ipsum libero nisi nostrum quibusdam quidem quis quo quod recusandae reiciendis rerum sed sint ut! Accusantium amet doloribus neque.
						</span>
					</div>
				</div>
				<div class="row pt-2">
					<div class="col-12 overflow-auto" style="max-height: 190px;">
						<a href="#" class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-2 active">
							<div class="row align-items-center">
								<div class="col text-left d-flex align-items-center">
									<img src="/img/confirm_primary.svg" width="20" alt="">
									<strong class="d-block ml-2" style="line-height: 1;">Booking Type Name</strong>
								</div>
								<div class="row pr-3 m-0 flex-column align-items-end">
									<span class="h5 mb-0 d-flex align-items-center">
										<strong class="mr-2">$55</strong>
										<small class="text-right">
											<span class="badge badge-light">30min</span>
										</small>
									</span>
								</div>
							</div>
						</a>
						<a href="#" class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none mb-2">
							<div class="row align-items-center">
								<div class="col text-left">
									<strong class="d-block">Booking Type Name</strong>
								</div>
								<div class="row pr-3 m-0 flex-column align-items-end">
									<span class="h5 mb-0 d-flex align-items-center">
										<strong class="mr-2">$55</strong>
										<small class="text-right">
											<span class="badge badge-light">30min</span>
										</small>
									</span>
								</div>
							</div>
						</a>
						<a href="#" class="p-3 rounded btn btn-outline-booking btn-block text-decoration-none">
							<div class="row align-items-center">
								<div class="col text-left">
									<strong class="d-block">Booking Type Name</strong>
								</div>
								<div class="row pr-3 m-0 flex-column align-items-end">
									<span class="h5 mb-0 d-flex align-items-center">
										<strong class="mr-2">$55</strong>
										<small class="text-right">
											<span class="badge badge-light">30min</span>
										</small>
									</span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="text-center shadow-lg w-100 position-fixed fixed-bottom bg-white" style="z-index: 10; height: 60px; padding-right: var(--scrollbar_width);">
			<div class="m-auto px-3 py-2 h-100" style="width: 100%; max-width: 360px;">
				<router-link :to="{ name: 'temp.booking_page.mobile.calendar' }" class="btn btn-block btn-primary h-100">
					<span class="d-flex justify-content-center align-items-center w-100">
						<span class="h4 mb-0">Book Now</span>
					</span>
				</router-link>
			</div>
		</div>
	</div>
</template>
<script>
	export default {

		components: {},
		data() {
			return {
				date: '23-11-2020',
				time: '09:00',
			};
		},

		mounted() {
			//
		},

		methods: {
			//
		},
	};
</script>
<style scoped>
</style>

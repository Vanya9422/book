<template>
	<div class="[ main ]">
		<div class="navbar fixed-top navbar-light bg-white">
			<div class="container">
				<router-link class="navbar-brand btn btn-link d-flex align-items-center" :to="{ name: 'main.home', params: { locale } }">
					<img src="/img/logo.svg" width="35" class="d-inline-block align-top" alt="">
					<span class="ml-2">Bookify</span>
				</router-link>
				<nav class="navbar navbar-expand-lg navbar-light bg-white">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
						aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div id="navbarNavDropdown" class="collapse navbar-collapse">
						<ul class="navbar-nav">
							<li class="nav-item mr-4">
								<router-link class="btn btn-link text-decoration-none" :to="{ name: 'main.features', params: { locale } }">
									Features <span class="sr-only">(current)</span>
								</router-link>
							</li>
							<li class="nav-item mr-4">
								<router-link class="btn btn-link text-decoration-none"
									:to="{ name: 'main.pricing', params: { locale } }">
									Pricing
								</router-link>
							</li>
							<li v-if="auth.user" class="nav-item">
								<router-link class="btn btn-link text-decoration-none" :to="{ name: auth.user.entryPointRoute }">
									Dashboard
								</router-link>
							</li>
							<li v-if="!auth.user" class="nav-item mr-4">
								<router-link class="nav-link btn btn-sm btn-success text-white"
									:to="{ name: 'auth.register', params: { locale } }">
									Sign Up
								</router-link>
							</li>
							<li v-if="!auth.user" class="nav-item">
								<router-link class="nav-link"
									:to="{ name: 'auth.login', params: { locale } }">
									Login
								</router-link>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</div>
		<router-view />
		<div class="language">
			<div class="navbar">
				<div class="container">
					<a class="navbar-brand" href="index.html">
						<img src="/img/logo.svg" width="30" height="30" class="d-inline-block align-top" alt="">
					</a>
					<div class="btn-group">
						<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">
							Language
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#">English</a>
							<a class="dropdown-item" href="#">Français</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer">
			<hr>
			<div class="container footer__top">
				<div class="row">
					<div class="col-12 col-md-6 col-lg-9">
						<div class="row">
							<div class="col-lg-3 col-md-6">
								<h5 class="footer__title">
									Product
								</h5>
								<ul class="nav flex-column">
									<li class="nav-item">
										<router-link class="nav-link text-secondary"
											:to="{ name: 'main.features', params: { locale } }">
											Features
										</router-link>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Integrations</a>
									</li>
									<li class="nav-item">
										<router-link class="nav-link text-secondary"
											:to="{ name: 'main.teams', params: { locale } }">
											For Teams
										</router-link>
									</li>
								</ul>
								<h5 class="footer__title">
									Pricing
								</h5>
								<ul class="nav flex-column">
									<li class="nav-item">
										<router-link class="nav-link text-secondary"
											:to="{ name: 'main.pricing', params: { locale } }">
											Plans
										</router-link>
									</li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-6">
								<h5 class="footer__title">
									Solutions
								</h5>
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Sales + Marketing</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Education</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Interview Scheduling</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Customer Success</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Consultants</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Leaders</a>
									</li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-6">
								<h5 class="footer__title">
									Resources
								</h5>
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Resource Library</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Developer Tools</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Help Center</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">API Reference</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Video Tutorials</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Community</a>
									</li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-6">
								<h5 class="footer__title">
									About Us
								</h5>
								<ul class="nav flex-column">
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Security</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Jobs</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Location</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-secondary" href="#">Blog</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-3">
						<h5 class="footer__title">
							Download Our App
						</h5>
						<a href="">
							<img src="/img/application.svg" alt="">
						</a>
					</div>
				</div>
			</div>
			<nav class="pl-0 pr-0 pt-4 pb-4 navbar navbar-expand-lg navbar-light bg-light footer__bottom">
				<div class="container flex-wrap">
					<div class="col-lg-12">
						<div class="row justify-content-between align-items-start">
							<div class="col-12 col-md-8 col-lg-10">
								<div class="row align-items-start footer__bottom--wrap">
									<small class="footer__bottom--copyright">
										<strong class=" text-secondary">© 2019 Book</strong>
									</small>
									<div class="footer__bottom--text">
										<small class="text-secondary">
											We take the work out of connecting with others so you can accomplish more.
										</small>
									</div>
								</div>
							</div>
							<div class="col-12 col-md-3 col-lg-2">
								<div class="col-lg-12">
									<div class="row justify-content-end">
										<a href="#" class="footer__bottom--social">
											<img src="/img/facebook.svg/" width="15" alt="">
										</a>
										<a href="#" class="footer__bottom--social">
											<img src="/img/facebook.svg" width="15" alt="">
										</a>
										<a href="#" class="footer__bottom--social">
											<img src="/img/facebook.svg" width="15" alt="">
										</a>
										<a href="#" class="footer__bottom--social">
											<img src="/img/facebook.svg" width="15" alt="">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12 pt-3">
						<div class="row">
							<router-link class="text-secondary mr-2" :to="{ name: 'main.privacy', params: { locale } }">
								<small>Privacy</small>
							</router-link>
							<router-link class="text-secondary" :to="{ name: 'main.terms', params: { locale } }">
								<small>Terms</small>
							</router-link>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		data() {
			return {};
		},

		computed: {
			...mapState([
				'auth',
				'locale',
			]),
		},

		mounted() {
			console.log('MainLayout mounted!');
		},

		beforeUpdate() {
			console.log('MainLayout beforeUpdate!');
		},

		updated() {
			console.log('MainLayout updated!');
		},
	};
</script>

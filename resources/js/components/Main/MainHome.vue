<template>
	<div>
		<div class="container signup pl-4 pr-4">
			<div class="row align-items-center">
				<div class="col-12 col-lg-6 col-md-6">
					<h2 class="signup__header mb-4">
						Book helps you schedule meetings without the back-and-forth emails
					</h2>
					<SmallLoginForm autofocus />
				</div>
				<div class="col-12 col-lg-6 col-md-6 mt-4 mt-md-0">
					<img src="/img/signup.png" alt="">
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="container video pt-5 pt-md-0">
				<div class="col-lg-12 p-4">
					<div class="row align-items-center">
						<div class="col-md-6 col-12 mb-4 mb-md-0">
							<h3 class="text-secondary mb-4">
								Watch our video
							</h3>
							<span class="text-secondary">
								We take the work out of connecting with others so you can accomplish more. Learn how painless scheduling can be with Book.
							</span>
						</div>
						<div class="col-md-6 col-12 video__player">
							<div class="rounded video__wrapper">
								<div class="video__preview">
									<img src="/img/video.png" alt="">
								</div>
								<div class="video__background rounded"></div>
								<div class="video__play">
									<img src="/img/play.svg" width="20" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container how-it-works">
			<h2 class="text-center">
				How it works
			</h2>
			<div class="col-lg-12 how-it-works__items">
				<div class="card how-it-works__item border-0">
					<div class="row flex-nowrap no-gutters">
						<div class="how-it-works__image">
							<img src="/img/how_it_works1.png" class="card-img" alt="...">
						</div>
						<div class="how-it-works__text">
							<div class="card-body">
								<h5 class="card-title">
									Create simple rules
								</h5>
								<p class="card-text ">
									Setup is easy. Let Bookify know your availability preferences and it’ll do the work for you.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card how-it-works__item border-0">
					<div class="row flex-nowrap no-gutters">
						<div class="how-it-works__image">
							<img src="/img/how_it_works2.png" class="card-img" alt="...">
						</div>
						<div class="how-it-works__text">
							<div class="card-body">
								<h5 class="card-title">
									Share your link
								</h5>
								<p class="card-text ">
									Share your Bookify links via email or embed it on your website.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card how-it-works__item border-0">
					<div class="row flex-nowrap">
						<div class="how-it-works__image">
							<img src="/img/how_it_works3.png" class="card-img" alt="...">
						</div>
						<div class="how-it-works__text">
							<div class="card-body">
								<h5 class="card-title">
									Schedule
								</h5>
								<p class="card-text ">
									They pick a time and the booking is added to your calendar.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container features">
			<h2 class="text-center features__title">
				Features that everyone will enjoy
			</h2>
			<div class="features__image">
				<img src="/img/features.png" alt="">
			</div>
			<div class="col-lg-12 features__items">
				<div class="row">
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/ft_calendar.svg" alt="">
							</i>
							<span>Calendar Integrations</span>
						</h5>
						<div class="features__item--text text-secondary">
							Works with your Google, Outlook, Office 365 or iCloud calendar so you’re never double booked
						</div>
					</div>
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/levels.svg" alt="">
							</i>
							<span>Control</span>
						</h5>
						<div class="features__item--text text-secondary">
							Set buffer times between meetings, prevent last minute meetings, create secret booking types, and more
						</div>
					</div>
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/line.svg" alt="">
							</i>
							<span>Flexible</span>
						</h5>
						<div class="features__item--text text-secondary">
							Supports 1-on-1, round robin and collective availability meetings
						</div>
					</div>
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/time-zone.svg" alt="">
							</i>
							<span>Time Zone Intelligent</span>
						</h5>
						<div class="features__item--text text-secondary">
							Seamless timezone detection for your invitees so everyone’s on the same page
						</div>
					</div>
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/testing.svg" alt="">
							</i>
							<span>Works with your apps</span>
						</h5>
						<div class="features__item--text text-secondary">
							Automate tasks with Salesforce, GoToMeeting, Zapier and more
						</div>
					</div>
					<div class="features__item col-lg-4 col-md-6 col-12 mb-4">
						<h5 class="features__item--title">
							<i class="features__item--icon">
								<img width="25" src="/img/user.svg" alt="">
							</i>
							<span>Grows with your team</span>
						</h5>
						<div class="features__item--text text-secondary">
							Works great for individuals, teams and departments
						</div>
					</div>
				</div>
			</div>
			<div class="features__link text-center">
				<a href="features.html" class="text-primary">Learn more about features</a>
			</div>
		</div>
		<div class="container users">
			<h2 class="users__title text-center">
				You're in good company
			</h2>
			<div class="users__subtitle text-center text-secondary">
				We're already connecting millions of people
			</div>
			<div class="row justify-content-center users__count">
				<div class="col-lg-9 border rounded p-4">
					<strong class="users__count--main text-center text-secondary">2,000,000</strong>
					<h5 class="users__count--description text-secondary text-center">
						Monthly Users
					</h5>
				</div>
			</div>
			<div class="users__companies">
				<div class="users__companies--title text-center text-secondary">
					Trusted by
				</div>
				<div class="col-lg-9 m-auto">
					<div class="row users__companies--items">
						<div class="users__companies--item col-3">
							<img src="/img/linked_in.png" alt="">
						</div>
						<div class="users__companies--item col-3">
							<img src="/img/uga.png" alt="">
						</div>
						<div class="users__companies--item col-3">
							<img src="/img/emyth.png" alt="">
						</div>
						<div class="users__companies--item col-3">
							<img src="/img/zendesk.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container get_started d-flex justify-content-center">
			<div class="col-lg-6">
				<h2 class="signup__header mb-4 text-center">
					Get started for free today
				</h2>
				<SmallLoginForm dashboard-button-centered />
			</div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex';

	export default {
		components: {
			SmallLoginForm: () => import('./components/SmallLoginForm'),
		},

		data() {
			return {
				//
			};
		},
		
		computed: {
			...mapState([
				'auth',
				'locale',
			]),
		},

		mounted() {
			//
		},

		methods: {
			//
		},
	};
</script>

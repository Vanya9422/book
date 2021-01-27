import VueRouter from 'vue-router';

const routes = [
	{
		path: '/',
		
		redirect: (to) => {
			return {
				name: 'main.home',
				params: { locale: router.app.$store.state.locale },
			};
		},
	},
	
	// pages
	{
		path: '/',
		component: () => import('./components/Main/Main'),
		
		children: [
			{
				path: '/:locale([a-z]{2})',
				name: 'main.home',
				component: () => import('./components/Main/MainHome'),
			},
			{
				path: '/:locale([a-z]{2})/pricing',
				name: 'main.pricing',
				component: () => import('./components/Main/MainPricing'),
			},
			{
				path: '/:locale([a-z]{2})/features',
				name: 'main.features',
				component: () => import('./components/Main/MainFeatures'),
			},
			{
				path: '/:locale([a-z]{2})/terms',
				name: 'main.terms',
				component: () => import('./components/Main/MainTerms'),
			},
			{
				path: '/:locale([a-z]{2})/privacy',
				name: 'main.privacy',
				component: () => import('./components/Main/MainPrivacy'),
			},
			{
				path: '/:locale([a-z]{2})/teams',
				name: 'main.teams',
				component: () => import('./components/Main/MainTeams'),
			},
			{
				path: '/:locale([a-z]{2})/about',
				name: 'main.about',
				component: () => import('./components/Main/MainAbout'),
			},
		],
	},
	
	// auth
	{
		path: '/',
		component: () => import('./components/Auth/Auth'),
		
		children: [
			{
				path: '/:locale([a-z]{2})/login',
				name: 'auth.login',
				component: () => import('./components/Auth/AuthLogin'),
			},
			{
				path: '/:locale([a-z]{2})/register',
				name: 'auth.register',
				component: () => import('./components/Auth/AuthRegister'),
			},
			{
				path: '/:locale([a-z]{2})/password/reset/:token',
				name: 'auth.password.reset',
				component: () => import('./components/Auth/AuthPasswordReset'),
			},
		],
	},
	
	// intro
	{
		path: '/',
		component: () => import('./components/Intro/Intro'),
		
		children: [
			{
				path: '/intro/basic',
				name: 'intro.basic',
				component: () => import('./components/Intro/IntroBasic'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/intro/calendar',
				name: 'intro.calendar',
				component: () => import('./components/Intro/IntroCalendar'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/intro/calendar/settings',
				name: 'intro.calendar.settings',
				component: () => import('./components/Intro/IntroCalendarSettings'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/intro/availability',
				name: 'intro.availability',
				component: () => import('./components/Intro/IntroAvailability'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/intro/role',
				name: 'intro.role',
				component: () => import('./components/Intro/IntroRole'),
				meta: { loggedInOnly: true },
			},
		],
	},
	
	// dashboard
	{
		path: '/',
		component: () => import('./components/Dashboard/Dashboard'),
		
		children: [
			{
				path: '/dashboard',
				name: 'dashboard.home',
				component: () => import('./components/Dashboard/DashboardHome'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/dashboard/stats',
				name: 'dashboard.stats',
				component: () => import('./components/Dashboard/DashboardStats'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/',
				component: () => import('./components/Dashboard/DashboardScheduled/DashboardScheduled'),
				
				children: [
					{
						path: '/dashboard/scheduled/upcoming',
						name: 'dashboard.scheduled.upcoming',
						component: () => import('./components/Dashboard/DashboardScheduled/DashboardScheduledUpcoming'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/scheduled/past',
						name: 'dashboard.scheduled.past',
						component: () => import('./components/Dashboard/DashboardScheduled/DashboardScheduledPast'),
						meta: { loggedInOnly: true },
					},
				],
			},
			{
				path: '/',
				component: () => import('./components/Dashboard/DashboardBilling/DashboardBilling'),
				
				children: [
					{
						path: '/dashboard/billing',
						name: 'dashboard.billing.overview',
						component: () => import('./components/Dashboard/DashboardBilling/DashboardBillingOverview'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/billing/payouts',
						name: 'dashboard.billing.payouts',
						component: () => import('./components/Dashboard/DashboardBilling/DashboardBillingPayouts'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/billing/cards',
						name: 'dashboard.billing.cards',
						component: () => import('./components/Dashboard/DashboardBilling/DashboardBillingCards'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/billing/plan-details',
						name: 'dashboard.billing.plan_details',
						component: () => import('./components/Dashboard/DashboardBilling/DashboardBillingPlanDetails'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/billing/users-on-plan',
						name: 'dashboard.billing.users_on_plan',
						component: () => import('./components/Dashboard/DashboardBilling/DashboardBillingUsersOnPlan'),
						meta: { loggedInOnly: true },
					},
				],
			},
			{
				path: '/',
				component: () => import('./components/Dashboard/DashboardSettings/DashboardSettings'),
				
				children: [
					{
						path: '/dashboard/settings/profile',
						name: 'dashboard.settings.profile',
						component: () => import('./components/Dashboard/DashboardSettings/DashboardSettingsProfile'),
						meta: { loggedInOnly: true },
					},
					{
						path: '/dashboard/settings/login',
						name: 'dashboard.settings.login',
						component: () => import('./components/Dashboard/DashboardSettings/DashboardSettingsLogin'),
						meta: { loggedInOnly: true },
					},
				],
			},
			{
				path: '/dashboard/calendar-connections',
				name: 'dashboard.calendar_connections',
				component: () => import('./components/Dashboard/DashboardCalendarConnections'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/dashboard/booking-pages/create',
				name: 'dashboard.booking_pages.create',
				component: () => import('./components/Dashboard/DashboardBookingPage/DashboardBookingPage'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/dashboard/booking-pages/:bookingPageId/edit',
				name: 'dashboard.booking_page.edit',
				component: () => import('./components/Dashboard/DashboardBookingPage/DashboardBookingPage'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/dashboard/booking-pages/:bookingPageId/booking-types/create',
				name: 'dashboard.booking_page.booking_types.create',
				component: () => import('./components/Dashboard/DashboardBookingType/DashboardBookingType'),
				meta: { loggedInOnly: true },
			},
			{
				path: '/dashboard/booking-pages/:bookingPageId/booking-types/:bookingTypeId/edit',
				name: 'dashboard.booking_page.booking_type.edit',
				component: () => import('./components/Dashboard/DashboardBookingType/DashboardBookingType'),
				meta: { loggedInOnly: true },
			},
		],
	},

	// booking page
	{
		path: '/',
		component: () => import('./components/BookingPage/BookingPage'),

		children: [
			{
				path: '/:locale([a-z]{2})/:bookingPageSlug',
				name: 'booking_page.home',
                
				component: () => {
					// TODO: some logic to switch between Procedural & Full modes
					return import('./components/BookingPage/BookingPageHomeProcedural');
				},
			},
			{
				path: '/:locale([a-z]{2})/:bookingPageSlug/:bookingTypeSlug',
				name: 'booking_page.booking_type',
				component: () => import('./components/BookingPage/BookingPageBookingType'),
			},
		],
	},

	// temp
	{
		path: '/',
		component: () => import('./components/Temp/Temp'),

		children: [
			{
				path: '/temp/video-room',
				name: 'temp.video_room',
				component: () => import('./components/Temp/TempVideoRoom'),
			},
			{
				path: '/temp/stream-room',
				name: 'temp.stream_room',
				component: () => import('./components/Temp/TempStreamRoom'),
			},
			{
				path: '/temp/webinar-booking',
				name: 'temp.webinar_booking',
				component: () => import('./components/Temp/TempWebinarBooking'),
			},
			{
				path: '/temp/webinar-confirmation',
				name: 'temp.webinar_confirmation',
				component: () => import('./components/Temp/TempWebinarConfirmation'),
			},
			{
				path: '/temp/booking-page',
				name: 'temp.booking_page',
				component: () => import('./components/Temp/TempBookingPage'),

				children: [
					{
						path: '/temp/booking-page/mobile/intro',
						name: 'temp.booking_page.mobile.intro',
						component: () => import('./components/Temp/BookingPage/Mobile/TempBookingPageMobileIntro'),
					},
					{
						path: '/temp/booking-page/mobile/calendar',
						name: 'temp.booking_page.mobile.calendar',
						component: () => import('./components/Temp/BookingPage/Mobile/TempBookingPageMobileCalendar'),
					},
					{
						path: '/temp/booking-page/mobile/time',
						name: 'temp.booking_page.mobile.time',
						component: () => import('./components/Temp/BookingPage/Mobile/TempBookingPageMobileTime'),
					},
					{
						path: '/temp/booking-page/mobile/confirm',
						name: 'temp.booking_page.mobile.confirm',
						component: () => import('./components/Temp/BookingPage/Mobile/TempBookingPageMobileConfirmation'),
					},
					{
						path: '/temp/booking-page/mobile/confirmed',
						name: 'temp.booking_page.mobile.confirmed',
						component: () => import('./components/Temp/BookingPage/Mobile/TempBookingPageMobileConfirmed'),
					},
					{
						path: '/temp/booking-page/desktop/intro',
						name: 'temp.booking_page.desktop.intro',
						component: () => import('./components/Temp/BookingPage/Desktop/TempBookingPageDesktopIntro'),
					},
					{
						path: '/temp/booking-page/desktop/calendar',
						name: 'temp.booking_page.desktop.calendar',
						component: () => import('./components/Temp/BookingPage/Desktop/TempBookingPageDesktopCalendar'),
					},
					{
						path: '/temp/booking-page/desktop/time',
						name: 'temp.booking_page.desktop.time',
						component: () => import('./components/Temp/BookingPage/Desktop/TempBookingPageDesktopTime'),
					},
					{
						path: '/temp/booking-page/desktop/confirm',
						name: 'temp.booking_page.desktop.confirm',
						component: () => import('./components/Temp/BookingPage/Desktop/TempBookingPageDesktopConfirmation'),
					},
					{
						path: '/temp/booking-page/desktop/confirmed',
						name: 'temp.booking_page.desktop.confirmed',
						component: () => import('./components/Temp/BookingPage/Desktop/TempBookingPageDesktopConfirmed'),
					},
					{
						path: '/temp/booking-page/fullpage/intro',
						name: 'temp.booking_page.fullpage.intro',
						component: () => import('./components/Temp/BookingPage/Fullpage/TempBookingPageFullpageIntro'),
					},
					{
						path: '/temp/booking-page/fullpage/template',
						name: 'temp.booking_page.fullpage.template',
						component: () => import('./components/Temp/BookingPage/Fullpage/TempBookingPageFullpageTemplate'),
					},
				],
			},
		],
	},

	// not found
	{
		path: '/',
		component: () => import('./components/Main/Main'),

		children: [{
			path: '*',
			name: 'main.not_found',
			component: () => import('./components/Main/MainNotFound'),
		}],
	},
];

const router = new VueRouter({
	history: true,
	mode: 'history',
	routes,
	linkActiveClass: 'active',
	
	scrollBehavior(to, from, savedPosition) {
		return { x: 0, y: 0 };
	},
});

export default router;

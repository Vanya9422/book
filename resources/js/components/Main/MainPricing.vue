<template>
	<div>
		<div class="get_started__first">
			<div class="container get_started d-flex justify-content-center">
				<div class="col-lg-6">
					<h2 class="signup__header mb-4 text-center">
						Get started for free today
					</h2>
					<SmallLoginForm dashboard-button-centered autofocus />
				</div>
			</div>
		</div>
		<h2 class="text-center">
			Choose the plan that’s right for you
		</h2>
		<p class="text-center text-secondary pb-4 mb-4 d-block">
			Take your productivity and meetings to the next level
		</p>
		<div class="container plans">
			<div class="plans__line">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 d-flex align-items-end">
							<span class="mr-2">Billed Monthly</span>
							<div class="custom-control custom-switch">
								<input id="customSwitch1" type="checkbox" checked class="custom-control-input">
								<label class="custom-control-label" for="customSwitch1"></label>
							</div>
							<span>Billed Annually</span>
						</div>
						<div class="col-lg-3 p-4 border border-bottom-0 text-center">
							<h4 class="text-center mb-2">
								Basic
							</h4>
							<span class="plans__price"></span>
							<div class="plans__description">
								<small>totally free</small>
							</div>
							<a href="#" class="btn mt-3">Current</a>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-bottom-0 text-center">
							<h4 class="text-center mb-2">
								Premium
							</h4>
							<span class="plans__price"></span>
							<div class="plans__description">
								<small>per user / month</small>
							</div>
							<a href="#" class="btn btn-primary mt-3">Upgrade now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-12 p-4 border bg-light text-secondary">
					Features
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Calendar connections per user</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Connect all of your calendars and we’ll make sure you’re never double-booked on any of them.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							1 calendar / user
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							2 calendars / user
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Calendar integrations with Google Calendar, Office 365, Outlook and iCloud Calendar integrations with Google Calendar, Office 365, Outlook and iCloud Calendar integrations with Google Calendar, Office 365, Outlook and iCloud</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="23" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Schedule unlimited bookings</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Booking types</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Booking types allow you to tailor your availability, meeting duration, location and more depending on the meeting and who’s scheduling with you.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							1 booking type
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							Unlimited booking types
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Personalized Bookify link (e.g. bookify.ai/janedoe)</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Removable Bookify branding</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Pooled availability options for teams (round robin, collective scheduling, multiple team members on one page)</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Group bookings (for tours, webinars, classes, etc.)</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Automated booking notifications</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Notifications of new meetings and cancellations are emailed automatically to you and your invitees, ensuring everyone stays in sync.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Customizable email notifications and reminders</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Send custom emails with information that you determine your invitees need, when they need it.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>SMS notifications</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Add links to booking confirmation pages</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Direct invitees back to your site, payment page or custom thank-you page.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Invitee redirect</small>
							<span
								class="plans__question ml-4 text-white btn-primary"
								title="Automatically redirect invitees to another website instead of displaying a confirmation page after scheduling a booking.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Metrics and reporting</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Automatically redirect invitees to another website instead of displaying a confirmation page after scheduling a booking.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12 p-4 border bg-light text-secondary border-top-0">
					Integrations
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Calendar connections per user</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="tooltip">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Calendar integrations with Google Calendar, Office 365, Outlook and iCloud Calendar integrations with Google Calendar, Office 365, Outlook and iCloud Calendar integrations with Google Calendar, Office 365, Outlook and iCloud</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="23" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Calendar integrations with Google</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<small class="text-secondary">1 booking type</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12 p-4 border bg-light text-secondary border-top-0">
					Integrations
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Add Bookify to your website</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Choose from three ways to add Bookify to your website: inline embed, pop-up text or pop-up widget. Site visitors will be able to schedule without leaving the page.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Color customization when adding Bookify to your website</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Customize the background, accent and button colors of the scheduling page to match your brand’s look and feel.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Intercom integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Let your clients schedule directly in Intercom through your Bookify links.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Over 700 app integrations with Zapier</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Easily trigger actions in other apps after a Bookify booking is scheduled or canceled. Zapier supports 700+ apps including InfusionSoft, Slack, ActiveCampaign, MailChimp, join.me and much more.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Custom integrations with webhooks</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Build custom integrations by directly accessing the Bookify API.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Zoom integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Automatically generate and include Zoom details in new Bookify bookings.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>GoToMeeting integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Automatically generate and include GoToMeeting details in new Bookify bookings.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Salesforce integration and support</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Automate more of your workflow with the Bookify and Salesforce integration. Keep your Salesforce records updated on the fly as new Bookify meetings are scheduled.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>HubSpot Integration </small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Keep your HubSpot records updated on the fly as new meetings are scheduled.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Stripe integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Connect your Stripe account with Bookify so invitees can submit full or partial credit card payments securely upon scheduling a meeting with you. Currently, this feature supports United States Dollar (USD), Australian Dollar (AUD), Canadian Dollar (CAD), Pound Sterling (GBP) and Euro (EUR).">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>PayPal integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Connect your PayPal account with Bookify so invitees can submit full or partial payments with their Paypal account or credit card upon scheduling a meeting with you. Currently, this feature supports United States Dollar (USD), Australian Dollar (AUD), Canadian Dollar (CAD), Pound Sterling (GBP) and Euro (EUR).">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Google Analytics integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Track booking activity and measure campaign conversions.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Facebook Pixel Integration</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="Track meetings scheduled as Facebook conversions.">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12 p-4 border bg-light text-secondary border-top-0">
					Integrations
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Email support</small><span
								class="plans__question ml-4 text-white btn-primary"
								title="TAvailable M-F, 8am-6pm Eastern time">?</span>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							Standard
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							3 hours
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Email support</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/yes.svg" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 border border-top-0 d-flex justify-content-start align-items-center">
							<small>Live Chat</small>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							<img height="28" src="/img/no.svg" alt="">
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 d-flex justify-content-center align-items-center">
							10+ users
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-6 p-4 d-flex align-items-end"></div>
						<div class="col-lg-3 p-4 border border-top-0 text-center">
							<h4 class="text-center mb-2">
								Basic
							</h4>
							<span class="plans__price"></span>
							<div class="plans__description">
								<small>totally free</small>
							</div>
							<a href="#" class="btn mt-3">Current</a>
						</div>
						<div class="col-lg-3 p-4 border border-left-0 border-top-0 text-center">
							<h4 class="text-center mb-2">
								Premium
							</h4>
							<span class="plans__price"></span>
							<div class="plans__description">
								<small>per user / month</small>
							</div>
							<a href="#" class="btn btn-primary mt-3">Upgrade now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container questions">
			<h2 class="text-center mb-4 pb-4">
				Questions? We've got answers.
			</h2>
			<div id="accordionExample" class="accordion">
				<div class="card">
					<div id="headingOne" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link"
								type="button"
								data-toggle="collapse"
								data-target="#collapseOne"
								aria-expanded="true"
								aria-controls="collapseOne">
								What happens at the end of my trial?
							</button>
						</h2>
					</div>
					<div
						id="collapseOne"
						class="collapse show"
						aria-labelledby="headingOne"
						data-parent="#accordionExample">
						<div class="card-body">
							At the end of your 14-day trial, you'll be automatically downgraded to the basic, free plan. Should you wish to upgrade to a paid plan, you can do so from the billing page at any point during or after your trial.
						</div>
					</div>
				</div>
				<div class="card">
					<div id="headingTwo" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#collapseTwo"
								aria-expanded="false"
								aria-controls="collapseTwo">
								Can we try Bookify with multiple users?
							</button>
						</h2>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						<div class="card-body">
							Absolutely! You can invite team members to join your trial account at no cost. At the end of your 14-day trial, all members will be automatically downgraded to the basic, free plan. Should you wish to upgrade to a paid plan, you can do so from the billing page at any point during or after your trial.
							<a href="#">Learn more</a> about the benefits of using Bookify for your team.
						</div>
					</div>
				</div>
				<div class="card">
					<div id="headingThree" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#collapseThree"
								aria-expanded="false"
								aria-controls="collapseThree">
								What does the renewal process look like?
							</button>
						</h2>
					</div>
					<div
						id="collapseThree"
						class="collapse"
						aria-labelledby="headingThree"
						data-parent="#accordionExample">
						<div class="card-body">
							Paid subscriptions automatically renew for the same subscription period unless you downgrade your plan before the end of the subscription period.
						</div>
					</div>
				</div>
				<div class="card">
					<div id="headingThree" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#collapse4"
								aria-expanded="false"
								aria-controls="collapse4">
								How do I upgrade or downgrade?
							</button>
						</h2>
					</div>
					<div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordionExample">
						<div class="card-body">
							It only takes a few clicks to upgrade or downgrade. Just
							<a href="#">visit your billing page</a>, and you can handle everything from there.
						</div>
					</div>
				</div>
				<div class="card">
					<div id="headingThree" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#collapse5"
								aria-expanded="false"
								aria-controls="collapse5">
								We’re a non-profit organization, is there special pricing available?
							</button>
						</h2>
					</div>
					<div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordionExample">
						<div class="card-body">
							We offer special pricing to qualified non-profit organizations.
							<a href="#">Contact our team</a> to learn more.
						</div>
					</div>
				</div>
				<div class="card">
					<div id="headingThree" class="card-header">
						<h2 class="mb-0">
							<button
								class="btn btn-link collapsed"
								type="button"
								data-toggle="collapse"
								data-target="#collapse6"
								aria-expanded="false"
								aria-controls="collapse6">
								What payment methods do you accept?
							</button>
						</h2>
					</div>
					<div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordionExample">
						<div class="card-body">
							We accept Visa, Mastercard, American Express, Discover, JCB and Diners Club credit and debit cards. Invoices and purchase orders can be used for transactions over $5,000.
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="quote">
			<div class="quote__top text-secondary text-center">
				“”
			</div>
			<h2 class="text-center text-secondary">
				Book saves my life daily! It coordinates with all of my calendars, so the back and forth to schedule meetings is eliminated.
			</h2>
			<p class="text-center text-secondary mt-4">
				- Crystal Jones
			</p>
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

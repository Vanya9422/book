require('./vendor');
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueNotification from 'vue-notification';
import router from './router';
import store from './store';
import { createApp } from './app';
import camelcaseKeys from 'camelcase-keys';
import snakecaseKeys from 'snakecase-keys';
import VueScrollTo from 'vue-scrollto';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-Use-Session'] = 'Yes';
axios.defaults.baseURL = '/api/v1';
Vue.use(VueAxios, axios);
Vue.use(VueNotification, { componentName: 'Notifications' });

Vue.use(VueScrollTo, {
	container: 'html',
	duration: 500,
	easing: 'ease',
	offset: 0,
	force: true,
	cancelable: true,
	onStart: false,
	onDone: false,
	onCancel: false,
	x: false,
	y: true,
});

import { extend as veeValidateExtend } from 'vee-validate';

import {
	required as requiredRule,
	email as emailRule,
} from 'vee-validate/dist/rules';

veeValidateExtend('email', emailRule);
veeValidateExtend('required', requiredRule);

// ---------------------------------------------------------------------- //

store.replaceState({
	...camelcaseKeys(__INITIAL_STATE__, {
		deep: true,
		stopPaths: ['translations', 'time_formats', 'date_formats'],
	}),

	detectedLocality: JSON.parse(localStorage.getItem('detected_locality')),
});

router.beforeEach(async (to, from, next) => {
	console.log('beforeEach', to, from);
	console.log('beforeEach', store.state.css, to.name.split(/[.]/)[0]);

	if (to.meta.loggedInOnly && !store.state.auth.user) {
		return next({
			name: 'auth.login',
			params: { locale: store.state.locale },
		});
	}

	if (to.name.match(/^booking_page[.].+/)) {
		if (!store.state.bookingPage || store.state.bookingPage.slug !== to.params.bookingPageSlug) {
			try {
				await store.dispatch('getBookingPage', { slug: to.params.bookingPageSlug });
				console.log('Booking Page loaded!');
			} catch (error) {
				console.error(error);
				store.commit('setBookingPage', { id: 0, slug: to.params.bookingPageSlug });
			}
		}

		if (!store.state.bookingPage.id) {
			return next({ name: 'main.not_found', params: [to.path], replace: true });
		}

		if (to.name.match(/^booking_page[.]booking_type$/)) {
			if (!store.state.bookingType || store.state.bookingType.slug !== to.params.bookingTypeSlug) {
				try {
					await store.dispatch('getBookingType', { slug: to.params.bookingTypeSlug });
					console.log('Booking Type loaded!');
				} catch (error) {
					console.error(error);
					store.commit('setBookingType', { id: 0, slug: to.params.bookingTypeSlug });
				}
			}

			if (!store.state.bookingType.id) {
				return next({ name: 'main.not_found', params: [to.path], replace: true });
			}
		}

		// Vue.loadStyle(store.state.css[to.name.split(/[.]/)[0]]);
		return next();
	}

	console.log('META TITLE', `meta.${to.name || 'main.not_found'}.title`);
	document.title = Vue.trans(`meta.${to.name || 'main.not_found'}.title`) + ' – ' + document.title.split(/–/).pop().trim();
	// Vue.loadStyle(store.state.css[to.name.split(/[.]/)[0]]);
	return next();
});

Vue.config.errorHandler = (error, vm, info) => {
	if (error.response) {
		console.error(error.response.data);

		return vm.$notify({
			title: error.response.data.error,
			text: error.response.data.message,
			type: 'error',
		});
	}

	console.error(error);

	return vm.$notify({
		text: 'Internal Client Error',
		type: 'error',
	});
};

axios.interceptors.request.use((config) => {
	if (config.params) {
		config.params = snakecaseKeys(config.params, { deep: true });
	}

	if (config.data && !(config.data instanceof FormData)) {
		config.data = snakecaseKeys(config.data, { deep: true });
	}

	return config;
}, async (error) => {
	throw error;
});

axios.interceptors.response.use((response) => {
	if (response.data) {
		response.data = camelcaseKeys(response.data, {
			deep: true,
			stopPaths: ['validation_fields'],
		});
	}

	return response;
}, async (error) => {
	if (error.response) {
		error.response.data = camelcaseKeys(error.response.data, {
			deep: true,
			stopPaths: ['validation_fields'],
		});
	}

	if (axios.interceptors.response.error) {
		throw error;
	}

	if (error.response && ['Unauthenticated', 'CSRF Token Mismatch'].indexOf(error.response.data.error) > -1) {
		let previousError = axios.interceptors.response.error = error;

		try {
			let response = await axios.get('/auth/refresh');
			delete axios.interceptors.response.error;

			if (previousError.response.data.error === 'Unauthenticated' && !response.data.data.isAuthenticated) {
				throw previousError;
			}
		} catch (error) {
			delete axios.interceptors.response.error;
			throw previousError;
		}

		console.log('axios.request', error.config);
		return axios.request(error.config);
	}

	throw error;
});

// ---------------------------------------------------------------------- //

const { app } = createApp();
window.app = app;
window.Vue = Vue;
window.state = store.state;
router.onReady(() => app.$mount('#app'));

if (module.hot) {
	const api = require('vue-hot-reload-api');
	api.install(Vue);
	
	if (!api.compatible) {
		throw new Error('vue-hot-reload-api is not compatible with the version of Vue you are using.');
	}
	
	module.hot.accept();
}

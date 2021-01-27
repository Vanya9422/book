import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
	state: {},
	
	actions: {
		async checkEmail({ commit }, email) {
			let response = await Vue.axios.post(`/auth/email/check`, {
				user: { email },
			});
			
			commit('setAuthEmail', response.data.data);
		},
		
		async forgetEmail({ commit }) {
			await Vue.axios.post(`/auth/email/forget`);
			commit('setAuthEmail', null);
		},
		
		async login({ commit }, data) {
			let response = await Vue.axios.post(`/auth/login`, data);
			commit('setAuth', response.data.data);
			commit('setLocale', response.data.data.user.locale);
		},
		
		async register({ commit }, data) {
			let response = await Vue.axios.post(`/auth/register`, data);
			commit('setAuth', response.data.data);
		},
		
		async getBookingPage({ commit }, data) {
			let response = await Vue.axios.get(`/booking_pages/slug:${data.slug}`);
			commit('setBookingPage', response.data.data);
		},
		
		async setBookingPageData({ commit }, data) {
			commit('setBookingPage', data);
		},
		
		async getBookingType({ commit, state }, data) {
			let response = await Vue.axios.get(`/booking_pages/${state.bookingPage.id}/booking_types/slug:${data.slug}`);
			commit('setBookingType', response.data.data);
		},
	},
	
	mutations: {
		setAuth(state, data) {
			Vue.set(state, 'auth', data);
		},
		
		setAuthEmail(state, data) {
			Vue.set(state.auth, 'email', data);
		},
		
		mergeAuthUser(state, data) {
			if (!state.auth) {
				return;
			}
			
			state.auth.user = { ...state.auth.user, ...data };
		},
		
		setLocale(state, locale) {
			Vue.set(state, 'locale', locale);
		},
		
		setDetectedLocality(state, data) {
			Vue.set(state, 'detectedLocality', data);
		},
		
		setBookingPage(state, data) {
			Vue.set(state, 'bookingPage', data);
		},
		
		setBookingType(state, data) {
			Vue.set(state, 'bookingType', data);
		},
	},
	
	getters: {
		getBooking: state => state.bookingPage,
	},
});

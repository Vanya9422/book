import Vue from 'vue';
import 'es6-promise/auto';
import VueRouter from 'vue-router';
import VSelect from 'vue-select';
import VueMoment from 'vue-moment';
import moment from 'moment-timezone';
import VueClipboard from 'vue-clipboard2';
import { ValidationProvider } from 'vee-validate';
import router from './router';
import helpers from './helpers';
import store from './store';
import App from './components/App.vue';

// ---------------------------------------------------------------------- //

Vue.component('VSelect', VSelect);
Vue.component('ValidationProvider', ValidationProvider);
Vue.use(VueRouter);
Vue.use(VueMoment, { moment });
Vue.use(VueClipboard);
Vue.use(helpers, { store });

// ---------------------------------------------------------------------- //

export function createApp() {
	const app = new Vue({
		router,
		store,
		render: h => h(App),
	});
	
	return { app, router, store };
}

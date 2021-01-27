import Vue from 'vue';
import { createApp } from './app';
import VueNotification from 'vue-notification/dist/ssr';
import camelcaseKeys from 'camelcase-keys';

export default (context) => {
	return new Promise((resolve, reject) => {
		Vue.use(VueNotification);
		const { app, store, router } = createApp();
		
		store.replaceState(camelcaseKeys(context.state, {
			deep: true,
			stopPaths: ['translations', 'time_formats', 'date_formats'],
		}));
		
		context.route = camelcaseKeys(context.route, { deep: true });
		
		if (app.$router.match(context.route).matched.length > 0) {
			// console.log('[context.route]', context.route, app.$router.match(context.route).matched);
			router.push(context.route);
		} else {
			// console.log('[context.url]', context.url, app.$router.match(context.url).matched);
			router.push(context.url);
		}
		
		router.onReady(() => {
			return resolve(app);
		});
	});
};

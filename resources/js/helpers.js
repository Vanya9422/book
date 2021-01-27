export default {
	install: (Vue, { store }) => {
		function trans(path, parameters) {
			if (!store.state.translations) {
				throw new Error('No language loaded');
			}
			
			parameters = parameters || [];
			
			let expression = path.split(/[.]/).reduce(function (list, part) {
				return list && list[part] ? list[part] : null;
			}, store.state.translations) || '';
			
			(expression && typeof expression === 'string') && (expression.match(/[:][a-z_]+/g) || []).map(function (match) {
				return match.slice(1);
			}).filter(function (parameterName, parameterNameIndex, parameterNames) {
				return parameterNames.indexOf(parameterName) === parameterNameIndex;
			}).sort(function (parameterName0, parameterName1) {
				return parameterName1.length - parameterName0.length;
			}).forEach((parameterName) => {
				if (typeof parameters[parameterName] === 'undefined') {
					throw new Error('Parameter `' + parameterName + '` is not set in `' + path + '` path');
				}
				
				expression = expression.replace(new RegExp('[:]' + parameterName, 'g'), parameters[parameterName] || '');
			});
			
			return expression || path;
		}
		
		Vue.trans = Vue.__ = trans;
		Vue.prototype.$trans = Vue.prototype.__ = trans;
		
		function parseTimeString(timeString) {
			timeString = (timeString.match(/[0-9]+|am|pm|a|p/gi) || []).filter((part, partIndex, parts) => {
				if (part.match(/^[0-9]+$/)) {
					return true;
				}
				
				return !parts.slice(partIndex + 1).some((part) => {
					return part.match(/^[0-9]+$/);
				});
			}).filter((part, partIndex, parts) => {
				if (part.match(/^[0-9]+$/)) {
					return true;
				}
				
				return !parts.slice(0, partIndex).some((part) => {
					return !part.match(/^[0-9]+$/);
				});
			}).join(' ');
			
			// let k = ["hmma", "hmm a", "h:mma", "h:mm a", "hhmma", "hh:mma", "hh:mm a"];
			// let O = ["H", "HH", "Hmm", "HHmm", "HH:mm"];
			
			let formats = [
				...['H', 'HH', 'Hmm', 'HHmm', 'H m', 'H mm', 'HH m', 'HH mm'],
				...['h a', 'hh a', 'hmm a', 'hhmm a', 'h m a', 'h mm a', 'hh m a', 'hh mm a'],
			];
			
			for (let format of formats) {
				let moment = Vue.moment(timeString, format, true);
				
				if (!moment.isValid()) {
					continue;
				}
				
				console.log(format, timeString);
				return moment.toDate();
			}
			
			return parseTimeString('12:00 am');
		}
		
		Vue.parseTimeString = parseTimeString;
		Vue.prototype.$parseTimeString = parseTimeString;
		
		async function detectLocality() {
			if (localStorage.getItem('detected_locality')) {
				return JSON.parse(localStorage.getItem('detected_locality'));
			}
			
			let response = await Vue.axios.get('/localities/detect');
			localStorage.setItem('detected_locality', JSON.stringify(response.data.data));
			return response.data.data;
		}
		
		Vue.detectLocality = detectLocality;
		Vue.prototype.$detectLocality = detectLocality;
	},
};

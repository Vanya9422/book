<template>
	<div id="app">
		<router-view />
		<Notifications />
	</div>
</template>

<script>
	export default {
		components: {
			//
		},
		
		data() {
			return {
				//
			};
		},
		
		mounted() {
			this.updateDetectedLocality();
		},
		
		methods: {
			async updateDetectedLocality() {
				if (this.$store.state.detectedLocality) {
					return;
				}
				
				let response = await this.$http.get('/localities/detect');
				this.$store.commit('setDetectedLocality', response.data.data);
				response.data.data && localStorage.setItem('detected_locality', JSON.stringify(response.data.data));
			},
		},
	};
</script>

<style lang="scss">
	@import '../../sass/_variables';
	@import url('https://fonts.googleapis.com/css?family=Nunito');
	
	@import '../../sass/bootstrap';
	@import '../../sass/cropperjs';
	@import '../../sass/vue-select';
	
	@import '../../sass/app';
	@import '../../sass/app-extension';
</style>

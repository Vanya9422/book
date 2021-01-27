<template>
	<div class="container pt-3">
		<DashboardBookingPageItem v-for="bookingPage in bookingPages" :key="bookingPage.id"
			:booking-page="bookingPage" />
	</div>
</template>

<script>
    export default {
        data() {
            return {
                bookingPages: [],
            };
        },

        async mounted() {
            console.log('DashboardHome mounted');
            await this.getBookingPages();
        },

        components: {
            DashboardBookingPageItem: () => import('../components/DashboardBookingPageItem'),
        },

        methods: {
            async getBookingPages() {
                try {
                    let response = await this.$http.get('/users/me/booking_pages');
                    this.bookingPages = response.data.data;
                } catch (error) {
                    throw error;
                }
            },
        },
    };
</script>

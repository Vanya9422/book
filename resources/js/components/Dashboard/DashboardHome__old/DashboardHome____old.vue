<template>
    <div>
<!--        <div class="container-fluid pl-4 pr-4 ">-->
<!--            <div class="container">-->
<!--                <div class="d-flex justify-content-between align-items-center">-->
<!--                    <ul class="nav nav-pills align-items-center" id="pills-tab" role="tablist">-->
<!--                        <button type="button" class="btn btn-link btn-sm mr-2 p-0 text-decoration-none" data-toggle="modal" data-target="#settings_modal">-->
<!--                            <span class="row align-items-center m-0 text-dark">-->
<!--                                <img src="/img/settings.svg" width="20" alt="">-->
<!--                                <strong class="ml-2">Bookings</strong>-->
<!--                            </span>-->
<!--                        </button>-->

<!--                        <li class="nav-item rounded-top">-->
<!--                            <a class="nav-link rounded-0 rounded-top active">Events</a>-->
<!--                        </li>-->
<!--                        <li class="nav-item rounded-top">-->
<!--                            <a class="nav-link rounded-0 rounded-top">Hourly Services</a>-->
<!--                        </li>-->
<!--                    </ul>-->

<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="container pt-4">-->
<!--            <div class="d-flex justify-content-between align-items-center">-->
<!--                <div class="d-flex align-items-center">-->
<!--                    <router-link class="btn btn-outline-primary mr-2" role="tab" :to="{ name: 'dashboard.stats' }">Stats</router-link>-->
<!--                    <router-link class="btn btn-outline-primary mr-2" role="tab" :to="{ name: 'dashboard.home' }" exact>Booking Types</router-link>-->
<!--                    <a class="btn btn-outline-primary mr-2" role="tab" href="#">-->
<!--                        Bookings-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="modal fade" id="settings_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Booking Sections</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Which sections should we should to your bookify visitors?</p>
                        <div class="row mr-0 ml-0 mb-4 align-items-center justify-content-between ">
                            <div class="col pl-0">
                                <label for="events_switch" class="mb-1"><strong>Events</strong></label>
                                <small class="d-block">People can book you for different event types.</small>
                            </div>
                            <div class="form-group mb-0 ml-2 mr-2">
                        <span class="switch">
                            <input type="checkbox" checked="" class="switch" id="events_switch">
                            <label for="events_switch" class="m-0"></label>
                        </span>
                            </div>
                        </div>
                        <div class="row mr-0 ml-0 mb-4 align-items-center justify-content-between ">
                            <div class="col pl-0">
                                <label for="hourly_services_switch" class="mb-1"><strong>Hourly Services</strong></label>
                                <small class="d-block">People can book you per hour for specific services such as advising/consulting/video conferencing/1-1 voice chats &amp; calls.</small>
                            </div>
                            <div class="form-group mb-0 ml-2 mr-2">
                        <span class="switch">
                            <input type="checkbox" checked="" class="switch" id="hourly_services_switch">
                            <label for="hourly_services_switch" class="m-0"></label>
                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>

        <router-view />
    </div>
</template>

<script>
    export default {
        data() {
            return {
                //
            };
        },

        mounted() {
            console.log('DashboardHomeLayout mounted!');
        },

        components: {
            //
        },

        methods: {
            //
        },
    };
</script>

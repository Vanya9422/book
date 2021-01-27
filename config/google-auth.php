<?php

return [

    /*
     * Path to the json file containing the credentials.
     */
    'service_account_credentials_json' => storage_path('app/google-calendar/service-account-credentials.json'),

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),

    "web" => [
        "client_id" => env('GOOGLE_CLIENT_ID'),
        "project_id"=> env('GOOGLE_PROJECT_ID'),
        "auth_uri"=> env('GOOGLE_AUTH_URI'),
        "token_uri"=> env('GOOGLE_TOKEN_URI'),
        "auth_provider_x509_cert_url"=> env('GOOGLE_AUTH_PROVIDEO_X509_CERT_URL'),
        "client_secret"=> env('GOOGLE_CLIENT_SECRET')
    ],

];

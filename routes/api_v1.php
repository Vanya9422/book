<?php

Route::get('/test', function () {
    dd(request()->include([
        'a' => 'Hi!',
        'c',
        'b',
    ]));
    
    $user = \App\Models\User\User::first();
    
    $user->load([
        'first_booking_page' => function () {
        },
    ]);
    
    dd($user);
    
    // request()->include([
    // 	'a',
    // 	'b',
    // 	'c',
    // ]);
});

// ---------------------------------------------------------------------- //

Route::prefix('/auth')->group(function () {
    Route::post('/login', 'Api\V1\Auth\LoginController@login');
    Route::get('/refresh', 'Api\V1\Auth\LoginController@refresh');
    Route::post('/email/check', 'Api\V1\Auth\EmailController@check');
    Route::post('/email/forget', 'Api\V1\Auth\EmailController@forget');
    Route::post('/logout', 'Api\V1\Auth\LoginController@logout')->name('api.v1.auth.logout');
    Route::post('/register', 'Api\V1\Auth\RegisterController@register');
    Route::post('/password/email', 'Api\V1\Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'Api\V1\Auth\ResetPasswordController@reset');
    Route::post('/password/change', 'Api\V1\Auth\ChangePasswordController@change');
});

// ---------------------------------------------------------------------- //

Route::prefix('/localities')->group(function () {
    Route::get('/detect', 'Api\V1\LocalityController@detect');
    Route::get('/autocomplete', 'Api\V1\LocalityController@autocomplete');
    
    Route::prefix('/{locality_key}')->group(function () {
        Route::get('/', 'Api\V1\LocalityController@get');
    });
});

// ---------------------------------------------------------------------- //

Route::prefix('/intro')->middleware('logged_in_only')->group(function () {
    Route::post('/basic', 'Api\V1\IntroController@basic');
    Route::post('/calendar', 'Api\V1\IntroController@calendar');
    Route::post('/calendar/settings', 'Api\V1\IntroController@calendarSettings');
    Route::post('/availability', 'Api\V1\IntroController@availability');
    Route::post('/role', 'Api\V1\IntroController@role');
});

Route::prefix('/users')->group(function () {
    Route::prefix('/{user_id}')->group(function () {
        Route::get('/', 'Api\V1\UserController@get')->name('api.v1.user');
        Route::post('/update', 'Api\V1\UserController@update');
        Route::post('/change_email', 'Api\V1\UserController@changeEmail');
        Route::get('/teams', 'Api\V1\UserController@teams');
        Route::get('/booking_pages', 'Api\V1\UserController@bookingPages');
        Route::post('/booking_pages/create', 'Api\V1\UserController@createBookingPage');
    });
});

Route::prefix('/teams')->group(function () {
    Route::get('/suggest_slug', 'Api\V1\TeamController@suggestSlug');
    
    Route::prefix('/{team_id}')->group(function () {
        Route::get('/suggest_slug', 'Api\V1\TeamController@suggestSlug');
    });
});

Route::prefix('/booking_pages')->group(function () {
    Route::post('/create', 'Api\V1\BookingPageController@create');
    
    Route::prefix('/{booking_page_id}')->group(function () {
        Route::get('/', 'Api\V1\BookingPageController@get')->name('api.v1.booking_page');
        Route::post('/update', 'Api\V1\BookingPageController@update');
        Route::post('/booking_types/create', 'Api\V1\BookingPageController@createBookingType');
        Route::get('/booking_types/suggest_slug', 'Api\V1\BookingPageController@suggestBookingTypeSlug');
        Route::get('/booking_types/{booking_type_id}', 'Api\V1\BookingPageController@bookingType')->name('api.v1.booking_page.booking_type');
        Route::get('/get_payout_methods/{page_id}', 'Api\V1\BookingPageController@getPayoutMethods');
        Route::post('/create_payout_method', 'Api\V1\BookingPageController@createPayoutMethod');
        Route::post('/delete_payout_method', 'Api\V1\BookingPageController@deletePayoutMethod');
    });
});

Route::prefix('/booking_types')->group(function () {
    Route::post('/portfolio_photos', 'Api\V1\BookingTypeController@updatePortfolioPhotos');
    Route::prefix('/{booking_type_id}')->group(function () {
        Route::get('/', 'Api\V1\BookingTypeController@get')->name('api.v1.booking_type');
        Route::post('/update', 'Api\V1\BookingTypeController@update');
        Route::post('/activate', 'Api\V1\BookingTypeController@activate');
        Route::post('/deactivate', 'Api\V1\BookingTypeController@deactivate');
        Route::get('/suggest_slug', 'Api\V1\BookingTypeController@suggestSlug');
        Route::get('/available_dates', 'Api\V1\BookingTypeController@availableDates');
        Route::post('/book', 'Api\V1\BookingTypeController@book');
    });
});

// ---------------------------------------------------------------------- //

Route::get('/{any?}', function () {
    abort(404);
})->where('any', '.*');

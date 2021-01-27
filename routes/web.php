<?php

Route::prefix('/auth')->group(function () {
	Route::get('/google', 'Auth\SocialController@google')->name('auth.google');
});

Route::prefix('/intro')->middleware([
    'check_entry_point_route',
])->group(function () {
    Route::get('/', 'MainController@default')->name('intro.index');
    Route::get('/basic', 'MainController@default')->name('intro.basic');
    Route::get('/calendar', 'MainController@default')->name('intro.calendar');
    Route::get('/calendar/settings', 'MainController@default')->name('intro.calendar.settings');
    Route::get('/availability', 'MainController@default')->name('intro.availability');
    Route::get('/role', 'MainController@default')->name('intro.role');
    Route::get('/{any?}', 'MainController@default')->where('any', '.*')->name('intro.other');
});

Route::prefix('/dashboard')->middleware([
    'check_entry_point_route',
])->group(function () {
    Route::get('/', 'MainController@default')->name('dashboard.home');
    Route::get('/calendar-connections', 'MainController@default')->name('dashboard.calendar_connections');
    Route::get('/{any?}', 'MainController@default')->where('any', '.*')->name('dashboard.other');
});

Route::prefix('/temp')->group(function () {
    Route::get('/video-room', 'MainController@default')->name('temp.video_room');
    Route::get('/{any?}', 'MainController@default')->where('any', '.*')->name('temp.other');
});

// ---------------------------------------------------------------------- //

Route::prefix('/{locale?}')->middleware([
    // 'fast_login',
    'check_entry_point_route',
    // 'referrer_user_detection',
    // 'ad_campaign_detection',
])->group(function () {
    Route::get('/login', 'MainController@default')->name('auth.login');
    Route::get('/register', 'MainController@default')->name('auth.register');
    Route::get('/password/reset/{token}', 'MainController@default')->name('auth.password.reset');

    Route::get('/', 'MainController@default')->name('main.home');
    Route::get('/pricing', 'MainController@default')->name('main.pricing');
    Route::get('/features', 'MainController@default')->name('main.features');
    Route::get('/terms', 'MainController@default')->name('main.terms');
    Route::get('/privacy', 'MainController@default')->name('main.privacy');
    Route::get('/teams', 'MainController@default')->name('main.teams');
    Route::get('/about', 'MainController@default')->name('main.about');
    Route::get('/{booking_page_slug}', 'BookingPageController@home')->name('booking_page.home');
    Route::get('/{booking_page_slug}/{booking_type_slug}', 'BookingPageController@bookingType')->name('booking_page.booking_type');
    Route::get('/{any?}', 'MainController@notFound')->where('any', '.*')->name('main.not_found');
});

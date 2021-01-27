<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingPageController extends Controller
{
    public function home(Request $request, $locale, $bookingPageSlug)
    {
        store()->getBookingPageBySlug($bookingPageSlug);
        store('meta.title', store('state.booking_page.computed_title'));
        
        return response()->handle();
    }
    
    public function bookingType(Request $request, $locale, $bookingPageSlug, $bookingTypeSlug)
    {
        store()->getBookingPageBySlug($bookingPageSlug);
        
        store()->getBookingPageBookingType([
            'booking_page_id' => store('state.booking_page.id'),
            'booking_type_slug' => $bookingTypeSlug,
        ]);
        
        store('meta.title', store('state.booking_type.name') . ' – ' . store('state.booking_page.computed_title'));
        
        return response()->handle();
    }
}

<?php

namespace App\Policies;

use App\Models\BookingPage\BookingPage;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPagePolicy
{
    use HandlesAuthorization;
    
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function edit(User $user, BookingPage $bookingPage)
    {
        return true;
        
        if ($bookingPage->owner_type == 'User' && $bookingPage->owner_id == $user->id) {
            return true;
        }
        
        return false;
    }
    
    public function createBookingType(User $user, BookingPage $bookingPage)
    {
        return true;
        
        if ($bookingPage->owner_type == 'User' && $bookingPage->owner_id == $user->id) {
            return true;
        }
        
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\BookingType\BookingType;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingTypePolicy
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
    
    public function edit(User $user, BookingType $bookingType)
    {
        return $user->can('edit', $bookingType->booking_page()->first());
    }
}

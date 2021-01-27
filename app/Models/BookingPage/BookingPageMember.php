<?php

namespace App\Models\BookingPage;

use Illuminate\Database\Eloquent\Model;

class BookingPageMember extends Model
{
    const ROLE_OWNER = 'OWNER';
    
    public static $roles = [
        self::ROLE_OWNER,
    ];
}

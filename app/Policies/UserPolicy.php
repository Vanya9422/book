<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
    
    public function access(User $authUser, User $user)
    {
        return $user->id == $authUser->id;
    }
    
    public function edit(User $authUser, User $user)
    {
        return $user->id == $authUser->id;
    }
}

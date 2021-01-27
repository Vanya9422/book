<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function check(Request $request)
    {
        validator()->make($request->all(), [
            'user' => 'required|array',
            'user.email' => 'required|email',
        ])->validate();
        
        $emailValue = strtolower($request->input('user.email'));
        $userQuery = User::selectRaw('id, first_name, last_name, auth_method');
        $userQuery->where('email', $request->input('user.email'));
        $user = $userQuery->first();
        
        $request->session()->put('auth.email', [
            'value' => $request->input('user.email'),
            'type' => auth()->getEmailType($emailValue),
            'user' => $user ? $user->makeVisible(['auth_method'])->toArray() : null,
        ]);
        
        return response()->resource($request->session()->get('auth.email'));
    }
    
    public function forget(Request $request)
    {
        $request->session()->forget('auth.email');
    }
}

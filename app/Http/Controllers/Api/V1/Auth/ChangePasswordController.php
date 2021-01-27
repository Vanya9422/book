<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;
use Laravel\Passport\ApiTokenCookieFactory;

class ChangePasswordController extends Controller
{
    /**
     * The API token cookie factory instance.
     *
     * @var \Laravel\Passport\ApiTokenCookieFactory
     */
    protected $cookieFactory;
    
    /**
     * Create a new controller instance.
     *
     * @param ApiTokenCookieFactory $cookieFactory
     */
    public function __construct(ApiTokenCookieFactory $cookieFactory)
    {
        $this->middleware('logged_in_only');
        $this->cookieFactory = $cookieFactory;
    }
    
    /**
     * Change User password
     *
     * @bodyParam current_password required Current User password
     * @bodyParam password required New User password
     * @bodyParam password_confirmation New User password confirmation
     *
     * @param Request $request
     * @return mixed
     */
    public function change(Request $request)
    {
        $user = auth()->user();
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) use ($user) {
                    return User::validate($data, [
                        'current_password' => 'required',
                        'password' => 'required|confirmed',
                    ], [
                        'user' => $user,
                    ]);
                },
            ],
        ]);
        
        $user->password = $input['user']['password'];
        $user->save();
        
        auth()->login($user);
        $request->session()->regenerate();
        
        return response()->resource(auth()->toArray())->withCookie($this->cookieFactory->make(auth()->user()->getKey(), $request->session()->token()));
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Auth\SessionGuard;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Passport\ApiTokenCookieFactory;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    
    /**
     * @var array
     */
    protected $input;
    
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
        $this->cookieFactory = $cookieFactory;
    }
    
    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            
            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        
        return $this->sendFailedLoginResponse($request);
    }
    
    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $this->input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) {
                    return validate($data, [
                        'email' => 'required|string',
                        'password' => 'required|string',
                    ]);
                },
            ],
            
            'remember_me' => 'boolean',
        ]);
    }
    
    /**
     * Attempt to log the user into the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        if (!$user = User::where('email', $this->input['user']['email'])->first()) {
            return false;
        }
        
        if (!$user->doesPasswordEqual($this->input['user']['password'])) {
            return false;
        }
        
        if (auth()->guard() instanceof SessionGuard) {
            auth()->login($user, $this->input['user']['remember_me'] ?? false);
        } else {
            auth()->setUser($user);
        }
        
        return true;
    }
    
    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        if (auth()->guard() instanceof SessionGuard) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            
            return response()->resource(auth()->toArray());
        }
        
        $this->clearLoginAttempts($request);
        $token = auth()->user()->createToken(config('app.name'))->accessToken;
        
        return response()->resource(['token' => $token]);
    }
    
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'user.email';
    }
    
    /**
     * Log the user out of the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if (!auth()->guard() instanceof SessionGuard) {
            return response()->resource();
        }
        
        if (!$user = auth()->user()) {
            return response()->resource(auth()->toArray());
        }
        
        $auth_email = [
            'value' => $user->email,
            'type' => $this->guard()->getEmailType($user->email),
            'user' => $user ? $user->toArray() : null,
        ];
        
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->put('auth.email', $auth_email);
        
        return response()->resource(auth()->toArray());
    }
    
    public function refresh()
    {
        return response()->resource([
            'is_authenticated' => auth()->check(),
        ]);
    }
}

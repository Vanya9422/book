<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Auth\SessionGuard;
use App\Http\Controllers\Controller;
use App\Models\Geo\Locality;
use App\Models\User\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Laravel\Passport\ApiTokenCookieFactory;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers;
    
    /**
     * The API token cookie factory instance.
     *
     * @var \Laravel\Passport\ApiTokenCookieFactory
     */
    protected $cookieFactory;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/intro';
    
    /**
     * Create a new controller instance.
     *
     * @param ApiTokenCookieFactory $cookieFactory
     */
    public function __construct(ApiTokenCookieFactory $cookieFactory)
    {
        $this->cookieFactory = $cookieFactory;
        $this->middleware('guest');
    }
    
    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        Locality::getOrMakeByKey($request->input('user.locality_key'));
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) {
                    return User::validate($data, [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required',
                        'password' => 'required',
                        'locality_key' => 'nullable',
                    ]);
                },
            ],
            
            'remember_me' => 'boolean',
        ]);
        
        $user = $this->create($input['user']);
        event(new Registered($user));
        
        if (auth()->guard() instanceof SessionGuard) {
            auth()->login($user, $input['remember_me'] ?? false);
        } else {
            auth()->setUser($user);
        }
        
        if (auth()->guard() instanceof SessionGuard) {
            return response()->resource(auth()->toArray());
        }
        
        $token = auth()->user()->createToken(config('app.name'))->accessToken;
        
        return response()->resource([
            'token' => $token,
        ]);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'locality_key' => $data['locality_key'] ?? null,
        ]);
    }
}

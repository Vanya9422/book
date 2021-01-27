<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class SessionGuard extends \Illuminate\Auth\SessionGuard
{
    public function __construct($name, UserProvider $provider, Session $session, Request $request = null)
    {
        parent::__construct($name, $provider, $session, $request);
    }
    
    public function toArray()
    {
        $auth = [];
        
        if (auth()->check()) {
            auth()->user()->load([
                'calendar_connections',
                'locality',
                'availability',
            ]);
            
            if (Str::startsWith(auth()->user()->entry_point_route, 'intro.')) {
                auth()->user()->load([
                    'booking_pages',
                ]);
            }
            
            auth()->user()->makeVisible([
                'intro_step',
                'email',
                'auth_method',
                'entry_point_route',
            ]);
            
            $auth['user'] = auth()->user()->toArray();
        }
        
        $auth['email'] = session()->get('auth.email');
        
        $auth['urls'] = [
            'google' => [
                'calendar' => google_client('calendar')->createAuthUrl(),
                'login' => google_client('login')->createAuthUrl(),
            ],
        ];
        
        return $auth;
    }
    
    public function getEmailType($email)
    {
        if (!preg_match('/@(gmail[.]com|outlook[.]com)$/', $email, $match)) {
            return null;
        }
        
        return [
            'gmail.com' => 'GOOGLE',
            // 'outlook.com' => 'OUTLOOK',
        ][$match[1]];
    }
    
    public function json()
    {
        return json_encode($this->toArray());
    }
}

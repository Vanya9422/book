<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CalendarConnection;
use App\Models\User\User;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function google(Request $request)
    {
        validator()->make($request->all(), [
            'state' => 'required|string',
            'code' => 'required|string',
        ])->validated() or abort(400, 'Bad Request');
        
        $state = json_decode(base64_decode($request->input('state')), true);
        
        validator()->make($state ?? [], [
            'action' => 'required|string',
            'locale' => 'required|string',
        ])->validated() or abort(400, 'Bad Request');
        
        if ($state['action'] == 'login') {
            $user = auth()->user();
            
            if ($user) {
                return redirect()->route($user->entry_point_route);
            }
            
            $googleClient = google_client('login');
            $googleClient->setRedirectUri(route('auth.google'));
            $googleClient->addScope('email');
            $googleClient->addScope('profile');
            $googleClient->addScope(\Google_Service_Calendar::CALENDAR);
            $googleClient->setState('login');
            
            try {
                $googleAccessToken = $googleClient->fetchAccessTokenWithAuthCode($request->input('code'));
                $googleServiceOauth2 = new \Google_Service_Oauth2($googleClient);
                $googleUser = $googleServiceOauth2->userinfo_v2_me->get();
            } catch (\Exception $exception) {
                return redirect()->to($googleClient->createAuthUrl());
            }
            
            $user = User::where('email', $googleUser->email)->first();
            
            if ($user) {
                if ($user->auth_method != User::AUTH_METHOD_GOOGLE) {
                    return redirect()->route('auth.login', $state['locale']);
                }
                
                auth()->login($user, true);
                
                return redirect()->route($user->entry_point_route);
            }
            
            try {
                $googleServiceCalendar = new \Google_Service_Calendar($googleClient);
                $calendarList = $googleServiceCalendar->calendarList->listCalendarList();
            } catch (\Exception $exception) {
                return redirect()->to($googleClient->createAuthUrl());
            }
            
            $primaryCalendarItem = collect($calendarList->items)->whereIn('accessRole', [
                'owner',
                'writer',
            ])->where('primary', true)->first();
            
            $user = User::create([
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'auth_method' => User::AUTH_METHOD_GOOGLE,
                // 'locale' => $googleUser->locale,
                'image_url' => $googleUser->picture,
            ]);
            
            $calendarConnection = new CalendarConnection;
            $calendarConnection->user_id = $user->id;
            $calendarConnection->type = CalendarConnection::TYPE_GOOGLE;
            $calendarConnection->identifier = $googleUser->email;
            $calendarConnection->access_token = $googleAccessToken;
            $calendarConnection->source_calendar_ids = [$primaryCalendarItem->id];
            $calendarConnection->destination_calendar_id = $primaryCalendarItem->id;
            $calendarConnection->save();
            auth()->login($user, true);
            
            return redirect()->route($user->entry_point_route);
        }
        
        if ($state['action'] == 'calendar') {
            $user = auth()->user();
            
            if (!$user) {
                return redirect()->route('auth.login', $state['locale']);
            }
            
            $googleClient = google_client('calendar');
            
            try {
                $googleAccessToken = $googleClient->fetchAccessTokenWithAuthCode($request->input('code'));
                $googleServiceOauth2 = new \Google_Service_Oauth2($googleClient);
                $googleUser = $googleServiceOauth2->userinfo_v2_me->get();
                $googleServiceCalendar = new \Google_Service_Calendar($googleClient);
                $calendarList = $googleServiceCalendar->calendarList->listCalendarList();
            } catch (\Exception $exception) {
                return redirect()->to($googleClient->createAuthUrl());
            }
            
            $primaryCalendarItem = collect($calendarList->items)->whereIn('accessRole', [
                'owner',
                'writer',
            ])->where('primary', true)->first();
            
            $calendarConnectionQuery = $user->calendar_connections();
            $calendarConnectionQuery->where('type', CalendarConnection::TYPE_GOOGLE);
            $calendarConnectionQuery->where('identifier', $googleUser->email);
            $calendarConnection = $calendarConnectionQuery->first();
            
            if (!$calendarConnection) {
                $calendarConnection = new CalendarConnection;
                $calendarConnection->user_id = $user->id;
                $calendarConnection->type = CalendarConnection::TYPE_GOOGLE;
                $calendarConnection->identifier = $googleUser->email;
                $calendarConnection->access_token = $googleAccessToken;
                $calendarConnection->source_calendar_ids = [$primaryCalendarItem->id];
                $calendarConnection->destination_calendar_id = $primaryCalendarItem->id;
                $calendarConnection->save();
            }
            
            if ($user->intro_step) {
                $user->intro_step = User::INTRO_STEP_CALENDAR_SETTINGS;
                $user->save();
                
                return redirect()->route('intro.calendar.settings');
            }
            
            return redirect()->route('dashboard.calendar_connections');
        }
        
        abort(400, 'Bad Request');
    }
}

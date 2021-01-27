<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\BookingPage\BookingPage;
use App\Models\CalendarConnection;
use App\Models\Geo\Locality;
use App\Models\User\User;
use App\Models\User\UserAvailability;
use Illuminate\Http\Request;

class IntroController extends Controller
{
    public function basic(Request $request)
    {
        $user = auth()->user();
        $userLocality = Locality::getOrMakeByKey($request->input('user.locality_key'));
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) use ($user) {
                    return User::validate($data, [
                        'locality_key',
                    ], [
                        'user' => $user,
                    ]);
                },
            ],
            
            'booking_page' => [
                'required|array',
                
                function ($data) use ($user) {
                    return BookingPage::validate($data, [
                        'slug' => 'required',
                    ], [
                        'booking_page' => $user->booking_pages[0],
                    ]);
                },
            ],
        ]);
        
        if ($request->input('just_validate')) {
            return new UserResource(null);
        }
        
        $user->booking_pages[0]->fill($input['booking_page']);
        $user->booking_pages[0]->save();
        $user->fill($input['user']);
        $user->setRelation('locality', $userLocality);
        $calendarConnectionExists = $user->calendar_connections()->exists();
        $user->intro_step = ($calendarConnectionExists ? User::INTRO_STEP_CALENDAR_SETTINGS : User::INTRO_STEP_CALENDAR);
        $user->save();
        
        return new UserResource($user->makeVisible([
            'entry_point_route',
        ]));
    }
    
    public function calendar(Request $request)
    {
        $user = auth()->user();
        
        if (!$request->input('skip')) {
            return response()->resource(null);
        }
        
        $user->intro_step = User::INTRO_STEP_AVAILABILITY;
        $user->save();
        
        return new UserResource($user->makeVisible([
            'entry_point_route',
        ]));
    }
    
    public function calendarSettings(Request $request)
    {
        $user = auth()->user();
        
        if (!$request->input('skip')) {
            $input = $request->validate([
                'calendar_connection' => [
                    'required|array',
                    
                    function ($data) {
                        return CalendarConnection::validate($data, [
                            'source_calendar_ids' => 'present',
                            'destination_calendar_id' => 'present',
                        ]);
                    },
                ],
            ]);
            
            $firstCalendarConnection = $user->calendar_connections()->first();
            $firstCalendarConnection->fill($input['calendar_connection']);
            $firstCalendarConnection->save();
        }
        
        $user->intro_step = User::INTRO_STEP_AVAILABILITY;
        $user->save();
        
        return new UserResource($user->makeVisible([
            'entry_point_route',
        ]));
    }
    
    public function availability(Request $request)
    {
        $user = auth()->user();
        
        if (!$request->input('skip')) {
            $input = $request->validate([
                'user_availability' => [
                    'required|array',
                    
                    function ($data) {
                        return UserAvailability::validate($data, [
                            'hour_from' => 'required',
                            'hour_to' => 'required',
                            'monday' => 'required',
                            'tuesday' => 'required',
                            'wednesday' => 'required',
                            'thursday' => 'required',
                            'friday' => 'required',
                            'saturday' => 'required',
                            'sunday' => 'required',
                        ]);
                    },
                ],
            ]);
            
            $user->availability->fill($input['user_availability']);
            $user->availability->save();
            
            foreach ($user->booking_pages[0]->booking_types as $bookingType) {
                $bookingType->setRulesFromUserAvailability($user->availability);
            }
        }
        
        $user->intro_step = User::INTRO_STEP_ROLE;
        $user->save();
        
        return new UserResource($user->makeVisible([
            'entry_point_route',
        ]));
    }
    
    public function role(Request $request)
    {
        $user = auth()->user();
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) {
                    return User::validate($data, [
                        'role' => 'required',
                    ]);
                },
            ],
        ]);
        
        $user->fill($input['user']);
        $user->intro_step = null;
        $user->save();
        
        return new UserResource($user->makeVisible([
            'entry_point_route',
        ]));
    }
}

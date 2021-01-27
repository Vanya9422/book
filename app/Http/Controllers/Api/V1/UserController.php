<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingPageCollectionResource;
use App\Http\Resources\TeamCollectionResource;
use App\Http\Resources\UserResource;
use App\Models\BookingPage\BookingPage;
use App\Models\Geo\Locality;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * @group Users
 */
class UserController extends Controller
{
    /**
     * Get
     * Get User by ID (or `me` for authenticated User)
     *
     * @urlParam user_id required User ID (or `me` string)
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User\User
     *
     * @param Request $request
     * @param $userId
     * @return null
     */
    public function get(Request $request, $userId)
    {
        $user = ($userId == 'me') ? auth()->user() ?? abort(401) : User::findOrFail($userId);
        
        return new UserResource($user);
    }
    
    /**
     * Update
     * Update User by ID (or `me` for authenticated User)
     *
     * @authenticated
     * @urlParam user_id required User ID (or `me` string) Example: me
     * @bodyParam user object required User
     * @bodyParam user.email email Email Example: test@email.com
     * @bodyParam user.first_name string First Name Example: Joe
     * @bodyParam user.last_name string Last Name Example: Doe
     * @bodyParam user.locale string Locale Example: en
     * @bodyParam user.date_format string Date Format Example: 24H
     * @bodyParam user.time_format string Time Format Example: AMERICAN
     * @bodyParam user.locality_key string Locality Key Example: ChIJDbdkHFQayUwR7-8fITgxTmU
     * @bodyParam user.avatar_file file Avatar File
     * @bodyParam user.title string Title Example: Full-Stuck Developer
     * @bodyParam user.workplace_name string Workplace Name Example: Bookify INC.
     * @bodyParam user.workplace_website_url url Workplace Website Url Example: https://www.bookify.ai/
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User\User
     *
     * @param Request $request
     * @param $userId
     * @return |null
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     */
    public function update(Request $request, $userId)
    {
        $this->middleware('logged_in_only');
        $user = ($userId == 'me') ? auth()->user() ?? abort(401) : User::findOrFail($userId);
        auth()->user()->can('edit', $user) or abort(403);
        Locality::getOrMakeByKey($request->input('user.locality_key'));
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) use ($user) {
                    return User::validate($data, null, [
                        'user' => $user,
                    ]);
                },
            ],
        ]);
        
        if ($request->has('just_validate')) {
            return response()->resource(null);
        }
        
        if (isset($input['user.booking_page'])) {
            $user->booking_page->fill($input['user.booking_page']);
            $user->booking_page->save();
        }
        
        $user->fill($input['user']);
        $user->save();
        
        if (Arr::has($input, 'user.avatar_file')) {
            $user->clearMediaCollection('avatars');
            
            if (Arr::get($input, 'user.avatar_file') && Arr::get($input, 'user.avatar_file')->isValid()) {
                $user->addMedia($input['user']['avatar_file'])->toMediaCollection('avatars');
            }
        }
        
        return response()->resource($user);
    }
    
    /**
     * Change email
     * Change User email by User ID (or `me` for authenticated User)
     *
     * @authenticated
     * @urlParam user_id required User ID (or `me` string)
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User\User
     *
     * @param Request $request
     * @param $userId
     * @return UserResource|null
     */
    public function changeEmail(Request $request, $userId)
    {
        $this->middleware('logged_in_only');
        $user = ($userId == 'me') ? auth()->user() ?? abort(401) : User::findOrFail($userId);
        auth()->user()->can('edit', $user) or abort(403);
        
        $input = $request->validate([
            'user' => [
                'required|array',
                
                function ($data) use ($user) {
                    return User::validate($data, [
                        'current_password' => 'required',
                        'email' => 'required',
                    ], [
                        'user' => $user,
                    ]);
                },
            ],
        ]);
        
        if ($request->input('just_validate')) {
            return response()->resource();
        }
        
        $user->fill($input['user']);
        $user->save();
        
        return new UserResource($user->makeVisible([
            'email',
        ]));
    }
    
    /**
     * Get BookingPages
     * Get BookingPages of this User
     *
     * @urlParam user_id required User ID (or `me`) Example: 83
     * @apiResourceCollection App\Http\Resources\BookingPageCollectionResource
     * @apiResourceModel App\Models\BookingPage
     *
     * @param Request $request
     * @param $userId
     * @return |null
     */
    
    public function bookingPages(Request $request, $userId)
    {
        $user = ($userId == 'me') ? auth()->user() ?? abort(401) : User::findOrFail($userId);
        auth()->user()->can('access', $user) or abort(403);
        $bookingPageQuery = BookingPage::query();
        $bookingPageQuery->where('parent_booking_page_id', null);
        $bookingPageQuery->join('booking_page_members', 'booking_page_members.booking_page_id', '=', 'booking_pages.id');
        $bookingPageQuery->where('booking_page_members.user_id', $user->id);
        
        $bookingPageQuery->with([
            'booking_types',
        ]);
        
        $bookingPages = $bookingPageQuery->get();
        
        return new BookingPageCollectionResource($bookingPages);
    }
    
    /**
     * Get Teams
     * Get Teams where this User is member
     *
     * @urlParam user_id required User ID (or `me`) Example: 83
     * @apiResourceCollection App\Http\Resources\TeamCollectionResource
     * @apiResourceModel App\Models\BookingPage
     *
     * @param Request $request
     * @param $userId
     * @return TeamCollectionResource
     */
    public function teams(Request $request, $userId)
    {
        $user = ($userId == 'me') ? auth()->user() ?? abort(401) : User::findOrFail($userId);
        auth()->user()->can('access', $user) or abort(403);
        $teamQuery = $user->teams();
        $teams = $teamQuery->get();
        
        return new TeamCollectionResource($teams);
    }
}

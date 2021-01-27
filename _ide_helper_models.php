<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Booking{
/**
 * App\Models\Booking\Booking
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $name
 * @property int $booker_user_id
 * @property int $bookee_user_id
 * @property int $duration
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $questions
 * @property string|null $answers
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereAnswers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereBookeeUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereBookerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereQuestions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Booking\Booking whereUpdatedAt($value)
 */
	class Booking extends \Eloquent {}
}

namespace App\Models\BookingPage{
/**
 * App\Models\BookingPage\BookingPage
 *
 * @property int $id
 * @property int|null $parent_booking_page_id
 * @property int $owner_user_id
 * @property int $assigned_user_id
 * @property string $slug
 * @property string|null $title
 * @property bool $use_user_name_as_title
 * @property bool $use_user_avatar_as_user_avatar
 * @property string $welcome_message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User\User $assigned_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingType[] $booking_types
 * @property-read int|null $booking_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingType[] $child_booking_pages
 * @property-read int|null $child_booking_pages_count
 * @property-read mixed $computed_title
 * @property-read mixed $computed_user_avatar
 * @property-read mixed $logo
 * @property-read mixed $user_avatar
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\BookingPage\BookingPage|null $parent_booking_page
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereAssignedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereOwnerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereParentBookingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereUseUserAvatarAsUserAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereUseUserNameAsTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPage whereWelcomeMessage($value)
 */
	class BookingPage extends \Eloquent {}
}

namespace App\Models\BookingPage{
/**
 * App\Models\BookingPage\BookingPageMember
 *
 * @property int $id
 * @property int $booking_page_id
 * @property int $user_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereBookingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingPage\BookingPageMember whereUserId($value)
 */
	class BookingPageMember extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingType
 *
 * @property int $id
 * @property int $booking_page_id
 * @property int $is_template
 * @property string $type
 * @property string $slug
 * @property string $name
 * @property string|null $description
 * @property string $locale
 * @property string $period_type
 * @property int $duration
 * @property string $color
 * @property int|null $max_invitees
 * @property string|null $timezone_code
 * @property string $timezone_type
 * @property int|null $max_bookings_per_day
 * @property int $min_booking_time
 * @property int $max_booking_time
 * @property int $buffer_before
 * @property int $buffer_after
 * @property int $spot_step
 * @property int $autofill_invitee_information
 * @property int $allow_invitees_to_add_guests
 * @property string $invitee_name_format
 * @property string $notification_type
 * @property bool $is_cancellation_allowed
 * @property string $cancellation_policy_text
 * @property bool $is_invitee_reminder_enabled
 * @property bool $is_invitee_sms_reminder_enabled
 * @property bool $is_invitee_email_follow_up_enabled
 * @property mixed|null $start_date
 * @property mixed|null $end_date
 * @property bool $is_public
 * @property bool $is_active
 * @property string $internal_note
 * @property string $payment_type
 * @property float|null $hourly_rate_value
 * @property string $hourly_rate_currency_code
 * @property bool $is_discount_enabled
 * @property float $discount_value
 * @property bool $discount_has_expiration
 * @property string $discount_expiration_date
 * @property bool $is_portfolio_enabled
 * @property bool $is_file_upload_enabled
 * @property string $confirmation_action_type
 * @property string $schedule_another_event_button_text
 * @property bool $is_schedule_another_event_button_shown
 * @property string|null $external_website_redirect_url
 * @property bool $pass_event_details_to_redirected_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeAppearance[] $appearances
 * @property-read int|null $appearances_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeAvailabilityRule[] $availability_rules
 * @property-read int|null $availability_rules_count
 * @property-read \App\Models\BookingPage\BookingPage $booking_page
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeCoupon[] $coupons
 * @property-read int|null $coupons_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeCustomLink[] $links
 * @property-read int|null $links_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeLocation[] $locations
 * @property-read int|null $locations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypePortfolio[] $portfolios
 * @property-read int|null $portfolios_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeQuestion[] $questions
 * @property-read int|null $questions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypeUpload[] $uploads
 * @property-read int|null $uploads_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereAllowInviteesToAddGuests($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereAutofillInviteeInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereBookingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereBufferAfter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereBufferBefore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereCancellationPolicyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereConfirmationActionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereDiscountExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereDiscountHasExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereExternalWebsiteRedirectUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereHourlyRateCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereHourlyRateValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereInternalNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereInviteeNameFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsCancellationAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsDiscountEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsFileUploadEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsInviteeEmailFollowUpEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsInviteeReminderEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsInviteeSmsReminderEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsPortfolioEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsScheduleAnotherEventButtonShown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereIsTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereMaxBookingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereMaxBookingsPerDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereMaxInvitees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereMinBookingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereNotificationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType wherePassEventDetailsToRedirectedUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType wherePaymentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType wherePeriodType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereScheduleAnotherEventButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereSpotStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereTimezoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereTimezoneType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingType whereUpdatedAt($value)
 */
	class BookingType extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeAppearance
 *
 * @property int $id
 * @property int $booking_type_id
 * @property int $is_main_photo_enabled
 * @property string $page_type
 * @property string $page_title
 * @property string $page_header
 * @property string $body_text
 * @property string $footer_text
 * @property string $main_button_text
 * @property string $main_button_color
 * @property string $main_button_text_color
 * @property string $main_text_color
 * @property string $main_font
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $photo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereBodyText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereFooterText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereIsMainPhotoEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereMainButtonColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereMainButtonText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereMainButtonTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereMainFont($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereMainTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance wherePageHeader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance wherePageTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance wherePageType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAppearance whereUpdatedAt($value)
 */
	class BookingTypeAppearance extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeAvailabilityRule
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAvailabilityRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAvailabilityRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeAvailabilityRule query()
 */
	class BookingTypeAvailabilityRule extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeCoupon
 *
 * @property int $id
 * @property int $booking_type_id
 * @property int $is_enable
 * @property string $name
 * @property string $code
 * @property float $discount_value
 * @property int $has_expiration
 * @property string|null $expiration_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereDiscountValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereHasExpiration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereIsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCoupon whereUpdatedAt($value)
 */
	class BookingTypeCoupon extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeCustomLink
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $title
 * @property string $url
 * @property int $is_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeCustomLink whereUrl($value)
 */
	class BookingTypeCustomLink extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeLocation
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $type
 * @property string|null $basic_information
 * @property string|null $additional_information
 * @property string|null $call_type
 * @property bool $is_hidden
 * @property float $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereAdditionalInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereBasicInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereCallType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereIsHidden($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeLocation whereUpdatedAt($value)
 */
	class BookingTypeLocation extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypePortfolio
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $name
 * @property int $position
 * @property int $is_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingTypePortfolioPhoto[] $photos
 * @property-read int|null $photos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolio whereUpdatedAt($value)
 */
	class BookingTypePortfolio extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypePortfolioPhoto
 *
 * @property int $id
 * @property int $booking_type_portfolio_id
 * @property string|null $title
 * @property string|null $description
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $photo
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereBookingTypePortfolioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypePortfolioPhoto whereUpdatedAt($value)
 */
	class BookingTypePortfolioPhoto extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeQuestion
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $title
 * @property string $answer_type
 * @property array|null $answer_options
 * @property int $other_option_allowed
 * @property float $position
 * @property int $is_required
 * @property int $is_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereAnswerOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereAnswerType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereOtherOptionAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeQuestion whereUpdatedAt($value)
 */
	class BookingTypeQuestion extends \Eloquent {}
}

namespace App\Models\BookingType{
/**
 * App\Models\BookingType\BookingTypeUpload
 *
 * @property int $id
 * @property int $booking_type_id
 * @property string $upload_box_text
 * @property string $upload_box_description
 * @property string $title
 * @property string $description
 * @property int $is_enabled
 * @property int $is_required
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereBookingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereIsEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereUploadBoxDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookingType\BookingTypeUpload whereUploadBoxText($value)
 */
	class BookingTypeUpload extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CalendarConnection
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string $identifier
 * @property array $access_token
 * @property array $source_calendar_ids
 * @property string|null $destination_calendar_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $calendars
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereDestinationCalendarId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereIdentifier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereSourceCalendarIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CalendarConnection whereUserId($value)
 */
	class CalendarConnection extends \Eloquent {}
}

namespace App\Models\Geo{
/**
 * App\Models\Geo\Country
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 * @property string $alpha2_code
 * @property string $alpha3_code
 * @property array $calling_codes
 * @property int|null $phone_code
 * @property string|null $phone_number_mask
 * @property array $top_level_domains
 * @property string|null $capital
 * @property array $alt_spellings
 * @property string|null $region
 * @property string|null $subregion
 * @property int $population
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $demonym
 * @property int|null $area
 * @property float|null $gini
 * @property array $timezones
 * @property array $borders
 * @property string|null $native_name
 * @property string|null $numeric_code
 * @property array $currency_codes
 * @property array $language_codes
 * @property string|null $cioc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Geo\CountryTranslation $relevant_translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Geo\CountryTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereAlpha2Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereAlpha3Code($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereAltSpellings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereBorders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereCallingCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereCapital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereCioc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereCurrencyCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereDemonym($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereGini($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereLanguageCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereNumericCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country wherePhoneNumberMask($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereSubregion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereTimezones($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereTopLevelDomains($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Country whereUpdatedAt($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models\Geo{
/**
 * App\Models\Geo\CountryTranslation
 *
 * @property int $id
 * @property string $country_code
 * @property string $locale
 * @property string $name
 * @property string|null $short_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\CountryTranslation whereUpdatedAt($value)
 */
	class CountryTranslation extends \Eloquent {}
}

namespace App\Models\Geo{
/**
 * App\Models\Geo\Locality
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $short_address
 * @property string $full_address
 * @property string|null $administrative_area_level_2
 * @property string|null $administrative_area_level_1
 * @property string $country_code
 * @property string|null $postal_code
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $timezone_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Geo\Country $country
 * @property-read mixed $administrative_area_level1
 * @property-read mixed $administrative_area_level2
 * @property-read \App\Models\Geo\LocalityTranslation $relevant_translation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Geo\LocalityTranslation[] $translations
 * @property-read int|null $translations_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereFullAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereShortAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereTimezoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\Locality whereUpdatedAt($value)
 */
	class Locality extends \Eloquent {}
}

namespace App\Models\Geo{
/**
 * App\Models\Geo\LocalityTranslation
 *
 * @property int $id
 * @property int $locality_id
 * @property string $locale
 * @property string $name
 * @property string $short_address
 * @property string $full_address
 * @property string|null $administrative_area_level_2
 * @property string|null $administrative_area_level_1
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereFullAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereLocalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereShortAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Geo\LocalityTranslation whereUpdatedAt($value)
 */
	class LocalityTranslation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GoogleAutocompleteQuery
 *
 * @property int $id
 * @property string $input
 * @property string|null $types
 * @property string|null $components
 * @property string|null $language
 * @property array $predictions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereComponents($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereInput($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery wherePredictions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\GoogleAutocompleteQuery whereUpdatedAt($value)
 */
	class GoogleAutocompleteQuery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IpInfoQuery
 *
 * @property int $id
 * @property string $ip
 * @property string|null $country_code
 * @property string|null $region_name
 * @property string|null $city_name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $postal_code
 * @property string|null $timezone
 * @property string|null $locality_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Geo\Locality $locality
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereCityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereLocalityKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereRegionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\IpInfoQuery whereUpdatedAt($value)
 */
	class IpInfoQuery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Language
 *
 * @property int $id
 * @property string|null $code
 * @property string $name
 * @property string|null $native_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereNativeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Language whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Language extends \Eloquent {}
}

namespace App\Models\Money{
/**
 * App\Models\Money\Currency
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereSymbol($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Money\Currency whereUpdatedAt($value)
 */
	class Currency extends \Eloquent {}
}

namespace App\Models\User{
/**
 * App\Models\User\User
 *
 * @property int $id
 * @property string|null $intro_step
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $title
 * @property string $workplace_name
 * @property string $workplace_website_url
 * @property string|null $auth_method
 * @property string|null $password
 * @property string|null $country_code
 * @property string|null $locality_key
 * @property string $locale
 * @property string $date_format
 * @property string $time_format
 * @property int $own_organization_id
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\User\UserAvailability $availability
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingPage\BookingPage[] $booking_pages
 * @property-read int|null $booking_pages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookingType\BookingType[] $booking_types
 * @property-read int|null $booking_types_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CalendarConnection[] $calendar_connections
 * @property-read int|null $calendar_connections_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read mixed $avatar
 * @property-read mixed $entry_point_route
 * @property-read mixed $full_name
 * @property-read \App\Models\Geo\Locality|null $locality
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereAuthMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCountryCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereDateFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereIntroStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereLocalityKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereOwnOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereTimeFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereWorkplaceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\User whereWorkplaceWebsiteUrl($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models\User{
/**
 * App\Models\User\UserAvailability
 *
 * @property int $id
 * @property int $user_id
 * @property int $hour_from
 * @property int $hour_to
 * @property bool $monday
 * @property bool $tuesday
 * @property bool $wednesday
 * @property bool $thursday
 * @property bool $friday
 * @property bool $saturday
 * @property bool $sunday
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereFriday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereHourFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereHourTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereMonday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereSaturday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereSunday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereThursday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereTuesday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User\UserAvailability whereWednesday($value)
 */
	class UserAvailability extends \Eloquent {}
}


<?php

namespace App\Models\Billing;

use App\Rules\PaymentMethodType;
use Illuminate\Database\Eloquent\Model;

class PayoutMethod extends Model
{
    
    const PAYOUT_PAYPAL = 'paypal';
    
    const PAYOUT_PAYONEER = 'payoneer';
    
    const PAYOUT_BANK_ACCOUNT = 'bank';
    
    const BANK_ACCOUNT_PERSONAL = 'personal';
    
    const BANK_ACCOUNT_BUSINESS = 'business';
    
    public $attributes = [
        'booking_page_id' => '',
        'type' => '',
        'bank_account_type' => '',
        'payment_email' => '',
        'bank_account_name' => '',
        'bank_account_number' => '',
        'bank_name' => '',
        'date_of_birth' => '',
        'aba_routing_number' => '',
        'transit_branch_number' => '',
        'bank_address' => '',
        'country_code' => '',
        'currency_code' => '',
    ];
    
    public $fillable = [
        'booking_page_id',
        'type',
        'bank_account_type',
        'payment_email',
        'bank_account_name',
        'bank_account_number',
        'bank_name',
        'date_of_birth',
        'aba_routing_number',
        'transit_branch_number',
        'bank_address',
        'country_code',
        'currency_code',
    ];
    
    public $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public $appends = [
        'payment_method_logo',
        'payment_type'
    ];
    
    public static $payoutMethodTypes = [
        self::PAYOUT_PAYPAL,
        self::PAYOUT_PAYONEER,
        self::PAYOUT_BANK_ACCOUNT,
    ];
    
    public static $bankAccountTypes = [
        self::BANK_ACCOUNT_PERSONAL,
        self::BANK_ACCOUNT_BUSINESS,
    ];
    
    public $images = [
        self::PAYOUT_PAYPAL => 'img/paypal.svg',
        self::PAYOUT_PAYONEER => 'img/payoneer.svg',
        self::PAYOUT_BANK_ACCOUNT => 'img/bank.svg',
    ];
    
    public function getPaymentMethodLogoAttribute()
    {
        return asset($this->images[$this->type]);
    }
    
    /**
     * Get the Payment Method type.
     *
     * @return string
     */
    public function getPaymentTypeAttribute()
    {
        return $this->type == self::PAYOUT_PAYPAL ? 'PayPal' : ucfirst($this->type);
    }
    
    public static function validate($data)
    {
        return validate($data, [
            'payment_email' => 'required|string|max:255',
            'type' => ['required|string', new PaymentMethodType(self::$payoutMethodTypes)],
            'booking_page_id' => 'required|exists:booking_pages,id',
            'bank_account_type' => ['required|string', new PaymentMethodType(self::$bankAccountTypes)],
            'bank_account_name' => 'required|string|max:255',
            'bank_account_number' => 'required|integer',
            'bank_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'aba_routing_number' => 'required|integer',
            'transit_branch_number' => 'required|integer',
            'bank_address' => 'required|string|max:1000',
            'account_details_confirm' => 'required|boolean',
            // 'country_code' => 'required|string|max:255',
        ]);
    }
}

<?php

namespace App\Rules;

use App\Models\Billing\PayoutMethod;
use Illuminate\Contracts\Validation\Rule;

class PayoutMethodType implements Rule
{
    
    private $types;
    
    /**
     * Create a new rule instance.
     *
     * @param $payoutMethodTypes
     */
    public function __construct($payoutMethodTypes)
    {
        $this->types = $payoutMethodTypes;
    }
    
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, $this->types);
    }
    
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

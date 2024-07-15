<?php

namespace App\Rules;

use App\Helpers\CardHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Log;

class ValidateCard implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
            if (!CardHelper::isValid($value)) {
                $fail('card_number', 'The card number is invalid.');
            }

    }
}

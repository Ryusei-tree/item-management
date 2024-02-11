<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class JanCodeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!($value && preg_match('/^([0-9]{13}|[0-9]{12}|[0-9]{8})$/', $value))) {
            $fail('EAN code must be 8, 12 or 13 characters.');
        }
    }
}

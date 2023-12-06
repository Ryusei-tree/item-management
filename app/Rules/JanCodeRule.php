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
            $fail('JANコードは13桁、8桁、もしくは12桁で入力してください。');
        }
    }
}

//---------
// 別解1  strlenを使う
//---------
// public function validate(string $attribute, mixed $value, Closure $fail): void
// {
//     if(!(strlen($value) == 13) && !(strlen($value) == 12) && !(strlen($value) == 8)) {
//         $fail('JANコードは13桁、8桁、もしくは12桁で入力してください。');
//     }
// }
<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NonEmptyArrayValue implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(str_contains($attribute,'degree')){
            $key = 'degree';
        }else if(str_contains($attribute,'gpa')){
            $key = 'gpa';
        }

        if(empty($value)){
            $fail('The '.$key.' field cannot be empty.');
        }
    }
}

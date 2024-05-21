<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BinusianValidation implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value) {
        if (strpos($value, '@binus.ac.id') !== false) {
            return true;
        }
        if (strpos($value, '@binus.edu') !== false) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message() {
        if(app()->getLocale() == 'id'){
            return 'Email-mu harus email Binus (@binus.ac.id | @binus.edu)!';
        }
        if(app()->getLocale() == 'en'){
            return 'Your Email must be a Binus email (@binus.ac.id | @binus.edu)!';
        }
        
    }
}

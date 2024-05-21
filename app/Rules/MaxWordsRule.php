<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class MaxWordsRule implements ImplicitRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(count(explode(' ', $value)) <= 1){
            return true;
        }
        return false;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if(app()->getLocale() == 'id'){
            return 'Nama depan-mu tidak boleh melebihi satu kata!';
        }
        if(app()->getLocale() == 'en'){
            return 'Your first name can\'t exceed one word!';
        }
    }
}

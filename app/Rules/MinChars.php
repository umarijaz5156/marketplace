<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinChars implements Rule
{
    private  $min_chars;
    private $isAdvanced;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min_chars = 3, $isAdvanced = null)
    {
        $this->min_chars = $min_chars;
        $this->isAdvanced = $isAdvanced;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($this->isAdvanced) {
            return strlen($value) >= $this->min_chars;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Minimum '.$this->min_chars.' characters are required.';
    }
}

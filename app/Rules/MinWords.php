<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MinWords implements Rule
{

    private  $min_words;
    private $isAdvanced;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($min_words = 5, $isAdvanced= null)
    {
        $this->min_words = $min_words;
        $this->isAdvanced  = $isAdvanced;
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
        if($this->isAdvanced)
        {
            return str_word_count($value) >= $this->min_words;
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
        return 'Minimum '.$this->min_words.' words required';
    }
}

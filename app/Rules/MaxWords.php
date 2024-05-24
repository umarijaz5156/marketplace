<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWords implements Rule
{

    private $maxWords;
    private $isAdvanced;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($max_words = 100,$isAdvanced = null)
    {
        $this->maxWords = $max_words;
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
        if($this->isAdvanced){
            return str_word_count($value) <= $this->maxWords;
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
        return 'Maximum '.$this->maxWords.' words allowed.';
    }
}

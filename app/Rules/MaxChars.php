<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxChars implements Rule
{
    private $max_chars;
    private $isAdavanced;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($max_chars = 50, $isAdavanced = null)
    {
        $this->max_chars = $max_chars;
        $this->isAdavanced = $isAdavanced;
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
        if($this->isAdavanced) {
            return strlen($value) <= $this->max_chars;
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
        return 'Maximum '.$this->max_chars.' characters are required.';
    }
}

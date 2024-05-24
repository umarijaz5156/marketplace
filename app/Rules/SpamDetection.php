<?php

namespace App\Rules;

use App\Models\MiscConfig;

class SpamDetection
{



    /**
     * Detect spam
     *
     * @param  string $body
     * @return bool
     */
    public function detect($body)
    {
        $keywords  = MiscConfig::where('name', 'spam_keywords')->first()['value'];

        $keywords = json_decode($keywords);

        foreach ($keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                // save spam in database
            
               return true;
            }
        }
        return false;
    }
}

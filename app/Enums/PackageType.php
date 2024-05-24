<?php

namespace App\Enums;

// package type enum in gig 
enum PackageType:int {
    case Basic = 0;
    case Standard = 1;
    case Advance = 2;

}
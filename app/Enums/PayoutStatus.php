<?php

namespace App\Enums;

enum PayoutStatus:int{

    case InActive = 0;
    case Pending = 1;
    case Paid =2;
    case Refunded = 3;
}
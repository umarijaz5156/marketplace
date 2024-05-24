<?php

namespace App\Enums;

enum RequestStatus:string {
    case Pending = 'Pending';
    case Accepted = 'Accepted';
    case Rejected = 'Rejected';
}
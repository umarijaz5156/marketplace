<?php

namespace App\Enums;

enum TimelineStatus:string {
    case Delivered = 'Delivered';
    case Completed = 'Completed';
    case RequestedModifcations = 'Requested Modifcations';
    case Cancelled = 'Cancelled'; 
}
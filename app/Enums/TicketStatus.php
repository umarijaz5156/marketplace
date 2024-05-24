<?php

namespace App\Enums;

enum TicketStatus:string {
    case Pending = 'Pending';
    case Resolved = 'Resolved';
    case Completed = 'Completed';
    // case Refunded = 'Refunded';
    case Cancelled = 'Cancelled';
}
<?php

namespace App\Enums;

enum OrderStatus:string {
    case InProgress = 'In Progress';
    case Delivered = 'Delivered';
    case Completed = 'Completed';
    // case Refunded = 'Refunded';
    case Pending = 'Pending';
    case Disputed = 'Disputed';
    // case InReview = 'In Review';
    case Cancelled = 'Cancelled';
    // order is yet not paid
    case UnPaid = 'UnPaid';
}

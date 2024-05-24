<?php

namespace App\Enums;

enum ReportType:string{
    case Gig = 'Gig';
    case Seller = 'Seller';
    case Review = 'Review';
    case Buyer = 'Buyer';
    case Chat = 'Chat';
}
<?php

namespace App\Enums;

enum EmailTemplateType:string {
    case OrderPlacedBuyer = 'Order placed (buyer)';
    case SellerOrderReceived = 'Seller has received a new order';
    case OrderDeliveredSeller = 'Order delivered (seller)';
    case OrderDeliveredBuyer = 'Order delivered (buyer)';
    case OrderCompletedSeller = 'Order completed (seller)';
    case OrderCompletedBuyer = 'Order completed (buyer)';
    case OrderModificationRequest = 'An order is requested modification';
    case OrderDelayed = 'Order Delayed';
    case ADayBeforeOrderDeadlineToSeller = '1 day before order deadline to seller';
    case PendingReviewForADay = ' When a review is pending on an order for 1 day';
    case UserRegistered = 'User registered';
    case SellerRegistered = 'Seller registered';
    case SellerApproved = 'Seller approved';
    case SellerDisapproved = 'Seller disapproved';
    case NewConversationGig = 'New conversation for Service';
    case NewConversationOrder = 'New conversation for order';
    case TicketUpdatedSeller = 'Ticket updated seller';
    case TicketUpdatedBuyer = 'Ticket updated buyer';
    case DisputeStarted = 'Dispute started';
    case DisputeResolved = 'Dispute resolved';
    case NewReply = 'On a new reply';
}

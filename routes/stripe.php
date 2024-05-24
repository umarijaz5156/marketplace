<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Stripe\StripeController;


Route::middleware('verified')->group(function(){
    Route::Post('/{seller}', [StripeController::class, 'redirectToStripe'])->name('stripe.redirect');

    Route::get('connect/{token}', [StripeController::class, 'connectStripe'])->name('stripe.connect');

    Route::Post('paymentIntent/{order}', [StripeController::class, 'fetchPaymentIntent'])->name('stripe.payment-intent');

    Route::get('order/{order}/checkout', [StripeController::class , 'checkoutForm'])->name('order.checkout');

    Route::post('order/success/{order}', [StripeController::class, 'successPayment'])->name('order.success');

    Route::post('order/transfer/{order}', [StripeController::class, 'transferToConnectAccount'])->name('order.transfer');

    Route::post('order/refund/{order}', [StripeController::class, 'refund'])->name('order.refund');

    Route::post('order/cancel/{order}', [StripeController::class, 'cancel'])->name('order.cancel');
});

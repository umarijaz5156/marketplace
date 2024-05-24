<?php

use Livewire\Livewire;
use App\Http\Livewire\Gigs\Create;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigController;
use App\Http\Livewire\MessageCenter\Main;
use App\Http\Livewire\Seller\Orders\Details;
use App\Http\Controllers\Seller\SellerDashboard;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Stripe\StripeController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Livewire\Seller\Orders\Index as OrdersIndex;
use App\Http\Livewire\Seller\Dispute\Index as DisputeIndex;
use App\Http\Livewire\Seller\Earnings\Index as EarningsIndex;
use App\Http\Livewire\Seller\Profile;
use App\Http\Livewire\Seller\Requests\Details as RequestsDetails;
use App\Http\Livewire\Seller\Requests\Index;

// seller routes
Route::get('/', function(){
    return redirect('/seller/dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'])->group(function() {
        Route::post('register_seller' , [SellerController::class, 'createSeller'])
        ->name('create_seller');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'isSeller',
])->group(function () {
    Route::get('/dashboard', [SellerDashboard::class, 'index'])
        ->name('seller-dashboard');

    Route::get('services/createForm', Create::class)->name('create_gig');

    Route::get('/edit/profile', Profile::class)->name('seller.edit_profile');

    Route::get('/services', [GigController::class, 'index'])
        ->name('gig_index');

    Route::get('services/edit/{id}', Create::class)->name('edit-gig');

    Route::get('/orders', OrdersIndex::class)->name('seller_orders');

    Route::get('/orders/{id}/details', Details::class)->name('order_details');

    Route::get('/disputes', DisputeIndex::class)->name('seller_disputes');

    Route::get('/disputes/{id}', DisputeIndex::class)->name('seller.dispute-details');
    Route::get('/messages', Main::class)->name('seller_messages');

    Route::get('/messages/{id}', Main::class)->name('seller.message_details');

    Route::get('/earnings', EarningsIndex::class)->name('seller.earnings');

    Route::post('/withdraw' ,[StripeController::class, 'withdraw'])->name('seller.withdraw');

    Route::get('/profile', Profile::class)->name('seller.profile');

    Route::get('/requests', Index::class)->name('seller.requests');
    Route::get('/requests/{id}', RequestsDetails::class)->name('seller.requests.details');

    // Route::get('/verify', [UserVerificationController::class, 'index'])->name('seller.verify');
});

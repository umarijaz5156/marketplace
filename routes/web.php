<?php

use App\Http\Controllers\AffiliateController;
use Illuminate\Http\Request;
use App\Http\Livewire\Search;
use App\Http\Livewire\ThankYouPage;
use App\Http\Livewire\Earnings\Index;
use App\Http\Livewire\Orders\Details;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GigController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Orders\BuyerIndex;
use App\Http\Livewire\MessageCenter\Main;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReqeustController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Livewire\Dispute\Index as DisputeIndex;
use App\Http\Controllers\Ticket\ResolutionController;
use App\Http\Controllers\UserVerificationController;
use App\Http\Livewire\Affiliate\Index as AffiliateIndex;
use App\Http\Livewire\Requests\Proposal;
use App\Http\Livewire\Requests\RequestDetails;
use App\Http\Livewire\Requests\Requests;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Mail\TestMail;
use App\Models\AffiliateUsers;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/

// email verifications link
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = AffiliateUsers::where('user_id', auth()->user()->id)->first();
    if($user && !$user->verified){
        $user->update([
            'verified' => true
        ]);

    }
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/categories/{catId}/details', [CategoryController::class, 'index'])->name('category_details');

Route::get('/analytics', function () {
    return view('analytics.index');
});

Route::get('/contact-us',  function(){
    return view('contact-us');
})->name('contact-us');

Route::get('/earnings',  Index::class)->middleware('verified');

Route::get('service/{slug}', [GigController::class, 'details'])->name('gig_details');

Route::get('/search', Search::class)->name('home.search_gigs');

Route::get('/profile/{name}', [SellerController::class, 'profileDetail'])->name('view_profile');

Route::get('/privacy-policy', function(){
    return view('policy');
})->name('privacy-policy');

Route::get('/refund-policy', function(){
    return view('refund-policy');
})->name('refund-policy');

Route::get('/terms-of-service',  function() {
    return view('terms');
})->name('terms');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::get('/seller-register', [SellerController::class, 'show'])
        ->name('seller-register');

    Route::get('/messages', Main::class)->name('message-center');
    Route::get('/messages/{id}', Main::class)->name('messages');

    Route::get('/orders', BuyerIndex::class)->name('orders');

    Route::get('/orders/{id}/details', Details::class)->name('buyerorder_details');

    Route::get('/disputes', DisputeIndex::class)->name('disputes');

    Route::get('/disputes/{id}', DisputeIndex::class)->name('dispute_details');

    Route::get('order/{id}/placed', ThankYouPage::class)->name('thank-you');
    Route::get('affiliate/index', AffiliateIndex::class)->name('affiliate.show');
    Route::get('/requests', \App\Http\Livewire\Requests\Index::class)->name('requests.index');
    Route::get('/requests/{id}/proposals', Proposal::class )->name('request.proposals');

});

Route::get('/become-seller', function () {
    return view('seller-register');
})->name('register-info');


Route::get('/send' , function(){

Mail::to('haseebbasra1@gmail.com')->send(new TestMail());

return "working";
});

// affiliate routes

Route::get('affiliate', [AffiliateController::class, 'redirect']);

Route::get('requests/{id}', RequestDetails::class)->name('requests.details');
Route::get('all-requests', Requests::class)->name('requests');


// samsub webhooks

Route::post('/verify/webhook', [UserVerificationController::class, 'webhook'])->name('verify.webhook');


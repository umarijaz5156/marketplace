<?php

use App\Http\Controllers\Admin\GigController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Livewire\Admin\Affiliate\Index as AffiliateIndex;
use App\Http\Livewire\Admin\MessageCenter\Index;
use App\Http\Livewire\Admin\Reports\Index as ReportsIndex;
use App\Http\Livewire\Admin\Revenue;
use App\Http\Livewire\Admin\Transactions;
use App\Http\Livewire\Manager\MessageCenter\Index as MessageCenterIndex;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('admin/dashboard');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Routes group than can only be accessed by 'ADMIN'
    Route::middleware([
        'isAdmin'
    ])->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin-dashboard');

        Route::get('/categories', [AdminController::class, 'viewCategories'])->name('admin.categories');
        // Route::post(('/create-category'), [AdminController::class, 'createCategory'])->name('create-category');
        Route::get(('/users'), [AdminController::class, 'manageUsers'])->name('admin.users');
        Route::get(('/sellers'), [AdminController::class, 'manageSellers'])->name('admin.sellers');
        Route::get('/configs', [AdminController::class, 'configs'])->name('admin.configs');
        Route::post('/update-config-basic', [AdminController::class, 'updateConfigBasic'])->name('submit_config_basic_form');

        Route::get('/service/{gigId}/view', [GigController::class, 'viewGigDetail'])->name('admin.gig-detail');
        Route::get(('/services'), [GigController::class, 'manageGigs'])->name('admin.gigs');
        Route::get('/services/create-gig', [GigController::class, 'gigCreate'])->name('admin.gig');

        Route::get('/services/edit/{id}', [GigController::class, 'gigCreate'])->name('admin.edit-gig');

        Route::get('/email-configs', [AdminController::class, 'emailConfig'])->name('admin.email-config');


        Route::get('/revenue', Revenue::class)->name('admin.revenue');

        Route::get('/message-center', Index::class)->name('admin.message-center');


        Route::get('/reports', ReportsIndex::class)->name('admin.reports');

        Route::get('/affiliate', AffiliateIndex::class)->name('admin.affiliate');
    });

    // Routes group that accessed by both 'ADMIN And Ticket Manager'
    Route::middleware([
        'isAdminOrTicketManager'
    ])->group(function () {
        Route::get('/ticket-management', [TicketController::class, 'index'])->name('admin.ticket-management');
        Route::get('/ticket-management/{ticketId}/chat', [TicketController::class, 'chat'])->name('admin.ticket_chat');
        Route::get('manager/messages/{id}', MessageCenterIndex::class)->name('manager.messages');

        Route::get('/orders', [AdminController::class, 'manageOrders'])->name('admin.orders');
        Route::get('/orders/{order}/details', [AdminController::class, 'orderDetails'])->name('admin.order_details');

        Route::get('/transactions', Transactions::class)->name('admin.transactions');
    });


});
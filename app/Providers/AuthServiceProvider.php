<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\ChatCenter\Chat;
use App\Models\Order\Order;
use App\Models\Request;
use App\Models\Seller\Seller;
use App\Models\Ticket\Ticket;
use App\Policies\ChatPolicy;
use App\Policies\OrderPolicy;
use App\Policies\RequestPolicy;
use App\Policies\SellerPolicy;
use App\Policies\TicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Chat::class => ChatPolicy::class,
        Seller::class => SellerPolicy::class,
        Order::class => OrderPolicy::class,
        Ticket::class => TicketPolicy::class,
        Request::class => RequestPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

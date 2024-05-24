<?php

namespace App\Console;

use App\Enums\OrderStatus;
use App\Models\Order\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ADayBeforeOrderDeadlineToSeller::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('order:deadline-to-seller')->daily();
        $schedule->command('order:pending-reviews')->daily();
        $schedule->command('order:delayed')->daily();
        $schedule->command('order:complete')->daily();

        $schedule->call(function () {
            // delete unpaid orders from orders
            Order::where('status', OrderStatus::UnPaid->value)->delete();
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

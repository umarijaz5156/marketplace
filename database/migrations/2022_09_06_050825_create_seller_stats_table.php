<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seller_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->decimal('money_earned')->default(0);
            $table->integer('total_orders')->default(0);
            $table->integer('orders_completed')->default(0);
            $table->integer('orders_canceled')->default(0);
            $table->integer('total_reviews')->default(0);
            $table->float('reviews_average')->default(0);
            $table->float('response_rate')->default(0);
            $table->foreign('seller_id')->references('id')
                ->on('sellers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_stats');
    }
};

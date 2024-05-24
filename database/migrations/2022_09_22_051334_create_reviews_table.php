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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('gig_id')->nullable();
            $table->unsignedBigInteger('from_user_id')->nullable();
            $table->unsignedBigInteger('to_user_id')->nullable();
            $table->float('rating');
            $table->string('review',1000);
            $table->string('review_type');
            $table->boolean('is_approved')->default(false);
            $table->foreign('gig_id')->references('id')
                ->on('gigs')
                ->nullOnDelete();
            $table->foreign('from_user_id')->references('id')
                ->on('common_database.users')
                ->nullOnDelete();
            $table->foreign('to_user_id')->references('id')
                ->on('common_database.users')
                ->nullOnDelete();
            $table->foreign('order_id')->references('id')
                ->on('orders')
                ->nullOnDelete();
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
        Schema::dropIfExists('reviews');
    }
};

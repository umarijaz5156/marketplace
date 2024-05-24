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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->string('subject');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('ticket_manager_id')->nullable();
            $table->string('ticket_winner')->default('Pending');
            $table->foreign('order_id')->references('id')->on('orders')->nullOnDelete();
            $table->foreign('buyer_id')->references('id')->on('common_database.users')->nullOnDelete();
            $table->foreign('seller_id')->references('id')->on('common_database.users')->nullOnDelete();
            $table->foreign('ticket_manager_id')->references('id')->on('common_database.users')->nullOnDelete();
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
        Schema::dropIfExists('tickets');
    }
};

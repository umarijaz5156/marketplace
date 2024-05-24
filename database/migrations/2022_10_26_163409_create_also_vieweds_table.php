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
        Schema::create('also_vieweds', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_rating')->default(1);
            $table->integer('gig_rating')->default(1);
            $table->integer('gig_orders')->default(1);
            $table->integer('seller_orders')->default(1);
            $table->dateTime('seller_reg_date')->nullable();
            $table->dateTime('gig_add_date')->nullable();
            $table->integer('gigs_limit')->default(4);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('also_vieweds');
    }
};

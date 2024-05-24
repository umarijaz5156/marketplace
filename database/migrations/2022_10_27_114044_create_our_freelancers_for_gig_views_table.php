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
        Schema::create('our_freelancers_for_gig_views', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_rating')->default(1);
            $table->integer('seller_orders')->default(1);
            $table->dateTime('seller_reg_date')->nullable();
            $table->integer('limit')->default(4);
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
        Schema::dropIfExists('our_freelancers_for_gig_views');
    }
};

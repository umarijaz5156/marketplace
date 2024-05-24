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
        Schema::create('gig_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gig_id');
            $table->integer('order_count')->default(0);
            $table->integer('order_cancelled')->default(0);
            $table->integer('order_completed')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->float('reviews_average')->default(0);
            $table->decimal('money_earned')->default(0);
            $table->foreign('gig_id')->references('id')
                ->on('gigs')
                ->cascadeOnDelete();
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
        Schema::dropIfExists('gig_stats');
    }
};

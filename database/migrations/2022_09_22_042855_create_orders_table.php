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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gig_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('solved_by')->nullable();
            $table->boolean('has_attachments')->default(false);
            $table->string('status');
            $table->foreign('gig_id')->references('id')->on('gigs')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('common_database.users')->nullOnDelete();
            $table->foreign('seller_id')->references('id')->on('sellers')->nullOnDelete();
            $table->foreign('solved_by')->references('id')->on('common_database.users')->nullOnDelete();

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
        Schema::dropIfExists('orders');
    }
};

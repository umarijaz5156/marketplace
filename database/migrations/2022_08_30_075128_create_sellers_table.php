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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('seller_name')->unique();

            $table->string('stripe_connect_id')->nullable();
            $table->string('stripe_onboarded')->default(0);

            $table->boolean('is_approved')->default(false);
            $table->integer('gigs_count')->default(0);
            $table->integer('seller_level')->default(0);
            $table->dateTime('joined_on', $precision=0)->useCurrent();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('common_database.users')
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
        Schema::dropIfExists('sellers');
    }
};

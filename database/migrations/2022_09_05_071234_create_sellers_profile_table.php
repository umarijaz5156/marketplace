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
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('description', 1000)->nullable();
            $table->string('address_line1', 500)->nullable();
            $table->string('address_line2', 500)->nullable();
            $table->string('phone');
            $table->unsignedBigInteger('seller_id')->unique();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('seller_id')->references('id')
                ->on('sellers')
                ->cascadeOnDelete();
            $table->foreign('country_id')->references('id')
                ->on('countries')
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
        Schema::dropIfExists('sellers_profile');
    }
};

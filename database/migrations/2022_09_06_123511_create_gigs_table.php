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
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->boolean('is_approved')->default(0);
            $table->integer('package_type')->nullable();
            $table->foreign('seller_id')->references('id')
                ->on('sellers')
                ->cascadeOnDelete();
            $table->foreign('edited_by')->references('id')->on('common_database.users')->cascadeOnDelete();
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
        Schema::dropIfExists('gigs');
    }
};

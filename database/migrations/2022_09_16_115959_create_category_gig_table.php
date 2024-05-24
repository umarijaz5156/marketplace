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
        Schema::create('category_gig', function (Blueprint $table) {
            $table->id();
            $table->integer('level');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('gig_id')->nullable();
            $table->foreign('category_id')
                ->references('id') 
                ->on('categories')
                ->nullOnDelete();
                $table->foreign('gig_id')
                ->references('id') 
                ->on('gigs')
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
        Schema::dropIfExists('category_gig');
    }
};

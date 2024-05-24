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
        Schema::create('config_home', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('header_image');
            $table->integer('status1')->default(0);
            $table->string('category_ids')->nullable();
            $table->integer('popular_categories_filter')->default(0);
            $table->integer('status2')->default(0);
            $table->string('market_place_manual_categories')->nullable();
            $table->integer('market_place_filter')->default(0);
            $table->integer('status3')->default(0);
            $table->string('seller_ids')->nullable();
            $table->integer('seller_filter')->default(0);
            $table->integer('status4')->default(0);
            $table->string('gig_ids')->nullable();
            $table->integer('gigs_filter')->default(0);
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
        Schema::dropIfExists('config_homes');
    }
};
